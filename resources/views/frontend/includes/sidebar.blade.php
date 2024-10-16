
<div class="sidebar d-flex d-md-none">
    <a href="{{ auth()->user()->is_subscribed == 0  ? route('client.showSubscribe') : route('client.dashboard.index')}}" class=" {{ Request::is('client/dashboard') || Request::is('client/dashboard/*') ? 'active' : '' }}" class="logo">
        <img src="{{ asset('public/assetss/images/logo.svg')}}" alt="logo">
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
                <a href="localRepresentatives.html">LocalRepresentatives</a>
            </li>
            <li>
                <a href="projections.html">Projections</a>
            </li>
            <li>
                <a href="{{route('client.election')}}" class=" {{ Request::is('client/election') || Request::is('client/election/*') ? 'active' : '' }}">Election</a>
            </li><li>
                <a href="federal.html">federal</a>
            </li>
            <li>
<a  href="stateLevel.html">State Level</a>                </li>
        </ul>
    </div>
</div>