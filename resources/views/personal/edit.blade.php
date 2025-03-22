@extends('template')

@push('css')
<style>
#customControlValidation1 {
    cursor: pointer;
}

#customControlValidation2 {
    cursor: pointer;
}
</style>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}" />
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" />
@endpush

@section('navigation')
<h2 class="page-title ">Editar Trabajador</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('personas.index') }}">Personal</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Editar Trabajador
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('personas.update', ['persona'=>$persona]) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <div class="row g-3">

                <div class="col-md-6">
                    <label for="dni" class="form-label">Número DNI:</label>
                    </br>
                    <div class="btn-group" role="group">
                        <input type="number" name="dni" id="dni" class="form-control" oninput="limitarCaracteres()"
                            value="{{ old('dni', $persona->dni) }}" autocomplete="off">
                        <button type="button" class="btn btn-info" style="margin-left: 10px"
                            onclick="buscarDocumento()">Buscar</button>
                    </div>
                    <small class="text-danger" style="display:none" id="errorDNI">No se encontraron resultados del
                        documento ingresado</small>
                    @error('dni')
                    </br>
                    <small class=" text-danger">{{'*'.$message}}</small>
                    <script>
                    const doc = document.getElementById("dni");
                    doc.classList.add("form-control");
                    doc.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="nombre" class="form-label">Apellidos y Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" maxlength="100"
                        value="{{old('nombre', $persona->nombre)}}" autocomplete="off" readonly>
                    @error('nombre')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const nombre = document.getElementById("nombre");
                    nombre.classList.add("form-control");
                    nombre.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="sistema_pension" class="form-label">Sistema fondo Pensión:</label>
                    <select name="sistema_pension" id="sistema_pension"
                        class="js-example-placeholder-single js-states form-control" style="width: 100%; height: 36px"
                        onchange="activarFondoPension()">
                        <option value=""></option>
                        @if ($persona->sistema_pension != null)
                        @if ($persona->sistema_pension == "AFP")
                        <option selected value="AFP" {{ old('sistema_pension') == 'AFP' ? 'selected' : '' }}>AFP
                        </option>
                        <option value="SNP" {{ old('sistema_pension') == 'SNP' ? 'selected' : '' }}>SNP</option>
                        @else
                        <option value="AFP" {{ old('sistema_pension') == 'AFP' ? 'selected' : '' }}>AFP
                        </option>
                        <option selected value="SNP" {{ old('sistema_pension') == 'SNP' ? 'selected' : '' }}>SNP
                        </option>
                        @endif
                        @else
                        <option value="AFP" {{ old('sistema_pension') == 'AFP' ? 'selected' : '' }}>AFP
                        </option>
                        <option value="SNP" {{ old('sistema_pension') == 'SNP' ? 'selected' : '' }}>SNP
                        </option>
                        @endif
                    </select>
                    @error('sistema_pension')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="tipo_sistema_pension" class="form-label">Tipo Sistema fondo Pensión:</label>
                    <select name="tipo_sistema_pension" id="tipo_sistema_pension"
                        class="js-example-placeholder-single js-states form-control" style="width: 100%; height: 36px">
                        <option value=""></option>
                    </select>
                    @error('tipo_sistema_pension')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cusp" class="form-label">CUSPP:</label>
                    <input type="text" name="cusp" id="cusp" class="form-control" maxlength="50"
                        value="{{old('cusp', $persona->cusp)}}" autocomplete="off">
                    @error('cusp')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const cusp = document.getElementById("cusp");
                    cusp.classList.add("form-control");
                    cusp.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento:</label>
                    <div class="input-group">
                        <?php
                        $nacimiento = DateTime::createFromFormat('Y-m-d', $persona->fecha_nacimiento);
                        $ingreso = DateTime::createFromFormat('Y-m-d', $persona->fecha_ingreso);
                        $nacimientoBD = $nacimiento->format('m/d/Y');
                        $ingresoBD = $ingreso->format('m/d/Y');
                        ?>
                        <input type="text" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                            placeholder="MM/DD/YYYY" value="{{old('fecha_nacimiento', $nacimientoBD)}}" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text h-100"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    @error('fecha_nacimiento')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const fecha_nacimiento = document.getElementById("fecha_nacimiento");
                    fecha_nacimiento.classList.add("form-control");
                    fecha_nacimiento.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <label for="fecha_ingreso" class="form-label">Fecha Ingreso:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="fecha_ingreso" name="fecha_ingreso"
                            placeholder="MM/DD/YYYY" value="{{old('fecha_ingreso', $ingresoBD)}}" readonly />
                        <div class="input-group-append">
                            <span class="input-group-text h-100"><i class="mdi mdi-calendar"></i></span>
                        </div>
                    </div>
                    @error('fecha_ingreso')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const fecha_ingreso = document.getElementById("fecha_ingreso");
                    fecha_ingreso.classList.add("form-control");
                    fecha_ingreso.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="contrato_id" class="form-label">Contrato:</label>
                    <select name="contrato_id" id="contrato_id" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                        @foreach($contratos as $item)
                        @if ($persona->contrato_id == $item->id)
                        <option selected value="{{ $item->id }}"
                            {{ old('contrato_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                        @else
                        <option value="{{ $item->id }}" {{ old('contrato_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('contrato_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="regimen" class="form-label">Régimen:</label>
                    <select name="regimen" id="regimen" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px" onchange="activarRegimen()">
                        <option value=""></option>
                        @if ($persona->regimene != null)
                        @if ($persona->regimene->nombre == "NIVEL REM")
                        <option selected value="NIVEL REM" {{ old('regimen') == 'NIVEL REM' ? 'selected' : '' }}>NIVEL
                            DE REMUNERACIÓN
                        </option>
                        <option value="REG LAB" {{ old('regimen') == 'REG LAB' ? 'selected' : '' }}>
                            RÉGIMEN LABORAL
                        </option>
                        @else
                        <option value="NIVEL REM" {{ old('regimen') == 'NIVEL REM' ? 'selected' : '' }}>NIVEL
                            DE REMUNERACIÓN
                        </option>
                        <option selected value="REG LAB" {{ old('regimen') == 'REG LAB' ? 'selected' : '' }}>
                            RÉGIMEN LABORAL
                        </option>
                        @endif
                        @else
                        <option value="NIVEL REM" {{ old('regimen') == 'NIVEL REM' ? 'selected' : '' }}>NIVEL
                            DE REMUNERACIÓN
                        </option>
                        <option value="REG LAB" {{ old('regimen') == 'REG LAB' ? 'selected' : '' }}>
                            RÉGIMEN LABORAL
                        </option>
                        @endif
                    </select>
                    @error('regimen')
                    <small class=" text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="regimene_id" class="form-label">Tipo Régimen:</label>
                    <select name="regimene_id" id="regimene_id" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                    </select>
                    @error('regimene_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="cargo_id" class="form-label">Cargo:</label>
                    <select name="cargo_id" id="cargo_id" class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                        <option value=""></option>
                        @foreach($cargos as $item)
                        @if ($persona->cargo_id == $item->id)
                        <option selected value="{{ $item->id }}"
                            {{ old('contrato_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                        @else
                        <option value="{{ $item->id }}" {{ old('contrato_id') == $item->id ? 'selected' : '' }}>
                            {{ $item->nombre }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    @error('cargo_id')
                    <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
                </div>

                <div>
                    <div class="border-top">
                        <button type="submit" class="btn btn-outline-success mt-3">
                            Guardar
                        </button>
                        <button type="button" class="btn btn-outline-secondary mt-3" id="restaurar">
                            Restaurar
                        </button>
                        <a href="{{ route('personas.index') }}"><button type="button"
                                class="btn btn-outline-danger mt-3">
                                Cancelar
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    const li = document.getElementById("personal-li");
    li.classList.add("sidebar-item");
    li.classList.add("selected");
    const a = document.getElementById("personal-a");
    a.classList.add("sidebar-link");
    a.classList.add("waves-effect");
    a.classList.add("waves-dark");
    a.classList.add("active");


    $("#nombre").on("keypress", function() {
        var $input = $(this);
        setTimeout(function() {
            $input.val($input.val().toUpperCase());
        }, 50);
    });

    $("#cusp").on("keypress", function() {
        var $input = $(this);
        setTimeout(function() {
            $input.val($input.val().toUpperCase());
        }, 50);
    });

    $("#tipo_sistema_pension").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Tipo Sistema Fondo Pensión',
        theme: "classic",
        allowClear: true
    });

    $("#sistema_pension").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Sistema Fondo Pensión',
        theme: "classic",
        allowClear: true
    });

    $("#cargo_id").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Cargo',
        theme: "classic",
        allowClear: true
    });

    $("#contrato_id").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Contrato',
        theme: "classic",
        allowClear: true
    });

    $("#regimen").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Régimen',
        theme: "classic",
        allowClear: true
    });

    $("#regimene_id").select2({
        language: {
            noResults: function() {
                return "No hay resultado";
            },
            searching: function() {
                return "Buscando...";
            }
        },
        placeholder: 'Seleccione un Tipo Régimen',
        theme: "classic",
        allowClear: true
    });

    const oldSisPen = "{{old('sistema_pension')}}";
    if (oldSisPen !== '') {
        const oldSisTipPen = "{{old('tipo_sistema_pension')}}";
        activarFondoPension();
        const selectElement = document.getElementById("tipo_sistema_pension");
        for (const option of selectElement.options) {
            if (option.value === oldSisTipPen) {
                option.selected = true;
                break;
            }
        }
    } else {
        const sisPen = "{{$persona->sistema_pension}}";
        if (sisPen !== '') {
            const sisTipPen = "{{$persona->tipo_sistema_pension}}";
            activarFondoPension();
            const selectElement3 = document.getElementById("tipo_sistema_pension");
            for (const option3 of selectElement3.options) {
                if (option3.value === sisTipPen) {
                    option3.selected = true;
                    break;
                }
            }
        }
    }

    const oldReg = "{{old('regimen')}}";
    if (oldReg !== '') {
        const oldRegID = "{{old('regimene_id')}}";
        activarRegimen();
        const selectElement2 = document.getElementById("regimene_id");
        for (const option2 of selectElement2.options) {
            if (option2.value === oldRegID) {
                option2.selected = true;
                break;
            }
        }
    } else {
        const reg = "{{$persona->regimene}}";
        if (reg != null) {
            const regID = "{{$persona->regimene_id}}";
            activarRegimen();
            const selectElement4 = document.getElementById("regimene_id");
            for (const option4 of selectElement4.options) {
                if (option4.value === regID) {
                    option4.selected = true;
                    break;
                }
            }
        }
    }
});

