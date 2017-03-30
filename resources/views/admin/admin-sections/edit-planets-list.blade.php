
<table class="table table-striped table-advance table-hover">
    <thead>
        <tr>
            <th>Image</th>
            <th>Planet Id</th>
            <th>Planet Name</th>
            <th>Solar System Id</th>
            <th>Metal</th>
            <th>Crystal</th>
            <th>Energy</th>
        </tr>
    </thead>
    <tbody>

        @foreach($user->planets()->get() as $planet)
            <tr>
                <td><img src="{{ $planet->PlanetType()->first()->img_path }}" alt="Planet Image" style="width:75px;height:75px;"></td>
                <td>{{ $planet->id }}</td>
                <td>{{ $planet->name }}</td>
                <td>{{ $planet->solarSystem_id }}</td>
                <td>
                    <div>{{ $planet->metal() }} / {{$planet->metal_storage}}</div>

                    <form class="form-horizontal style-form" method="POST" action="{{ url('/planets/' . $planet->id. '/edit/resources/metal') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-" max="{{ $planet->metal_storage }}"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>
                <td>
                    <div>{{ $planet->crystal() }} / {{$planet->crystal_storage}}</div>

                    <form class="form-horizontal style-form" method="POST" action="{{ url('/planets/' . $planet->id. '/edit/resources/crystal') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-" max="{{ $planet->crystal_storage }}"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>
                <td>
                    <div>{{ $planet->energy() }} / {{$planet->energy_storage}}</div>

                    <form class="form-horizontal style-form" method="POST" action="{{ url('/planets/' . $planet->id. '/edit/resources/energy') }}">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-" max="{{ $planet->energy_storage }}"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
