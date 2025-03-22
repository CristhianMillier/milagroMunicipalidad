<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Contrato;
use App\Models\Persona;
use App\Models\Plantilla;
use App\Models\Regimene;
use App\Models\Tipo_plantilla;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()){
            $usuario = User::find(Auth::user()->id);
            $roles = $usuario->getRoleNames();
            $rol = $roles[0];
            
            $nusers = count(User::all());
            $ncargos = count(Cargo::all());
            $ncontratos = count(Contrato::all());
            $nlaborales = count(Regimene::all()->where('nombre','REG LAB'));
            $nremuneraciones = count(Regimene::all()->where('nombre','NIVEL REM'));
            $npersonas = count(Persona::all());
            $ntipoplantillas = count(Tipo_plantilla::all());
            $nplantillas = count(Plantilla::all());
            $nroles = count(Role::all());

            $query = Plantilla::select('mes', DB::raw('SUM(monto_total) as total_monto'))
            ->where('anio', '=', DB::raw('CAST(YEAR(NOW()) AS CHAR)'))
            ->groupBy('mes', 'anio')
            ->get();
       
            return view('dashboard.index',compact('nusers', 'ncargos', 'ncontratos', 'nlaborales', 'nremuneraciones', 'npersonas', 
                'ntipoplantillas', 'nplantillas', 'nroles', 'rol', 'query'));
        } else{
            return redirect()->route('login');
        }
    }
}