function buscarDocumento() {
    var numero = $('#dni').val();

    $.ajax({
        type: "GET",
        url: '/consultar-dni/' + numero,
        success: function(response) {
            if (response.error === 'Error al consultar el DNI') {
                document.getElementById("errorDNI").style.display = 'block';
                showModal('El DNI ingresado no existe.');
            } else {
                $('#nombre').val(response.apellido_paterno + " " +
                    response.apellido_materno + " " + response.nombre);
                document.getElementById("errorDNI").style.display = 'none';
            }
        },
        error: function(error) {
            document.getElementById("errorDNI").style.display = 'block';
        }
    });
}

function limitarCaracteres() {
    var input = document.getElementById("dni");
    if (input.value.length > 8) {
        input.value = input.value.slice(0, 8);
    }
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

function activarFondoPension() {
    var select = document.getElementById("sistema_pension");
    var select2 = document.getElementById("tipo_sistema_pension");
    select2.innerHTML = '';

    if (select.value === "AFP") {
        const afp = ['INTEGRA', 'PROFUTURO', 'HABITAD', 'PRIMA'];

        afp.forEach(function(seguroAFP) {
            const option = document.createElement('option');
            option.value = seguroAFP;
            option.textContent = seguroAFP;
            select2.appendChild(option);
        });
    }

    if (select.value === "SNP") {
        const onp = ['ONP'];

        onp.forEach(function(seguroONP) {
            const option2 = document.createElement('option');
            option2.value = seguroONP;
            option2.textContent = seguroONP;
            select2.appendChild(option2);
        });
    }

    select2.selectedIndex = -1;
}

jQuery("#fecha_nacimiento").datepicker({
    autoclose: true,
    todayHighlight: true,
});

jQuery("#fecha_ingreso").datepicker({
    autoclose: true,
    todayHighlight: true,
});

function activarRegimen() {
    var select = document.getElementById("regimen");
    var select2 = document.getElementById("regimene_id");
    select2.innerHTML = '';
    var regimenes = @json($regimenes);

    regimenes.forEach(function(rem) {
        if (select.value === rem.nombre) {
            const option = document.createElement('option');
            option.value = rem.id;
            option.textContent = rem.tipo_regimene;
            select2.appendChild(option);
        }
    });

    select2.selectedIndex = -1;
}
const botonRestablecer = document.getElementById('restaurar');
botonRestablecer.addEventListener('click', restablecerPagina);

function restablecerPagina() {
    location.reload();
}
</script>
@endpush