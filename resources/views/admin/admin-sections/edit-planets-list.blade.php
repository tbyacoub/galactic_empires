
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

                    <div><input class="form-control btn btn-sm" type="number"></div>
                    <a type="button" class="btn btn-success btn-sm" href="/admin/edit-player/modify-resource/{{$planet->id}}/add/"><i class="fa fa-plus"></i> Add</a>
                    <a type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Remove</a>

                </td>
                <td>
                    <div>{{ $planet->crystal() }} / {{$planet->crystal_storage}}</div>
                    <div><input class="form-control btn btn-sm" type="number"></div>
                    <a type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
                    <a type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Remove</a>

                </td>                        <td>
                    <div>{{ $planet->energy() }} / {{$planet->energy_storage}}</div>
                    <div><input class="form-control btn btn-sm" type="number"></div>
                    <a type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add</a>
                    <a type="button" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> Remove</a>

                </td>
            </tr>
        @endforeach

    </tbody>
</table>
