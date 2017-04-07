<! -- ANIMATED PROGRESS BARS -->
<div class="showback">
    <h4><i class="fa fa-angle-right"></i> Outgoing Fleets</h4>
    @if(count($outgoing) > 0)
        <table class="table table-striped table-advance table-hover">
            <thead>
            <tr>
                <th>Your Fleet</th>
                <th>Image</th>
                <th>Our Planet</th>
                <th>Duration</th>
                <th>Enemy Planet</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach($outgoing as $travel)
                <tr>
                    <td>
                        @if($travel->fleet[0] > 0) Babylon 5: {{ $travel->fleet[0] }} <br> @endif
                        @if($travel->fleet[1] > 0) Battlestar Galactica: {{ $travel->fleet[1] }} <br> @endif
                        @if($travel->fleet[2] > 0) Stargate: {{ $travel->fleet[2] }} <br> @endif
                    </td>
                    <td><img src="{{ $travel->fromPlanet()->first()->PlanetType->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                    <td>{{ $travel->fromPlanet()->first()->name}}</td>
                    <td width="40%">
                        <p>Arrives on {{ $travel->arrival }}</p>
                        <div class="progress progress-striped active">
                            <div data-rate="{{ $travel->getPercentRatePerSecond() }}" data-width=" {{$travel->getTravelPercent()}}" class="progress-bar from-travel-pb"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"></div>
                        </div>
                    </td>
                    <td>{{ $travel->toPlanet()->first()->name}}</td>
                    <td><img src="{{ $travel->toPlanet()->first()->PlanetType->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5>There are currently no Outgoing Attacks. Use your fleets to attack another planet and steal their resources!</h5>
    @endif
</div>

<div class="showback">
    <h4><i class="fa fa-angle-right"></i> Incoming Fleets</h4>
    @if(count($incoming) > 0)
        <table class="table table-striped table-advance table-hover">
            <thead>
            <tr>
                <th>Image</th>
                <th>Status</th>
                <th>Our Planet</th>
                <th>Duration</th>
                <th>Enemy Planet</th>
                <th>Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach($incoming as $travel)
                <tr>
                    <td><img src="{{ $travel->toPlanet()->first()->PlanetType->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                    <td>
                        @if($travel->type == "attacking") Enemy is Attacking
                        @else Returning Fleet Carrying: <br>
                        {{ $travel->metal }} Metal <br>
                        {{ $travel->energy }} Crystal <br>
                        {{ $travel->crystal }} Energy <br>
                        @endif
                    </td>
                    <td>{{ $travel->toPlanet()->first()->name}}</td>
                    <td width="40%">
                        <p>Arrives on {{ $travel->arrival }}</p>
                        <div class="progress progress-striped active" style="transform: scaleX(-1)">
                            <div data-rate="{{ $travel->getPercentRatePerSecond() }}" data-width=" {{ $travel->getTravelPercent() }}" class="progress-bar progress-bar-danger from-travel-pb"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                        </div>
                    </td>
                    <td>{{ $travel->fromPlanet()->first()->name}}</td>
                    <td><img src="{{ $travel->fromPlanet()->first()->PlanetType->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h5>There are currently no Incoming Attacks. It's a good day.</h5>
    @endif
</div>