@extends('layouts.dashboard')

@section('sub-content')

    <div class="row mt">
        <div class="col-md-12">
            <div class="content-panel">
                <table class="table table-bordered table-striped table-condensed">
                    <h4><i class="fa fa-angle-right"></i> Users List</h4>
                    <hr>
                    <thead>
                    <tr>
                        <th><i class="fa fa-user"></i> User</th>
                        <th><i class="fa fa-envelope"></i> E-Mail</th>
                        <th><i class="fa fa-edit"></i> Account Role</th>
                        <th><i class="fa fa-calendar"></i> Created At</th>
                        <th><i class="fa fa-globe"></i> Planets Count</th>
                        <th><i class="fa fa-ship"></i> Crystal</th>
                        <th><i class="fa fa-ship"></i> Energy</th>
                        <th><i class="fa fa-ship"></i> Metal</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <td><a href="{{ url('/users/' . $user->id . '/edit') }}">{{ $user->name }}</a></td>
                            <td class="hidden-phone">{{ $user->email }}</td>
                            <td>{{ $user->cachedRoles()[0]->display_name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->planets()->count() }}</td>
                            <td>{{ $user->crystal() }}</td>
                            <td>{{ $user->energy() }}</td>
                            <td>{{ $user->metal() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $users->links() }}
            </div><!-- /content-panel -->
        </div><!-- /col-md-12 -->
    </div><!-- /row -->

@endsection