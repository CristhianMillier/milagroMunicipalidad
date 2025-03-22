<nav class="sidebar-nav">
    <ul id="sidebarnav" class="pt-4 container-fluid">
        <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('panel') }}"
                aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
        </li>

        @can('Ver-Cargos')
        <li class="sidebar-item" id="cargo-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="cargo-a" href="{{ route('cargos.index') }}"
                aria-expanded="false"><i class="fa-solid fa-address-book"></i><span class="hide-menu">Cargos</span></a>
        </li>
        @endcan

        @can('Ver-Contratos')
        <li class="sidebar-item" id="contrato-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="contrato-a"
                href="{{ route('contratos.index') }}" aria-expanded="false"><i
                    class="fa-solid fa-file-signature"></i><span class="hide-menu">Contratos</span></a>
        </li>
        @endcan

        @can('Ver-Laborales')
        <li class="sidebar-item" id="laboral-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="laboral-a"
                href="{{ route('laborales.index') }}" aria-expanded="false"><i class="fa-solid fa-briefcase"></i><span
                    class="hide-menu">Regimenes Laborales</span></a>
        </li>
        @endcan

        @can('Ver-Remuneraciones')
        <li class="sidebar-item" id="remuneracion-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="remuneracion-a"
                href="{{ route('remuneraciones.index') }}" aria-expanded="false"><i
                    class="fa-solid fa-building"></i><span class="hide-menu">Niveles Remuneraciones</span></a>
        </li>
        @endcan

        @can('Ver-Personas')
        <li class="sidebar-item" id="personal-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="personal-a"
                href="{{ route('personas.index') }}" aria-expanded="false"><i class="fa-solid fa-user-tie"></i><span
                    class="hide-menu">Personal</span></a>
        </li>
        @endcan

        @can('Ver-Tipos-Plantillas')
        <li class="sidebar-item" id="tipoPlantilla-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="tipoPlantilla-a"
                href="{{ route('tipoplantillas.index') }}" aria-expanded="false"><i
                    class="fa-solid fa-table-list"></i><span class="hide-menu">Tipos de Planillas</span></a>
        </li>
        @endcan

        @can('Ver-Plantillas')
        <li class="sidebar-item" id="plantilla-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" id="plantilla-a"
                href="{{ route('plantillas.index') }}" aria-expanded="false"><i
                    class="fa-solid fa-table-columns"></i><span class="hide-menu">Planillas</span></a>
        </li>
        @endcan

        @can('Ver-Usuarios')
        <li class="sidebar-item" id="user-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('users.index') }}"
                aria-expanded="false" id="user-a"><i class="fa-solid fa-users"></i><span
                    class="hide-menu">Usuarios</span></a>
        </li>
        @endcan

        @can('Ver-Roles')
        <li class="sidebar-item" id="role-li">
            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('roles.index') }}"
                aria-expanded="false" id="role-a"><i class="fa-solid fa-person-circle-plus"></i><span
                    class="hide-menu">Roles</span></a>
        </li>
        @endcan

        <li class="sidebar-item border-top">
            <a class="sidebar-link has-arrow waves-effect waves-dark d-flex" href="javascript:void(0)"
                aria-expanded="false"><i class="fa-solid fa-user-lock"></i></i><span
                    class="hide-menu container-fluid">Configuración
                </span></a>
            <ul aria-expanded="false" class="collapse first-level">
                <li class="sidebar-item">
                    <a href="{{route('profile.index')}}" class="sidebar-link"><i
                            class="mdi mdi-account me-1 ms-1"></i><span class="hide-menu"> Mi Perfil
                        </span></a>
                </li>
                <li class="sidebar-item">
                    <a href="{{route('logout')}}" class="sidebar-link"><i class="fa fa-power-off me-1 ms-1"></i><span
                            class="hide-menu" id="crear-venta-li">
                            Cerrar Sección
                        </span></a>
                </li>
            </ul>
        </li>

    </ul>
</nav>