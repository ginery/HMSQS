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
        @if (Auth::user()->role == 0)
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
                <div class="side-menu__title"> Payments </div>
            </a>
        </li>
        <li>
            <a href="{{ route('scanqr') }}" class="<?= $currentPageName == 'scanqr' ? 'side-menu side-menu--active':'side-menu'?>">
                <div class="side-menu__icon"> <i data-feather="maximize"></i> </div>
                <div class="side-menu__title"> Scan QR </div>
            </a>
        </li>
    </ul>
</nav>