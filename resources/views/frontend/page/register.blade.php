@extends('frontend.layouts.layout1')


@section('content')
   
<style>
    .error{
        color: red;
    }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
 </style>   
<section class="dashboard position-relative p-0 p-md-3 justify-content-center w-100">
   
    <div class="container h-100 d-flex align-items-center justify-content-center w-100">
        <div class="row w-100 justify-content-center">
            <div class="col-12 col-md-7">
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
                <div class="mfacard  mx-auto d-flex p-3 px-md-5 py-md-4">
                    <div class="row">
                        <div class="col-12 text-center d-flex justify-content-center mb-4">
                            <a href="index.html" class="account-logo">
                                <img src="{{ asset('public/assetss/images/logo.svg')}}" alt="logo">
                            </a>
                        </div>
                        <div class="col-12">
                            <h4 class="text-white pageTitle mb-4">sign-up</h4>
                            <form action="{{ route('registerUser') }}" class="row g-2" method="POST">
                                @csrf
                                    <div class="col-6 col-md-4">
                                        <input type="text" class="form-control themeInput" name="first_name" placeholder="First Name" value="{{old('first_name')}}">
                         @if ($errors->has('first_name'))<span class="error">{{ $errors->first('first_name') }}</span>@endif

                                    </div>
                                    <div class="col-6 col-md-4">
                                        <input type="text" class="form-control themeInput" name="last_name" placeholder="Last Name" value="{{old('last_name')}}">
                         @if ($errors->has('last_name'))<span class="error">{{ $errors->first('last_name') }}</span>@endif

                                    </div>
                            
                                    <div class="col-12 col-md-4">
                                        <input type="email" class="form-control themeInput" name="email" placeholder="Email" value="{{old('email')}}">
                         @if ($errors->has('email'))<span class="error">{{ $errors->first('email') }}</span>@endif

                                    </div>
                                    <div class="col-12 col-md-4">
                                        <input type="number" class="form-control themeInput" name="mobile_number" placeholder="Phone" value="{{old('mobile_number')}}"  oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);" 
                                        maxlength="10">
                         @if ($errors->has('mobile_number'))<span class="error">{{ $errors->first('mobile_number') }}</span>@endif

                                    </div>
                            
                                <!-- Third Line: Birthday -->
                                <div class="col-12 col-md-4">
                                    <input type="date" class="form-control themeInput" name="dob" placeholder="Birthday" value="{{old('dob')}}">
                         @if ($errors->has('dob'))<span class="error">{{ $errors->first('dob') }}</span>@endif

                                </div>
                                    <div class="col-12 col-md-4">
                                        <input type="text" class="form-control themeInput" name="user_name" placeholder="Username" value="{{old('user_name')}}">
                         @if ($errors->has('user_name'))<span class="error">{{ $errors->first('user_name') }}</span>@endif

                                    </div>
                                    <div class="col-12 col-md-6">
                                        <input type="password" class="form-control themeInput mb-3" name="password" placeholder="Password">
                         @if ($errors->has('password'))<span class="error">{{ $errors->first('password') }}</span>@endif

                                    
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <p class="themeColor mt-2">Provisioned accounts available: <strong>132</strong></p>
                                    </div>
                                <!-- Subscription Options and Submit Button -->
                                <div class="col-12 col-md-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-label">Subscription Option:</label>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div>
                                                <input type="radio" name="subscription_type" value="1" id="noSubscription" onclick="toggleProvisionOthers()" {{ old('subscription_type') == 1 ? 'checked' : '' }}>
                                                <label for="noSubscription"> No Subscription</label><br>
                                                <input type="radio" name="subscription_type" value="2" id="provisioned" onclick="toggleProvisionOthers()" {{ old('subscription_type') == 2 ? 'checked' : '' }}>
                                                <label for="provisioned"> Provisioned</label><br>
                                                <input type="radio" name="subscription_type" value="3" id="monthly" onclick="toggleProvisionOthers()" {{ old('subscription_type') == 3 ? 'checked' : '' }}>
                                                <label for="monthly"> $2 per month</label>
                                                <div style="display:{{ (old('subscription_type') == 1 || old('subscription_type') == 3)  ? 'block' : 'none' }};" id="provisionOthers">
                                                    <input type="checkbox" name="provisionOthers" id="provisionForOthers" {{ old('provisionOthers') == "on" ? 'checked' : '' }}>
                                                    <label for="provisionOthers"> Provision accounts for others</label>
                                                </div>
                         @if ($errors->has('subscription_type'))<span class="error">{{ $errors->first('subscription_type') }}</span>@endif
                         
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 d-flex justify-content-end align-items-end">
                                            
                                            <button type="submit" class="theme-btn ">Sign Up</button>

                                        </div>
                                    </div>
                                
                                
                                </div>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

</section>

    {{-- @include('frontend.includes.footer') --}}

@section('script')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> --}}

    <script type="text/javascript">
function toggleProvisionOthers() {
    const provisionOthersDiv = document.getElementById('provisionOthers');
    const selectedValue = document.querySelector('input[name="subscription_type"]:checked');
   const provisionCheckbox = document.getElementById('provisionForOthers');


    if (selectedValue) {
        const value = selectedValue.value;
        if (value === "1" || value === "3") {
            provisionOthersDiv.style.display = 'block';
        } else {
            provisionOthersDiv.style.display = 'none';
           provisionCheckbox.checked = false;

        }
    }
}

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
