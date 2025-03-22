<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Cargo;
use App\Http\Requests\StoreCargoRequest;
use App\Http\Requests\UpdateCargoRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class CargoController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Cargos|Crear-Cargo|Editar-Cargo|Eliminar-Cargo',['only'=>['index']]);
        $this->middleware('permission:Crear-Cargo',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Cargo',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Cargo',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cargos = Cargo::all();
        return view('cargo.index')->with('cargos', $cargos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cargo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCargoRequest $request)
    {
        try{
            DB::beginTransaction();
            $cargo = Cargo::create($request->validated());
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
        }

        return redirect()->route('cargos.index')->with('success', 'Cargo registrado');
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
    public function edit(Cargo $cargo)
    {
        return view('cargo.edit')->with('cargo', $cargo);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCargoRequest $request, Cargo $cargo)
    {
        Cargo::where('id', $cargo->id)
        ->update($request->validated());

        return redirect()->route('cargos.index')->with('success', 'Cargo editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $cargo = Cargo::find($id);
        if ($cargo->estado == 1){
            Cargo::where('id', $cargo->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Cargo eliminado';
        } else{
            Cargo::where('id', $cargo->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Cargo restaurado';
        }

        return redirect()->route('cargos.index')->with('success', $message);
    }
}