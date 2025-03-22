<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo_plantilla;
use App\Http\Requests\StoreTipoplantillaRequest;
use App\Http\Requests\UpdateTipoplantillaRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class TipoplantillaController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Tipos-Plantillas|Crear-Tipo-Plantilla|Editar-Tipo-Plantilla|Eliminar-Tipo-Plantilla',['only'=>['index']]);
        $this->middleware('permission:Crear-Tipo-Plantilla',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Tipo-Plantilla',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Tipo-Plantilla',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipoplantillas = Tipo_plantilla::all();
        return view('tipoplantilla.index')->with('tipoplantillas', $tipoplantillas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipoplantilla.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTipoplantillaRequest $request)
    {
        try{
            DB::beginTransaction();
            $tipo = Tipo_plantilla::create($request->validated());
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('tipoplantillas.index')->with('success', 'Tipo de Plantilla registrado');
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
    public function edit(Tipo_plantilla $tipoplantilla)
    {
        return view('tipoplantilla.edit')->with('tipoplantilla', $tipoplantilla);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTipoplantillaRequest $request, Tipo_plantilla $tipoplantilla)
    {
        Tipo_plantilla::where('id', $tipoplantilla->id)
        ->update($request->validated());

        return redirect()->route('tipoplantillas.index')->with('success', 'Tipo de Plantilla editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $tipo = Tipo_plantilla::find($id);
        if ($tipo->estado == 1){
            Tipo_plantilla::where('id', $tipo->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Tipo de Plantilla eliminado';
        } else{
            Tipo_plantilla::where('id', $tipo->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Tipo de Plantilla restaurado';
        }

        return redirect()->route('tipoplantillas.index')->with('success', $message);
    }
}