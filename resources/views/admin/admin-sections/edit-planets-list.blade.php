
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
                    <th>Wood</th>
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
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>
                        <td>
                            <div>{{ $planet->wood() }} / MAX</div>
                            <br>
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>                        <td>
                            <div>{{ $planet->energy() }} / MAX</div>
                            <br>
                            <button class="btn btn-success btn-sm"><i class="fa fa-plus"></i> 1000</button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-minus"></i> 1000</button>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-md-12 -->

