<div class="col-sm-3 col-md-2 sidebar">
    @if(Auth::user()->hasRole('player'))
        <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Empire Overview</a></li>
            <li><a href="#">Planet Overview</a></li>
            <li><a href="#">Resources</a></li>
            <li><a href="#">Facilities</a></li>
            <li><a href="#">Planetary Defenses</a></li>
            <li><a href="#">Research</a></li>
            <li><a href="#">Shipyard</a></li>
            <li><a href="#">Fleets</a></li>
            <li><a href="#">Galaxy Map</a></li>
        </ul>
    @endif
    @if(Auth::user()->hasRole('admin'))
        <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Players List</a></li>
            <li><a href="#">Game Settings</a></li>
            <li><a href="#">Push News</a></li>
        </ul>
    @endif
</div>