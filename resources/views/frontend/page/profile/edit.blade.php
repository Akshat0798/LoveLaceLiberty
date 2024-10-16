@extends('frontend.layouts.layout')
<style>
    
    .background-container {
        position: relative;
        width: 100%;
        height: 170px;
        background-color: #f0f0f0;
        background-size: cover;
        background-position: center;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .profile-container {
        margin-bottom: 20px;
    }
    .profile-picture {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 3px solid white;
        object-fit: cover;
        margin-bottom: 10px; 
        background-color: #fff;
        left: 17px;
        position: absolute;
        top: 113px;
        z-index: 1;
    }
    .profile-picture img{
        position: relative;
        width: 100%;
        height: 100%;
        object-fit: cover;
        overflow: hidden;
        border-radius: 50%;

    }

    .edit-icon {
        position: absolute;
    top: 10px;
    right: -4px;
    cursor: pointer;
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    border-radius: 50%;
    padding: 5px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 111;
    }

    .about-section {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
    }
    button#edit-background {
        top: 10px;
        right: 10px;
    }
</style>
@section('content')


    <div class="">
        <div class="container mt-4">
            <!-- Background Image Section -->
            <div class="background-container" id="background-img" style="background-image: url({{ $user->background_image == null ? asset('public\assetss\images\user.svg') : asset($user->background_image) }});">
                <button id="edit-background" class="edit-icon btn btn-secondary">
                    <i class="bi bi-pencil"></i>
                </button>
                <div class="profile-picture">
                    
                    <form id="profile-form" action="{{ route('client.update.profileImage') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <img id="profile-img" src="{{ $user->profile_image == null ? asset('public\assetss\images\user.svg') : asset($user->profile_image) }}" alt="Profile Image" width="100">
                            <button type="button" id="edit-profile" class="edit-icon btn btn-secondary"><i class="bi bi-pencil"></i></button>
                        </div>
                        <input type="hidden" name="profile_image" id="profile-image-input">
                        <input type="hidden" name="background_image" id="background-image-input">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
            <section class="pt-5 pb-3">
                <div class="pageTitle themeColor">{{$user->user_name}}</div>
            </section>
            <!-- Profile Picture Section -->
        
            <!-- About Section -->
             <div class="row">
                <div class="col-12 col-md-4">
                    <div class="mfacard w-100 mt-3 p-4 position-relative">
                        <button id="edit-info" class="edit-icon btn btn-secondary" data-bs-toggle="modal" data-bs-target="#editInfoModal">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <h3 class="text-white mt-3">Personal Information</h3>
                        <div class="row ">
                            <div class="mb-1">
                                <p class="themeColor mb-0">Mobile number </p>

                                <label for="mobNumber" class="form-label">{{$user->mobile_number}}</label>
                            </div>
                            <div class="mb-1">
                                <p class="themeColor mb-0"> Email </p>

                                <label for="email" class="form-label">{{$user->email}}</label>
                            </div>
                           
                            <div class="mb-1">
                                <p class="themeColor mb-0"> Password </p>

                                <label for="password" class="form-label">******</label>
                            </div>
                           
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mfacard w-100 mt-3  py-3 px-4 position-relative">
                       
                        <h3 class="text-white mt-2">Documents</h3>
                        <div class="row mt-3">
                            <div class="col-12 col-md-6">
                                <div class="document">
                                    <img src="{{asset('public\assetss\images\pdf-file.svg') }}" class="w-50" alt="">
                                </div>
                                <div class="document-name mt-3 themeColor">Document Name</div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="document">
                                    <img src="{{asset('public\assetss\images\pdf-file.svg') }}" class="w-50" alt="">
                                </div>
                                <div class="document-name mt-3 themeColor">Document Name</div>
                            </div>
                            <div>
                           <a href="{{route('client.IdentityVerificationView')}}" class="theme-btn mt-3 mb-2">Verify</a>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <h3 class="text-white mt-4 mb-4">Participated Polls Events</h3>
                    <div class="d-flex flex-column gap-3">
                        @foreach ($events as $value)
                        <div class="candidateResult px-3 py-2 w-100 mfacard d-flex align-items-center justify-content-between">
                            <ul class="d-flex gap-3 list-unstyled align-items-center mb-0">
                                
                                <li>
                                    <p class="candidate1 text-white mb-0">{{$value->name}}</p>
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="mfacard w-100 mt-3 p-4 position-relative">
                       
                        <h3 class="text-white mt-3">locality Information</h3>
                        <div class="row ">
                            <div class="col-12 col-md-3">
                                <p class="themeColor mb-0">Address </p>

                                <label for="mobNumber" class="form-label">80/2 patel marg</label>
                            </div>
                            <div class="col-12 col-md-3">
                                <p class="themeColor mb-0"> City </p>

                                <label for="email" class="form-label">Jaipur</label>
                            </div>
                           
                            <div class="col-12 col-md-3">
                                <p class="themeColor mb-0"> State </p>

                                <label for="password" class="form-label">Rajasthant</label>
                            </div>
                            <div class="col-12 col-md-3">
                                <p class="themeColor mb-0"> Zip Code </p>

                                <label for="password" class="form-label">1234</label>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            
        </div>
        
    </div>

    <!-- Modal -->
