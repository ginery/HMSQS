<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <div class="text-center"> <a href="javascript:;" data-toggle="modal" data-target="#add-user-modal" class="button text-white bg-theme-1 shadow-md mr-2">Add New User</a> </div>
            <!-- <button class="" >Add New User</button> -->
        
            {{--<div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>--}}
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
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/profile-11.jpg">
                    </div>
                    <div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">
                        <a href="" class="font-medium">{{$users->first_name}} {{$users->last_name}}</a> 
                        <div class="text-gray-600 text-xs">{{$users->email}}</div>
                    </div>
                    <!-- <div class="flex -ml-2 lg:ml-0 lg:justify-end mt-3 lg:mt-0">
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Facebook"> <i class="w-3 h-3 fill-current" data-feather="facebook"></i> </a>
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Twitter"> <i class="w-3 h-3 fill-current" data-feather="twitter"></i> </a>
                        <a href="" class="w-8 h-8 rounded-full flex items-center justify-center border ml-2 text-gray-500 zoom-in tooltip" title="Linked In"> <i class="w-3 h-3 fill-current" data-feather="linkedin"></i> </a>
                    </div> -->
                </div>
                <div class="flex flex-wrap lg:flex-no-wrap items-center justify-center p-5">
                    <div class="w-full lg:w-1/2 mb-4 lg:mb-0 mr-auto">
                        <!-- <div class="flex">
                            <div class="text-gray-600 text-xs mr-auto">Progress</div>
                            <div class="text-xs font-medium">20</div>
                        </div>
                        <div class="w-full h-1 mt-2 bg-gray-400 rounded-full">
                            <div class="w-1/4 h-full bg-theme-1 rounded-full"></div>
                        </div> -->
                    </div>
                    <!-- <button class="button button--sm text-white bg-theme-1 mr-2"> Message</button> -->
                    <!-- <button class="button button--sm text-gray-700 border border-gray-300">Profile</button> -->
                    <button class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white" onclick="view_user_details('{{$users}}')"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Edit </button>
                </div>
            </div>
        </div>
        @endforeach
        <!-- END: Users Layout -->
        {{--
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
        --}}
    </div>

    @include('modals.add-user')
    @include('modals.edit-user')
    <script>
        $("#add-user-form").submit( function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'api/user/user_add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $.toast('Success! New user was added.');
                    $("#add-user-modal").modal('hide');
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            })
        });

        function view_user_details(user_data){ 
            $("#edit-user-modal").modal('show');
            var o = JSON.parse(user_data);
            console.log(o)

            $("#first_name").val(o.first_name);
            $("#last_name").val(o.last_name);
            $("#email").val(o.email);
            // $("#password").val(o.password);
            $("#role").val(o.role).trigger('change');
            $("#id").val(o.id);
        }
        
        $("#edit-user-form").submit( function(e){
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'api/user/user_edit',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $.toast('Success! User details was updated.');
                    $("#edit-user-modal").modal('hide');
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            })
        });

    </script>
</x-app-layout>