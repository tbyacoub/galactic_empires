@extends('layouts.dashboard')

@section('sub-content')

    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Admin : Post Notifications/Updates</h3>

            {{-- Form : Create new Post --}}
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Input Messages</h4>
                        <form class="form-horizontal tasi-form" method="get">

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Post Title :</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="enter title">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Scheduled Date :</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" placeholder="placeholder">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label col-lg-2">Content :</label>
                                <div class="col-lg-10">
                                    <textarea type="text" class="form-control" placeholder="enter content..."></textarea>
                                </div>
                            </div>

                            <input type="button" class="btn btn-theme" value="Submit Post">

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
                                        <th><i class="fa fa-hashtag-"></i> Id</th>
                                        <th><i class="fa fa-sort-alpha-asc-"></i> Title</th>
                                        <th><i class="fa fa-calendar-"></i> Date Posted</th>
                                        <th><i class="fa fa-comment-"></i> Content </th>
                                        <th><i class="fa fa-pencil-" style="widh:10%;"></i> Edit/Remove </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>###</td>
                                        <td>Title</td>
                                        <td>Date</td>
                                        <td>Content</td>
                                        <td>
                                            <button class="btn btn-primary btn-md fa fa-pencil"></button>
                                            <button class="btn btn-danger btn-md fa fa-trash-o" data-toggle="modal" data-target="#myModal"></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </section>
                    </div><!-- /content-panel -->
                </div><!-- /col-lg-12 -->
            </div><!-- /row -->

            <!-- Hidden : Post Removal Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title" id="myModalLabel">Remove Post</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to remove this Post? The removal is permanent.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-danger">Remove </button>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </section>
@endsection