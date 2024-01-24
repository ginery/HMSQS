<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <a href="" class="flex mr-auto">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="{{asset('dist/images/logo.svg')}}">
        </a>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-feather="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-theme-24 py-5 hidden">
        <li>
            <a href="{{ route('dashboard') }}" class="menu menu--active">
                <div class="menu__icon"> <i data-feather="home"></i> </div>
                <div class="menu__title"> Dashboard </div>
            </a>
        </li>
        @if (Auth::user()->role != 2)
        <li>
            <a href="{{ route('rooms') }}" class="menu">
                <div class="menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="menu__title"> Rooms </div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('reservation') }}" class="menu">
                <div class="menu__icon"> <i data-feather="book"></i> </div>
                <div class="menu__title"> Reservations </div>
            </a>
        </li>
        @if (Auth::user()->role == 0)
        <li>
            <a href="{{ route('services') }}" class="menu">
                <div class="menu__icon"> <i data-feather="star"></i> </div>
                <div class="menu__title"> Services </div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('payment') }}" class="menu">
                <div class="menu__icon"> <i data-feather="dollar-sign"></i> </div>
                <div class="menu__title"> Payments </div>
            </a>
        </li>
        @if (Auth::user()->role != 2)
        <li>
            <a href="{{ route('scanqr') }}" class="menu">
                <div class="menu__icon"> <i data-feather="maximize"></i> </div>
                <div class="menu__title"> Scan QR </div>
            </a>
        </li>
        @endif
        
        @if (Auth::user()->role != 2)
        <li>
            <a href="javascript:;" class="menu">
                <div class="menu__icon"> <i data-feather="bar-chart-2"></i> </div>
                <div class="menu__title"> Reports <i class="menu__sub-icon" data-feather="chevron-down"></i> </div>
            </a>
            <ul class="">
                <li>
                    <a href="{{ route('reports') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="circle"></i> </div>
                        <div class="menu__title"> Transactions </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sales-report') }}" class="menu">
                        <div class="menu__icon"> <i data-feather="circle"></i> </div>
                        <div class="menu__title"> Sales </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</div>