@extends('layouts.dashboard')

@section('sub-content')

    <!--main content start-->
    <h3><i class="fa fa-angle-right"></i> Admin : Post Notifications/Updates</h3>

    {{-- Form : Create new Post --}}
    <div class="row mt">
        <div class="col-lg-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-panel">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Input Messages</h4>
                <form class="form-horizontal tasi-form" method="POST" action="{{ url('/posts') }}">

                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="col-sm-2 control-label col-lg-2">Post Title :</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="title" placeholder="enter title" value="{{ old('title') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label col-lg-2">Scheduled Date :</label>
                        <div class="col-lg-10">
                            <input type="date" class="form-control" name="post_date" placeholder="placeholder" value="{{ old('post_date') }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label col-lg-2">Content :</label>
                        <div class="col-lg-10">
                            <textarea class="form-control" name="content" placeholder="enter content...">{{ old('content') }}</textarea>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-theme" value="Submit Post">

                </form>
            </div><!-- /form-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->

    {{-- Posts History--}}
    <div class="row mt">
        <div class="col-lg-12">
            <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Posts History</h4>
                <section id="no-more-tables">
                    <table class="table table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                            <tr>
                                <th style="width: 5%;"><i class="fa fa-hashtag-"></i> Id</th>
                                <th style="width: 5%;"><i class="fa fa-hashtag-"></i>Posted By</th>
                                <th style="width: 13%;"><i class="fa fa-sort-alpha-asc-"></i> Title</th>
                                <th style="width: 15%;"><i class="fa fa-calendar-"></i> Date Posted</th>
                                <th style="width: 55%;"><i class="fa fa-comment-"></i> Content </th>
                                <th style="width: 7%;"><i class="fa fa-pencil-" style="width:10%;"></i> Edit/Remove </th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user_id }}</td>
                                <td><input class="form-control" name="{{ 'title_'. $post->id }}" id="{{ 'title_'. $post->id }}" value="{{ $post->title }}"></td>
                                <td>{{ $post->post_date }}</td>
                                <td><textarea class="form-control" name="{{ 'content_'. $post->id }}" id="{{ 'content_'. $post->id }}">{{ $post->content }}</textarea></td>
                                <td>

                                    <form action="{{ url('/posts/' . $post->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <button type="submit" class="btn btn-primary btn-md fa fa-pencil"></button>
                                    </form>

                                    <form action="{{ url('/posts/'. $post->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger btn-md fa fa-trash-o"></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $posts->links() }}

                </section>
            </div><!-- /content-panel -->
        </div><!-- /col-lg-12 -->
    </div><!-- /row -->


@endsection