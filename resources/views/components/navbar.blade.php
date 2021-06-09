<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <!-- Brandname -->
        <a class="navbar-brand" href="/">
            <p class="text-danger fs-4 fw-bold d-inline">
                {{ config('app.name') }}
            </p>
        </a>

        <!-- Mobile Menu Icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- Nav links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @foreach ($navlinks as $navlink)
                <li class="nav-item">
                    <a
                        class="nav-link px-3 {{ ($loop->first) ? 'active' : '' }}"
                        aria-current="{{ ($loop->first) ? 'page' : '' }}"
                        href="{{ $navlink->route }}"
                    >
                        {{ $navlink->title }}
                    </a>
                </li>
                @endforeach
            </ul>

            <!-- Auth links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
                @endguest

                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        {{ csrf_field() }}
                    </form>
                </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
