<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Regimene;
use App\Models\Contrato;
use App\Models\Cargo;
use Exception;
use DateTime;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdatePersonaRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class PersonaController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Personas|Crear-Persona|Editar-Persona|Eliminar-Persona',['only'=>['index']]);
        $this->middleware('permission:Crear-Persona',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Persona',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Persona',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personas = Persona::with('cargo', 'regimene', 'contrato')->latest()->get();
        return view('personal.index')->with('personas', $personas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regimenes = Regimene::all()->where('estado', 1);
        $contratos = Contrato::all()->where('estado', 1);
        $cargos = Cargo::all()->where('estado', 1);
        return view('personal.create',compact('regimenes', 'contratos', 'cargos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        try{
            DB::beginTransaction();
            $persona = new Persona;
            $dateFechaNacimiento = DateTime::createFromFormat('m/d/Y', $request->fecha_nacimiento);
            $dateFechaIngreso = DateTime::createFromFormat('m/d/Y', $request->fecha_ingreso);

            $persona->fill([
                'nombre' => $request->nombre,
                'dni' => $request->dni,
                'sistema_pension' => $request->sistema_pension,
                'tipo_sistema_pension' => $request->tipo_sistema_pension,
                'cusp' => $request->cusp,
                'fecha_nacimiento' => $dateFechaNacimiento->format('Y-m-d'),
                'fecha_ingreso' => $dateFechaIngreso->format('Y-m-d'),
                'cargo_id' => $request->cargo_id,
                'regimene_id' => $request->regimene_id,
                'contrato_id' => $request->contrato_id
            ]);
            $persona->save();
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('personas.index')->with('success', 'Trabajador Registrado');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Persona $persona)
    {
        $persona->load('regimene', 'cargo', 'contrato');
        $regimenes = Regimene::all()->where('estado', 1);
        $contratos = Contrato::all()->where('estado', 1);
        $cargos = Cargo::all()->where('estado', 1);
        return view('personal.edit',compact('regimenes', 'contratos', 'cargos', 'persona'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonaRequest $request, Persona $persona)
    {
        try{
            DB::beginTransaction();
            $dateFechaNacimiento = DateTime::createFromFormat('m/d/Y', $request->fecha_nacimiento);
            $dateFechaIngreso = DateTime::createFromFormat('m/d/Y', $request->fecha_ingreso);

            $persona->fill([
                'nombre' => $request->nombre,
                'dni' => $request->dni,
                'sistema_pension' => $request->sistema_pension,
                'tipo_sistema_pension' => $request->tipo_sistema_pension,
                'cusp' => $request->cusp,
                'fecha_nacimiento' => $dateFechaNacimiento->format('Y-m-d'),
                'fecha_ingreso' => $dateFechaIngreso->format('Y-m-d'),
                'cargo_id' => $request->cargo_id,
                'regimene_id' => $request->regimene_id,
                'contrato_id' => $request->contrato_id
            ]);
            $persona->update();
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('personas.index')->with('success', 'Trabajador Editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $persona = Persona::find($id);
        if ($persona->estado == 1){
            Persona::where('id', $persona->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Trabajador Eliminado';
        } else{
            Persona::where('id', $persona->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Trabajador Restaurado';
        }

        return redirect()->route('personas.index')->with('success', $message);
    }
}