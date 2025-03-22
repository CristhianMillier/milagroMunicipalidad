<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Plantilla;
use App\Models\Habere;
use App\Models\Aporte;
use App\Models\Descuento;
use App\Models\Persona;
use App\Models\Tipo_plantilla;
use App\Http\Requests\StorePlantillaRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use App\Exports\PlantillaExport;
use Maatwebsite\Excel\Facades\Excel;

class PlantillaController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Plantillas|Crear-Plantilla|Mostrar-Plantilla|Eliminar-Plantilla|Exportar-Plantilla',['only'=>['index']]);
        $this->middleware('permission:Crear-Plantilla',['only'=>['create', 'store']]);
        $this->middleware('permission:Mostrar-Plantilla',['only'=>['show']]);
        $this->middleware('permission:Eliminar-Plantilla',['only'=>['destroy']]);
        $this->middleware('permission:Ver-Detalle-del-Trabajador-en-la-Plantilla',['only'=>['verDetalleTrabajador']]);
        $this->middleware('permission:Eliminar-el-Trabajador-de-la-Plantilla',['only'=>['eliminarPersona']]);
        $this->middleware('permission:Exportar-Plantilla',['only'=>['exportPlantilla']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plantillas = Plantilla::with('tipo_plantilla')
        ->where('estado', 1)->latest()->get();
        return view('plantilla.index')->with('plantillas', $plantillas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $personas = Persona::all()->where('estado', 1);
        $tipo_plantillas = Tipo_plantilla::all()->where('estado', 1);
        return view('plantilla.create',compact('personas', 'tipo_plantillas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantillaRequest $request)
    {
        try{
            $plantillaExiste = Plantilla::all()->where('mes', $request->mes)->where('anio', $request->anio)->where('tipo_plantilla_id', $request->tipo_plantilla_id)->count();
            $plantilla = new Plantilla();

            $posicion_guion = strpos($request->persona_id, "-");
            DB::table('personas')->where('id', substr($request->persona_id, 0, $posicion_guion))
                ->update([
                    'dias_labor' => $request->dias_labor
            ]);
            
            if($plantillaExiste > 0){
                $plantilla = Plantilla::where('mes', $request->mes)
                    ->where('anio', $request->anio)
                    ->where('tipo_plantilla_id', $request->tipo_plantilla_id)
                    ->first();
                $monto_haberes = $plantilla->monto_haberes;
                $monto_descuentos = $plantilla->monto_descuentos;
                $monto_aportes = $plantilla->monto_aportes;
                $monto_total = $plantilla->monto_total;

                DB::table('plantillas')->where('id', $plantilla->id)
                ->update([
                    'monto_haberes' => $monto_haberes + $request->total_haberes,
                    'monto_descuentos' => $monto_descuentos + $request->total_descuentos,
                    'monto_aportes' => $monto_aportes + $request->total_aportes,
                    'monto_total' => $monto_total+ $request->importe_pago
                ]);
            } else{
                $plantilla->fill([
                    'mes' => $request->mes,
                    'anio' => $request->anio,
                    'monto_haberes' => $request->total_haberes,
                    'monto_descuentos' => $request->total_descuentos,
                    'monto_aportes' => $request->total_aportes,
                    'monto_total' => $request->importe_pago,
                    'tipo_plantilla_id' => $request->tipo_plantilla_id,
                    'user_id' => $request->user_id
                ]);
                $plantilla->save();
            }

            //Relacionamos haberes con Plantilla
            $nombreHaberes = $request->get('arraynombrehaberes');
            $montoHaberes = $request->get('arraymontohaberes');
            
            $sizeArrayHaber = count($nombreHaberes);
            $count = 0;
            while($count  < $sizeArrayHaber){
                $haber = new Habere();
                $haber->fill([
                    'nombre' => $nombreHaberes[$count],
                    'monto' => $montoHaberes[$count],
                    'fecha_hora' => $request->fecha_hora,
                    'persona_id' => substr($request->persona_id, 0, $posicion_guion),
                    'plantilla_id' => $plantilla->id
                ]);
                $haber->save();

                $count++;
            }

            //Relacionamos descuentos con Plantilla
            $nombreDescuentos = $request->get('arraynombredescuentos');
            $montoDescuentos = $request->get('arraymontodescuentos');
            
            $sizeArrayDescuento = count($nombreDescuentos);
            $count = 0;
            while($count  < $sizeArrayDescuento){
                $descuento = new Descuento();
                $descuento->fill([
                    'nombre' => $nombreDescuentos[$count],
                    'monto' => $montoDescuentos[$count],
                    'fecha_hora' => $request->fecha_hora,
                    'persona_id' => substr($request->persona_id, 0, $posicion_guion),
                    'plantilla_id' => $plantilla->id
                ]);
                $descuento->save();

                $count++;
            }

            //Relacionamos aporte con Plantilla
            $nombreAportes = $request->get('arraynombreaportes');
            $montoAportes = $request->get('arraymontoaportes');
            
            $sizeArrayAporte = count($nombreAportes);
            $count = 0;
            while($count  < $sizeArrayAporte){
                $aporte = new Aporte();
                $aporte->fill([
                    'nombre' => $nombreAportes[$count],
                    'monto' => $montoAportes[$count],
                    'fecha_hora' => $request->fecha_hora,
                    'persona_id' => substr($request->persona_id, 0, $posicion_guion),
                    'plantilla_id' => $plantilla->id
                ]);
                $aporte->save();

                $count++;
            }

            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('plantillas.index')->with('success', 'Trabajador registrado en Plantilla');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plantilla $plantilla)
    {        
        $personasPlan = Habere::join('plantillas as p', 'haberes.plantilla_id', '=', 'p.id')
        ->join('personas as per', 'haberes.persona_id', '=', 'per.id')
        ->where('haberes.plantilla_id', $plantilla->id)
        ->where('p.mes', $plantilla->mes)
        ->where('p.anio', $plantilla->anio)
        ->select('per.id')
        ->groupBy('per.id')
        ->get();
            
        return view('plantilla.show',compact('plantilla', 'personasPlan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $haberes = Habere::where('plantilla_id', $id)
        ->select('id')->get();

        $descuentos = Descuento::where('plantilla_id', $id)
        ->select('id')->get();

        $aportes = Aporte::where('plantilla_id', $id)
        ->select('id')->get();

        foreach ($haberes as $haber) {
            Habere::where('id', $haber->id)
            ->delete();
        }
        foreach ($descuentos as $descuento) {
            Descuento::where('id', $descuento->id)
            ->delete();
        }
        foreach ($aportes as $aporte) {
            Aporte::where('id', $aporte->id)
            ->delete();
        }

        Plantilla::where('id', $id)
        ->delete();

        return redirect()->route('plantillas.index')->with('success', 'La Plantila se ha elimado correctamente');
    }

    public function verDetalleTrabajador($idPer, $idPlan)
    {                    
        $persona = Persona::find($idPer);
        $plantilla = Plantilla::find($idPlan);
        
        $haberes = Habere::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('nombre', 'monto')->get();

        $descuentos = Descuento::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('nombre', 'monto')->get();

        $aportes = Aporte::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('nombre', 'monto')->get();

        return view('plantilla.detalle',compact('haberes', 'descuentos', 'aportes', 'persona', 'plantilla'));
    }

    public function eliminarPersona($idPer, $idPlan)
    {
        $haberes = Habere::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('id', 'monto')->get();

        $descuentos = Descuento::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('id', 'monto')->get();

        $aportes = Aporte::where('persona_id', $idPer)
        ->where('plantilla_id', $idPlan)
        ->select('id', 'monto')->get();

        $totalHaber = 0.0;
        $totalDescuento = 0.0;
        $totalAporte = 0.0;
        
        foreach ($haberes as $haber) {
            Habere::where('id', $haber->id)
            ->delete();
            $totalHaber += floatval($haber->monto);
        }
        foreach ($descuentos as $descuento) {
            Descuento::where('id', $descuento->id)
            ->delete();
            $totalDescuento += floatval($descuento->monto);
        }
        foreach ($aportes as $aporte) {
            Aporte::where('id', $aporte->id)
            ->delete();
            $totalAporte += floatval($aporte->monto);
        }
        $total = floatval($totalHaber) - floatval($totalDescuento);

        $plantilla = Plantilla::find($idPlan);

        DB::table('plantillas')->where('id', $idPlan)
        ->update([
            'monto_haberes' => floatval($plantilla->monto_haberes) - floatval($totalHaber),
            'monto_descuentos' => floatval($plantilla->monto_descuentos) - floatval($totalDescuento),
            'monto_aportes' => floatval($plantilla->monto_aportes) - floatval($totalAporte),
            'monto_total' => floatval($plantilla->monto_total) - floatval($total)
        ]);
        
        $personasPlan = Habere::join('plantillas as p', 'haberes.plantilla_id', '=', 'p.id')
        ->join('personas as per', 'haberes.persona_id', '=', 'per.id')
        ->where('haberes.plantilla_id', $plantilla->id)
        ->where('p.mes', $plantilla->mes)
        ->where('p.anio', $plantilla->anio)
        ->select('per.id')
        ->groupBy('per.id')
        ->get();
            
        return view('plantilla.show',compact('plantilla', 'personasPlan'));
    }

    function exportPlantilla($id){
        $plantilla = Plantilla::find($id);
        $nombre = $plantilla->tipo_plantilla->nombre . " DEL MES DE " . $plantilla->mes . " DEL " . $plantilla->anio . ".xlsx";
        return Excel::download(new PlantillaExport($id), $nombre);
    }
}