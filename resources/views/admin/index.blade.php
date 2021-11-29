@extends('layouts.dashboard.app')

@section('title','Dashboard')

@push('css')

@endpush

@section('content')
<div class="container-fluid">
    <div class="block-header">
        <h2>DASHBOARD</h2>
    </div>

    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-pink hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL POSTS</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-cyan hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">favorite</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL FAVORITE</div>
                    <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">library_books</i>
                </div>
                <div class="content">
                    <div class="text">PENDING POSTS</div>
                    <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="info-box bg-orange hover-expand-effect">
                <div class="icon">
                    <i class="material-icons">person_add</i>
                </div>
                <div class="content">
                    <div class="text">TOTAL VIEWS</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Widgets -->


    <!-- Widgets -->
    <div class="row clearfix">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-3">
            <div class="info-box bg-blue-grey hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">playlist_add_check</i>
                </div>
                <div class="content">
                    <div class="text">TAGS</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
              <div class="info-box bg-purple hover-zoom-effect">
                <div class="icon">
                    <i class="material-icons">apps</i>
                </div>
                <div class="content">
                    <div class="text">CATEGORIES</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
             <div class="info-box bg-deep-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                <div class="content">
                    <div class="text">TOTAL AUHTORS</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
            <div class="info-box bg-deep-purple hover-zoom-effect">
                    <div class="icon">
                        <i class="material-icons">fiber_new</i>
                    </div>
                <div class="content">
                    <div class="text">TODAY AUTHOR</div>
                    <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-3 col-sm-6 col-xs-9">
          <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                   <th>Rank</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Views</th>
                                        <th>Favorite</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Task A</td>
                                    <td><span class="label bg-green">Doing</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                        </div>
                                    </td>
                                </tr>

                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- #END# Widgets -->

 

    <div class="row clearfix">
        <!-- Task Info -->
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12">
            <div class="card">
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Task</th>
                                    <th>Status</th>
                                    <th>Manager</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Task A</td>
                                    <td><span class="label bg-green">Doing</span></td>
                                    <td>John Doe</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar bg-green" role="progressbar" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100" style="width: 62%"></div>
                                        </div>
                                    </td>
                                </tr>

                              
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
  
    </div>
</div>
@endsection


@push('js')
  

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/dashboard/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Morris Plugin Js -->
    <script src="{{ asset('assets/dashboardplugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/morrisjs/morris.js') }}"></script>

    <!-- ChartJs -->
    <script src="{{ asset('assets/dashboard/plugins/chartjs/Chart.bundle.js') }}"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/flot-charts/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/flot-charts/jquery.flot.categories.js') }}"></script>
    <script src="{{ asset('assets/dashboard/plugins/flot-charts/jquery.flot.time.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/pages/index.js') }}"></script>
@endpush
