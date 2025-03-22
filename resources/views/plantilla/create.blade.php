@extends('template')

@push('css')
<style>
#customControlValidation1 {
    cursor: pointer;
}

#customControlValidation2 {
    cursor: pointer;
}

.requerido label:after {
    content: " *";
    color: red;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
@endpush

@section('navigation')
<h2 class="page-title ">Registro de Trabajador a la Planilla</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plantillas.index') }}">Planillas</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Registro de Trabajador a la Planilla
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('plantillas.store') }}" method="post">
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
        <div class="form-group row">
            <div class="row g-3">
                <div class="col-md-6 requerido">
                    <?php
                        $monthNum = date('n');
                        $meses = array(
                            'ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO',
                            'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'
                        );
                        $mesNombre = $meses[$monthNum- 1];
                    ?>
                    <label for="mes" class="form-label">Mes:</label>
                    <select name="mes" id="mes" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                        @foreach($meses as $mes)
                        @if ($mesNombre == $mes)
                        <option selected value="{{ $mes }}" {{ old('mes') == $mes ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                        @else
                        <option value="{{ $mes }}" {{ old('mes') == $mes ? 'selected' : '' }}>
                            {{ $mes }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('mes')
                    <small class=" text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 requerido">
                    <?php
                        $anioNum = date('Y');
                    ?>
                    <label for="anio" class="form-label">Año:</label>
                    <input type="number" name="anio" id="anio" class="form-control" autocomplete="off"
                        value="{{ old('anio', $anioNum) }}">
                    @error('anio')
                    </br>
                    <small class=" text-danger">{{'*'.$message}}</small>
                    <script>
                    const anio = document.getElementById("anio");
                    anio.classList.add("form-control");
                    anio.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <?php
                    use Carbon\Carbon;
                    $fechaHora = Carbon::now()->toDateTimeString();
                ?>
                <input type="hidden" name="fecha_hora" value="{{$fechaHora}}">

                <div class="col-md-12 mb-2 requerido">
                    <label for="tipo_plantilla_id" class="form-label">Tipo de Planilla:</label>
                    <select name="tipo_plantilla_id" id="tipo_plantilla_id" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                        @foreach($tipo_plantillas as $item)
                        <option value="{{ $item->id }}" {{ old('tipo_plantilla_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                        @endforeach
                    </select>
                    @error('tipo_plantilla_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 requerido" id="trabajador">
                    <label for="persona_id" class="form-label">Trabajador:</label>
                    <select name="persona_id" id="persona_id" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                        @foreach($personas as $item)
                        @if ($item->regimene == null)
                        <option
                            value="{{$item->id}}-{{$item->sistema_pension}}-{{$item->tipo_sistema_pension}}-a-a-{{$item->cargo->nombre}}-{{$item->contrato->nombre}}"
                            {{ old('persona_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre.'-'.$item->dni }}
                        </option>
                        @else
                        <option
                            value="{{$item->id}}-{{$item->sistema_pension}}-{{$item->tipo_sistema_pension}}-{{$item->regimene->nombre}}-{{$item->regimene->tipo_regimene}}-{{$item->cargo->nombre}}-{{$item->contrato->nombre}}"
                            {{ old('persona_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre.'-'.$item->dni }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('persona_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6 requerido" id="labor">
                    <label for="dias_labor" class="form-label">Días laborables:</label>
                    <input type="number" name="dias_labor" id="dias_labor" class="form-control"
                        value="{{ old('dias_labor', 30) }}" autocomplete="off">
                    @error('dias_labor')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const labor = document.getElementById("dias_labor");
                    labor.classList.add("form-control");
                    labor.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6" id="pension">
                    <label for="sistema_pension" class="form-label">Sistema fondo Pensión:</label>
                    <input type="text" name="sistema_pension" id="sistema_pension" class="form-control"
                        autocomplete="off" value="{{ old('sistema_pension') }}" disabled>
                </div>

                <div class="col-md-6" id="reg">
                    <label for="regimen" class="form-label">Régimen:</label>
                    <input type="text" name="regimen" id="regimen" class="form-control" autocomplete="off"
                        value="{{ old('regimen') }}" disabled>
                </div>

                <div class="col-md-6" id="con">
                    <label for="contrato" class="form-label">Contrato:</label>
                    <input type="text" name="contrato" id="contrato" class="form-control" autocomplete="off"
                        value="{{ old('contrato') }}" disabled>
                </div>

                <div class="col-md-6" id="car">
                    <label for="cargo" class="form-label">Cargo:</label>
                    <input type="text" name="cargo" id="cargo" class="form-control" autocomplete="off"
                        value="{{ old('cargo') }}" disabled>
                </div>

                <div class="col-md-12" id="pago">
                    <label for="importe_pago" class="form-label">Importe Pagado:</label>
                    <input type="number" name="importe_pago" id="importe_pago" class="form-control" autocomplete="off"
                        value="{{ old('importe_pago') }}" readonly>
                    @error('importe_pago')
                    </br>
                    <small class=" text-danger">{{'*'.$message}}</small>
                    <script>
                    const importe_pago = document.getElementById("importe_pago");
                    importe_pago.classList.add("form-control");
                    importe_pago.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6" id="haber">
                    <div class="text-white bg-secondary p-1 text-center">
                        HABERES
                    </div>
                    <div class="p-3 border border-3 border-secondary">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="nombre_habere" class="form-label">Nombre:</label>
                                <input type="text" name="nombre_habere" id="nombre_habere" class="form-control"
                                    autocomplete="off" value="{{old('nombre_habere')}}" step="1">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="monto_habere" class="form-label">Monto:</label>
                                <input type="number" name="monto_habere" id="monto_habere" class="form-control"
                                    autocomplete="off" value="{{old('monto_habere')}}" step="1">
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="button" id="agregar" class="btn btn-outline-secondary mt-3"
                                    onclick="agregarHaber()">
                                    Agregar
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="border-top">
                                    <div class="table-responsive mt-3">
                                        <table id="tablaHaberes"
                                            class="table table-striped table-bordered table-hover table-sm table-tighten">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th class="text-white">Nombre Haber</th>
                                                    <th class="text-white">Monto Haber</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot style="background-color:#C8CBD2">
                                                <tr>
                                                    <th colspan="1">R.Aseg.</th>
                                                    <th colspan="0">
                                                        <input type="hidden" name="total_haberes" value="0"
                                                            id="inputTotal_haberes">
                                                        <spam id="total_haberes">0</span>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                data-bs-target="#exampleModalHaberes" id="cancelarHabere">
                                Cancelar Detalle Haberes
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="descuento">
                    <div class="text-white bg-secondary p-1 text-center">
                        DESCUENTOS
                    </div>
                    <div class="p-3 border border-3 border-secondary">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="nombre_descuento" class="form-label">Nombre:</label>
                                <input type="text" name="nombre_descuento" id="nombre_descuento" class="form-control"
                                    autocomplete="off" value="{{old('nombre_descuento')}}" step="1">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="monto_descuento" class="form-label">Monto:</label>
                                <input type="number" name="monto_descuento" id="monto_descuento" class="form-control"
                                    autocomplete="off" value="{{old('monto_descuento')}}" step="1">
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="button" id="agregar" class="btn btn-outline-secondary mt-3"
                                    onclick="agregarDescuento()">
                                    Agregar
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="border-top">
                                    <div class="table-responsive mt-3">
                                        <table id="tablaDescuentos"
                                            class="table table-striped table-bordered table-hover table-sm table-tighten">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th class="text-white">Nombre Descuento</th>
                                                    <th class="text-white">Monto Descuento</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot style="background-color:#C8CBD2">
                                                <tr>
                                                    <th colspan="1">Total Descuentos</th>
                                                    <th colspan="0">
                                                        <input type="hidden" name="total_descuentos" value="0"
                                                            id="inputTotal_descuentos">
                                                        <spam id="total_descuentos">0</span>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                data-bs-target="#exampleModalDescuentos" id="cancelarDescuentos">
                                Cancelar Detalle Descuentos
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" id="aporte">
                    <div class="text-white bg-secondary p-1 text-center">
                        APORTES DEL EMPLEADOR
                    </div>
                    <div class="p-3 border border-3 border-secondary">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="nombre_aporte" class="form-label">Nombre:</label>
                                <input type="text" name="nombre_aporte" id="nombre_aporte" class="form-control"
                                    autocomplete="off" value="{{old('nombre_aporte')}}" step="1">
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="monto_aporte" class="form-label">Monto:</label>
                                <input type="number" name="monto_aporte" id="monto_aporte" class="form-control"
                                    autocomplete="off" value="{{old('monto_aporte')}}" step="1">
                            </div>

                            <div class="col-md-12 mb-2 text-end">
                                <button type="button" id="agregar" class="btn btn-outline-secondary mt-3"
                                    onclick="agregarAporte()">
                                    Agregar
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="border-top">
                                    <div class="table-responsive mt-3">
                                        <table id="tablaAportes"
                                            class="table table-striped table-bordered table-hover table-sm table-tighten">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th class="text-white">Nombre Aporte</th>
                                                    <th class="text-white">Monto Aporte</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot style="background-color:#C8CBD2">
                                                <tr>
                                                    <th colspan="1">Total Aportes</th>
                                                    <th colspan="0">
                                                        <input type="hidden" name="total_aportes" value="0"
                                                            id="inputTotal_aportes">
                                                        <spam id="total_aportes">0</span>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                data-bs-target="#exampleModalAporte" id="cancelarAporte">
                                Cancelar Detalle Aporte
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="border-top">
                        <button type="submit" class="btn btn-outline-success mt-3" id="guardar">
                            Guardar
                        </button>
                        <a href="{{ route('plantillas.index') }}"><button type="button"
                                class="btn btn-outline-danger mt-3">
                                Cancelar
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="exampleModalHaberes" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRMACIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿SEGURO QUE QUIERES CANCELAR EL DETALLE DE HABERES?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="cancelarHaberes()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalDescuentos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRMACIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿SEGURO QUE QUIERES CANCELAR EL DETALLE DE DESCUENTOS?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="cancelarDescuentos()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModalAporte" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CONFIRMACIÓN</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿SEGURO QUE QUIERES CANCELAR EL DETALLE DE APORTES?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                        onclick="cancelarAportes()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    disableButtons();

    const li = document.getElementById("plantilla-li");
    li.classList.add("sidebar-item");
    li.classList.add("selected");
    const a = document.getElementById("plantilla-a");
    a.classList.add("sidebar-link");
    a.classList.add("waves-effect");
    a.classList.add("waves-dark");
    a.classList.add("active");

    $("#persona_id").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Trabajador',
        theme: "classic",
        allowClear: true
    });

    $("#tipo_plantilla_id").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Tipo de Plantilla',
        theme: "classic",
        allowClear: true
    });

    $("#mes").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Mes',
        theme: "classic",
        allowClear: true
    });

    $("#nombre_habere").on("keypress", function() {
        var $input = $(this);
        setTimeout(function() {
            $input.val($input.val().toUpperCase());
        }, 50);
    });

    $("#nombre_aporte").on("keypress", function() {
        var $input = $(this);
        setTimeout(function() {
            $input.val($input.val().toUpperCase());
        }, 50);
    });


    $("#nombre_descuento").on("keypress", function() {
        var $input = $(this);
        setTimeout(function() {
            $input.val($input.val().toUpperCase());
        }, 50);
    });


    $("#persona_id").change(mostrarValor);
    $("#tipo_plantilla_id").change(activarTrab);
    $("#mes").change(seleccionMes);

    activarTrab();

    const tipPlant = "{{old('tipo_plantilla_id')}}";
    if (tipPlant !== '') {
        const persona = "{{old('persona_id')}}";
        $("#persona_id").val(persona).trigger("change");
    }
});

let totalHaberes = 0.0;
let totalAportes = 0.0;
let totalDescuentos = 0.0;
let conHaberes = 0;
let conDescuentos = 0;
let conAportes = 0;

function seleccionMes() {
    $("#persona_id").val(null).trigger("change");
}

function mostrarValor() {
    var dataPersona = document.getElementById("persona_id").value.split("-");
    if (dataPersona[0] === "") {
        $('#sistema_pension').val("");
        $('#regimen').val("");
        $('#contrato').val("");
        $('#cargo').val("");

        $('#labor').hide();
        $('#pension').hide();
        $('#reg').hide();
        $('#con').hide();
        $('#car').hide();
        $('#aporte').hide();
        $('#descuento').hide();
        $('#pago').hide();
        $('#haber').hide();

        limpiarGeneral();
    } else {
        limpiarGeneral();

        var mes = $('#mes').val();
        var anio = $('#anio').val();
        var tipPlant = $('#tipo_plantilla_id').val();

        $.ajax({
            type: "GET",
            url: '/buscar-existente/' + dataPersona[0] + '/' + mes + '/' + anio + '/' + tipPlant,
            success: function(response) {
                if (response.id == null) {
                    if (dataPersona[1] === "") {
                        $('#sistema_pension').val("------------");
                    } else {
                        $('#sistema_pension').val(dataPersona[1] + ": " + dataPersona[2]);
                    }

                    if (dataPersona[3] === "a") {
                        $('#regimen').val("-----------");
                    } else {
                        $('#regimen').val(dataPersona[3] + ": " + dataPersona[4]);
                    }
                    $('#contrato').val(dataPersona[5]);
                    $('#cargo').val(dataPersona[6]);

                    $('#labor').show();
                    $('#pension').show();
                    $('#reg').show();
                    $('#con').show();
                    $('#car').show();
                    $('#aporte').show();
                    $('#pago').show();
                    $('#descuento').show();
                    $('#haber').show();

                    buscarValoresExiste(dataPersona[0], mes, anio);
                } else {
                    showModal(
                        'La persona seleccionada ya se encuentra registrada en la plantilla seleccionada del mes de ' +
                        mes + ' del ' + anio
                    );
                    $('#sistema_pension').val("");
                    $('#regimen').val("");
                    $('#contrato').val("");
                    $('#cargo').val("");

                    $('#labor').hide();
                    $('#pension').hide();
                    $('#reg').hide();
                    $('#con').hide();
                    $('#car').hide();
                    $('#aporte').hide();
                    $('#descuento').hide();
                    $('#pago').hide();
                    $('#haber').hide();
                }
            },
        });
    }
}

function buscarValoresExiste(persona, mes, anio) {
    $.ajax({
        type: "GET",
        url: '/buscar-valores/' + persona + '/' + mes + '/' + anio,
        success: function(response) {
            if (response.haberes != null) {
                for (const haberes of response.haberes) {
                    totalHaberes += round(parseFloat(haberes.monto));

                    let fila = '<tr id="haber' + parseInt(conHaberes) + '">' +
                        '<th><input type="hidden" name="arraynombrehaberes[]" value="' +
                        haberes.nombre + '">' + haberes.nombre + '</th>' +
                        '<th><input type="hidden" name="arraymontohaberes[]" value="' +
                        haberes.monto + '">' + haberes.monto + '</th>' +
                        '<th><button class="btn btn-danger" onClick="eliminarHaber(' + parseInt(
                            conHaberes) +
                        ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                        '</tr>';

                    $('#tablaHaberes').append(fila);

                    $('#total_haberes').html(totalHaberes);
                    $('#inputTotal_haberes').val(
                        totalHaberes);

                    disableButtons();
                    conHaberes += 1;
                }
            }

            if (response.descuentos != null) {
                for (const descuentos of response.descuentos) {
                    totalDescuentos += round(parseFloat(descuentos.monto));

                    let fila = '<tr id="descuento' + parseInt(conDescuentos) + '">' +
                        '<th><input type="hidden" name="arraynombredescuentos[]" value="' +
                        descuentos.nombre + '">' + descuentos.nombre + '</th>' +
                        '<th><input type="hidden" name="arraymontodescuentos[]" value="' +
                        descuentos.monto + '">' + descuentos.monto + '</th>' +
                        '<th><button class="btn btn-danger" onClick="eliminarDescuento(' + parseInt(
                            conDescuentos) +
                        ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                        '</tr>';

                    $('#tablaDescuentos').append(fila);

                    $('#total_descuentos').html(totalDescuentos);
                    $('#inputTotal_descuentos').val(
                        totalDescuentos);

                    disableButtons();
                    conDescuentos += 1;
                }
            }

            if (response.aportes != null) {
                for (const aportes of response.aportes) {
                    totalAportes += round(parseFloat(aportes.monto));

                    let fila = '<tr id="aporte' + parseInt(conAportes) + '">' +
                        '<th><input type="hidden" name="arraynombreaportes[]" value="' +
                        aportes.nombre + '">' + aportes.nombre + '</th>' +
                        '<th><input type="hidden" name="arraymontoaportes[]" value="' +
                        aportes.monto + '">' + aportes.monto + '</th>' +
                        '<th><button class="btn btn-danger" onClick="eliminarAporte(' + parseInt(
                            conAportes) +
                        ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                        '</tr>';

                    $('#tablaAportes').append(fila);

                    $('#total_aportes').html(totalAportes);
                    $('#inputTotal_aportes').val(
                        totalAportes);

                    disableButtons();
                    conAportes += 1;
                }
            }
        },
    });
}

function limpiarGeneral() {
    $('#tablaHaberes > tbody').empty();
    totalHaberes = 0;

    $('#total_haberes').html(totalHaberes);
    $('#inputTotal_haberes').val(totalHaberes);
    //************/
    $('#tablaDescuentos > tbody').empty();
    totalDescuentos = 0;

    $('#total_descuentos').html(totalDescuentos);
    $('#inputTotal_descuentos').val(totalDescuentos);
    //************/
    $('#tablaAportes > tbody').empty();
    totalAportes = 0;

    $('#total_aportes').html(totalAportes);
    $('#inputTotal_aportes').val(totalAportes);

    limpiarAportes();
    limpiarDescuentos();
    disableButtons();
    limpiarHaberes();
}

function activarTrab() {
    var tipoPlantilla = document.getElementById("tipo_plantilla_id").value;
    if (tipoPlantilla === "") {
        $('#trabajador').hide();
        $('#labor').hide();
        $('#pension').hide();
        $('#reg').hide();
        $('#con').hide();
        $('#car').hide();
        $('#aporte').hide();
        $('#descuento').hide();
        $('#haber').hide();
        $('#guardar').hide();
        $('#pago').hide();
    } else {
        $('#trabajador').show();
    }

    $("#persona_id").val(null).trigger("change");
}

function limpiarHaberes() {
    $('#nombre_habere').val('');
    $('#monto_habere').val('');
}

function limpiarAportes() {
    $('#nombre_aporte').val('');
    $('#monto_aporte').val('');
}

function limpiarDescuentos() {
    $('#nombre_descuento').val('');
    $('#monto_descuento').val('');
}

function showModal(message, icon = 'error') {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: icon,
        title: message
    });
}

function existeHaberEnTabla(haber) {
    var existe = true;

    $('#tablaHaberes tr').each(function() {
        var filaId = $(this).attr('id');
        if (filaId === haber) {
            existe = false;
        }
    });

    return existe;
}

function existeDescuentoEnTabla(descuento) {
    var existe = true;

    $('#tablaDescuentos tr').each(function() {
        var filaId = $(this).attr('id');
        if (filaId === descuento) {
            existe = false;
        }
    });

    return existe;
}

function existeAporteEnTabla(aporte) {
    var existe = true;

    $('#tablaAportes tr').each(function() {
        var filaId = $(this).attr('id');
        if (filaId === aporte) {
            existe = false;
        }
    });

    return existe;
}

function agregarHaber() {
    var nombreHaber = $('#nombre_habere').val();
    var montoHaber = $('#monto_habere').val();

    if (nombreHaber !== '' && montoHaber !== '') {
        if (parseFloat(montoHaber) >= 0) {
            if (existeHaberEnTabla(nombreHaber)) {
                totalHaberes += round(parseFloat(montoHaber));

                let fila = '<tr id="haber' + parseInt(conHaberes) + '">' +
                    '<th><input type="hidden" name="arraynombrehaberes[]" value="' +
                    nombreHaber + '">' + nombreHaber + '</th>' +
                    '<th><input type="hidden" name="arraymontohaberes[]" value="' +
                    montoHaber + '">' + montoHaber + '</th>' +
                    '<th><button class="btn btn-danger" onClick="eliminarHaber(' + parseInt(conHaberes) +
                    ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                    '</tr>';

                $('#tablaHaberes').append(fila);
                limpiarHaberes();

                $('#total_haberes').html(totalHaberes);
                $('#inputTotal_haberes').val(totalHaberes);

                disableButtons();
                conHaberes += 1;

            } else {
                showModal('El haber a ingresar ya se encuentra registrado en la Tabla.');
            }
        } else {
            showModal('Usted ha ingresado un monto negativo al haber a Agregar.');
        }
    } else {
        showModal('Usted no ha ingresado un nombre y/o el monto al Haber a Agregar.');
    }
}

function eliminarHaber(idH) {
    const filaHaber = document.getElementById("haber" + idH);

    totalHaberes -= round(parseFloat(filaHaber.cells[1].textContent));

    $('#total_haberes').html(totalHaberes);
    $('#inputTotal_haberes').val(totalHaberes);

    filaHaber.remove();

    disableButtons();
}

function cancelarHaberes() {
    if (totalHaberes > 0) {
        $('#tablaHaberes > tbody').empty();
        totalHaberes = 0;

        $('#total_haberes').html(totalHaberes);
        $('#inputTotal_haberes').val(totalHaberes);

        limpiarHaberes();
        disableButtons();
    } else {
        showModal('No existen Haberes Agregados en la tabla.');
    }
}

function agregarDescuento() {
    var nombreDescuento = $('#nombre_descuento').val();
    var montoDescuento = $('#monto_descuento').val();

    if (nombreDescuento !== '' && montoDescuento !== '') {
        if (parseFloat(montoDescuento) >= 0) {
            if (existeDescuentoEnTabla(nombreDescuento)) {
                totalDescuentos += round(parseFloat(montoDescuento));

                let fila = '<tr id="descuento' + parseInt(conDescuentos) + '">' +
                    '<th><input type="hidden" name="arraynombredescuentos[]" value="' +
                    nombreDescuento + '">' + nombreDescuento + '</th>' +
                    '<th><input type="hidden" name="arraymontodescuentos[]" value="' +
                    montoDescuento + '">' + montoDescuento + '</th>' +
                    '<th><button class="btn btn-danger" onClick="eliminarDescuento(' + parseInt(conDescuentos) +
                    ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                    '</tr>';

                $('#tablaDescuentos').append(fila);
                limpiarDescuentos();

                $('#total_descuentos').html(totalDescuentos);
                $('#inputTotal_descuentos').val(totalDescuentos);

                disableButtons();
                conDescuentos += 1;

            } else {
                showModal('El descuento a ingresar ya se encuentra registrado en la Tabla.');
            }
        } else {
            showModal('Usted ha ingresado un monto negativo al descuento a Agregar.');
        }
    } else {
        showModal('Usted no ha ingresado un nombre y/o el monto al descuento a Agregar.');
    }
}

function eliminarDescuento(idD) {
    const filaDesc = document.getElementById("descuento" + idD);

    totalDescuentos -= round(parseFloat(filaDesc.cells[1].textContent));

    $('#total_descuentos').html(totalDescuentos);
    $('#inputTotal_descuentos').val(totalDescuentos);

    filaDesc.remove();

    disableButtons();
}

function cancelarDescuentos() {
    if (totalDescuentos > 0) {
        $('#tablaDescuentos > tbody').empty();
        totalDescuentos = 0;

        $('#total_descuentos').html(totalDescuentos);
        $('#inputTotal_descuentos').val(totalDescuentos);

        limpiarDescuentos();
        disableButtons();
    } else {
        showModal('No existen Descuentos Agregados en la tabla.');
    }
}

function agregarAporte() {
    var nombreAporte = $('#nombre_aporte').val();
    var montoAporte = $('#monto_aporte').val();

    if (nombreAporte !== '' && montoAporte !== '') {
        if (parseFloat(montoAporte) >= 0) {
            if (existeAporteEnTabla(nombreAporte)) {
                totalAportes += round(parseFloat(montoAporte));

                let fila = '<tr id="aporte' + parseInt(conAportes) + '">' +
                    '<th><input type="hidden" name="arraynombreaportes[]" value="' +
                    nombreAporte + '">' + nombreAporte + '</th>' +
                    '<th><input type="hidden" name="arraymontoaportes[]" value="' +
                    montoAporte + '">' + montoAporte + '</th>' +
                    '<th><button class="btn btn-danger" onClick="eliminarAporte(' + parseInt(conAportes) +
                    ')" type="button"><i class="fa-solid fa-trash"></i></button></th>' +
                    '</tr>';

                $('#tablaAportes').append(fila);
                limpiarAportes();

                $('#total_aportes').html(totalAportes);
                $('#inputTotal_aportes').val(totalAportes);

                disableButtons();
                conAportes += 1;

            } else {
                showModal('El Aporte a ingresar ya se encuentra registrado en la Tabla.');
            }
        } else {
            showModal('Usted ha ingresado un monto negativo al aporte a Agregar.');
        }
    } else {
        showModal('Usted no ha ingresado un nombre y/o el monto al aporte a Agregar.');
    }
}

function eliminarAporte(idA) {
    const filaAport = document.getElementById("aporte" + idA);

    totalAportes -= round(parseFloat(filaAport.cells[1].textContent));

    $('#total_aportes').html(totalAportes);
    $('#inputTotal_aportes').val(totalAportes);

    filaAport.remove();

    disableButtons();
}

function cancelarAportes() {
    if (totalAportes > 0) {
        $('#tablaAportes > tbody').empty();
        totalAportes = 0;

        $('#total_aportes').html(totalAportes);
        $('#inputTotal_aportes').val(totalAportes);

        limpiarAportes();
        disableButtons();
    } else {
        showModal('No existen Aportes Agregados en la tabla.');
    }
}

function disableButtons() {
    $('#importe_pago').val(round(totalHaberes - totalDescuentos));
    if ((totalHaberes - totalDescuentos) >= 0) {
        if (totalHaberes > 0 && totalAportes > 0 && totalDescuentos > 0) {
            $('#guardar').show();
        } else {
            $('#guardar').hide();
        }
    } else {
        showModal('Verifique los montos, porque el importe no puede ser negativo.');
    }
}

function round(num, decimales = 2) {
    var signo = (num >= 0 ? 1 : -1);
    num = num * signo;
    if (decimales === 0)
        return signo * Math.round(num);
    // round(x * 10 ^ decimales)
    num = num.toString().split('e');
    num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
    // x * 10 ^ (-decimales)
    num = num.toString().split('e');
    return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
}
</script>
@endpush