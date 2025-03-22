@extends('template')

@push('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endpush

@section('navigation')
<h2 class="page-title ">Ver Planilla</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('plantillas.index') }}">Planillas</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Ver Planilla
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container w-100 mt-4 form-group">
    <input type="hidden" value="{{ $plantilla->id }}" id="plantilla">
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                <input type="text" class="form-control" value="Mes:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$plantilla->mes}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-regular fa-calendar-days"></i></span>
                <input type="text" class="form-control" value="Año:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$plantilla->anio}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-table-cells"></i></span>
                <input type="text" class="form-control" value="Tipo Planilla:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$plantilla->tipo_plantilla->nombre}}" disabled>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="fa-solid fa-database"></i></span>
                <input type="text" class="form-control" value="Usuario que regitro la plantilla:" disabled>
            </div>
        </div>
        <div class="col-sm-8">
            <input type="text" class="form-control" value="{{$plantilla->user->name}}" disabled>
        </div>
    </div>

    <div class="card mb-4 border border-2">
        <div class="card-header">
            <i class="fa-solid fa-table"></i>
            Tabla de Trabajadores en la Planilla
        </div>
        <div class="card-body table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-hover table-sm table-tighten">
                <thead class="bg-info">
                    <tr>
                        <th class="text-white">Nombre</th>
                        <th class="text-white">DNI</th>
                        <th class="text-white">Sistema Pensión</th>
                        <th class="text-white">Contrato</th>
                        <th class="text-white">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personasPlan as $plan)
                    <?php
                    $persona = \App\Models\Persona::find($plan->id);
                    ?>
                    <input type="hidden" value="{{ $persona->id }}" id="persona{{ $persona->id }}">
                    <tr>
                        <td>
                            {{ $persona->nombre }}
                        </td>
                        <td>
                            {{ $persona->dni }}
                        </td>
                        <td>
                            @if ($persona->sistema_pension != null)
                            <p class="fw-semibold mb-1">{{ $persona->sistema_pension }}</p>
                            <p class="text-muted mb-0">{{ $persona->tipo_sistema_pension }}</p>
                            @else
                            No especificado
                            @endif
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">{{ $persona->contrato->nombre }}</p>
                            <p class="text-muted mb-0">{{ $persona->cargo->nombre }}</p>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                @can('Ver-Detalle-del-Trabajador-en-la-Plantilla')
                                <a class="btn btn-cyan btn-sm text-white"
                                    href="{{ route('detalle-trabajador', ['idPer' => $persona->id, 'idPlan' => $plantilla->id]) }}">
                                    Ver Detalle
                                </a>
                                @endcan

                                @can('Eliminar-el-Trabajador-de-la-Plantilla')
                                <button type="button" class="btn btn-danger btn-sm mr-3" style="margin-left: 10px"
                                    data-bs-toggle="modal" data-bs-target="#confirmarModal-{{ $persona->id }}">
                                    Eliminar
                                </button>
                                @endcan
                            </div>
                        </td>
                    </tr>

                    @can('Eliminar-el-Trabajador-de-la-Plantilla')
                    <!-- Modal -->
                    <div class="modal fade" id="confirmarModal-{{ $persona->id }}" data-bs-backdrop="static"
                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">MENSAJE DE CONFIRMACIÓN...
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿SEGURO QUE QUIERES ELIMINAR AL TRABAJADOR {{ $persona->nombre }} DE LA PLANTILLA?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cerrar</button>

                                    <a class="btn btn-danger text-white"
                                        href="{{ route('eliminar-trabajador', ['idPer' => $persona->id, 'idPlan' => $plantilla->id]) }}">
                                        Confirmar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class=" col-md-12 text-end border-top">
        <a href="{{ route('plantillas.index') }}"><button type="button" class="btn btn-danger mt-3">
                Atras
            </button></a>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/libs/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
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

    $('#zero_config').DataTable({
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columns": [{},
            {},
            {
                "orderable": false
            },
            {
                "orderable": false
            },
            {
                "orderable": false,
                "searchable": false
            }
        ]
    });
});
</script>
@endpush