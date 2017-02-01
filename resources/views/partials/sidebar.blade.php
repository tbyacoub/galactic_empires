<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li class="{{ (Request::is('home')) ? 'active':'' }}">
            <a href="{{ url('/home') }}">Overview</a></li>
        <li class="{{ (Request::is('empire-overview')) ? 'active':'' }}">
            <a href="{{ url('empire-overview') }}">Empire Overview</a></li>
        <li class="{{ (Request::is('planet-overview')) ? 'active':'' }}">
            <a href="{{ url('planet-overview') }}">Planet Overview</a></li>
        <li class="{{ (Request::is('resources')) ? 'active':'' }}">
            <a href="{{ url('resources') }}">Resources</a></li>
        <li class="{{ (Request::is('facilities')) ? 'active':'' }}">
            <a href="{{ url('facilities') }}">Facilities</a></li>
        <li class="{{ (Request::is('planetary-defences')) ? 'active':'' }}">
            <a href="{{ url('planetary-defences') }}">Planetary Defenses</a></li>
        <li class="{{ (Request::is('research')) ? 'active':'' }}">
            <a href="{{ url('research') }}">Research</a></li>
        <li class="{{ (Request::is('shipyard')) ? 'active':'' }}">
            <a href="{{ url('shipyard') }}">Shipyard</a></li>
        <li class="{{ (Request::is('fleets')) ? 'active':'' }}">
            <a href="{{ url('fleets') }}">Fleets</a></li>
        <li class="{{ (Request::is('galaxy-map')) ? 'active':'' }}">
            <a href="{{ url('galaxy-map') }}">Galaxy Map</a></li>
    </ul>
    @if(Auth::user()->hasRole('admin'))
        <ul class="nav nav-sidebar">
            <li class="{{ (Request::is('admin/player-list')) ? 'active':'' }}">
                <a href="{{ url('/admin/player-list') }}">Players List</a></li>
            <li class="{{ (Request::is('admin/game-settings')) ? 'active':'' }}">
                <a href="{{ url('/admin/game-settings') }}">Game Settings</a></li>
            <li class="{{ (Request::is('admin/push-notifications')) ? 'active':'' }}">
                <a href="{{ url('/admin/push-notifications') }}">Push Notifications</a></li>
        </ul>
    @endif
</div>