<div class="modal fade" id="editInfoModal" tabindex="-1" aria-labelledby="editInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content mfacard">
        <div class="modal-body px-3 px-md-5 pt-0 pb-4 editInfoModal">
            <div class="d-flex justify-content-between align-items-center py-3 py-md-4">
                <h3 class="text-white mb-0">Personal Information</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('client.edit.profile.post')}}" class="row edit-info" method="POST">
                @csrf
                <div class="mb-1">
                    <label for="mobNumber" class="form-label">Mobile number</label>
                    <input type="text" id="mobNumber" class="form-control themeInput" name="mobile_number" value="{{$user->mobile_number}}" required >
                    @if ($errors->has('mobile_number'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('mobile_number') }}</span>
                @endif
                </div>
                <div class="mb-1">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control themeInput" name="email" value="{{$user->email}}" required>
                    @if ($errors->has('email'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('email') }}</span>
                @endif
                </div>
                
                <div class="mb-1">
                    <label for="password" class="form-label">New Password</label>
                    <div class="position-relative">
                        <input type="password" id="password" class="form-control themeInput" name="password"  required>
                        <div class="eye" id="toggle-password">
                            <img class="closeEye" src="{{asset('public\assetss\images\closeEye.svg'.$user->profile_image) }}" alt="closeEye">
                            <img class="ShowEye d-none" src="{{asset('public\assetss\images\Eye.svg'.$user->profile_image) }}" alt="Eye">
                        </div>
                    </div>
                    @if ($errors->has('password'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('password') }}</span>
                @endif
                </div>
                <div class="mb-1">
                    <label for="confirmPassword" class="form-label">Confirm New Password</label>
                    <input type="password" id="confirmPassword" class="form-control themeInput" name="confirmation_password" required>
                    @if ($errors->has('confirmation_password'))
                    <span class="error"
                        style="font-size: 15px; color: red; font-family: 'Graphik';">{{ $errors->first('confirmation_password') }}</span>
                @endif
                </div>
                <div class="mb-1">
                    <button class="theme-btn" id="update-info">Update</button>
                </div>
            </form>
        </div>
       
      </div>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        @if ($errors->any())
            var editInfoModal = new bootstrap.Modal(document.getElementById('editInfoModal'));
            editInfoModal.show();
        @endif
    });

  // Background Image Upload Handler
document.getElementById('edit-background').addEventListener('click', function() {
    const backgroundInput = document.createElement('input');
    backgroundInput.type = 'file';
    backgroundInput.accept = 'image/*';

    backgroundInput.onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('background-img').src = e.target.result;
                document.getElementById('background-image-input').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    
    backgroundInput.click();
});
    
        document.getElementById('edit-profile').addEventListener('click', function() {
    const profileInput = document.createElement('input');
    profileInput.type = 'file';
    profileInput.accept = 'image/*';

    profileInput.onchange = function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-img').src = e.target.result;
                // Store the image in a hidden input to send it to the server
                document.getElementById('profile-image-input').value = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
    
    profileInput.click();
});

</script>
@endsection
