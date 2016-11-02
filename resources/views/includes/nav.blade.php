<div class="navbar-header">

    <!-- Collapsed Hamburger -->
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <!-- Branding Image -->
    <a class="navbar-brand" href="{{ url('/') }}">
        <span class="fa fa-fire" style="color: red"></span>
        {{ config('app.name', 'Laravel') }}
    </a>
</div>

<div class="collapse navbar-collapse" id="app-navbar-collapse">

    <ul class="nav navbar-nav navbar-right" id="no-panel-links">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}"><span class="fa fa-user"></span> Login</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="fa fa-user-secret"></span>
                    {{ Auth::user()->name }} <span class="fa fa-caret-down"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        @if(Auth::user()->is_admin)
                            <a href="{{ url('/admin') }}">
                                <span class="fa fa-line-chart"></span>
                                Admin Panel
                            </a>
                        @endif
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out"></span>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="nav navbar-nav navbar-right" id="panel-links">
        <!-- Authentication Links -->
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}"><span class="fa fa-user"></span> Login</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="fa fa-user-secret"></span>
                    {{ Auth::user()->name }} <span class="fa fa-caret-down"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        @if(Auth::user()->is_admin)
                            <a href="{{ url('/admin') }}">
                                <span class="fa fa-line-chart"></span>
                                Admin Panel
                            </a>
                        @endif
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            <span class="fa fa-sign-out"></span>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>

            @if(Auth::user()->is_admin)
                @include('includes.admin_links')
            @endif
        @endif
    </ul>
</div>