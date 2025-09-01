@extends('layouts.app')

@section('title', 'All ExpireSoon')

@section('content')


<div class="col-lg-12">
	<h1 class="page-header">All ExpireSoon</h1>
</div>
<section class="content">
<div class="row">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
                List of All ExpireSoon

                <a href="{{ url('/view/tenants') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>


			</div>
			<!-- /.panel-heading -->
			<div class="panel-body">


				@if(!empty($tenantDatas))

                <div class="box-body">
                <table id="example1" width="100%" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                    <th>S/N</th>
                    <th>Full Name</th>
                    {{-- <th>Email</th> --}}
                    {{-- <th>Phone Number</th> --}}
                    <th>Property Name</th>
                    <th>Property Location</th>
                    <th>Lease Start</th>
                    <th>Lease End</th>
                    {{-- <th>Total Amount</th> --}}
                    {{-- <th>Amount Paid</th> --}}
                    {{-- <th>Payment Date</th> --}}
                    {{-- <th>Receipt Attachment</th> --}}
                    {{-- <th>Payment Status</th> --}}
                    {{-- <th>Show</th> --}}
                    {{-- @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
                    <th>Edit</th>
                    @endif --}}

                    {{-- @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('administrator'))
                    <th>Delete</th>
                    @endif --}}
                    <th>Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                            @foreach($tenantDatas as $key=>$tenantData)
                            <tr class="odd gradeX"

                                @if (\Carbon\Carbon::parse($tenantData->lease_end)->addDays(7))
                                style="color: #ff9966;"
                                @endif

                            >
                                <td class="center">{{ $key + 1 }}</td>
                                <td class="center">{{ $tenantData->full_name }}</td>
                                {{-- <td class="center">{{ $tenantData->email }}</td> --}}
                                {{-- <td class="center">{{ $tenantData->phone_number }}</td> --}}
                                <td class="center">{{ $tenantData->property_name }}</td>
                                <td class="center">{{ $tenantData->property_location }}</td>
                                <td class="center">{{ $tenantData->lease_start }}</td>
                                <td class="center">{{ $tenantData->lease_end }}</td>
                                {{-- <td class="center">{{ $tenantData->total_amount }}</td> --}}
                                {{-- <td class="center">{{ $tenantData->amount_paid }}</td> --}}
                                {{-- <td class="center">{{ $tenantData->payment_date }}</td> --}}
                                {{-- <td class="center">
                                    <a href="{{ Storage::url($tenantData->receipt_attachment) }}" target="_blank" type="button" class="btn btn-danger"><i class="fa fa-download" arial-hidden="true"></i></a>
                                </td> --}}
                                {{-- <td class="center">{{ $tenantData->paid }}</td> --}}

                                {{-- @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
                                <td>
                                    <a href="{{ url('/view/tenants/'.$tenantData->id.'/edit') }}" type="button" class="btn btn-primary"><i class="fa fa-pencil-square-o" arial-hidden="true"></i></a>
                                </td>
                                @endif --}}

                                {{-- @if(Auth::user()->hasRole('developer') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('director') || Auth::user()->hasRole('superadmin'))
                                <td>
                                        <a href='#{{ $tenantData->id }}' data-toggle="modal" type="button" class="btn btn-danger"><i class="fa fa-trash" arial-hidden="true"></i></a>
                                        <div class="modal fade" id="{{ $tenantData->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title"><strong>Delete</strong></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete Tenant?<h9 style="color: blue;">{{ $tenantData->full_name }}</h9>
                                                    </div>
                                                    <form action="/view/tenants/{{ $tenantData->id  }}" method="POST" role="form">

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
                                @endif --}}

                                <td>{{date("F jS, Y", strtotime($tenantData->created_at))}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                </div>
				@else
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>No New ExpireSoon found</strong>
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
