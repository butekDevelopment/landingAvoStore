@extends('MasterLogin.app')
@section('Content')
<div class="wrapper2">
    <div class="wave">
        
    </div>
   
</div>
<div class="login-box center" style="z-index: 1">
    <div class="login-logo">
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
    <div class="card">
        <div class="card-body login-card-body" style="border-radius: 10px;">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="{{ url('/admin/doLogin') }}" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row mx-4">
                    <button type="submit" class="btn btn-info btn-block" style="border-radius: 5x">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('Js')

@endsection