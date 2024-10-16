@extends('layouts.app')
@section('content')
<style>
    .radio-sectoin input {
        position: absolute;
        left: 15px;
        opacity: 0;
        transform: scale(1.5);
        right: 12px;
        top: 4px;
        z-index: 1111;
        position: absolute;
        z-index: 999;
        left: 4px;
        top: 4px;
        opacity: 0;

    }

    .radio-sectoin{
        padding: 0px;
    }

    .radio-sectoin  {
        position: relative;
        list-style: none;
        padding-left: 35px;
    }
    .radio-sectoin   span {
        width: 21px;
        height: 21px;
        border: 1px solid #4e73df!important;
        position: relative;
        display: inline-block;
        top: 4px;
        position: absolute;
        left: 4px;
        top: 0px;
        opacity: 1;
    }
    .radio-sectoin  span:before {
        width: 8px;
        height: 8px;
        content: "";
        position: absolute;
        background-color: #4e73df;
        border-radius: 50%;
        opacity: 0;
        top: 5px;
        right: 0px;
        left: 5px;
    }
    .radio-sectoin input:checked + span:before {
        opacity: 1;
        z-index: 12;
    }

    .form-group.form-floating-label {
    position: relative;
}
    #togglePassword {
    position: absolute;
    z-index: 1;
    right: 15px;
    top: 41px;
}

</style>


        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center ">
                                        <img src="{{ url('public/assetss/images/logo.svg') }}" width="200px" style="margin-bottom: 20px;" />
                                        <h1 class="h4 text-gray-900 mb-4">Welcome</h1>
                                    </div>
                                        @if (\Session::has('success'))
                                            <div class="alert alert-success">
                                                <ul>
                                                    <li>{!! \Session::get('success') !!}</li>
                                                </ul>
                                            </div>
                                        @endif

                                        @if (\Session::has('errMsg'))
                                            <div class="alert alert-danger">
                                                <ul>
                                                    <li>{!! \Session::get('errMsg') !!}</li>
                                                </ul>
                                            </div>
                                        @endif
                                     <form class="user" method="POST" action="{{ route('admin.loginn') }}">
                                        {{ csrf_field() }}


                                        <div class="form-group form-floating-label {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="username" class="">Email</label>
                                            <input id="email" type="text" class="form-control input-border-bottom" name="email"  value="{{ old('email') }}" placeholder="Enter the email" required autofocus style="width:98.8%;">
                                            @if (session('email'))<span class="help-block"><strong style="color:#ff0000;">{{ session('email') }}</strong></span>@endif
                                        </div>
                                        <div class="form-group form-floating-label {{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="">Password</label>
                                            <input id="password" name="password" type="password" class="form-control input-border-bottom"  placeholder="Enter the password" required style="display: inline; width: 98.8%; padding-right:10px"  >
                                             <i class="fa fa-eye-slash fa-fw" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                            @if (session('password'))<span class="help-block"><strong style="color:#ff0000;">{{ session('password') }}</strong></span>@endif
                                        </div>

                                        <div class="form-group form-floating-label " >
                                            <a href="{{ route('forget-password') }}" style="color:#1572e8;">Forgot Password?</a>
                                        </div>

                                        
                                        <button type="submit" class="btn btn-primary btn-rounded btn-login btn-user btn-block" style="background-color:#1572e8; border:#1572e8; font-size:15px">Login</button>
                                        <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> -->
                                    </form>




                
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
<script>


const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function (e) {
    if (password.type == 'password') {
    password.setAttribute('type', 'text');
    togglePassword.classList.add('fa-eye');
    togglePassword.classList.remove('fa-eye-slash');
    } else {
    togglePassword.classList.add('fa-eye-slash');
    togglePassword.classList.remove('fa-eye');
    password.setAttribute('type', 'password');
    }

});
</script>


@endsection
