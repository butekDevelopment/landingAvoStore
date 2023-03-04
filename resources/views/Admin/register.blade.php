@extends('MasterLogin.app')
@section('Content')
<div class="wrapper2">
    <div class="wave">
        
    </div>
   
</div>
<div class="register-box" style="z-index: 1">
    <div class="register-logo">
        <p style="color: white"><b style="font-weight: bold">AvoStore</b> Malang</p>
    </div>
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
    <div class="card">
        <div class="card-body register-card-body" style="border-radius: 10px;">
            <p class="login-box-msg">Register a new account</p>
            <form action="{{ url('/admin/doRegister') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <input type="password" class="form-control" placeholder="Retype password" name="repassword">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mx-4">
                    <button type="submit" class="btn btn-info btn-block" style="border-radius: 5px">Register</button>
                </div>
                <p class="text-center mt-2 mb-0">
                    <a href="{{ url('admin/login') }}" type="button" class="btn btn-light"
                        style="font-size: 15px; color: rgb(136, 136, 136)">Back to login</a>
                </p>
            </form>
        </div>
    </div>
</div>
@endsection

@section('Js')

@endsection