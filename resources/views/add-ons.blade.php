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
                <button type="button" onclick="addOns()" class="button text-white bg-theme-1 shadow-md mr-2">Add Service</button>                
            </div>
        </div>
        <!-- END: File Manager Filter -->
        <!-- BEGIN: Directory & Files -->
        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5">
            @foreach ($services as $service)                 
            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2" >
                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                    <div class="absolute left-0 top-0 mt-3 ml-3">
                        <input class="input border border-gray-500 room-checkbox" value="{{$service->id}}" type="checkbox">
                    </div>
                    <a href="" class="w-3/5">
                        
                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-md" src="{{asset('assets/uploads/service/'.$service->image)}}">
                    </a>
                    <a href="#" class="block font-medium mt-4 text-center truncate">{{$service->service_name}}</a> 
                    <div class="text-gray-600 text-xs text-center">Php. {{number_format($service->price, 2)}}</div>
                    <div class="text-blue-600 text-md text-center">{{$service->description}}</div>
                </div>
            </div>
            @endforeach
        </div>
       
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

    function addOns(){
        let reservation_id = "{{ request()->route('reservation_id') }}";
        var service_id = [];
        $(".room-checkbox:checked").each(function(){
            service_id.push($(this).val());
        });
        console.log(reservation_id);
        var apiEndpoint = "{{ url('api/reservation/add_ons_insert') }}";
        if(service_id.length > 0){
            if(confirm("Are you sure to add service(s) into your room?")){
                $.ajax({
                    url: apiEndpoint, // Replace with your upload endpoint
                    type: 'POST',
                    data: {service_id: service_id},
                    success: function(response) {
                        console.log("response: ", response);
                        // if(response > 0){
                        //     $.toast('Success! Services added as add ons.');
                        //     setTimeout(()=>{ window.location.reload(); },2000)
                        // }else{
                        //     $.toast('Error! Something was wrong.');
                        // }
                    },
                    error: function(error) {
                        console.log("error: ", error);
                    }
                });
            }
        }else{
            $.toast('Please select service(s).');
        }


    }

</script>
</x-app-layout>