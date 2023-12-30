<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#add-user-modal" class="button text-white bg-theme-1 shadow-md mr-2">Add New User</a> </div>
            <!-- <button class="" >Add New User</button> -->
            <div class="dropdown relative">
                <button class="dropdown-toggle button px-2 box text-gray-700">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                </button>
                <div class="dropdown-box mt-10 absolute w-40 top-0 left-0 z-20">
                    <div class="dropdown-box__content box p-2">
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> Add Group </a>
                        <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="message-circle" class="w-4 h-4 mr-2"></i> Send Message </a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
                </div>
            </div>
        </div>
        <!-- BEGIN: Users Layout -->
        {{-- {{dd(json_encode($data))}} --}}
        
        @foreach ($users as $users)  
        <div class="intro-y col-span-12 md:col-span-6">
            <div class="box">
                <div class="flex flex-col lg:flex-row items-center p-5 border-b border-gray-200">
                    <div class="w-24 h-24 lg:w-12 lg:h-12 image-fit lg:mr-1">
                        <!-- <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-11.jpg"> -->
                        <div id="qrcode" class="rounded-full"></div>
                    </div>
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <a href="" class="font-medium">{{$users->first_name}} {{$users->last_name}}</a> 
                        <div class="text-gray-600 text-xs">{{$users->email}}</div>
                    </div>
                    <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Facebook"> <i class="w-3 h-3 fill-current" data-feather="facebook"></i> </a>
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Twitter"> <i class="w-3 h-3 fill-current" data-feather="twitter"></i> </a>
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Linked In"> <i class="w-3 h-3 fill-current" data-feather="linkedin"></i> </a>
                    </div>
                </div>
                <div class="flex flex-wrap lg:flex-no-wrap items-center justify-center p-5">
                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                        <div class="flex">
                            <div class="text-gray-600 text-xs mr-auto">Progress</div>
                            <div class="text-xs font-medium">20</div>
                        </div>
                        <div class="w-full h-1 mt-2 bg-gray-400 rounded-full">
                            <div class="w-1/4 h-full bg-theme-1 rounded-full"></div>
                        </div>
                    </div>
                    <button class="button button--sm text-white bg-theme-1 mr-2">Message</button>
                    <button class="button button--sm text-gray-700 border border-gray-300">Profile</button>
                </div>
            </div>
        </div>
        @endforeach
        <!-- END: Users Layout -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a>
                </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li> <a class="pagination__link" href="">1</a> </li>
                <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
                <li> <a class="pagination__link" href="">3</a> </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                </li>
            </ul>
            <select class="w-20 input box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
    </div>

    @include('modals.add-user')
    <script>
        $("#add-user-form").submit( function(e){
            e.preventDefault();
            var data = $("#add-user-form").serialize();

            $.ajax({
                type: 'POST',
                url: 'api/user/user_add',
                data: data,
                success: function(response) {
                    $.toast('Success! New user was added.');
                    $("#add-user-modal").modal('hide');
                    window.location.reload();
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            })
        });

        new QRCode(document.getElementById("qrcode"), {
            drawer: 'svg',
            text: "your text here",
            // logo: "logo.png",
            width: 50,
            height: 50,
            // logoWidth: 80,
            // logoHeight: 80,
            // logoBackgroundTransparent: true
        });
    </script>
</x-app-layout>