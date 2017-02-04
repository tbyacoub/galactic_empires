@extends('layouts.dashboard')

@section('sub-content')
    <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
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
                                <th><i class="fa fa-ship"></i> Resource 1</th>
                                <th><i class="fa fa-ship"></i> Resource 2</th>
                                <th><i class="fa fa-ship"></i> Resource 3</th>
                                <th><i class="fa fa-ship"></i> Modify</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($users as $user)
                                    <tr>
                                        <td><a href="basic_table.html#">{{ $user->name }}</a></td>
                                        <td class="hidden-phone">{{ $user->email }}</td>
                                        <td>
                                            <div class="btn-group" style="min-width:170px;">
                                                <button type="button" class="btn btn-theme03">
                                                    {{ $user->role }}
                                                </button>
                                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a>Activate</a></li>
                                                    <li><a>Suspend</a></li>
                                                    <li><a>Upgrade To Premium</a></li>
                                                    <li><a>Upgrade To Admin</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>###</td>
                                        <td>###</td>
                                        <td><input class="form-control" type="text" value="###" style="max-width:100px;"></td>
                                        <td><input class="form-control" type="text" value="###" style="max-width:100px;"></td>
                                        <td><input class="form-control" type="text" value="###" style="max-width:100px;"></td>
                                        <td><button type="button" class="btn btn-theme"><i class="fa fa-pencil"></i> Update</button></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->
@endsection