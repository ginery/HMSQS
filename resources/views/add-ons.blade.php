<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-8">

        <div class="col-span-12">
            <!-- BEGIN: File Manager Filter -->
            <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
                <div class=" relative mr-auto mt-3 sm:mt-0">
                    <!-- <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700" data-feather="search"></i> 
                <input type="text" class="input w-full sm:w-64 box px-10 text-gray-700 placeholder-theme-13" placeholder="Search rooms">
                 -->
                </div>
                <div class="w-full sm:w-auto flex">
                    <!-- <div class="flex items-center text-gray-700 sm:ml-20 sm:pl-5 pr-3 mr-3 bg-white">
                        <input type="checkbox" class="input border mr-2" id="cb-check-all" onchange="selectAll()">
                        <label class="cursor-pointer select-none" for="horizontal-remember-me">Select All</label>
                    </div> -->
                    <div class="flex items-center text-gray-700 sm:ml-20 sm:pl-5 pr-3 mr-3 px-10">
                        <select id="filter" class="input" onchange="filter()">
                            <option value="all">All</option>
                            <option value="1">Foods</option>
                            <option value="3">Laundry</option>
                            <option value="4">Massage</option>
                            <option value="2">Others</option>
                        </select>
                    </div>
                    <button type="button" onclick="addOns()" class="button text-white bg-theme-1 shadow-md mr-2">Add Service</button>
                </div>
            </div>
            <!-- END: File Manager Filter -->
            <!-- BEGIN: Directory & Files -->
            <div class="intro-y grid grid-cols-12 gap-3 sm:gap-6 mt-5 services-list">
                @foreach ($services as $service)
                <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                    <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                        <a href="" class="w-3/5">

                            <img alt="Midone Tailwind HTML Admin Template" class="rounded-md"
                                src="{{asset('assets/uploads/service/'.$service->image)}}">
                        </a>
                        <a href="#" class="block font-medium mt-4 text-center truncate">{{$service->service_name}}</a>
                        <div class="text-gray-600 text-xs text-center">Php. {{number_format($service->price, 2)}}</div>
                        <div class="text-blue-600 text-md text-center">{{$service->description}}</div>
                        <div class="text-center mt-3 d-flex justify-center">
                            <div>Qty:</div>
                            <input type="number" id="qty-{{$service->id}}" min="0" class="input w-20 border mt-2"
                                value="1" disabled>
                            <div class="mt-3 ml-3">
                                <input id="cb_{{$service->id}}" class="input border border-gray-500 room-checkbox"
                                    value="{{$service->id}}" type="checkbox" onchange="is_selected({{$service->id}})">
                            </div>
                        </div>
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

        $(document).ready(function () {
            $('#addForm').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'api/room/room_add', // Replace with your upload endpoint
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        // console.log("response: ", response);
                        $.toast('Success! New room was added.');
                        $("#add-modal").modal('hide');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000)
                    },
                    error: function (error) {
                        console.log("error: ", error);
                    }
                });

            });
        });

        function checkAll() {
            $('.room-checkbox').prop("checked", true);
        }

        function uncheckAll() {
            $('.room-checkbox').prop("checked", false);
        }

        function selectAll() {
            var cb = $("#cb-check-all").is(":checked");
            if (cb) {
                checkAll();
            } else {
                uncheckAll();
            }
        }

        function addOns() {
            let reservation_id = "{{ request()->route('reservation_id') }}";
            let user_id = "{{Auth::id()}}";
            var service_data = [];
            $(".room-checkbox:checked").each(function () {
                var service_id = $(this).val();
                var service_qty = $("#qty-" + service_id).val();
                service_data.push(`${service_id}-${service_qty}`);
            });
            console.log(reservation_id);
            var apiEndpoint = "{{ url('api/reservation/add_ons_insert') }}";
            if (service_data.length > 0) {
                if (confirm("Are you sure to add service(s) into your room?")) {
                    $.ajax({
                        url: apiEndpoint, // Replace with your upload endpoint
                        type: 'POST',
                        data: {
                            service_data: service_data,
                            reservation_id: reservation_id,
                            user_id: user_id
                        },
                        success: function (response) {
                            if (response > 0) {
                                $.toast('Success! Services added as add ons.');
                                setTimeout(() => {
                                    window.location.href = "/view-reservation/" + reservation_id
                                }, 2000)
                            } else {
                                $.toast('Error! Something was wrong.');
                            }
                        },
                        error: function (error) {
                            console.log("error: ", error);
                        }
                    });
                }
            } else {
                $.toast('Please select service(s).');
            }
        }

        function is_selected(addOnId) {
            if ($("#cb_" + addOnId).is(":checked")) {
                $("#qty-" + addOnId).prop("disabled", false);
            } else {
                $("#qty-" + addOnId).prop("disabled", true);
            }
        }

        function filter(){
            var filter = $("#filter").val();
            $.ajax({
                url: '/api/reservation/add_ons_filter', // Replace with your upload endpoint
                type: 'POST',
                data: {filter: filter},
                success: function (response) {
                    $('.services-list').empty();

                    // Loop through the returned services and create the new HTML elements
                    $.each(response.services, function(index, service) {
                        var newElement = `
                            <div class="intro-y col-span-6 sm:col-span-4 md:col-span-3 xxl:col-span-2">
                                <div class="file box rounded-md px-5 pt-8 pb-5 px-3 sm:px-5 relative zoom-in">
                                    <a href="" class="w-3/5">
                                        <img alt="Midone Tailwind HTML Admin Template" class="rounded-md"
                                            src="${service.image}">
                                    </a>
                                    <a href="#" class="block font-medium mt-4 text-center truncate">${service.service_name}</a>
                                    <div class="text-gray-600 text-xs text-center">Php. ${service.price.toFixed(2)}</div>
                                    <div class="text-blue-600 text-md text-center">${service.description}</div>
                                    <div class="text-center mt-3 d-flex justify-center">
                                        <div>Qty:</div>
                                        <input type="number" id="qty-${service.id}" min="0" class="input w-20 border mt-2"
                                            value="1" disabled>
                                        <div class="mt-3 ml-3">
                                            <input id="cb_${service.id}" class="input border border-gray-500 room-checkbox"
                                                value="${service.id}" type="checkbox" onchange="is_selected(${service.id})">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Append the new element to the container
                        $('.services-list').append(newElement);
                    });
                },
                error: function (error) {
                    console.log("error: ", error);
                }
            });
        }

    </script>
</x-app-layout>
