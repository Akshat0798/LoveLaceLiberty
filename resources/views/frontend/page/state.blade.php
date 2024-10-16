<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Lovelaceliberty</title>
        <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/owl-carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="icon" type="image/x-icon" href="images/favicon.ico">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/images/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon-16x16.png') }}">
        <link rel="icon" href="images/favicon.png">
        <meta property="og:image" content="images/logo.svg">
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    </head>
<style>
    .progress-circle {
    width: 60px;
    height: 60px;
}

.circular-chart {
    display: block;
    margin: 10px auto;
    max-width: 100%;
    max-height: 100%;
}

.circle-bg {
    fill: none;
    stroke: #eee;
    stroke-width: 3.8;
}

.circle {
    fill: none;
    stroke-width: 2.8;
    stroke-linecap: round;
    stroke: #4caf50;
    stroke-dasharray: 0, 100;
    animation: progress 1s ease-out forwards;
}

@keyframes progress {
    0% {
        stroke-dasharray: 0 100;
    }
    100% {
        stroke-dasharray: 90 100;
    }
}
</style>
<body class="dashboardBg">
   <section class="dashboard position-relative p-3">
    <div class="sidebar">
        <a href="index.html" class="logo">
            <img src="{{ asset('assetss/images/logo.svg')}}" alt="logo">
        </a>
        <div class="sidelinks p-3">
            <ul class="list-unstyled mb-0 h-100 d-flex d-md-none">
                <li>
                    <a href="index.html">Dashboard</a>
                </li>
<li>
                    <a href="authenticate.html">Authenticate</a>
                </li>
                <li>
                    <a href="subscribe.html">Subscribe</a>
                </li>
                <li>
                    <a href="localRepresentatives.html">LocalRepresentatives</a>
                </li>
                <li>
                    <a href="projections.html">Projections</a>
                </li>
                <li>
                    <a href="election.html">Election</a>
                </li>
                <li>
                    <a class="active" href="stateLevel.html">State Level</a>
                </li>
                <li>
                    <div class="accordion" id="accordionSidebar">
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Congress
                                </button>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body px-0">
                                    <ul class="list-group">
                                        <li class="list-group-item">President Name</li>
                                        <li class="list-group-item">V-President Name</li>
                                        <li class="list-group-item">Cabinet</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Legislative
                                </button>
                            <div id="collapseTwo" class="accordion-collapse collapse px-0" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    Legislative content here...
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Judicial
                                </button>
                            <div id="collapseThree" class="accordion-collapse collapse px-0" aria-labelledby="headingThree"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    Judicial content here...
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled mb-0 h-100 d-none d-md-flex">
                <li>
                    <a class="active" href="stateLevel.html">State Level</a>
                </li>
                <li>
                    <div class="accordion" id="accordionSidebar">
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Congress
                                </button>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body px-0">
                                    <ul class="list-group">
                                        <li class="list-group-item">President Name</li>
                                        <li class="list-group-item">V-President Name</li>
                                        <li class="list-group-item">Cabinet</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Legislative
                                </button>
                            <div id="collapseTwo" class="accordion-collapse collapse px-0" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    Legislative content here...
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-transparent">
                                <button class="accordion-button collapsed py-2 border-0" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Judicial
                                </button>
                            <div id="collapseThree" class="accordion-collapse collapse px-0" aria-labelledby="headingThree"
                                data-bs-parent="#accordionSidebar">
                                <div class="accordion-body">
                                    Judicial content here...
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="w-100 h-100 d-flex flex-column ps-0 ps-md-3">
        <nav class="w-100 d-flex justify-content-end gap-3 pb-0 pb-md-3" >
            <ul class="list-unstyled d-none d-md-flex gap-3 dashboardLinks mb-0 align-items-center">
                <li>
                    <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.dashboard.index')}}" class=" {{ Request::is('client/dashboard') || Request::is('client/dashboard/*') ? 'active' : '' }}">Dashboard</a>
                </li>
      {{-- <li>
                    <a href="authenticate.html">Authenticate</a>
                </li> --}}
                <li>
                  <a href="{{route('client.showSubscribe')}}" class=" {{ Request::is('client/subscription') || Request::is('client/subscription/*') ? 'active' : '' }}">Subscribe</a>
                </li>
                <li>
                    <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.localView',$value)}}">LocalRepresentatives</a>
                </li>
                <li>
                    <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.projectionView')}}">Projections</a>
                </li>
                <li>
                    <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.electionView')}}">Election</a>
                </li>
                </li>
                        <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.federalView')}}">federal</a>
                    </li><li>
             <a  href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.stateView',$value)}}">State Level</a>      
          </li>
            </ul>
            <ul class="list-unstyled d-flex gap-2 align-items-center mb-0">
                <li class="dropdown ">
                    <a class="rounded-circle " href="#" role="button" id="dropdownUser"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="avatar avatar-md avatar-indicators avatar-online">
                           <img alt="avatar" src="{{ auth()->user()->profile_image == null ? asset('public\assetss\images\user.svg') : asset(auth()->user()->profile_image) }}" class="user">
                        </div>
                    </a> 
                    <div class="dropdown-menu pb-2" aria-labelledby="dropdownUser">
                        <div class="dropdown-item bg-tran">
                            <div class="d-flex py-2">
                                <div class="avatar avatar-md avatar-indicators avatar-online me-2">
                                   <img alt="avatar" src="{{ auth()->user()->profile_image == null ? asset('public\assetss\images\user.svg') : asset(auth()->user()->profile_image) }}" class="user">
                                </div>
                                <div class="ml-3 lh-1">
                                    <h5 class="mb-0">{{auth()->user()->user_name}}</h5>
                                    <p class="mb-0">{{auth()->user()->email}}</p>
                                </div>

                            </div>
                            
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="">
                            <ul class="list-unstyled">
                                
                                
                            
            
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.edit.profile')}}">
                <span class="mr-1">
                
    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </span>Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.dashboard.index')}}">
                <span class="mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></span>Settings
                                    </a>
                                </li>
                                
                            
                            </ul>
                        </div>
                        <div class="dropdown-divider"></div>
                        <ul class="list-unstyled">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">
            <span class="mr-2">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg></span>Sign Out
                            </a>
                        </li>
                    
                    </ul>
                        
                    </div>
                </li>
                <li>
                    <div class="toggle-icon d-flex d-md-flex d-lg-none">
                        <img src="{{asset('assetss/images/toggle-icon.svg')}}" alt="toggle-icon">
                    </div>
                </li>

              </ul>
        </nav>
        <div class="main h-100 overflow-auto">
            <div class="container my-4">
                    <h4 class="text-center pageTitle mb-3">State of <span class="themeColor">State Name</span></h4>
                  
                   
                        <div class="row g-3 mt-3"> <!-- Use g-2 for small gutters -->
                            <!-- Box 1: Image, Follow, Elections -->
                            <div class="col-md-4">
                                <div class="mfacard w-100 p-3 h-100">
                                    <div class="card-body text-center">
                                        <img src="images/user.svg" alt="Abraham Lincoln" class="img-fluid rounded-circle mb-3"
                                            style="width: 150px;">
                                        <h5 class="text-white mb-3 ">Abraham Lincoln</h5>
                                        <p class="text-white mb-3">President of the United States</p>
                                        <div class="d-flex flex-wrap gap-3 justify-content-center">
                                            <button class="theme-btn">Follow</button>
                                            <button class="theme-btn">Elections</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Box 2: Political Stance -->
                            <div class="col-md-4">
                                <div class="mfacard w-100 p-3 h-100">
                                    <div class="card-body">
                                        <h5 class="text-white mb-3">Key Political Stance</h5>
                                        <ul class="list-unstyled text-white">
                                            <li>This politician stands for Love</li>
                                            <li>This politician stands for Lace</li>
                                            <li>This politician stands for Liberty</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Box 3: Reliability Score -->
                            <div class="col-md-4">
                                <div class="mfacard w-100 h-100 p-3">
                                    <div class="card-body">
                                        <h5 class="text-white mb-3">Reliability Score</h5>
                                        <div class="flex progress-wrapper">
                                            <input class="opacity-0" type="range" value="90" min="0" max="100" step="1">
                                          </div>
                                        <div class="d-flex align-items-center themeColor">
                                            <div  class="pie themeColor text-white mx-auto" data-pie='{ "percent": 90 }'>
                                            </div>
                                        </div>
                                        <p class="small text-white mt-4">Reliability Score is based on many factors such as voting history and claims.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Box 4: Funding and Voting History Buttons -->
                        <div class="row d-flex g-3 mt-2">
                            <div class="col-md-6 col-12">
                                <div class="mfacard d-flex justify-content-center align-items-center p-3 p-md-5 w-100">
                                <button class="theme-btn">Funding</button>
                            </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mfacard d-flex justify-content-center align-items-center p-3 p-md-5 w-100">

                                <button class="theme-btn">Voting History</button>
                                </div>
                            </div>
                        </div>
                   
                </div>
            </div>
    </div>
   
   </section>

   <script src="{{ asset('public/assetss/js/jquery.js') }}"></script>
   <script src="{{ asset('public/assetss/js/bootstrap.js') }}"></script>
   <script src="{{ asset('public/assetss/js/owl-carousel.js') }}"></script>
   <script src="https://cdn.jsdelivr.net/gh/tomik23/circular-progress-bar@latest/docs/circularProgressBar.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
   <script src="{{ asset('public/assetss/js/custom.js') }}"></script>

</body>
</html>