<?php

namespace App\Exports;

use App\Models\Plantilla;
use App\Models\Habere;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PlantillaExport implements FromView
{
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function view(): View
    {
        $personasPlan = Habere::join('plantillas as p', 'haberes.plantilla_id', '=', 'p.id')
        ->join('personas as per', 'haberes.persona_id', '=', 'per.id')
        ->where('haberes.plantilla_id', $this->id)
        ->select('per.id')
        ->groupBy('per.id')
        ->get();
        
        return view('plantilla.exportar', [
            'plantilla' => Plantilla::find($this->id),
            'personasPlan' => $personasPlan
        ]);
    }
}