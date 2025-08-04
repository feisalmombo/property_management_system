@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Edit Tenant</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Edit Truck<a href="{{ url('/view/tenants') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid pull-left">
					<section class="container center-block">
						<div class="container-page">
							<div class="col-md-12">

                                <form role="form"  action="{{ url('/view/tenants/'.$tenants->id) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('PATCH') }}

                                    <h2 style="text-align: center;">Tenant Details:</h2>
									<div class="col-md-4">

										<div class="form-group">
											<label>Full Name: </label>
                                            <input class="form-control" name="full_name" value="{{ isset($tenants->full_name) ? $tenants->full_name : old('full_name') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Tenant TIN (Optional): </label>
                                            <input class="form-control" name="tin" value="{{ isset($tenants->tin) ? $tenants->tin : old('tin') }}">
                                        </div>


                                        <div class="form-group">
                                            <label>Property Name: </label>
                                            <select class="form-control"  required="required" name="property_id" id="property_id">
                                                <option value="">-- Select Property Name --</option>
                                                    @foreach($fetchallproperties as $fetchallproperty)
                                                    <option value="{{ $fetchallproperty->property_name }}">{{ $fetchallproperty->property_name }}</option>
                                                    @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="form-group">
                                                <label>Lease Attachment (Optional): </label>
                                                <input type="file" name="lease_attachment" id="lease_attachment" class="form-control" value="{{ isset($tenants->lease_attachment) ? $tenants->lease_attachment : old('lease_attachment') }}">
                                        </div> --}}

                                        <div class="form-group">
                                                <label>Payment Date: </label>
                                                <input type="date" class="form-control" name="payment_date" value="{{ isset($tenants->payment_date) ? $tenants->payment_date : old('payment_date') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <label>Tenant Email: </label>
                                                <input class="form-control" name="email" value="{{ isset($tenants->email) ? $tenants->email : old('email') }}">
                                            </div>

                                            {{-- <div class="form-group">
                                                    <label>Tenant NIDA (Optional): </label>
                                                    <input class="form-control" name="nida_number" value="{{ isset($tenants->nida_number) ? $tenants->nida_number : old('nida_number') }}">
                                                </div> --}}

                                                <div class="form-group">
                                                        <label>Lease Start: </label>
                                                        <input type="date" class="form-control" name="lease_start" value="{{ isset($tenants->lease_start) ? $tenants->lease_start : old('lease_start') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Amount: </label>
                                                    <input class="form-control" name="total_amount" value="{{ isset($tenants->total_amount) ? $tenants->total_amount : old('total_amount') }}">
                                                </div>

                                                {{-- <div class="form-group">
                                                    <label>Receipt Attachment (Optional): </label>
                                                    <input type="file" name="receipt_attachment" id="receipt_attachment" class="form-control" value="{{ isset($tenants->receipt_attachment) ? $tenants->receipt_attachment : old('receipt_attachment') }}">
                                                </div> --}}

										<div class="form-group" style="padding-top:25px">
                                                <button type="submit" class="btn btn-primary center-block">
                                                    Update
                                                </button>
                                            </div>
                                    </div>


                                    <div class="col-md-4">

										<div class="form-group">
											<label>Tenant Phone Number: </label>
                                            <input class="form-control" name="phone_number" value="{{ isset($tenants->phone_number) ? $tenants->phone_number : old('phone_number') }}">
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>Tenant NIDA, or others Attachments (Optional): </label>
                                            <input type="file" name="nida_attachment" id="nida_attachment" class="form-control" value="{{ isset($tenants->nida_attachment) ? $tenants->nida_attachment : old('nida_attachment') }}">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label>Lease End: </label>
                                            <input type="date" class="form-control" name="lease_end">
                                        </div> --}}

                                        <div class="form-group">
                                            <label>Amount Paid: </label>
                                            <input class="form-control" name="amount_paid" value="{{ isset($tenants->amount_paid) ? $tenants->amount_paid : old('amount_paid') }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Status: </label>
                                            <select class="form-control"  required="required" name="status" id="status">
                                                <option value="">-- Select Status --</option>
                                                        <option value="Paid">Paid</option>
                                                        <option value="Unpaid">Unpaid</option>
                                            </select>
                                        </div>

                                    </div>
								</form>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
@endsection
