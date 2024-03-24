<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
    <a href="{{ route('companies-test.index') }}" class="nav-link {{ Request::is('companies-test') ? 'active' : '' }}">
        <i class="nav-icon fas fa-building"></i>
        <p>Cadastrar Empresa</p>
    </a>

</li>
