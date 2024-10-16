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
 

<div class=" position-relative p-0 m-0">
    {{-- <nav class="w-100 d-flex justify-content-between align-items-center pe-3 pe-md-0">
        <a href="index.html" class="landinPagelogo p-3 bg-black">
            <img src="images/logo.svg" alt="logo">
        </a>
        <ul class="list-unstyled d-none d-md-flex gap-3 landinPageLinks mb-0">
            <li>
                <a href="index.html">Dashboard</a>
            </li>
            <li>
                <a class="active" href="authenticate.html">Authenticate</a>
            </li>
            <li>
                <a  href="subscribe.html">Subscribe</a>
            </li>
            <li>
                <a href="localRepresentatives.html">LocalRepresentatives</a>
            </li>
            <li>
                <a  href="projections.html">Projections</a>
            </li>
            <li>
                <a  href="election.html">Election</a>
            </li>
            
                    <a href="federal.html">federal</a>
                <li>
<a href="stateLevel.html">State Level</a>                </li>
        </ul>
       <ul class="list-unstyled d-flex gap-2 align-items-center">
            <li class="dropdown ">
                <a class="rounded-circle " href="#" role="button" id="dropdownUser"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="avatar avatar-md avatar-indicators avatar-online">
                        <img alt="avatar" src="images/user.svg" class="user">
                    </div>
                </a> 
                <div class="dropdown-menu pb-2" aria-labelledby="dropdownUser">
                    <div class="dropdown-item bg-tran">
                        <div class="d-flex py-2">
                            <div class="avatar avatar-md avatar-indicators avatar-online me-2">
                                <img alt="avatar" src="images/user.svg" class="user">
                            </div>
                            <div class="ml-3 lh-1">
                                <h5 class="mb-0">Annette Black</h5>
                                <p class="mb-0">annette@company.com</p>
                            </div>

                        </div>
                        
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="">
                        <ul class="list-unstyled">
                            
                            
                        
        
                            <li>
                                <a class="dropdown-item" href="profile.html">
            <span class="mr-1">
            
<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            </span>Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:;">
            <span class="mr-2">
<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Settings
                                </a>
                            </li>
                            
                        
                        </ul>
                    </div>
                    <div class="dropdown-divider"></div>
                    <ul class="list-unstyled">
                    <li>
                        <a class="dropdown-item" href="login.html">
        <span class="mr-2">
<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg></span>Sign Out
                        </a>
                    </li>
                
                </ul>
                    
                </div>
            </li>
            <li>
                <div class="toggle-icon d-flex d-md-flex d-lg-none">
                    <img src="images/toggle-icon.svg" alt="toggle-icon">
                </div>
            </li>

          </ul>
    </nav> --}}
    <div class="main h-100 overflow-auto d-flex justify-content-center align-items-center">
        <div class="container h-100 d-flex justify-content-center align-items-center">
            <div class="mfacard text-center p-3 p-md-5 mt-5">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-white pageTitle">MFA Verification</h4>
                        <p class="text-white">A pin has been sent to xxxx. Please enter it below for verification</p>
                        <form action="{{route('verification')}}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{$userEmail}}">
                            <input class="mt-3 mb-3 themeInput" type="text" placeholder="Enter Pin" name="otp">
                            <button type="submit" class="theme-btn">Verify</button>
                        </form>
                        <div class="d-flex flex-wrap gap-3 mfaLinks mt-3">
                            <a href="javascript:;">
                                Verify another way
                            </a>
                            <a href="javascript:;">
                                Resend pin
                            </a>
                            <a href="javascript:;">
                                I need help
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    {{-- @include('frontend.includes.footer') --}}

@section('script')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"> --}}

    <script type="text/javascript">
function toggleProvisionOthers() {
    const provisionOthersDiv = document.getElementById('provisionOthers');
    const selectedValue = document.querySelector('input[name="subscription_type"]:checked');

    if (selectedValue) {
        const value = selectedValue.value;
        if (value === "1" || value === "3") {
            provisionOthersDiv.style.display = 'block';
        } else {
            provisionOthersDiv.style.display = 'none';
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
