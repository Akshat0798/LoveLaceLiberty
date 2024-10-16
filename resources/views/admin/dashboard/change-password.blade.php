@extends('admin.layouts.layout')
@section('content')     
         
@push('styles')
<link rel="preload" href="{{ asset('backend/css/styles.css') }}" as="style">
<style>
.img-account-profile {
    height: 10rem;
}
.rounded-circle {
    border-radius: 50% !important;
}
.mb-2 {
    margin-bottom: 0.5rem !important;
}
img, svg {
    vertical-align: middle;
}
*, *::before, *::after {
    box-sizing: border-box;
}
.text-center {
    text-align: center !important;
}
.card:not([class*=bg-]) .card-header {
    color: #0061f2;
}
.card .card-header {
    font-weight: 500;
}
.card-header:first-child {
    border-radius: 0.35rem 0.35rem 0 0;
}

.card-header {
    padding: 1rem 1.35rem;
    margin-bottom: 0;
    background-color: rgba(33, 40, 50, 0.03);
    border-bottom: 1px solid rgba(33, 40, 50, 0.125);
}
#togglePassword {
    position: absolute;
    z-index: 1;
    right: 15px;
    top: 41px;
}
</style>

@endpush
<!-- Begin Page Content -->
<div class="container-fluid">
<div class="row">

    <div class="col-xl-12">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Enter Details</div>
            <div class="card-body">
                <form action="{{ route('admin.change.password.post') }}" method="post" >
                    @csrf
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="current_password">Current Password<span style="color: red">*</span></label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password" value="" style="display: inline; width: 98.8%; padding-right:10px">
                            <i class="fa fa-eye-slash fa-fw" id="eye_current" style="margin-left: -30px; cursor: pointer;"></i>
                            <span class="text-danger">{{$errors->first('current_password')}}</span>
                            @if (\Session::has('error_message'))
                                <span class="text-danger">{!! \Session::get('error_message') !!}</span>                           
                            @endif
                        </div>
                    </div>

                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">New Password<span style="color: red">*</span></label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" value="" style="display: inline; width: 98.8%; padding-right:10px">
                        <i class="fa fa-eye-slash fa-fw" id="eye_new" style="margin-left: -30px; cursor: pointer;"></i>
                        <span class="text-danger">{{$errors->first('new_password')}}</span>
                        @if (\Session::has('error_messages'))
                                <span class="text-danger">{!! \Session::get('error_messages') !!}</span>                           
                            @endif
                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="inputPhone">Confirm Password<span style="color: red">*</span></label>
                            <input type="password" class="form-control" id="confirmation_password" name="Confirm_Password" placeholder="Confirm Password" value="" style="display: inline; width: 98.8%; padding-right:10px">
                            <i class="fa fa-eye-slash fa-fw" id="eye_confirmation" style="margin-left: -30px; cursor: pointer;"></i>
                            <span class="text-danger">{{$errors->first('Confirm_Password')}}</span>
                        </div>

                    </div>

                    <!-- Save changes button-->
                    <button type="submit" class="btn btn-primary" type="button">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>







@push('scripts')
<script>
    function readURL(input)
    {
        if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
        $('#image_preview').attr('src', e.target.result);

        $('#image_preview').hide();
        $('#image_preview').fadeIn(650);
        }
    reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).ready(function(){

        $("#image").change(function() {
        readURL(this);
        });

    });






</script>
@endpush
<script>
    const togglePassword = document.querySelector('#eye_current');
const password = document.querySelector('#current_password');

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

const togglePasswordn = document.querySelector('#eye_new');
const passwordn = document.querySelector('#new_password');

togglePasswordn.addEventListener('click', function (e) {
  if (passwordn.type == 'password') {
  passwordn.setAttribute('type', 'text');
  togglePasswordn.classList.add('fa-eye');
  togglePasswordn.classList.remove('fa-eye-slash');
  } else {
  togglePasswordn.classList.add('fa-eye-slash');
  togglePasswordn.classList.remove('fa-eye');
  passwordn.setAttribute('type', 'password');
  }

});

const togglePasswordc = document.querySelector('#eye_confirmation');
const passwordc = document.querySelector('#confirmation_password');

togglePasswordc.addEventListener('click', function (e) {
  if (passwordc.type == 'password') {
  passwordc.setAttribute('type', 'text');
  togglePasswordc.classList.add('fa-eye');
  togglePasswordc.classList.remove('fa-eye-slash');
  } else {
  togglePasswordc.classList.add('fa-eye-slash');
  togglePasswordc.classList.remove('fa-eye');
  passwordc.setAttribute('type', 'password');
  }

});
</script>
@endsection
