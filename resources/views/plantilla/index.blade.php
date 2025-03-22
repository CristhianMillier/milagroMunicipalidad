@extends('template')

@push('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
<style>
.dataTables_paginate .paginate_button {
    padding: 0;
    margin-right: 10px;
}
</style>
@endpush

@section('navigation')
<h2 class="page-title ">Planillas </h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Planillas
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="card-body">
    @can('Crear-Plantilla')
    <a href="{{ route('plantillas.create') }}"><button type="button" class="btn btn-outline-info">Añadir nuevo
            Personal a la Planilla</button></a>
    @endcan
    <h5 class="card-title mt-5"><i class="fa-solid fa-table-cells"></i> Tabla Planillas
    </h5>
    <div class="table-responsive">
        <table id="zero_config" class="table table-striped table-bordered table-hover table-sm table-tighten">
            <thead>
                <tr>
                    <th>Tipo Planilla</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Totales</th>
                    <th>Importe Pagado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plantillas as $item)
                <tr>
                    <td>
                        {{ $item->tipo_plantilla->nombre }}
                    </td>
                    <td>
                        {{ $item->mes }}
                    </td>
                    <td>
                        {{ $item->anio }}
                    </td>
                    <td>
                        <p class="fw-semibold mb-1">Haberes: S/. {{ $item->monto_haberes }}</p>
                        <p class="fw-semibold mb-1">Descuentos: S/. {{ $item->monto_descuentos }}</p>
                        <p class="fw-semibold mb-1">Aportes: S/. {{ $item->monto_aportes }}</p>
                    </td>
                    <td>
                        {{ $item->monto_total }}
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            @can('Mostrar-Plantilla')
                            <form action=" {{ route('plantillas.show', ['plantilla'=>$item]) }}">
                                @csrf
                                <button type="submit" class="btn btn-cyan btn-sm text-white">
                                    Ver
                                </button>
                            </form>
                            @endcan

                            @can('Eliminar-Plantilla')
                            <button type="button" class="btn btn-danger btn-sm mr-3" style="margin-left: 10px"
                                data-bs-toggle="modal" data-bs-target="#confirmarModal-{{ $item->id }}">
                                Eliminar
                            </button>
                            @endcan

                            @can('Exportar-Plantilla')
                            <a class="btn btn-success btn-sm text-white mr-3" style="margin-left: 10px"
                                href="{{ route('exportar-plantilla', ['id' => $item->id]) }}">
                                <i class="fa-solid fa-file-excel"></i>
                                Export
                            </a>
                            @endcan
                        </div>
                    </td>
                </tr>

                @can('Eliminar-Plantilla')
                <!-- Modal -->
                <div class="modal fade" id="confirmarModal-{{ $item->id }}" data-bs-backdrop="static"
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
                                ¿SEGURO QUE QUIERES ELIMINAR LA PLANILLA "{{ $item->tipo_plantilla->nombre }}" DEL MES
                                {{ $item->mes }} DEL {{ $item->anio }}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                <form action=" {{ route('plantillas.destroy', ['plantilla'=>$item->id]) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger text-white">Confirmar</button>
                                </form>
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
@endsection

@push('js')
<script src="{{ asset('assets/libs/DataTables/datatables.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    $('#zero_config').DataTable({
        responsive: true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
        "columns": [{}, {},
            {},
            {
                "searchable": false,
                "orderable": false
            },
            {
                "searchable": false,
                "orderable": false
            },
            {
                "orderable": false,
                "searchable": false
            }
        ]
    });

    @if(session('success'))
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: "{{ session('success') }}"
    });
    @endif
});
</script>
@endpush