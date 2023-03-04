@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-sm-8">
					<h1 class="m-0 text-dark">Change Password</h1>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-md-8">
					@if(session()->get('failed'))
						<div class="alert alert-warning alert-dismissible fade show">
							{{ session()->get('failed') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					@if(session()->get('success'))
						<div class="alert alert-success alert-dismissible fade show">
							{{ session()->get('success') }}
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif
					<div class="card card-success card-outline">
						<div class="card-body box-profile">
							<form action="{{ url('/admin/profile/updatePassword') }}" method="POST">
								@csrf
								<div class="form-group row">
									<label for="passwordOld" class="col-sm-2 col-form-label">Old Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="passwordOld"
											name="passwordOld" placeholder="Old password" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="passwordNew" class="col-sm-2 col-form-label">New Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="passwordNew"
											name="passwordNew" placeholder="New password" required>
									</div>
								</div>
								<div class="form-group row">
									<label for="rePassword" class="col-sm-2 col-form-label">Repeat Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="rePassword"
											name="rePassword" placeholder="Repeat new password" required>
									</div>
								</div>
								<div class="text-right" style="margin-left: 60%">
									<button type="submit" class="btn btn-primary btn-block" style="border-radius: 5px">Save</button>
								</div>
							</form>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
			</div>
		</div>
	</section>

	@endsection

    @section('Js')

	@endsection