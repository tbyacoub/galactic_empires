<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ (Request::is('home')) ? 'active':'' }}"><a href="/home">Overview <span class="sr-only">(current)</span></a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Empire Overview</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Planet Overview</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Resources</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Facilities</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Planetary Defenses</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Research</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Shipyard</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Fleets</a></li>
        <li class="{{ (Request::is('')) ? 'active':'' }}"><a href="#">Galaxy Map</a></li>
    </ul>
    @if(Auth::user()->hasRole('admin'))
        <ul class="nav nav-sidebar">
            <li class="{{ (Request::is('admin/player-list')) ? 'active':'' }}"><a href="/admin/player-list">Players List</a></li>
            <li class="{{ (Request::is('admin/game-settings')) ? 'active':'' }}"><a href="/admin/game-settings">Game Settings</a></li>
            <li class="{{ (Request::is('admin/push-notifications')) ? 'active':'' }}"><a href="/admin/push-notifications">Push Notifications</a></li>
        </ul>
    @endif
</div>