
<! -- ANIMATED PROGRESS BARS -->
<div class="showback">
    <h4><i class="fa fa-angle-right"></i> Outgoing Fleets</h4>

    @if(count($from_travels) > 0)
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th>Fleet</th>
                <th>Status</th>
                <th>Our Planet</th>
                <th>Duration</th>
                <th>Enemy Planet</th>
            </tr>
        </thead>

        <tbody>
        @foreach($from_travels as $travel)
            <tr>
                <td>{{ $travel->fleet[0]['type'] }} : {{ $travel->fleet[0]['amount'] }}</td>
                <td>{{ $travel->type}}</td>
                <td>
                    <div>
                        {{ $travel->fromPlanet()->first()->name}}
                    </div>
                    <img src="{{ $travel->fromPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;">
                </td>
                <td width="40%">
                    <p>Arrives on {{ $travel->arrival }}</p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                    </div>
                </td>
                <td>
                    <div>
                        {{ $travel->toPlanet()->first()->name}}
                    </div>
                    <img src="{{ $travel->toPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;">
                </td>
            </tr>
        @endforeach
        </tbody>
        @else
            <h5>There are currently no Outgoing Fleets. Use your fleets to attack another planet and steal their resources!</h5>
        @endif
    </table>
</div>

<div class="showback">
    <h4><i class="fa fa-angle-right"></i> Incoming Fleets</h4>

    @if(count($from_travels) > 0)
    <table class="table table-striped table-advance table-hover">
        <thead>
        <tr>
            <th>Fleet</th>
            <th>Status</th>
            <th>Our Planet</th>
            <th>Duration</th>
            <th>Enemy Planet</th>
        </tr>
        </thead>

        <tbody>
        @foreach($to_travels as $travel)
            <tr>
                <td>{{ $travel->fleet[0]['type'] }} : {{ $travel->fleet[0]['amount'] }}</td>
                <td>{{ $travel->type}}</td>
                <td>
                    <div>
                        {{ $travel->toPlanet()->first()->name}}
                    </div>
                    <img src="{{ $travel->toPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;">
                </td>
                <td width="40%">
                    <p>Arrives on {{ $travel->arrival }}</p>
                    @if($travel->type == "attacking")
                        <div class="progress progress-striped active" style="transform: scaleX(-1)">
                            <div class="progress-bar progress-bar-danger"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                        </div>
                    @else
                        <div class="progress progress-striped active" style="transform: scaleX(-1)">
                            <div class="progress-bar"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                        </div>
                    @endif
                </td>
                <td>
                    <div>
                        {{ $travel->fromPlanet()->first()->name}}
                    </div>
                    <img src="{{ $travel->fromPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;">
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @else
        <h5>There are currently no Incoming Fleets, which means to Incoming Enemy Attacks. It's a good day.</h5>
    @endif
</div>
