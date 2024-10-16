@extends('frontend.layouts.layout1')

@section('content')
 
<section class="dashboard position-relative p-3 justify-content-between w-100" >
   
    <div class="main h-100 w-100">
        <div class="container h-100 d-flex align-items-center w-100">
            <div class="row align-items-center d-flex w-100 justify-content-center">
                <div class="col-12 col-md-4">
                    @if (session('success'))
                    <div class="alert alert-success"  style=" font-family: 'Graphik';">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if (session('message'))
                    <div class="alert alert-success"  style=" font-family: 'Graphik';">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger"   style=" font-family: 'Graphik';">
                        {{ session('error') }}
                    </div>
                    @endif
                    @if (session('errMsg'))
                    <div class="alert alert-danger"   style=" font-family: 'Graphik';">
                        {{ session('errMsg') }}
                    </div>
                    @endif
                    <div class="mfacard  mx-auto d-flex p-3 p-md-5">
                        <div class="row">
                            <div class="col-12 text-center d-flex justify-content-center mb-4">
                                <a href="index.html" class="account-logo">
                                    <img src="{{ asset('public/assetss/images/logo.svg') }}" alt="logo">
                                </a>
                            </div>
                            <div class="col-12">
                                <h4 class="text-white pageTitle mb-3">Login</h4>
                                <form action="{{route('signin')}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" id="username" class="form-control themeInput" name="user_name" required value="{{old('user_name')}}">
                                        @if ($errors->has('user_name'))<span class="error">{{ $errors->first('user_name') }}</span>@endif
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password" class="form-control themeInput" required name="password">
                                        @if ($errors->has('password'))<span class="error">{{ $errors->first('password') }}</span>@endif
                                    </div>
                                    <button type="submit" class="theme-btn mb-3 w-100">Login</button>
                                    <div class="text-center">
                                        <a href="{{ route('registerView')}}" class="themeColor text-decoration-none themeLink">Don't have an account?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-12 col-md-6 d-none d-md-flex">
                    <img src="images/usa-map.png" class="w-100" alt="">
                </div> -->
            </div>
            
        </div>
    </div>

</section>

    {{-- @include('frontend.includes.footer') --}}

    
@endsection
