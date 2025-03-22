@extends('template')

@push('css')
@endpush

@section('navigation')
<h2 class="page-title ">Detalle del Trabajador en Planilla</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plantillas.index') }}">Planillas</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plantillas.show', ['plantilla'=>$plantilla]) }}">Ver
                    Planilla</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Detalle del Trabajador en Planilla
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-100 mt-4 form-group">
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                <input type="text" class="form-control" value="Trabajador:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$persona->nombre}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-regular fa-building"></i></span>
                <input type="text" class="form-control" value="Días Laborables:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$persona->dias_labor}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-user-doctor"></i></span>
                <input type="text" class="form-control" value="Sistema fondo Pensión:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            @if($persona->sistema_pension != null)
            <input type="text" class="form-control"
                value="{{$persona->sistema_pension}} - {{$persona->tipo_sistema_pension}}" disabled>
            @else
            <input type="text" class="form-control" value="----------" disabled>
            @endif
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-scale-balanced"></i></span>
                <input type="text" class="form-control" value="Régimen:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            @if($persona->regimene_id != null)
            <input type="text" class="form-control"
                value="{{$persona->regimene->nombre}} - {{$persona->regimene->tipo_regimene}}" disabled>
            @else
            <input type="text" class="form-control" value="----------" disabled>
            @endif
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-file-signature"></i></span>
                <input type="text" class="form-control" value="Contrato:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$persona->contrato->nombre}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-address-book"></i></span>
                <input type="text" class="form-control" value="Cargo:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$persona->cargo->nombre}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-hand-holding-dollar"></i></span>
                <input type="text" class="form-control" value="Importe Pagado:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="0" id="importe" disabled>
        </div>
    </div>

    <div class="form-group row">
        <div class="row g-3">
            <div class="col-md-6" id="haber">
                <div class="text-white p-1 text-center" style="background-color:#2D3135">
                    HABERES
                </div>
                <div class="p-3 border border-3 border-secondary">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top">
                                <div class="table-responsive mt-3">
                                    <table id="tablaHaberes"
                                        class="table table-striped table-bordered table-hover table-sm table-tighten">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th class="text-white">Nombre Haber</th>
                                                <th class="text-white">Monto Haber</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($haberes as $item)
                                            <tr>
                                                <th>{{ $item->nombre }}</th>
                                                <th>{{ $item->monto }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot style="background-color:#C8CBD2">
                                            <tr>
                                                <th colspan="1">R.Aseg.</th>
                                                <th colspan="0">
                                                    <spam id="total_haberes">0</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" id="descuento">
                <div class="text-white p-1 text-center" style="background-color:#2D3135">
                    DESCUENTOS
                </div>
                <div class="p-3 border border-3 border-secondary">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top">
                                <div class="table-responsive mt-3">
                                    <table id="tablaDescuentos"
                                        class="table table-striped table-bordered table-hover table-sm table-tighten">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th class="text-white">Nombre Descuento</th>
                                                <th class="text-white">Monto Descuento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($descuentos as $item)
                                            <tr>
                                                <th>{{ $item->nombre }}</th>
                                                <th>{{ $item->monto }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot style="background-color:#C8CBD2">
                                            <tr>
                                                <th colspan="1">Total Descuentos</th>
                                                <th colspan="0">
                                                    <spam id="total_descuentos">0</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6" id="aporte">
                <div class="text-white p-1 text-center" style="background-color:#2D3135">
                    APORTES DEL EMPLEADOR
                </div>
                <div class="p-3 border border-3 border-secondary">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="border-top">
                                <div class="table-responsive mt-3">
                                    <table id="tablaAportes"
                                        class="table table-striped table-bordered table-hover table-sm table-tighten">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th class="text-white">Nombre Aporte</th>
                                                <th class="text-white">Monto Aporte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($aportes as $item)
                                            <tr>
                                                <th>{{ $item->nombre }}</th>
                                                <th>{{ $item->monto }}</th>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot style="background-color:#C8CBD2">
                                            <tr>
                                                <th colspan="1">Total Aportes</th>
                                                <th colspan="0">
                                                    <spam id="total_aportes">0</span>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-md-12 text-end border-top">
        <a href="{{ route('plantillas.show', ['plantilla'=>$plantilla]) }}"><button type="button"
                class="btn btn-danger mt-3">Atras
            </button></a>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    const li = document.getElementById("plantilla-li");
    li.classList.add("sidebar-item");
    li.classList.add("selected");
    const a = document.getElementById("plantilla-a");
    a.classList.add("sidebar-link");
    a.classList.add("waves-effect");
    a.classList.add("waves-dark");
    a.classList.add("active");

    let = totalHaberes = 0;
    let = totalDescuentos = 0;
    let = totalAportes = 0;

    const haberes = @json($haberes);
    haberes.forEach(function(haber) {
        totalHaberes += parseFloat(haber.monto);
    });
    $('#total_haberes').html(totalHaberes);

    const descuentos = @json($descuentos);
    descuentos.forEach(function(descuento) {
        totalDescuentos += parseFloat(descuento.monto);
    });
    $('#total_descuentos').html(totalDescuentos);

    const aportes = @json($aportes);
    aportes.forEach(function(aporte) {
        totalAportes += parseFloat(aporte.monto);
    });
    $('#total_aportes').html(totalAportes);

    $('#importe').val(totalHaberes - totalDescuentos);
});
</script>
@endpush