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
                <div class="flex items-center text-gray-700 sm:ml-20 sm:pl-5 pr-3 mr-3 bg-white">
                    <input type="checkbox" class="input border mr-2" id="cb-check-all" onchange="selectAll()">
                    <label class="cursor-pointer select-none" for="horizontal-remember-me">Select All</label>
                </div>
                <button type="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Add Room</button>
                <button type="button" onclick="deleteRooms()" class="button text-white bg-theme-6 shadow-md mr-2">Delete Room</button>                
            </div>
        </div>
        <!-- END: File Manager Filter -->
        <!-- BEGIN: Directory & Files -->
        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
            @foreach ($rooms as $room)                 
            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                    <div class="absolute left-0 top-0 mt-3 ml-3">
                        <input class="input border border-gray-500 room-checkbox" value="{{$room->id}}" type="checkbox">
                    </div>
                    <a href="" class="w-3/5">
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="assets/uploads/rooms/{{$room->image}}">
                    </a>
                    <a href="#" class="block font-medium mt-4 text-center truncate">{{$room->room_name}}</a> 
                    <div class="text-gray-600 text-xs text-center">Php. {{number_format($room->price, 2)}}</div>
                    <!-- <div class="absolute top-0 right-0 mr-2 mt-2 dropdown ml-auto">
                        <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-vertical" class="w-5 h-5 text-gray-500"></i> </a>
                        <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-10">
                            <div class="dropdown-box__content box p-2">
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="users" class="w-4 h-4 mr-2"></i> Share File </a>
                                <a href="" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash" class="w-4 h-4 mr-2"></i> Delete </a>
                            </div>
                        </div>
                    </div> -->
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
                url: 'api/room/room_add', // Replace with your upload endpoint
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("response: ", response);
                    $.toast('Success! New room was added.');
                    $("#add-modal").modal('hide');
                    setTimeout(()=>{ window.location.reload(); },1000)
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });

        });
    });

    function checkAll(){
        $('.room-checkbox').prop("checked", true);
    }

    function uncheckAll(){
        $('.room-checkbox').prop("checked", false);
    }

    function selectAll(){
        var cb = $("#cb-check-all").is(":checked");
        if(cb){
            checkAll();
        }else{
            uncheckAll();
        }
    }

    function deleteRooms(){
        var rooms = [];
        $(".room-checkbox:checked").each(function(){
            rooms.push($(this).val());
        });

        if(rooms.length > 0){
            if(confirm("Are you sure to delete selected room/s?")){
                $.ajax({
                    url: 'api/room/room_delete', // Replace with your upload endpoint
                    type: 'POST',
                    data: {rooms: rooms},
                    success: function(response) {
                        // console.log("response: ", response);
                        if(response > 0){
                            $.toast('Success! Selected room/s was removed.');
                            setTimeout(()=>{ window.location.reload(); },2000)
                        }else{
                            $.toast('Error! Something was wrong.');
                        }
                    },
                    error: function(error) {
                        console.log("error: ", error);
                    }
                });
            }
        }else{
            $.toast('Please select room/s to be deleted.');
        }


    }

</script>
</x-app-layout>