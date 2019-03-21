<nav class="navbar navbar-expand-md text-body navbar-primary bg-white">
    <a class="navbar-brand" href="/">
        <img src="https://i.ibb.co/fxTRWgL/sifiks4.png" alt="sifiks4" width="125" class="d-inline-block align-top" border="0">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="btn-group">
        <button type="button" class="btn btn-light dropdown-toggle text-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Health Info
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Sickness</a>
            <a class="dropdown-item" href="#">Medicine</a>
            <a class="dropdown-item" href="#">Health</a>
        </div>
    </div>

    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
            <a class="nav-link" href="#">Find Hospital</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Find Doctor</a>
        </li>
    </ul>
    <ul class="navbar-nav">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item">
                <a class="nav-link" href="#">Ask a Question</a>
            </li>
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#"> Profile</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</nav>
