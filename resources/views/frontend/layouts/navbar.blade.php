<div class="container-fluid header-top">
    <div class="container d-flex align-items-center">
        <div class="d-flex align-items-center h-100">
            <a href="#" class="navbar-brand" style="height: 125px;">
                <h1 class="text-primary mb-0"><i class="fas fa-bolt"></i> {{ $main_settings['site_name'] }}</h1>
                {{-- <img src="FrontEnd/img/logo.png" alt="Logo">  --}}
            </a>
        </div>
        <div class="w-100 h-100">
            <div class="topbar px-0 py-2 d-none d-lg-block" style="height: 45px;">
                <div class="row gx-0 align-items-center">
                    <div class="col-lg-8 text-center text-lg-center mb-lg-0">
                        <div class="d-flex flex-wrap">
                            <div class="border-end border-primary pe-3">
                                <a href="#" class="text-muted small"><i
                                        class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                            </div>
                            <div class="ps-3">
                                <a href="mailto:example@gmail.com" class="text-muted small"><i
                                        class="fas fa-envelope text-primary me-2"></i>example@gmail.com</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <div class="d-flex justify-content-end align-items-center">
                            <!-- Social Links -->
                            <div class="d-flex border-end border-primary pe-3">
                                <a class="btn p-0 text-primary me-3" href="{{ $main_settings['facebook_link'] }}"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn p-0 text-primary me-3" href="{{ $main_settings['twitter_link'] }}"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn p-0 text-primary me-3" href="{{ $main_settings['instagram_link'] }}"><i
                                        class="fab fa-instagram"></i></a>
                                <a class="btn p-0 text-primary me-0" href="{{ $main_settings['linkedin_link'] }}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>

                            <!-- Language Dropdown -->
                            <div class="dropdown ms-3">
                                <a href="#" class="dropdown-toggle text-white" data-bs-toggle="dropdown">
                                    <small class="text-body">
                                        <i class="fas fa-globe-europe text-primary me-2"></i> English
                                    </small>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="#" class="dropdown-item">English</a>
                                    <a href="#" class="dropdown-item">Bangla</a>
                                    <a href="#" class="dropdown-item">French</a>
                                    <a href="#" class="dropdown-item">Spanish</a>
                                    <a href="#" class="dropdown-item">Arabic</a>
                                </div>
                            </div>

                            <!-- Auth Links -->
                            <div class="ms-3 d-flex align-items-center">
                                @auth
                                    <a href="{{ route('dashboard') }}"
                                        class="text-sm text-white text-decoration-underline me-2">
                                        Dashboard
                                    </a>
                                @endauth

                                @guest
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <a href="{{ route('login') }}" class="text-sm text-white text-decoration-underline">
                                            Login
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="text-sm text-white text-decoration-underline">
                                                Register
                                            </a>
                                        @endif
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="nav-bar px-0 py-lg-0" style="height: 80px;">
                <nav class="navbar navbar-expand-lg navbar-light d-flex justify-content-lg-end">
                    <a href="#" class="navbar-brand-2">
                        <h1 class="text-primary mb-0"><i class="fas fa-bolt"></i> Electra</h1>
                        {{-- <img src="FrontEnd/img/logo.png" alt="Logo"> --}}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav mx-0 mx-lg-auto bg-white">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="/about" class="nav-item nav-link">About</a>
                            <a href="/service" class="nav-item nav-link">Service</a>
                            <a href="/blog" class="nav-item nav-link">Blog</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link" data-bs-toggle="dropdown">
                                    <span class="dropdown-toggle">Pages</span>
                                </a>

                            </div>
                            <a href="/contact" class="nav-item nav-link">Contact</a>
                            <div class="nav-btn ps-3">
                                <button
                                    class="btn-search btn btn-primary btn-md-square mt-2 mt-lg-0 mb-4 mb-lg-0 flex-shrink-0"
                                    data-bs-toggle="modal" data-bs-target="#searchModal"><i
                                        class="fas fa-search"></i></button>
                                <a href="#" class="btn btn-primary py-2 px-4 ms-0 ms-lg-3"> Get Solution</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
