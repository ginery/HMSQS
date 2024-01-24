<?php 
$currentPageName = Route::current()->getName();
?>

<nav class="side-nav">
    <a href="" class="intro-x flex items-center pl-5 pt-4">
        <img alt="hometel-logo" class="w-6" style="width: 94px;" src="{{asset('assets/images/logo-3.jpg')}}">
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}" class="<?= $currentPageName == 'dashboard' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        @if (Auth::user()->role != 2)
        <li>
            <a href="{{ route('rooms') }}" class="<?= $currentPageName == 'rooms' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="inbox"></i> </div>
                <div class="side-menu__title"> Rooms </div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('reservation') }}" class="<?= $currentPageName == 'reservation' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="book"></i> </div>
                <div class="side-menu__title"> Reservations </div>
            </a>
        </li>
        @if (Auth::user()->role == 0)
        <li>
            <a href="{{ route('services') }}" class="<?= $currentPageName == 'services' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="star"></i> </div>
                <div class="side-menu__title"> Services </div>
            </a>
        </li>
        @endif
        <li>
            <a href="{{ route('payment') }}" class="<?= $currentPageName == 'payment' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="dollar-sign"></i> </div>
               
                <div class="side-menu__title"> Payments 
                @if (countUnpaid() > 0)
                    <div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">{{countUnpaid()}}</div>
                @endif
                </div>
              
            </a>
        </li>
        @if (Auth::user()->role != 2)
        <li>
            <a href="{{ route('scanqr') }}" class="<?= $currentPageName == 'scanqr' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="maximize"></i> </div>
                <div class="side-menu__title"> Scan QR </div>
            </a>
        </li>
        @endif
        @if (Auth::user()->role != 2)
        <li>
            <a href="javascript:;" class="<?= $currentPageName == 'reports' || $currentPageName == 'sales-report' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="bar-chart-2"></i> </div>
                <div class="side-menu__title"> Reports <i class="side-menu__sub-icon" data-feather="chevron-down"></i> </div>
            </a>
            <ul class="<?= $currentPageName == 'reports' || $currentPageName == 'sales-report' ? 'side-menu__sub-open':''?>">
                <li>
                    <a href="{{ route('reports') }}" class="<?= $currentPageName == 'reports' ? 'side-menu side-menu--active':'side-menu'?>">
                        <div class="side-menu__icon"> <i data-feather="circle"></i> </div>
                        <div class="side-menu__title"> Transactions </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('sales-report') }}" class="<?= $currentPageName == 'sales-report' ? 'side-menu side-menu--active':'side-menu'?>">
                        <div class="side-menu__icon"> <i data-feather="circle"></i> </div>
                        <div class="side-menu__title"> Sales </div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
    </ul>
</nav>