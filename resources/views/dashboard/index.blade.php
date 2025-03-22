@extends('template')

@push('css')
<link href="{{ asset('assets/libs/flot/css/float-chart.css') }}" rel="stylesheet" />
@endpush

@section('navigation')
<h2 class="page-title">Dashboard</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                Inicio
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container-fluid mt-4 form-group">
    <div class="row">
        @can('Ver-Cargos')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-cyan text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-address-book"></i>
                            <span class="mt-1">Cargos</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$ncargos}}</p>
                        </div>
                        <div class=" card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('cargos.index') }}">Ver más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Contratos')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-file-signature"></i>
                            <span class="mt-1">Contratos</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$ncontratos}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('contratos.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Laborales')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-briefcase"></i>
                            <span class="mt-1">Regimenes Laborales</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$nlaborales}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('laborales.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Remuneraciones')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-building"></i>
                            <span class="mt-1">Niveles Remuneraciones</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$nremuneraciones}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('remuneraciones.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Personas')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-user-tie"></i>
                            <span class="mt-1">Personal</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$npersonas}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('personas.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Tipos-Plantillas')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-table-list"></i>
                            <span class="mt-1">Tipos de Plantillas</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$ntipoplantillas}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('tipoplantillas.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Plantillas')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-cyan text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-table-columns"></i>
                            <span class="mt-1">Plantillas</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$nplantillas}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('plantillas.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Roles')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-info text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-person-circle-plus"></i>
                            <span class="mt-1">Roles</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$nroles}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('roles.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @can('Ver-Usuarios')
        <div class="col-md-6 col-lg-3 col-xlg-3">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <i class="fa-solid fa-users"></i>
                            <span class="mt-1">Usuarios</span>
                        </div>
                        <div class="col-4">
                            <p class="text-center fw-bold fs-4">{{$nusers}}</p>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="{{ route('users.index') }}">Ver
                                más</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        @if ($rol == "ADMINISTRADOR")
        <div class="container">
            <div class="form-group row">
                <div class="row g-3">
                    <div class="col-md-12">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

<script>
$(document).ready(function() {
    const ctx = document.getElementById('myChart');
    const barra = @json($query);
    const barraData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    for (var key in barra) {
        if (barra.hasOwnProperty(key)) {
            var dato = barra[key];

            if (dato.mes === 'ENERO') {
                barraData.splice(0, 0, dato.total_monto);
            }

            if (dato.mes === 'FEBRERO') {
                barraData.splice(1, 0, dato.total_monto);
            }

            if (dato.mes === 'MARZO') {
                barraData.splice(2, 0, dato.total_monto);
            }

            if (dato.mes === 'ABRIL') {
                barraData.splice(3, 0, dato.total_monto);
            }

            if (dato.mes === 'MAYO') {
                barraData.splice(4, 0, dato.total_monto);
            }

            if (dato.mes === 'JUNIO') {
                barraData.splice(5, 0, dato.total_monto);
            }

            if (dato.mes === 'JULIO') {
                barraData.splice(6, 0, dato.total_monto);
            }

            if (dato.mes === 'AGOSTO') {
                barraData.splice(7, 0, dato.total_monto);
            }

            if (dato.mes === 'SEPTIEMBRE') {
                barraData.splice(8, 0, dato.total_monto);
            }

            if (dato.mes === 'OCTUBRE') {
                barraData.splice(9, 0, dato.total_monto);
            }

            if (dato.mes === 'NOVIEMBRE') {
                barraData.splice(10, 0, dato.total_monto);
            }

            if (dato.mes === 'DICIEMBRE') {
                barraData.splice(11, 0, dato.total_monto);
            }
        }
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV',
                'DIC'
            ],
            datasets: [{
                label: 'Egresos Mensuales del año ' +
                    <?php echo date("Y"); ?>,
                data: barraData,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
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