<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

        <!-- Brandname -->
        <a class="navbar-brand" href="/">
            <p class="text-danger fs-4 fw-bold d-inline">
                {{ config('app.name') }}
            </p>
        </a>

        <!-- Mobile Menu Icon -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            <!-- Nav links -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @foreach($navlinks as $navlink)
                    @if ($navlink->hasChild)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                id="navbarDropdown{{ $navlink->id }}"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{  $navlink->title }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach ($navlink->child as $sub_link)
                                    <li>
                                        <a class="dropdown-item" href="{{ $sub_link->slug }}">
                                            {{ $sub_link->title }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @elseif (!$navlink->hasParent())
                        <li class="nav-item">
                            <a class="nav-link px-3 {{ ($loop->first) ? 'active' : '' }}"
                                aria-current="{{ ($loop->first) ? 'page' : '' }}"
                                href="{{ $navlink->slug }}">
                                {{ $navlink->title }}
                            </a>
                        </li>
                    @endif
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
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endauth

            </ul>

        </div>
    </div>
</nav>
