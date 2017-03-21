
<! -- ANIMATED PROGRESS BARS -->
<div class="showback">
    <table class="table table-striped table-advance table-hover">
    <h4><i class="fa fa-angle-right"></i> Outgoing Attacks</h4>
        <thead>
            <tr>
                <th>Fleet</th>
                <th>Image</th>
                <th>Our Planet</th>
                <th>Duration</th>
                <th>Enemy Planet</th>
                <th>Image</th>
            </tr>
        </thead>

        <tbody>
        @foreach($from_travels as $travel)
            <tr>
                <td>{{ $travel->fleet[0]['type'] }} : {{ $travel->fleet[0]['amount'] }}</td>
                <td><img src="{{ $travel->fromPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                <td>{{ $travel->fromPlanet()->first()->name}}</td>
                <td width="40%">
                    <p>Arrives on {{ $travel->arrival }}</p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                    </div>
                </td>
                <td>{{ $travel->toPlanet()->first()->name}}</td>
                <td><img src="{{ $travel->toPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="showback">
    <table class="table table-striped table-advance table-hover">
        <h4><i class="fa fa-angle-right"></i> Incoming Attacks</h4>
        <thead>
        <tr>
            <th>Image</th>
            <th>Our Planet</th>
            <th>Duration</th>
            <th>Enemy Planet</th>
            <th>Image</th>
        </tr>
        </thead>

        <tbody>
        @foreach($to_travels as $travel)
            <tr>
                <td><img src="{{ $travel->toPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                <td>{{ $travel->toPlanet()->first()->name}}</td>
                <td width="40%">
                    <p>Arrives on {{ $travel->arrival }}</p>
                    <div class="progress progress-striped active" style="transform: scaleX(-1)">
                        <div class="progress-bar progress-bar-danger"  role="progressbar" style="width: {{$travel->getTravelPercent()}}%"> </div>
                    </div>
                </td>
                <td>{{ $travel->fromPlanet()->first()->name}}</td>
                <td><img src="{{ $travel->fromPlanet()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
