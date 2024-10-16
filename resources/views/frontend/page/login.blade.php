@extends('frontend.layouts.layout')

@section('content')
<main >
    <section class="login-sec">
     <div class="container-fluid">
         <div class="col-md-5 mx-auto">
             <div class="date-time login-form" id="date-time" tabindex="-1" aria-labelledby="date-timeLabel" aria-hidden="true">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
            @if (\Session::has('password'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('password') !!}</li>
                    </ul>
                </div>
            @endif 

            @if (\Session::has('errMsg'))
                <div class="alert alert-danger" x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show">
                    <ul>
                        <li>{!! \Session::get('errMsg') !!}</li>
                    </ul>
                </div>
            @endif 
                <form action="{{ route('businessSigninn') }}" method="POST">
                    @csrf
                     <div class="mt-4 mb-5 text-center">
                         <figure><img src="{{ asset('public/assetss/images/logo.svg')}}" alt=""></figure>
                     </div>
                     <div class="input-group mb-3 same-input">
                         <span class="input-group-text"><span class="icon-massage"></span></span>
                         <input type="text" class="form-control" placeholder="Email Address" name="email" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" value="{{old('email')}}" maxlength="100" minlength="10">
                        </div>
                        @if ($errors->has('email'))
                        <span class="error" style="color: red;">{{ $errors->first('email') }}</span>
                    @endif
                    <div class="input-group mb-3 same-input eye-right">
                        <span class="input-group-text"><span class="icon-lock"></span></span>
                        <input type="password" class="form-control" id="new_password" name="password"
                            placeholder="Password" required maxlength="25" minlength="8">
                        <span class="eye-btn"><i class="fa fa-eye-slash fa-fw" id="new_togglePassword"
                                style=" cursor: pointer;"></i></span>
                        @if ($errors->has('password'))
                            <p class="error" style="color: red;">{{ $errors->first('password') }}</p>
                        @endif
                    </div>
                     <div class="d-flex align-items-center justify-content-between mb-3">
                         <a href="{{ route('businessForgetPassword') }}">Forgot Password?</a>
                         <button  class="btn btn-primary px-xl-5" type="submit">Login</button>
                         {{-- <a href="#" class="btn btn-primary px-xl-5" type="submit">Login</a> --}}
                     </div>
                     <div class="text-center">
                         <p>Don’t have an account. <a href="{{ route('businessregister') }}#signUpForm">Sign Up</a></p>
                     </div>
                 </form>
             </div>
         </div>
     </div>
    </section>
   </main>

    {{-- @include('frontend.includes.footer') --}}

    @section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

    <script type="text/javascript">
        const new_togglePassword = document.querySelector('#new_togglePassword');
        const new_password = document.querySelector('#new_password');

        new_togglePassword.addEventListener('click', function(e) {
            if (new_password.type == 'password') {
                new_password.setAttribute('type', 'text');
                new_togglePassword.classList.add('fa-eye');
                new_togglePassword.classList.remove('fa-eye-slash');
            } else {
                new_togglePassword.classList.add('fa-eye-slash');
                new_togglePassword.classList.remove('fa-eye');
                new_password.setAttribute('type', 'password');
            }
        });
    </script>
@endsection
@endsection
