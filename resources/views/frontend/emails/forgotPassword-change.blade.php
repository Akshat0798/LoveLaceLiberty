@extends('frontend.layouts.layout')

@section('content')
    <style>
        .error {
            color: red;
        }

        .input-eye {
        position: relative;
    }

    .input-eye i {
        position: absolute;
        top: 10px;
        right: 20px;
    }
    </style>


    <main>
        <section class="login-sec">
            <div class="container-fluid">
                <div class="col-md-5 mx-auto">
                    <div class="date-time login-form" id="date-time" tabindex="-1" aria-labelledby="date-timeLabel"
                        aria-hidden="true">
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
                        <form action="{{ route('businessSetPassWord') }}" method="POST">
                            @csrf
                            <div class="mt-4 mb-5 text-center">
                                <figure><img src="{{ asset('public/business_assets/images/logo-img.png') }}" alt="">
                                </figure>
                            </div>
                            {{-- <h2>
                            Please reset your password !</h2> --}}
                            <div class="form-group" style="margin-bottom: 20px; font-family: 'Graphik';">
                                {{-- <label for="new_password" >New Password:</label> --}}
                                <input type="hidden" id="email" name="email"
                                    value="{{ $email }}">
                                <div class="input-eye">
                                    <input type="password" class="form-control"
                                        id="new_password" placeholder="New Password"
                                        name="new_password" maxlength="25" minlength="8"
                                        style="display: inline; width: 98.8%; padding-right:10px; position: relative; font-family: 'Graphik'; ">

                                    <i class="fa fa-eye-slash fa-fw" id="new_togglePassword"
                                        style="margin-left: -30px; cursor: pointer;"></i>
                                </div>

                                @error('new_password')
                                    <span class="text-danger">{{ $message }}</span><br><br>
                                    @endif



                                </div>
                                <br>
                                <div class="form-group" style="margin-bottom: 20px; font-family: 'Graphik';">
                                    {{-- <label for="pwd" style="">Confirm Password:</label> --}}
                                    <div class="input-eye">
                                        <input type="password" class="form-control"
                                            id="confirm_password"
                                            placeholder="Confirm New Password"
                                            name="confirm_password"
                                            data-rule-equalTo="#new_password" maxlength="25"
                                            minlength="8"
                                            style="display: inline; width: 98.8%; padding-right:10px;" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false">

                                        <i class="fa fa-eye-slash fa-fw"
                                            id="confirm_togglePassword"
                                            style="margin-left: -30px; cursor: pointer;"></i>
                                    </div>
                                    @error('confirm_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        <br><br>
                                        @endif

                                    </div>
                            
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <button class="btn btn-primary px-xl-5" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>




    
    


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
            
            const confirm_togglePassword = document.querySelector('#confirm_togglePassword');
            const confirm_password = document.querySelector('#confirm_password');

            confirm_togglePassword.addEventListener('click', function(e) {
                if (confirm_password.type == 'password') {
                    confirm_password.setAttribute('type', 'text');
                    confirm_togglePassword.classList.add('fa-eye');
                    confirm_togglePassword.classList.remove('fa-eye-slash');
                } else {
                    confirm_togglePassword.classList.add('fa-eye-slash');
                    confirm_togglePassword.classList.remove('fa-eye');
                    confirm_password.setAttribute('type', 'password');
                }
                
                
            });
            </script>

@endsection