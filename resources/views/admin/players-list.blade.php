@extends('layouts.dashboard')

@section('sub-content')
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <h3><i class="fa fa-angle-right"></i> Players List</h3>

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-bordered table-striped table-condensed">
                    <h4><i class="fa fa-angle-right"></i>Users List</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class="fa fa-user"></i> User</th>
                        <th><i class="fa fa-envelope"></i> E-Mail</th>
                        <th><i class="fa fa-edit"></i> Account Role</th>
                        <th><i class="fa fa-calendar"></i> Created At</th>
                        <th><i class="fa fa-globe"></i> Planets Count</th>
                        <th><i class="fa fa-ship"></i> Ships Count</th>
                        <th><i class="fa fa-ship"></i> Crystal</th>
                        <th><i class="fa fa-ship"></i> Energy</th>
                        <th><i class="fa fa-ship"></i> Metal</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td><a href="/admin/edit-player/{{ $user->id }}">{{ $user->name }}</a></td>
                            <td class="hidden-phone">{{ $user->email }}</td>
                            <td>{{ $user->cachedRoles()[0]->display_name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->planets()->count() }}</td>
                            <td>###</td>
                            <td><input class="form-control" type="text" value="{{ $user->crystal() }}" style="max-width:100px;" readonly></td>
                            <td><input class="form-control" type="text" value="{{ $user->energy() }}" style="max-width:100px;" readonly></td>
                            <td><input class="form-control" type="text" value="{{ $user->metal() }}" style="max-width:100px;" readonly></td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {{ $users->links() }}
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

@endsection