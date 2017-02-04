<!--sidebar start-->
<aside>
    <div id="sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">

            <p class="centered"><a href="#"><img src="{{ URL::asset('img/ui-sam.jpg') }}" class="img-circle" width="60"></a></p>
            <h5 class="centered">{{ Auth::user()->name }}</h5>

            <li class="mt">
                <a class="active" href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>Empire Overview</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/planet-overview') }}">
                    <i class="fa fa-globe"></i>
                    <span>Planet Overview</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/resources') }}">
                    <i class="fa fa-btc"></i>
                    <span>Resources</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/facilities') }}">
                    <i class="fa fa-building"></i>
                    <span>Facilities</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/planetary-defenses') }}">
                    <i class="fa fa-shield"></i>
                    <span>Planetary Defenses</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/research') }}">
                    <i class="fa fa-university"></i>
                    <span>Research</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/shipyard') }}">
                    <i class="fa fa-space-shuttle"></i>
                    <span>Shipyard</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/fleets') }}">
                    <i class="fa fa-truck"></i>
                    <span>Fleets</span>
                </a>
            </li>

            <li class="mt">
                <a href="{{ url('/galaxy-map') }}">
                    <i class="fa fa-star"></i>
                    <span>Galaxy Map</span>
                </a>
            </li>

            @if(Auth::user()->hasRole('admin'))
                <li class="sub-menu">
                    <a href="javascript:" >
                        <i class="fa fa-desktop"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub">
                        <li><a  href="{{ url('/admin/players-list') }}">Players List</a></li>
                        <li><a  href="{{ url('/admin/game-settings') }}">Game Settings</a></li>
                        <li><a  href="{{ url('/admin/push-notification') }}">Push Notification</a></li>
                    </ul>
                </li>
            @endif

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->