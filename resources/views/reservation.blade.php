<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            @if (Auth::user()->role != 2)
            <button button="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Add Reservation </button>
            @endif
            {{--<div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>--}}
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ROOMS</th>
                        <th class="whitespace-no-wrap">ROOM NAME</th>
                        @if (Auth::user()->role != '2')
                        <th class="whitespace-no-wrap">CUSTOMER NAME</th>
                        @endif
                        <th class="text-center whitespace-no-wrap">CHECKIN</th>
                        <th class="text-center whitespace-no-wrap">CHECKOUT</th>
                        <th class="text-center whitespace-no-wrap">PAYMENT STATUS</th>
                        <th class="text-center whitespace-no-wrap">STATUS</th>
                        {{--@if (Auth::user()->role != '2')--}}
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                        {{--@endif--}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)

                    <tr class="intro-x reservation-{{$reservation->id}}" style="cursor: pointer">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="{{getRoomName($reservation->room_id)}}" class="tooltip rounded-full" src="{{getRoomImage($reservation->room_id)}}" title="{{getRoomName($reservation->room_id)}}">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-no-wrap">{{getRoomName($reservation->room_id)}}</a>
                            <div class="text-gray-600 text-xs whitespace-no-wrap"> Total: {{number_format($reservation->total_amount,2)}}</div>
                        </td>
                        @if (Auth::user()->role != '2')
                        <td>
                            {{getUserName($reservation->user_id)}}
                        </td>
                        @endif
                        <td class="text-center">{{$reservation->checkin_date ? date('F j, Y H:i:A', strtotime($reservation->checkin_date)):'N/A' }}</td>
                        <td class="text-center">{{ $reservation->checkout_date ? date('F j, Y H:i:A', strtotime($reservation->checkout_date)):'N/A'}}</td>
                        <td class="w-40">
                            {!!getPaymentStatus($reservation->id)!!}
                        </td>
                        <td class="w-40">
                            {!!getReservationStatus($reservation->id)!!}

                        </td>
                        
                        <td class="table-report__action w-56">
                            <div class="dropdown relative"> <a href="#" class="dropdown-toggle button inline-block text-black"><i data-feather="settings" class="w-6 h-6 text-gray-700"></i></a>
                                <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 -mr-12 sm:mr-0 z-20">
                                    <div class="dropdown-box__content box">
                                        <div class="p-4 border-b border-gray-200 font-medium">Action</div>

                                        <div class="p-2">
                                            <a href="{{ route('view-reservation', $reservation->id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="eye" class="w-4 h-4 text-gray-700 mr-2"></i> View </a>
                                            
                                        @if (date('Y-m-d', strtotime('+ '.$reservation->terms.' days', strtotime($reservation->created_at))) >= date('Y-m-d') || $reservation->status == 0)
                                            <a href="#" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md" onclick="view_reservation_details('{{$reservation}}')"> <i data-feather="check-square" class="w-4 h-4 text-gray-700 mr-2"></i> Edit </a>                                          

                                            <a href="#" onclick="deleteReservation({{$reservation->id}})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash-2" class="w-4 h-4 text-gray-700 mr-2"></i> Delete </a>
                                            @if (Auth::user()->role != '2')
                                            <a href="#" onclick="generateQR({{$reservation->id}})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="maximize" class="w-4 h-4 text-gray-700 mr-2"></i> Generate </a>
                                            @endif
                                            @endif
                                        </div>
                                        @if (Auth::user()->role != '2')
                                        @if (date('Y-m-d', strtotime('+ '.$reservation->terms.' days', strtotime($reservation->created_at))) >= date('Y-m-d') || $reservation->status == 0)
                                        <div class="px-3 py-3 border-t border-gray-200 font-medium flex">
                                            <button type="button" onclick="approve({{$reservation->id}})" class="button button--sm bg-theme-1 text-white" {{$reservation->overdue}}>Approve</button>
                                            <button type="button" onclick="decline({{$reservation->id}})" class="button button--sm bg-theme-6 text-white ml-auto">Decline</button>
                                        </div>

                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
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
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                <input type="hidden" id="reservation_id">
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white delete-btn">Delete</button>
            </div>
        </div>
    </div>
    @include('modals.add-reservation')
    @include('modals.edit-reservation')
    @include('modals.scan-qr')
    @include('modals.generate-qr')
    @include('modals.success-scan')
    <script>
        $(document).ready(function() {
            var room_price = 0;
            var service_price = 0;
            $('#room_id').on('change', function() {
                var val = $(this).val();
                $.ajax({
                    url: 'api/get-room-price/' + val,
                    type: 'GET',
                    success: function(response) {
                        room_price = response.price;
                        var total = room_price + service_price;
                        $("#total_amount").val(total);
                    }
                });
            });
            $('#e_room_id').on('change', function() {
                var val = $(this).val();
                $.ajax({
                    url: 'api/get-room-price/' + val,
                    type: 'GET',
                    success: function(response) {
                        room_price = response.price;
                        var total = room_price + service_price;
                        $("#e_total_amount").val(total);
                    }
                });
            });
            $('#service_id').on('change', function() {
                var val = $(this).val();

                $.ajax({
                    url: 'api/get-service-price/' + val,
                    type: 'GET',
                    success: function(response) {
                        service_price = response.price;
                        var total = room_price + service_price;
                        $("#total_amount").val(total);
                    }
                });
            });
            $('#e_service_id').on('change', function() {
                var val = $(this).val();

                $.ajax({
                    url: 'api/get-service-price/' + val,
                    type: 'GET',
                    success: function(response) {
                        service_price = response.price;
                        var total = room_price + service_price;
                        $("#e_total_amount").val(total);
                    }
                });
            });
            $('#addForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'api/reservation/add_reservation',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log("response: ", response);
                        if(response == 1){
                            $.toast('Success! New reservation was added.');
                            $("#add-modal").modal('hide');
                            setTimeout(()=>{window.location.reload();},2000);
                        }
                    },
                    error: function(error) {
                        console.log("error: ", error);
                    }
                });

            });
        });


        function addModal() {
            $("#add-modal").modal("show");
        }

        function closeModal(id) {
            console.log("QR Cleared", id);
            $("#" + id).modal('hide');
            var qrcode = new QRCode(document.getElementById("qrcode"));
            qrcode.clear();
        }

        function generateQR(room_id) {

            console.log("generate qr:", room_id);
            $("#generate-qr").modal('show');
            $('#generate-qr').on('click', function(e) {
                e.stopPropagation();
            });
            var qrcode = new QRCode(document.getElementById("qrcode"));
            qrcode.makeCode("HOMETEL-RES-" + room_id);
        }

        function checkInCheckOut(id) {
            let user_id = '{{Auth::user()->id}}';
            let explode = id.split('HOMETEL-');
            console.log("Scaned: ", explode[1]);
            $("#success-modal").modal("show");
            var formData = new FormData();

            formData.append("user_id", user_id);
            formData.append("reservation_id", explode[2]);
            $.ajax({
                url: 'api/reservation/check',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("response: ", response);
                    $.toast("Success! Scan successful.");
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        }

        function approve(reservation_id) {
            var formData = new FormData();
            formData.append("reservation_id", reservation_id);

            $.ajax({
                url: 'api/reservation/approve',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("response: ", response);
                    $.toast("Success! Selected reservation was approved.");
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        }

        function decline(reservation_id) {
            var formData = new FormData();
            formData.append("reservation_id", reservation_id);

            $.ajax({
                url: 'api/reservation/decline',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log("response: ", response);
                    $.toast("Success! Selected reservation was declined.");
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        }

        function deleteReservation(reservation_id) {
            $("#delete-confirmation-modal").modal("show");
            $("#reservation_id").val(reservation_id);
        }

        $(".delete-btn").click( function(){
            $("#delete-confirmation-modal").modal("hide");
            var reservation_id = $("#reservation_id").val();
            var formData = new FormData();
            formData.append("reservation_id", reservation_id);

            $.ajax({
                url: 'api/reservation/delete',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $.toast("Success! Selected reservation was removed.");
                    $(".reservation-"+reservation_id).fadeOut(500)
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        });

        function view_reservation_details(reservation_data){
            $("#edit-modal").modal('show');
            var o = JSON.parse(reservation_data);
            console.log(o)
            var pax = o.pax.split(", ");

            $("#e_id").val(o.id);
            $("#e_room_id").val(o.room_id).trigger('change');
            $("#e_service_id").val(o.service_id).trigger('change');
            $("#e_adult").val(pax[0]).trigger('change');
            $("#e_child").val(pax[1]).trigger('change');
            $("#e_total_amount").val(o.total_amount);
        }
        
        $('#editForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: 'api/reservation/update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // console.log("response: ", response);
                        if(response == 1){
                            $.toast('Success! Reservation details was updated.');
                            $("#edit-modal").modal('hide');
                            setTimeout(()=>{window.location.reload();},2000);
                        }
                    },
                    error: function(error) {
                        console.log("error: ", error);
                    }
                });

            });
    </script>
</x-app-layout>