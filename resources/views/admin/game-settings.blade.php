@extends('layouts.dashboard')

@section('sub-content')
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Admin : Game Speed Settings</h3>

            <!-- INPUT MESSAGES -->
            <div class="row mt">
                <div class="col-lg-12">
                    <div class="form-panel">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> Speed Settings </h4>
                        <form class="form-horizontal tasi-form" method="get">

                            {{-- Research--}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Research</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Infrastructure--}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Infrastructure</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{--Ship Recruitment/Build--}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Ship Recruitment</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Travel Speed--}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Travel Speed</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Minerals --}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Minerals</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Energy --}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Energy </label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Crystal --}}
                            <div class="form-group has-error">
                                <label class="col-sm-2 control-label col-lg-2" for="inputError">Crystal</label>
                                <div class="col-lg-10">
                                    <select class="form-control">
                                        <option>1.0</option>
                                        <option>1.2</option>
                                        <option>1.4</option>
                                        <option>1.6</option>
                                        <option>1.8</option>
                                        <option>2.0</option>
                                        <option>10.0</option>
                                    </select>
                                </div>
                            </div>

                            <input type="button" class="btn btn-theme" value="Submit Update">
                        </form>
                    </div><!-- /form-panel -->
                </div><!-- /col-lg-12 -->
            </div><!-- /row -->


        </section><! --/wrapper -->
    </section><!-- /MAIN CONTENT -->

@endsection