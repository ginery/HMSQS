<div class="intro-x dropdown w-8 h-8 relative">
    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
        <img alt="Midone Tailwind HTML Admin Template" src="dist/images/profile-12.jpg">
    </div>
    <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
        <div class="dropdown-box__content box bg-theme-38 text-white">
            <div class="p-4 border-b border-theme-40">
                <div class="font-medium">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</div>
                <div class="text-xs text-theme-41">{{ getRole(Auth::user()->role)}}</div>
            </div>
            <div class="p-2">
                <a href="{{route('profile.edit')}}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                <a href="{{ route('users') }}" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
            </div>
            <div class="p-2 border-t border-theme-40">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <a href="#" onclick="event.preventDefault();
                this.closest('form').submit();" class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                </form>
            </div>
        </div>
    </div>
</div>