<nav class="navbar navbar-expand-lg" style="background-color: #05184E">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ url('assets/logo.JPG') }}" alt="Logo"
                class="d-inline-block align-text-center img-fluid rounded mx-auto d-block">
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
                <li class="nav-item">
                    <a class="nav-link text-white" aria-current="page" href="{{ url('/') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="profileDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Profile
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item " href="{{ url('visi-misi') }}">Visi dan Misi</a></li>
                        <li><a class="dropdown-item" href="{{ url('dosen') }}">Dosen</a></li>
                        <li><a class="dropdown-item" href="{{ url('akreditasi') }}">Akreditasi</a></li>
                        <li><a class="dropdown-item" href="{{ url('struktur') }}">SO</a></li>
                        <li><a class="dropdown-item" href="{{ url('alumni') }}">Alumni</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="layananDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li><a class="dropdown-item" href="{{ url('aproval') }}">Aproval Kaprodi</a></li>
                        {{-- <li><a class="dropdown-item" href="{{ url('sinta') }}">Pengaduan</a></li> --}}
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="layananDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Agenda
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="layananDropdown">
                        <li><a class="dropdown-item" href="{{ url('events') }}">Jadwal</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="risetDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Riset dan Pengabdian
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="risetDropdown">
                        <li><a class="dropdown-item" href="{{ url('jurnal') }}">Daftar Jurnal</a></li>
                        <li><a class="dropdown-item" href="{{ url('sinta') }}">Profil Sinta</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="infoDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Info Penting
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="infoDropdown">
                        <li><a class="dropdown-item" href="{{ url('sorotan') }}">Terkini</a></li>
                        <li><a class="dropdown-item" href="{{ url('lomba') }}">Lomba</a></li>
                    </ul>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ url('lainnya') }}">Lainnya</a>
                </li> --}}
            </ul>

            <div class="navbar-nav ms-auto">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-md login btn-outline-primary">Login</a>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                {{ Auth::user()->name }}
                            @endauth
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ '/logout' }}">Logout</a>
                            </li>
                            {{-- <li>
                                <hr class="dropdown-divider">
                            </li> --}}
                        </ul>
                    </li>
                @endauth
            </div>

        </div>
    </div>
</nav>
