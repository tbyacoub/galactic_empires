@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    <h3 class="panel-title">Login to Play Galactic Empires!</h3>
                </div>

                <div class="panel-body">
                    <form action="/login" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="enter email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="password" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="login" class="btn btn-success pull-right">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection