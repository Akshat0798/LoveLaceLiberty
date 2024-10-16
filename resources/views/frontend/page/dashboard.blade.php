@extends('frontend.layouts.layout')


@section('content')

@include('frontend.includes.sidebar')
    <section class="messageSlider bg-tran py-3 py-md-5">
        <div class="row justify-content-center  align-items-center">
            <div class="col-12 col-md-7">
                <h5 class="text-white pageTitle messageTitle"><span>Now is not the time for elections,</span>   whenever elections are held, you will be able to vote.</h5>
            </div>
            <div class="col-md-4 col-12">
                <img src="{{ asset('public/assetss/images/usa-map.png') }}" class="w-100" alt="">
            </div>
        </div>
    </section>
    <div class="main h-100 overflow-auto">
        <div class="container my-4">
            <!-- Header with Logo and Login/Logout -->
    
            <!-- Hook Message Section -->
          
    
            <!-- Main Content Section -->
            <div class="row ">
                <div class=" col-md-12 sidebar-buttons my-4">
                    <div class="d-flex justify-content-center flex-wrap gap-3">
                        <a href="{{route('client.projectionView')}}" class="btn-outline-primary theme-btn ">Poll Projection</a>
                        <a href="{{route('client.electionView')}}" class="btn-outline-primary theme-btn ">Submit my vote</a>
                        <a href="{{route('client.projectionView')}}" class="btn-outline-primary theme-btn ">View Election Analytics</a>
                    </div>
                </div>
                <!-- Featured Events/Elections -->
                <div class="col-md-4 mb-3 featured-events">
                    <div class="mfacard w-100 p-3 ">
                        <h5 class="text-white">Featured Events/Elections</h5>
                        <p class="text-white mb-0"> Lorem Ipsum is simply dummy text of the printing and typesetting industry. and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.Lorem Ipsum is simply dummy text of the printing and typesetting industry. and more recently versions of Lorem Ipsum.</p>
                    </div>
                </div>
                <!-- Your Representatives -->
                <div class="col-md-4 mb-3 representatives">
                    <div class="mfacard p-3">
                        <h5 class="text-white mb-3">Your Representatives</h5>
                        <h6 class="text-white">Congress</h6>
                        <div class="candidateResult py-2 w-100  d-flex align-items-center justify-content-between">
                            <ul class="d-flex gap-3 list-unstyled align-items-start mb-0">
                            
                                <li>
                                    <div class="candidateImg mt-2">
                                        <img src="{{ auth()->user()->profile_image == null ? asset('public\assetss\images\user.svg') : asset(auth()->user()->profile_image) }}" alt="candidateImg">
                                    </div>
                                </li>
                                <li>
                                    <p class="candidate1 text-white mb-0">Lorem Ipsum is simply dummy text of the</p>
                                </li>
                            </ul>
                        </div>
                        <h6 class="text-white">House of representatives</h6>
                        <div class="candidateResult py-2 w-100  d-flex align-items-center justify-content-between">
                            <ul class="d-flex gap-3 list-unstyled align-items-start mb-0">
                            
                                <li>
                                    <div class="candidateImg mt-2">
                                        <img src="{{ auth()->user()->profile_image == null ? asset('public\assetss\images\user.svg') : asset(auth()->user()->profile_image) }}" alt="candidateImg">
                                    </div>
                                </li>   
                                <li>
                                    <p class="candidate1 text-white mb-0">Lorem Ipsum is simply dummy text of the</p>
                                </li>
                            </ul>
                        </div>
                        <div class="candidateResult py-2 w-100  d-flex align-items-center justify-content-between">
                            <ul class="d-flex gap-3 list-unstyled align-items-start mb-0">
                            
                                <li>
                                    <div class="candidateImg mt-2">
                                        <img src="{{ auth()->user()->profile_image == null ? asset('public\assetss\images\user.svg') : asset(auth()->user()->profile_image) }}" alt="candidateImg">
                                    </div>
                                </li>
                                <li>
                                    <p class="candidate1 text-white mb-0">Lorem Ipsum is simply dummy text of the</p>
                                </li>
                            </ul>
                        </div>
                        </div>
                </div>
    
                <!-- Search Section -->
                <div class="col-md-4 mb-3 search-section">
                    <label class="text-white">Federal Level</label>
                    <a href="{{route('client.federalView')}}" class="theme-btn mb-2">View Officials</a>
    
                    <label class="text-white">State Level Search</label>
                    <div class="mb-2">
                        <select class="form-select themeInput" id="state" name="state"> 
                            <option selected>Select State</option>
                            @foreach ($states as $value)
                            <option value="{{$value->state_abbreviation}}">{{$value->state_name}}</option>
                            @endforeach
                        </select>
                        <button class="theme-btn mt-2" id="submit-state">View Officials</button>
                    </div>
    
                    <label class="text-white">Local Level Search</label>
                    <div class="input-group">
                        <input type="text" class="form-control themeInput" placeholder="Zipcode" id="local" name="local">
                    </div>
                    <button class="theme-btn mt-2" id="submit-local">View Officials</button>
                </div>
            
           
            
        </div>
    </div>


</section>
   @section('script')

   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   <script type="text/javascript">
// state filter
       $(document).ready(function() {
            $('#submit-state').click(function() {
                var stateId = $('#state').val(); // Get the selected state ID

                if (stateId) {
                    $.ajax({
                        url: '{{ route('client.submitState') }}',
                        type: 'POST',
                        data: {
                            state_id: stateId,
                            _token: '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        success: function(response) {
                            
                            window.location.href = response.redirect_url;

                        },
                        error: function(xhr) {
                            $('#response-message').html('<p>Error occurred while submitting!</p>');
                        }
                    });
                } else {
                    $('#response-message').html('<p>Please select a state!</p>');
                }
            });
        });

        // local filter
        $(document).ready(function() {
            $('#submit-local').click(function() {
                var localId = $('#local').val(); // Get the selected local ID
                if (localId) {
                    $.ajax({
                        url: '{{ route('client.submitlocal') }}',
                        type: 'POST',
                        data: {
                            local_id: localId,
                            _token: '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        success: function(response) {
                            
                            window.location.href = response.redirect_url;

                        },
                        error: function(xhr) {
                            $('#response-message').html('<p>Error occurred while submitting!</p>');
                        }
                    });
                } else {
                    $('#response-message').html('<p>Please select a state!</p>');
                }
            });
        });


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