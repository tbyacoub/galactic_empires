
<div class="col-md-12">
    <div class="content-panel">
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
                        <td><img src="" alt="Planet Image" style="width:75px;height:75px;"></td>
                        <td>{{ $planet->id }}</td>
                        <td>{{ $planet->name }}</td>
                        <td>{{ $planet->solarSystem_id }}</td>
                        <td>
                            <div>{{ $planet->metal() }} / MAX</div>
                            <br>
                            <button data-planet-id="{{ $planet->id }}" class="add-metal btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button data-planet-id="{{ $planet->id }}" class="subtract-metal btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>
                        <td>
                            <div>{{ $planet->crystal() }} / MAX</div>
                            <br>
                            <button data-planet-id="{{ $planet->id }}" class="add-crystal btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button data-planet-id="{{ $planet->id }}" class="subtract-crystal btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>                        <td>
                            <div>{{ $planet->energy() }} / MAX</div>
                            <br>
                            <button data-planet-id="{{ $planet->id }}" class="add-energy btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button data-planet-id="{{ $planet->id }}" class="subtract-energy btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-md-12 -->
