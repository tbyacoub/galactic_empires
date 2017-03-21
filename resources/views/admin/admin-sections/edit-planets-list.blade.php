
<table class="table table-striped table-advance table-hover">
    <h4><i class="fa fa-angle-right"></i> Planets List</h4>
    <hr>
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

                    <form class="form-horizontal style-form" method="POST" action="{{ url('admin/edit-player/modify-metal/'.$planet->id) }}">

                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>
                <td>
                    <div>{{ $planet->crystal() }} / {{$planet->crystal_storage}}</div>

                    <form class="form-horizontal style-form" method="POST" action="{{ url('admin/edit-player/modify-crystal/'.$planet->id) }}">

                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>                        <td>
                    <div>{{ $planet->energy() }} / {{$planet->energy_storage}}</div>

                    <form class="form-horizontal style-form" method="POST" action="{{ url('admin/edit-player/modify-energy/'.$planet->id) }}">

                        {{ csrf_field() }}
                        <div><input class="form-control btn btn-sm" type="number" name="amount" placeholder="enter +/-"></div>
                        <button type="submit" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i> Update</button>
                    </form>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
