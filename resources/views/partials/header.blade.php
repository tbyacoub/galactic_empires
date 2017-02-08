<!--header start-->
<header class="header black-bg">
    @if(Auth::user())
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
    @endif

<!--logo start-->
    <a href="{{ url('/home') }}" class="logo"><b>Galactic Empire</b></a>
    <!--logo end-->

    @if(Auth::user())
        <div class="nav notify-row" id="top_menu">
        <!--  notification start -->
        <inbox></inbox>
        <!--  notification end -->
        </div>
    @endif

    <div class="top-menu">
        <ul class="nav pull-right top-menu">
            @if(Auth::user())
                <li>
                    <a href="{{ url('/logout') }}" class="logout"
                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @else
                <li><a class="logout" href="{{ url('/login') }}">Login</a></li>
                <li><a class="logout" href="{{ url('/register') }}">Register</a></li>
            @endif
        </ul>
    </div>

</header>
<!--header end-->
