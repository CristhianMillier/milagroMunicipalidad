<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Contrato;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class ContratoController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Contratos|Crear-Contrato|Editar-Contrato|Eliminar-Contrato',['only'=>['index']]);
        $this->middleware('permission:Crear-Contrato',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Contrato',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Contrato',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = Contrato::all();
        return view('contrato.index')->with('contratos', $contratos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contrato.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContratoRequest $request)
    {
        try{
            DB::beginTransaction();
            $contrato = Contrato::create($request->validated());
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('contratos.index')->with('success', 'Contrato registrado');
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
    public function edit(Contrato $contrato)
    {
        return view('contrato.edit')->with('contrato', $contrato);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContratoRequest $request, Contrato $contrato)
    {                
        Contrato::where('id', $contrato->id)
        ->update($request->validated());

        return redirect()->route('contratos.index')->with('success', 'Contrato editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $contrato = Contrato::find($id);
        if ($contrato->estado == 1){
            Contrato::where('id', $contrato->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Contrato eliminado';
        } else{
            Contrato::where('id', $contrato->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Contrato restaurado';
        }

        return redirect()->route('contratos.index')->with('success', $message);
    }
}