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
                {{-- <img style="width: 93%"  class="img-account-profile rounded-circle mb-2" id="image_preview" src="{{ asset(Auth::user()->profile_picture)}}" alt=""> --}}


            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Account Details</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                <tbody>
                     @php $user = $data['user']; @endphp
                     <tr>
                         <th style="width:30%">Name</th>
                         <td style="width:70%">{{$user->full_name}}</td>
                     </tr>
                     <tr>
                         <th style="width:30%">Email</th>
                         <td style="width:70%">{{$user->email}}</td>
                     </tr>
                     <!-- <tr>
                         <th style="width:30%">Phone Number</th>
                         <td style="width:70%">user->mobile_number</td>
                     </tr> -->



                 </tbody>
             </table>
                 </div>
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
