<x-app-layout>
<div class="grid grid-cols-12 gap-6 mt-8">
   
    <div class="col-span-12">
        <!-- BEGIN: File Manager Filter -->
        <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
            <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700" data-feather="search"></i> 
                <input type="text" class="input w-full sm:w-64 box px-10 text-gray-700 placeholder-theme-13" placeholder="Search rooms">
                
            </div>
            <div class="w-full sm:w-auto flex">
                <button type="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Add Room</button>
                <div class="dropdown relative">
                    <button class="dropdown-toggle button px-2 box text-gray-700">
                        <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i> </span>
                    </button>
                    <div class="dropdown-box mt-10 absolute w-40 top-0 right-0 z-20">
                        <div class="dropdown-box__content box p-2">
                            <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> Select All </a>
                            <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="square" class="w-4 h-4 mr-2"></i> De-select All </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: File Manager Filter -->
        <!-- BEGIN: Directory & Files -->
        {{-- {{dd(json_encode($data))}} --}}
        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
            @foreach ($rooms as $room)                 
            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                    <div class="absolute left-0 top-0 mt-3 ml-3">
                        <input class="input border border-gray-500" type="checkbox">
                    </div>
                    <a href="" class="w-3/5">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="assets/uploads/rooms/{{$room->image}}">
                    </a>
                    <a href="#" class="block font-medium mt-4 text-center truncate">{{$room->room_name}}</a> 
                    <div class="text-gray-600 text-xs text-center">Php. {{number_format($room->price, 2)}}</div>
                    <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                            <div class="dropdown-box__content box p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> Share File </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- END: Directory & Files -->
        <!-- BEGIN: Pagination -->
        {{-- <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-6">
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
        </div> --}}
        <!-- END: Pagination -->
    </div>
</div>
@include('modals.add-rooms')
<script>
    function addModal() {        
        $("#add-modal").modal("show");       
    }
    $(document).ready(function(){
        $('#addForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'api/room_add', // Replace with your upload endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("response: ", response);
                    $.toast('Success! New room was added.');
                    $("#add-modal").modal('hide');
                    window.location.reload();
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });

        });
    });

</script>
</x-app-layout>