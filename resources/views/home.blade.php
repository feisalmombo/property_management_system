@extends('layouts.app')

@section('title', 'Home')

@section('content')


    {{-- DEVELOPER HEADER --}}
    @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
        <section class="content">
                    <h1>
                        <strong>Dashboard</strong>
                    </h1>

                    <p style="color: black">
                        <strong style="font-size: 18px">Welcome <strong style="color: blueviolet">{{ Auth::user()->first_name }}  {{ Auth::user()->last_name }}</strong> To Property Management System (PMS)</strong>
                    </p>
            <!-- 1 row -->
            <div class="row">
                    @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <a href="{{ url('/settings/manage_users/roles') }}" style="color: black">
                                <div class="info-box">
                                    <span class="info-box-icon bg-aqua"><i class="fa fa-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">System Roles</span>
                                        <span class="info-box-number">{{ $roleCount[0]->roleCount }}</span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </a>
                        </div>
                    @endif

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('/settings/manage_users/permissions') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-universal-access"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">System Permission</span>
                                <span class="info-box-number">{{ $permissionCount[0]->permissionCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('/view-users') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-user"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">System users</span>
                                <span class="info-box-number">{{ $userCount[0]->userCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('/view/properties') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Property registered</span>
                                <span class="info-box-number">{{ $propertyregisteredCount[0]->propertyregisteredCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </a>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            {{--  2 row  --}}
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('/view/tenants') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="fa fa-font-awesome"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Tenant</span>
                                <span class="info-box-number">{{ $tenantregisteredCount[0]->tenantregisteredCount }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('/view/overdue') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-paperclip"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Overdue</span>
                                <span class="info-box-number">{{ $overdue }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>


                <div class="col-md-3 col-sm-6 col-xs-12">
                    <a href="{{ url('view/expiresoon') }}"  style="color: black">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-magnet"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Total Expires Soon</span>
                                <span class="info-box-number">{{ $expiringSoon }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

            <!-- 3 row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Properties Registered Based in charts</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-9">

                                    <div class="chart">
                                        <canvas id="salesChart" style="height: 40px;"></canvas>
                                        {!! Charts::assets() !!}
                                    </div>

                                    {!! $piechart->render() !!}
                                    <!-- /.chart-responsive -->
                                </div>
                                <!-- /.col -->

                                {{--  Records Side  --}}
                                {{-- <div class="col-md-3">
                                    <p class="text-center">
                                        <strong>Records in summary</strong>
                                    </p>

                                    <div class="progress-group">
                                        <span class="progress-text">Total System Roles</span>
                                        <span class="progress-number">{{ $roleCount[0]->roleCount }}</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                                    </div>
                                    </div>
                                    <!-- /.progress-group -->

                                    <div class="progress-group">
                                        <span class="progress-text">Total System Permission</span>
                                        <span class="progress-number">{{ $permissionCount[0]->permissionCount }}</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                                    </div>
                                    </div>

                                    <!-- /.progress-group -->
                                    <div class="progress-group">
                                        <span class="progress-text">Total Users</span>
                                        <span class="progress-number">{{ $userCount[0]->userCount }}</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                                    </div>
                                    </div>
                                </div> --}}
                                <!-- /.col -->
                            </div>
                        <!-- /.row -->
                        </div>
                    </div>
                <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-8">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">All Users Registered in the System Chart</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="chart">
                                        <canvas id="salesChart" style="height: 40px;"></canvas>
                                        {{-- {!! Charts::assets() !!} --}}
                                    </div>
                                        {!! $chart->render() !!}
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box bg-aqua">
                        <span class="info-box-icon"><i class="fa fa-home"></i></span>

                        <div class="info-box-content">
                            <a href="{{ url('/view/properties') }}" style="color: white">
                                <span class="info-box-text">All Property Registered</span>
                                <span class="info-box-number">{{ $propertyregisteredCount[0]->propertyregisteredCount }}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 180%"></div>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-font-awesome"></i></span>

                        <div class="info-box-content">
                            <a href="{{ url('/view/tenants') }}" style="color: white">
                                <span class="info-box-text">All Tenants Registered</span>
                                <span class="info-box-number">{{ $tenantregisteredCount[0]->tenantregisteredCount }}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 180%"></div>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->


                    <!-- /.info-box -->
                    <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-paperclip"></i></span>

                        <div class="info-box-content">
                            <a href="{{ url('/view/overdue') }}" style="color: white">
                                <span class="info-box-text">All Overdue</span>
                                <span class="info-box-number">{{ $overdue }}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 180%"></div>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->


                    <!-- /.info-box -->
                    <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-magnet"></i></span>

                        <div class="info-box-content">
                            <a href="{{ url('/view/expiresoon') }}" style="color: white">
                                <span class="info-box-text">All Expire Soon</span>
                                <span class="info-box-number">{{ $expiringSoon }}</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: 180%"></div>
                                </div>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Main row -->

        </section>
    @endif

@endsection
