<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Enem Feliz<sup>*</sup></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @can('admin')
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Gestão de diciplinas
        </div>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('disciplines.index') }}">
                <i class="fas fa-solid fa-plus"></i>
                <span>Cadastrar</span></a>
            <a class="nav-link" href="{{ route('disciplines.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Diciplinas</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Gestão de usuários
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-solid fa-users"></i>
                <span>Usuários</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('teachers.index') }}">Professores</a>
                    <a class="collapse-item" href="{{ route('students.index') }}">Alunos</a>
                </div>
            </div>
        </li>
    @endcan
    <hr class="sidebar-divider d-none d-md-block">
    <div class="sidebar-heading">
        Gestão de perfil
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            <span>Sair</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>ENEM FELIZ -</strong> Quaisquer dúvidas, favor entrar em contato</p>
        <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone=5581997252471"
            target="_blank">Suporte</a>
    </div>
</ul>
