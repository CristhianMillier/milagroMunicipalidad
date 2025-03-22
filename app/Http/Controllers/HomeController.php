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

            /**$rol = $roles[0];*/
            $rol = $roles->first(); 

            // Si el usuario no tiene rol, redirige o maneja el error
            if (!$rol) {
                Auth::logout();
                return redirect()->route('login')->withErrors(['error' => 'Usuario sin rol asignado']);
            }
            
            /**$nusers = count(User::all());
            $ncargos = count(Cargo::all());
            $ncontratos = count(Contrato::all());
            $nlaborales = count(Regimene::all()->where('nombre','REG LAB'));
            $nremuneraciones = count(Regimene::all()->where('nombre','NIVEL REM'));
            $npersonas = count(Persona::all());
            $ntipoplantillas = count(Tipo_plantilla::all());
            $nplantillas = count(Plantilla::all());
            $nroles = count(Role::all());**/

            $nusers = User::count();
            $ncargos = Cargo::count();
            $ncontratos = Contrato::count();
            $nlaborales = Regimene::where('nombre', 'REG LAB')->count();
            $nremuneraciones = Regimene::where('nombre', 'NIVEL REM')->count();
            $npersonas = Persona::count();
            $ntipoplantillas = Tipo_plantilla::count();
            $nplantillas = Plantilla::count();
            $nroles = Role::count();

            /**$query = Plantilla::select('mes', DB::raw('SUM(monto_total) as total_monto'))
            ->where('anio', '=', DB::raw('CAST(YEAR(NOW()) AS CHAR)'))
            ->groupBy('mes', 'anio')
            ->get();*/
       

            $query = Plantilla::select('mes', DB::raw('SUM(monto_total) as total_monto'))
            ->where('anio', date('Y'))
            ->groupBy('mes')
            ->get();


            return view('dashboard.index',compact('nusers', 'ncargos', 'ncontratos', 'nlaborales', 'nremuneraciones', 'npersonas', 
                'ntipoplantillas', 'nplantillas', 'nroles', 'rol', 'query'));
        } else{
            return redirect()->route('login');
        }
    }
}