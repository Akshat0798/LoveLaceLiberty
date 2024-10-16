<div class="d-flex d-md-none">
  <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.dashboard.index')}}" class=" {{ Request::is('client/dashboard') || Request::is('client/dashboard/*') ? 'active' : '' }}" class="logo">
      <img src="{{ asset('public\assetss\images\logo.svg')}}" alt="logo">
  </a>
  <div class="sidelinks p-3">
      <ul class="list-unstyled">
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
              <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.local', ['USA'])}}">LocalRepresentatives</a>
          </li>
          <li>
              <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.projectionView')}}">Projections</a>
          </li>
          <li>
              <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.electionView')}}">Election</a>
          </li>
          </li>
                  <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.federal')}}">federal</a>
              </li><li>
       <a  href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.state', ['USA'])}}">State Level</a>      
    </li>
      </ul>
  </div>
</div>

<div class=" position-relative p-0 m-0">

<nav class="w-100 d-flex justify-content-between align-items-center pe-3 pe-md-0">
  <a href="{{route('client.dashboard.index')}}" class="landinPagelogo p-3 bg-black">
      <img src="{{ asset('public\assetss\images\logo.svg')}}" alt="logo">
  </a>
  <ul class="list-unstyled d-none d-md-flex gap-3 landinPageLinks mb-0">
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
          <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.localView', ['USA'])}}">LocalRepresentatives</a>
      </li>
      <li>
          <a  href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.projectionView')}}">Projections</a>
      </li>
      <li>
          <a  href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.electionView')}}">Election</a>
      </li>
      
              <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.federalView')}}">federal</a>
          <li>
<a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.stateView', ['USA'])}}">State Level</a>                
</li>
  </ul>
 <ul class="list-unstyled d-flex gap-2 align-items-center">
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