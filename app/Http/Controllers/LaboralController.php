<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\Regimene;
use App\Http\Requests\StoreLaboralRequest;
use App\Http\Requests\UpdateLaboralRequest;
use Spatie\Permission\Middlewares\PermissionMiddleware;

class LaboralController extends Controller
{
    function __construct(){
        $this->middleware('permission:Ver-Laborales|Crear-Laboral|Editar-Laboral|Eliminar-Laboral',['only'=>['index']]);
        $this->middleware('permission:Crear-Laboral',['only'=>['create', 'store']]);
        $this->middleware('permission:Editar-Laboral',['only'=>['edit', 'update']]);
        $this->middleware('permission:Eliminar-Laboral',['only'=>['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regimenes = Regimene::all();
        return view('laboral.index')->with('regimenes', $regimenes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laboral.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLaboralRequest $request)
    {
        try{
            DB::beginTransaction();
            $laboral = new Regimene;

            $laboral->fill([
                'nombre' => 'REG LAB',
                'tipo_regimene' => $request->nombre
            ]);
            $laboral->save();

            DB::commit();
        } catch(Exception $e){
            dd($e);
            DB::rollBack();
        }

        return redirect()->route('laborales.index')->with('success', 'Regimen Laboral registrado');
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
    public function edit(Regimene $laborale)
    {
        return view('laboral.edit')->with('laboral', $laborale);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLaboralRequest $request, Regimene $laborale)
    {
        DB::table('regimenes')->where('id', $laborale->id)
            ->update([
                'nombre' => 'REG LAB',
                'tipo_regimene' => $request->nombre
        ]);

        return redirect()->route('laborales.index')->with('success', 'Regimen Laboral editado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $laboral = Regimene::find($id);
        if ($laboral->estado == 1){
            Regimene::where('id', $laboral->id)
            ->update([
                'estado' => 0
            ]);
            $message = 'Regimen Laboral eliminado';
        } else{
            Regimene::where('id', $laboral->id)
            ->update([
                'estado' => 1
            ]);
            $message = 'Regimen Laboral restaurado';
        }

        return redirect()->route('laborales.index')->with('success', $message);
    }
}