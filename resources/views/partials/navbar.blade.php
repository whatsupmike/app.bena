<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            @if(Auth::check())
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            @endif
                {{ link_to_route('dashboard', $title=config('app.name'), null, ['class' => 'navbar-brand']) }}

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                @if(Auth::check())
                    <li>{{ link_to_route('car.index', $title=trans('cars.navbar')) }}</li>
                    <li>{{ link_to_route('trip.create', $title=trans('trips.navbar')) }}</li>
                    <li>{{ link_to_route('fuel.create', $title=trans('fuels.navbar')) }}</li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right user-nav">
                <!-- Authentication Links -->
                @unless(Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu custom-dropdown-element" role="menu">
                            <li>
                                <a href="{{ url('/preferences') }}">
                                    <i class="fa fa-btn fa-cog"></i> {{ trans('navigation_bar.preferences') }}
                                </a>
                            </li>
                            <li>
                                
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-btn fa-sign-out"></i> {{ trans('navigation_bar.logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endunless
            </ul>

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
