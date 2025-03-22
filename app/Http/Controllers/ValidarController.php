<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantilla;
use App\Models\Habere;
use App\Models\Descuento;
use App\Models\Aporte;

class ValidarController extends Controller
{
    public function buscarExistente($persona, $mes, $anio, $tipPlant){
        $plantillaIds = Plantilla::join('haberes as h', 'plantillas.id', '=', 'h.plantilla_id')
        ->where('h.persona_id', $persona)
        ->where('plantillas.mes', $mes)
        ->where('plantillas.anio', $anio)
        ->where('plantillas.tipo_plantilla_id', $tipPlant)
        ->pluck('plantillas.id')->first();

        return response()->json([
            'id' => $plantillaIds
        ]);
    }

    public function buscarValores($persona, $mes, $anio){
        $meses = array(
            'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
        );
        if ($mes == 'ENERO'){
            $newMes = 'DICIEMBRE';
        } else{
            $posicion = array_search($mes, $meses);
            $newMes = $meses[$posicion- 1];
        }

        $anioNum = date('Y');
        if ($anioNum != $anio){
            $anio -= 1;
        }

        $haberes = Habere::join('plantillas as p', 'haberes.plantilla_id', '=', 'p.id')
        ->where('haberes.persona_id', $persona)
        ->where('p.mes', $newMes)
        ->where('p.anio', $anio)
        ->select('haberes.nombre', 'haberes.monto')->get();

        $descuentos = Descuento::join('plantillas as p', 'descuentos.plantilla_id', '=', 'p.id')
        ->where('descuentos.persona_id', $persona)
        ->where('p.mes', $newMes)
        ->where('p.anio', $anio)
        ->select('descuentos.nombre', 'descuentos.monto')->get();

        $aportes = Aporte::join('plantillas as p', 'aportes.plantilla_id', '=', 'p.id')
        ->where('aportes.persona_id', $persona)
        ->where('p.mes', $newMes)
        ->where('p.anio', $anio)
        ->select('aportes.nombre', 'aportes.monto')->get();

        return response()->json([
            'haberes' => $haberes,
            'descuentos' => $descuentos,
            'aportes' => $aportes
        ]);
    }
}