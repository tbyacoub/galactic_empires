<! -- TUTORIAL -->
<div class="showback">
        @php
                $tutorial = "";
                switch (Request::path()) {
                    case 'home':
                        $tutorial = "Home";
                        break;
                    case 'planets':
                        $tutorial = "Planet Overview";
                        break;
                    case 'building/resource':
                        $tutorial = "Resources";
                        break;
                    case 'building/facility':
                        $tutorial = "Facilities";
                        break;
                    case 'building/planetary_defenses':
                        $tutorial = "Planetary Defense";
                        break;
                    case 'building/research':
                        $tutorial = "Research";
                        break;
                    case 'building/shipyard':
                        $tutorial = "Shipyard";
                        break;
                    case 'fleets':
                        $tutorial = "Fleets";
                        break;
                    case 'galaxy-map':
                        $tutorial = "Galaxy Map";
                        break;
                        default:
                        //code to be executed
                }
        @endphp

    <h4><i class="fa fa-angle-right"></i> {{ $tutorial }} Tutorial </h4>
    <a href=" {{ url('/complete-tutorial') }}">I got this.. Skip Tutorial</a>
    <div class="alert alert-info">
        @if(Request::path() == 'home')
            <a href="{{ url('/planets') }}" class="close" aria-hidden="true">Continue To Planet Overview</a>
            <strong>Messaging : </strong> You can message other players via the envelop on the top navigation bar. <br>
            <strong>Notifications : </strong> You will also receive instant notifications on game events such as
            Game Rate changes, Buildings Constructed, Attacks, etc.. <br>
            <strong>User Control : </strong> The below user control will be found on most views. You'll be able to
            select any of your planets. <br> It will also display the current Planet information. <br>
            <strong>Fleet Travels : </strong> The Fleet Travels is located below the User Control. Later on, when you have a fleet
            or are worthy of being attacked, <br> you will be able to track all your fleets that aren't docked at a planet. <br>
            <strong>Outgoing Fleets : </strong> This section will contain all your Fleets outgoing to attack an Enemy Planet. <br>
            <strong>Incoming Fleets : </strong> This section will contain either Incoming Attacks, or your Returning Fleets.<br>

        @elseif(Request::path() == 'planets')
            <a href="{{ url('/building/resource') }}" class="close" aria-hidden="true">Continue To Resources</a>
            <strong>Planet Overview : </strong> Compared to your User Control, this view will give you a more detailed view of your Planet.

        @elseif(Request::path() == 'building/resource')
            <a href="{{ url('/building/facility') }}" class="close" aria-hidden="true">Continue To Facilities</a>
            <strong>Resource Gathering : </strong> You will receive a certain amount of resources every 5 minutes. <br>
            <strong>Resource Upgrades : </strong> Upgrade your resource buildings below to increase the amount you get. Increasing levels will cost more and take longer.

        @elseif(Request::path() == 'building/facility')
            <a href="{{ url('/building/planetary_defenses') }}" class="close" aria-hidden="true">Continue To Planetary Defenses</a>
            <strong>Resource Storage : </strong> As you may ave already noticed, there is capacity to how many resources you can have
            Increase this Storage Cap by <br> upgrading your storage buildings below.


        @elseif(Request::path() == 'building/planetary_defenses')
            <a href="{{ url('/building/research') }}" class="close" aria-hidden="true">Continue To Research</a>
            <strong>Planetary Defenses : </strong> When you get attacked, which will happen, you will need to defend your planet. Your first line of  <br>
            defense will be your stationed fleet. However, your planetary defenses will provide continuous damage to the enemy fleet. <br>
            <strong>Upgrade Defenses : </strong> Upgrade your defenses to increase the damage they do to the enemy fleet.

        @elseif(Request::path() == 'building/research')
            <a href="{{ url('/building/shipyard') }}" class="close" aria-hidden="true">Continue To Shipyard</a>
            <strong>Research Lab : </strong> Your Research Lab provides bonuses to the gather rate of your resources. Each upgrade provides a 5% increase. <br>
            <strong>Alloy Lab : </strong> Your Alloy Lab will only provide a bonus to your metal rate, however it will be of 15% per upgrade.

        @elseif(Request::path() == 'building/shipyard')
            <a href="{{ url('/fleets') }}" class="close" aria-hidden="true">Continue To Fleets</a>
            <strong>Shipyard Capacity : </strong> Similar to resources, there is also a limit on how many ships of each type can be docked at each Planet. <br>
            <strong>Shipyard Upgrades : </strong> Upgrade your Shipyards to increase the max capacity of that type of ship, for the current Planet. <br>

        @elseif(Request::path() == 'fleets')
            <a href="{{ url('/galaxy-map') }}" class="close" aria-hidden="true">Continue To Galaxy Map</a>
            <strong>Fleets : </strong> Create fleets to attack enemy planets or to defend your planet. <br>

        @elseif(Request::path() == 'galaxy-map')
            <a href="{{ url('/complete-tutorial') }}" class="close" aria-hidden="true">Complete Tutorial</a>
            <strong>Solar System : </strong> Each location on the map contains a Solar System, explore different systems to find different planets. <br>
            <strong>Where's my Planets?  </strong> Solar Systems marked yellow contain Planets that belong to you. <br>
            <strong>Let's attack! </strong> Build up your fleet, find an enemy Planet, Attack it and gain loot! Note: The further their Planet is, the longer it will take to reach it.

        @endif
    </div>
</div><!-- /showback -->