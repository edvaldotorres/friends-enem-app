<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Enem Feliz<sup>*</sup></div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Gestão de aulas
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('disciplines.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Diciplinas</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-tablet-alt"></i>
            <span>Aulas</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('class.index') }}">Listagem</a>
                <a class="collapse-item" href="{{ route('class.create') }}">Cadastro</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Gestão de usuários
    </div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('teachers.index') }}">
            <i class="fas fa-solid fa-user-shield"></i>
            <span>Professores</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('students.index') }}">
            <i class="fas fa-solid fa-users"></i>
            <span>Alunos</span></a>
    </li>
    <div class="sidebar-card d-none d-lg-flex">
        <p class="text-center mb-2"><strong>ENEM FELIZ -</strong> Quaisquer dúvidas, favor entrar em contato</p>
        <a class="btn btn-success btn-sm" href="https://api.whatsapp.com/send?phone=5581997252471"
            target="_blank">Suporte</a>
    </div>
</ul>
