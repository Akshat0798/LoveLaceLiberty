@extends('frontend.layouts.layout')

@section('content')
    <style>
        .error {
            color: red;
        }
    </style>


    <main>
        <section class="login-sec">
            <div class="container-fluid">
                <div class="col-md-5 mx-auto">
                    <div class="date-time login-form" id="date-time" tabindex="-1" aria-labelledby="date-timeLabel"
                        aria-hidden="true">
                        @if ($errors->has('success'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>Reset password link is sent to your email address. Please check
                                    your email</li>
                            </ul>
                        </div>
                        @endif
                        @if (\Session::has('errMsg'))
                            <div class="alert alert-danger">
                                <ul>
                                    <li>This email address is not registered</li>
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('businessResetPassLinkSent') }}" method="POST">
                            @csrf
                            <div class="mt-4 mb-5 text-center">
                                <figure><img src="{{ asset('public/business_assets/images/logo-img.png') }}" alt="">
                                </figure>
                            </div>
                            <div class="input-group mb-3 same-input">
                                <span class="input-group-text"><span class="icon-massage"></span></span>
                                <input type="text" class="form-control" placeholder="Email" name="email" required
                                pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" value="{{ old('email') }}" maxlength="100" minlength="2">
                            </div>
                            @if ($errors->has('email'))
                                <span class="error" style="color: red; font-family: 'Graphik';">{{ $errors->first('email') }}</span><br>
                            @endif

                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <button class="btn btn-primary px-xl-5" type="submit">Submit</button>
                                {{-- <a href="#" class="btn btn-primary px-xl-5" type="submit">Login</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
