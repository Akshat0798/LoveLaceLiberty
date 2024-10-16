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
</style>

@endpush
<div class="container-fluid">
<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            <div class="card-body text-center">
                <!-- Profile picture image-->
                @if ($user->profile_image)
                <img style="width: 93%"  class="img-account-profile rounded-circle mb-2" id="image_preview" src="{{ asset($user->profile_image)}}" alt="">
                @else
                <img style="width: 93%"  class="img-account-profile rounded-circle mb-2" id="image_preview" src="{{ asset(Auth::user()->profile_picture)}}" alt="">
                @endif
                {{-- <img style="width: 93%" class="img-account-profile rounded-circle mb-2" id="image_preview" src="{{ asset(Auth::user()->profile_image)}}" alt=""> --}}
                <!-- Profile picture help block-->
                <!-- <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> -->
                <!-- Profile picture upload button-->
               <!--  <button class="btn btn-primary" type="button">Upload new image</button> -->
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <form action="{{ route('admin.edit.profile.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="name">Name</label>
                            <input class="form-control" id="name" name="name" type="text" placeholder="Enter your name" value="{{ Auth::user()->first_name }}">
                            {{-- <span class="text-danger">{{$errors->first('user_name')}}</span> --}}
                            @if ($errors->has('name'))<span class="error" style="font-size: 15px; color: red;">{{ $errors->first('name') }}</span>@endif


                        </div>

                    </div>

                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" type="email" name="email" placeholder="Enter your email address" value="{{ Auth::user()->email }}" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}">
                        {{-- <span class="text-danger">{{$errors->first('email')}}</span> --}}
                        @if ($errors->has('email'))<span class="error" style="font-size: 15px; color: red;">{{ $errors->first('email') }}</span>@endif

                    </div>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <!-- <div class="col-md-12">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <input class="form-control" id="inputPhone" type="text" name="phone_number" placeholder="Enter your phone number" value="{{ Auth::user()->mobile_number }}">
                            <span class="text-danger">{{$errors->first('phone_number')}}</span>
                        </div> -->

                    </div>
                     <!-- Form Row-->
                     <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-12">
                            <label class="small mb-1" for="image">Profile <Picture></Picture></label>
                            <input class="form-control" id="image" type="file" name="profile_pic"  >
                            {{-- <span class="text-danger">{{$errors->first('profile_pic')}}</span> --}}
                            @if ($errors->has('profile_pic'))<span class="error" style="font-size: 15px; color: red;">{{ $errors->first('profile_pic') }}</span>@endif

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
@endsection
