<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Regimene;
use App\Http\Requests\StoreRemuneracionRequest;
use App\Http\Requests\UpdateRemuneracionRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class RemuneracionController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Remuneraciones|Crear-Remuneración|Editar-Remuneración|Eliminar-Remuneración',['only'=>['index']]);
        $this->middleware('permission:Crear-Remuneración',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Remuneración',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Remuneración',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regimenes = Regimene::all();
        return view('remuneracion.index')->with('regimenes', $regimenes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('remuneracion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRemuneracionRequest $request)
    {
        try{
            DB::beginTransaction();
            $remuneracone = new Regimene;

            $remuneracone->fill([
                'nombre' => 'NIVEL REM',
                'tipo_regimene' => $request->nombre
            ]);
            $remuneracone->save();

            DB::commit();
        } catch(Exception $e){
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('remuneraciones.index')->with('success', 'Nivel de Remuneración registrado');
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
    public function edit(Regimene $remuneracione)
    {
        return view('remuneracion.edit')->with('remuneracione', $remuneracione);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRemuneracionRequest $request, Regimene $remuneracione)
    {
        DB::table('regimenes')->where('id', $remuneracione->id)
            ->update([
                'nombre' => 'NIVEL REM',
                'tipo_regimene' => $request->nombre
        ]);

        return redirect()->route('remuneraciones.index')->with('success', 'Nivel de Remuneración editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $remuneracone = Regimene::find($id);
        if ($remuneracone->estado == 1){
            Regimene::where('id', $remuneracone->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Nivel de Remuneración eliminado';
        } else{
            Regimene::where('id', $remuneracone->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Nivel de Remuneración restaurado';
        }

        return redirect()->route('remuneraciones.index')->with('success', $message);
    }
}