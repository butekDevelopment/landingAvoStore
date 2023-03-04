@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-sm-8">
					<h1 class="m-0 text-dark">Profile User</h1>
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
							<div class="text-center">
								<img class="img-fluid elevation-2" src="{{ $photo }}" alt="User profile">
							</div>
							<h4 class="text-center mb-3 mt-2">{{ $username }}</h4>
							<hr>
							<form action="{{ url('/admin/profile/update') }}" method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group row">
									<label for="username" class="col-sm-2 col-form-label">Username</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" value="{{ $username }}" id="username"
											name="username" placeholder="Username">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
									<div class="col-sm-10">
										<select class="form-control" id="jenisKelamin" name="jenisKelamin">
											<option value="1"
												{{ $jenisKelamin == 1 ? 'selected' : null }}>
												Laki - laki</option>
											<option value="0"
												{{ $jenisKelamin == 1 ? null : 'selected	' }}>
												Perempuan</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="email" class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" value="{{ $email }}" id="email" name="email" placeholder="Email">
									</div>
								</div>
								<div class="form-group row">
									<label for="phone" class="col-sm-2 col-form-label">Phone</label>
									<div class="col-sm-10">
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text" id="basic-addon1">+62</span>
											</div>
											<input type="number" class="form-control"
												value="{{ $phone == null ? null : $phone }}"
												id="phone" name="phone"
												placeholder="{{ $phone == null ? "The phone number has not been set" : "Phone" }}" required>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="exampleInputFile" class="col-sm-2 col-form-label">Image Profile</label>
									<div class="input-group col-sm-10">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="inputBannerImg"
												name="fileName">
											<label class="custom-file-label" for="inputBannerImg">Choose
												file</label>
										</div>
									</div>
								</div>
								<div class="text-right" style="margin-left: 50%">
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
	<script>
		$(".custom-file-input").on("change", function () {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
	</script>

	@endsection