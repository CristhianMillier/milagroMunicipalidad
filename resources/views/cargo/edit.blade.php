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
@endpush

@section('navigation')
<h2 class="page-title ">Editar Cargo</h2>
<div class="ms-auto text-end">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cargos.index') }}">Cargos</a></li>
            <li class="breadcrumb-item active" aria-current="page">
                Editar Cargo
            </li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="container">
    <form action="{{ route('cargos.update', ['cargo'=>$cargo]) }}" method="post">
        @method('PATCH')
        @csrf
        <div class="form-group row">
            <div class="row g-3">
                <div class="col-md-12 requerido">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" maxlength="100"
                        value="{{old('nombre', $cargo->nombre)}}" autocomplete="off">
                    @error('nombre')
                    <small class="text-danger">{{'*'.$message}}</small>
                    <script>
                    const nombre = document.getElementById("nombre");
                    nombre.classList.add("form-control");
                    nombre.classList.add("is-invalid");
                    </script>
                    @enderror
                </div>

                <div>
                    <div class="border-top">
                        <button type="submit" class="btn btn-outline-success mt-3">
                            Guardar
                        </button>
                        <button type="reset" class="btn btn-outline-secondary mt-3">
                            Restaurar
                        </button>
                        <a href="{{ route('cargos.index') }}"><button type="button" class="btn btn-outline-danger mt-3">
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
<script>
$(document).ready(function() {
    const li = document.getElementById("cargo-li");
    li.classList.add("sidebar-item");
    li.classList.add("selected");
    const a = document.getElementById("cargo-a");
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

});
</script>
@endpush