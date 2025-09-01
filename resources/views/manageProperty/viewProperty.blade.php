@extends('layouts.app')

@section('title', 'Properties')

@section('content')


<div class="col-lg-12">
	<h1 class="page-header">All Properties</h1>
</div>
<section class="content">
<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
                List of properties

                <a href="{{ url('/view/properties/create') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-plus"></i>&nbsp;Add Property</a>

			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">


				@if(!empty($propertyDatas))

                <div class="box-body">
                <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Property Name</th>
                        <th>Property Location</th>
                        {{-- <th>Property Type</th>
                        <th>Property Status</th> --}}
                        <th>Show</th>
                        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
                        <th>Edit</th>
                        @endif
                        @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
                        <th>Delete</th>
                        @endif
                        <th>Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($propertyDatas as $key=>$propertyData)
                            <tr class="odd gradeX">
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $propertyData->property_name }}</td>
                                <td>{{ $propertyData->property_location }}</td>
                                {{-- <td class="center">{{ $propertyData->type }}</td>
                                <td class="center">{{ $propertyData->status }}</td> --}}

                                <td>
                                    <a class="btn btn-info" data-toggle="modal" href='#{{ $propertyData->id."show" }}'><i class="fa fa-bullseye" arial-hidden="true"></i></a>
                                    <div class="modal fade" id="{{ $propertyData->id."show" }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title">Property Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            <label>Property Name: </label>
                                                        </div>
                                                    </div>
                                                    </div>

                                                    <div class="col-sm-9">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            {{ $propertyData->property_name }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <hr/>

                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            <label>Property Location: </label>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <div class="center-block">
                                                        <div class="form-group">
                                                            {{ $propertyData->property_location }}
                                                        </div>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    <hr/>

                                                {{-- <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        <label>Property Type: </label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        {{ $propertyData->type }}
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <hr/> --}}

                                                {{-- <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        <label>Property Status: </label>
                                                    </div>
                                                </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="center-block">
                                                    <div class="form-group">
                                                        {{ $propertyData->status }}
                                                    </div>
                                                </div>
                                                </div>
                                                </div>
                                                <hr/> --}}

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
                                <td>
                                    <a href="{{ url('/view/properties/'.$propertyData->id.'/edit') }}" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></a>
                                </td>
                                @endif

                                @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
                                <td>
                                        <a href='#{{ $propertyData->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                                        <div class="modal fade" id="{{ $propertyData->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title"><strong>Delete</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete Property Name?<h9 style="color: blue;"> {{ $propertyData->property_name." with Location: ".$propertyData->property_location }}</h9>
                                                    </div>
                                                    <form action="/view/properties/{{ $propertyData->id  }}" method="POST" role="form">

                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>

                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                @endif

                                <td>{{date("F jS, Y", strtotime($propertyData->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                  </table>
                </div>
				@else
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>No New Property found</strong>
				</div>
				@endif
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-12 -->
</div>

</section>
<!-- /.row -->

@endsection
