@extends('layouts.app')

@section('title', 'Add Tenant')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Add Tenant</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Create Tenant<a href="{{ url('/view/tenants') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid pull-left">
					<section class="container center-block">
						<div class="container-page">
							<div class="col-md-12">

								<form role="form"  action="{{ url('/view/tenants') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <h2 style="text-align: center;">Tenant Details:</h2>
									<div class="col-md-4">

										<div class="form-group">
											<label>Full Name: </label>
											<input class="form-control" name="full_name" required="required"  placeholder="eg: Ally Mzee Kidia">
                                        </div>

                                        <div class="form-group">
                                            <label>Tenant TIN (Optional): </label>
                                            <input class="form-control" name="tin" placeholder="eg: 186-789-098">
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
                                                <input type="file" name="lease_attachment" id="lease_attachment" class="form-control">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                                <label>Payment Date: </label>
                                                <input type="date" name="payment_date" id="payment_date" class="form-control">
                                        </div> --}}
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <label>Tenant Email: </label>
                                                <input class="form-control" name="email" placeholder="eg: allymzee@gmail.com">
                                            </div>

                                            {{-- <div class="form-group">
                                                    <label>Tenant NIDA (Optional): </label>
                                                    <input class="form-control" name="nida_number" placeholder="eg: 19930629-41208-00005-28">
                                                </div> --}}

                                                <div class="form-group">
                                                        <label>Lease Start: </label>
                                                        <input type="date" class="form-control" required="required"  name="lease_start">
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Amount: </label>
                                                    <input name="total_amount" id="total_amount" class="form-control" placeholder="eg: 1,200,000">
                                                </div>

                                                {{-- <div class="form-group">
                                                    <label>Receipt Attachment (Optional): </label>
                                                    <input type="file" name="receipt_attachment" id="receipt_attachment" class="form-control">
                                                </div> --}}

										<div class="form-group" style="padding-top:25px">
                                                <button type="submit" class="btn btn-primary center-block">
                                                    Save
                                                </button>
                                            </div>
                                    </div>


                                    <div class="col-md-4">

										<div class="form-group">
											<label>Tenant Phone Number: </label>
											<input class="form-control" name="phone_number" placeholder="eg: 0654123456">
                                        </div>
{{--
                                        <div class="form-group">
                                            <label>Tenant NIDA, or others Attachments (Optional): </label>
                                            <input type="file" class="form-control" name="nida_attachment">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label>Lease End: </label>
                                            <input type="date" class="form-control" name="lease_end">
                                        </div> --}}

                                        {{-- <div class="form-group">
                                            <label>Amount Paid: </label>
											<input class="form-control" name="amount_paid" required="required" placeholder="eg: 1,200,000">
                                        </div> --}}

                                        <div class="form-group">
                                            <label>Lease Duration (months): </label>
                                            <select class="form-control"  required="required" name="lease_duration" id="lease_duration">
                                                <option value="">-- Select Lease Duration --</option>
                                                <option value="1">1 Month</option>
                                                <option value="2">2 Months</option>
                                                <option value="3">3 Months</option>
                                                <option value="4">4 Months</option>
                                                <option value="5">5 Months</option>
                                                <option value="6">6 Months</option>
                                                <option value="12">12 Months</option>
                                            </select>
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>Status: </label>
                                            <select class="form-control"  required="required" name="status" id="status">
                                                <option value="">-- Select Status --</option>
                                                        <option value="Paid">Paid</option>
                                                        <option value="Unpaid">Unpaid</option>
                                            </select>
                                        </div> --}}

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
