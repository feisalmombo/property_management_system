@extends('layouts.app')

@section('title', 'Add Property')

@section('content')
<div class="col-lg-12">
	<h1 class="page-header">Add Property</h1>
</div>

<div class="row">
    <section class="content">
	<div class="col-lg-12">
		@include('msgs.success')
		<div class="panel panel-default">
			<div class="panel-heading">
				Create Property<a href="{{ url('/view/properties') }}" class="col-2 pull-right" style="text-decoration: none;"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
			</div>
			<div class="panel-body">
				<div class="container-fluid pull-left">
					<section class="container center-block">
						<div class="container-page">
							<div class="col-md-12">

								<form role="form"  action="{{ url('/view/properties') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <h2 style="text-align: center;">Property Details:</h2>
									<div class="col-md-4">

										<div class="form-group">
											<label>Property Name: </label>
											<input class="form-control" name="property_name" id="property_name" required="required"  placeholder="eg: Upanga Apartment">
                                        </div>

                                            {{-- <div class="form-group">
                                                    <label>Property Status: </label>
                                                    <select class="form-control" name="status" id="status" required="required">
                                                        <option value="">-- Select Property Status --</option>
                                                        <option value="Apartment">Apartment</option>
                                                        <option value="House">House</option>
                                                        <option value="Room">Room</option>
                                                    </select>
                                            </div> --}}
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <label>Property Location: </label>
                                                <input class="form-control" name="property_location" id="property_location" placeholder="eg: Upanga, Dar es Salaam" required="required">
                                            </div>

										<div class="form-group" style="padding-top:25px">
                                                <button type="submit" class="btn btn-primary center-block">
                                                    Save
                                                </button>
                                            </div>
                                    </div>


                                    {{-- <div class="col-md-4">

										<div class="form-group">
											<label>Propert Type: </label>
											<select class="form-control" name="type" id="type" required="required">
                                                <option value="">-- Select Property Type --</option>
                                                <option value="Vacant">Vacant</option>
                                                <option value="Occupied">Occupied</option>
                                            </select>
                                        </div>

                                    </div> --}}
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
