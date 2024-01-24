<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <button button="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Payment</button>

            {{-- <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div> --}}
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">PAYMENT ID</th>
                        <th class="whitespace-no-wrap">RESERVATION ID</th>
                        <th class="whitespace-no-wrap">ADD ONS</th>
                        <th class="text-center whitespace-no-wrap">PAYMENT TYPE</th>
                        <th class="text-center whitespace-no-wrap">REFERENCE NUMBER</th>
                        <th class="text-center whitespace-no-wrap">AMOUNT</th>
                        <th class="text-center whitespace-no-wrap">STATUS</th>
                      
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)

                    <tr class="intro-x payment-{{$payment->id}}" style="cursor: pointer" onclick="">
                        <td class="w-40">
                            {{$payment->id}}
                        </td>
                        <td>
                            {{$payment->reservation_id}}
                        </td>
                        <td>
                            {{$payment->add_ons_id}}
                        </td>
                        <td class="text-center">
                            {{$payment->payment_type == 'C' ? 'Cash':'Online'}}
                        </td>
                        <td class="w-40">
                            {{$payment->reference_number}}
                        </td>                       
                        <td class="w-40">
                            @if($payment->partial_amount != 0.00)
                                Php. {{number_format($payment->partial_amount, 2)}} / {{number_format($payment->total_amount, 2)}}
                            @else
                                Php. {{number_format($payment->total_amount, 2)}}
                            @endif
                        </td>
                        <td class="w-40">
                           @if ($payment->status == 1)
                                @if ($payment->partial_amount == 0.00)
                                    <div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Paid</div>
                                @else
                                    <div class="text-xs  bg-green-600  px-1 rounded-md text-white ml-auto">Partial -<br> Fully Paid</div>
                                @endif
                            @elseif($payment->status == -1)
                                <div class="text-xs  bg-theme-6  px-1 rounded-md text-white ml-auto">Canceled</div>
                            @elseif($payment->status == 2)
                                <div class="text-xs  bg-theme-11  px-1 rounded-md text-white ml-auto">Partial</div>
                            @else
                            <div class="text-xs  bg-gray-600  px-1 rounded-md text-white ml-auto">Pending for approval</div>
                            @endif
                        </td>
                       
                        <td class="table-report__action w-56">
                            <div class="dropdown relative"> <a href="#" class="dropdown-toggle button inline-block text-black"><i data-feather="settings" class="w-6 h-6 text-gray-700"></i></a>
                                <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 -mr-12 sm:mr-0 z-20">
                                    <div class="dropdown-box__content box">
                                        <div class="p-4 border-b border-gray-200 font-medium">Action</div>

                                        <div class="p-2">

                                            <a href="{{route('invoice', $payment->id)}}" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="eye" class="w-4 h-4 text-gray-700 mr-2"></i> View </a>
                                            @if (Auth::user()->role != '2')
                                            <a href="#" onclick="deletePayment({{$payment->id}})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="trash-2" class="w-4 h-4 text-gray-700 mr-2"></i> Delete </a>

                                            {{-- <a href="#" onclick="generateQR({{$payment->id}})" class="flex items-center block p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="repeat" class="w-4 h-4 text-gray-700 mr-2"></i> Generate </a> --}}
                                            @if ($payment->status == 0)
                                            <div class="px-3 py-3 border-t border-gray-200 font-medium flex">
                                                <button type="button" onclick="approve({{$payment->id}})" class="button button--sm bg-theme-1 text-white" >Approve</button>
                                                <button type="button" onclick="decline({{$payment->id}})" class="button button--sm bg-theme-6 text-white ml-auto">Cancel</button>
                                            </div>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i>
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
                <input type="hidden" id="payment_id"/>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white delete-btn">Delete</button>
            </div>
        </div>
    </div>
    @include('modals.add-payment')
    @include('modals.generate-qr')

    <script>
        function addModal() {
            $("#add-modal").modal("show");
        }

        function viewInvoice(payment_id) {
            console.log("test", payment_id);
            window.location.href = "/invoice/" + payment_id;
        }

        function closeModal(id) {
            console.log("QR Cleared", id);
            $("#" + id).modal('hide');
            var qrcode = new QRCode(document.getElementById("qrcode"));
            qrcode.clear();
        }

        function generateQR(id) {
            $("#generate-qr").modal('show');
            $('#generate-qr').on('click', function(e) {
                e.stopPropagation();
            });
            var qrcode = new QRCode(document.getElementById("qrcode"));
            qrcode.makeCode("HOMETEL-PAY-" + id);
        }
        function approve(payment_id) {
            var formData = new FormData();
            formData.append("payment_id", payment_id);

            $.ajax({
                url: 'api/payment/approve',
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

        function decline(payment_id) {
            var formData = new FormData();
            formData.append("payment_id", payment_id);

            $.ajax({
                url: 'api/payment/decline',
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
        $(document).ready(function() {

            $('#reservation_id').on('change', function() {
                var val = $(this).val();
                var reservation_id = $(this).find('option:selected').attr('class');
                $('#partial_payment').val("0").trigger('change');
                $.ajax({
                    url: 'api/get-room-price/' + reservation_id,
                    type: 'GET',
                    success: function(response) {
                        // service_price = response.price;
                        $("#total_amount").val(response.price);
                        console.log(response, reservation_id);
                    }
                });
            });
            $('#reservation').on('click', function() {
                var reservation = $(this).val();
                $('#service').prop('checked', false);
                $("#service_dropdown").hide();
                $("#reservation_dropdown").show();
                $('#service').val(0);

                
            });
            $('#service').on('click', function() {

                var service = $(this).val();
                $('#reservation').prop('checked', false);
                $("#reservation_dropdown").hide();
                $("#service_dropdown").show();
                $('#reservation').val(0);
                console.log("service", service); // Output the selected value to the console
            });
            $("#add_ons_id").on('change', function() {
               
                var reservation_id = $(this).find('option:selected').attr('class');
                $('#input_reservation_id').val(reservation_id);
                $('#partial_payment').val("0").trigger('change');
                var aoid = $(this).val();
             
                $.ajax({
                    url: 'api/get-addons-price/' + aoid,
                    type: 'GET',
                    success: function(response) {                       
                        $("#total_amount").val(response.price);
                        console.log("price", response);
                    }
                });
               
            });
            $('#payment_type').on('change', function() {
                let val_selected = $(this).val();
                if (val_selected == 'O') {
                    $("#reference_number").show();
                } else {
                    $("#reference_number").val("");
                    $("#reference_number").hide();
                }
                // console.log($(this).val());
            });
            $('#payment_method').on('change', function() {
                let val_selected = $(this).val();
                let val = val_selected.split(',');

                if(val[3]){
                    $(".rounded-md").show();
                    $(".rounded-md").attr("src", 'assets/uploads/payment_account/'+val[3]);
                }else{
                    $(".rounded-md").hide();
                }

                $(".account_name").html(val[0]);
                $(".account_number").html(val[2]);
                $(".account_holder_name").html(val[1]);
            });
            $('#partial_payment').on('change', function() {
                let val_selected = $(this).val();
                var total_amount = $("#total_amount").val();
                if (val_selected != '0') {
                    $(".partial-container").removeClass("md:hidden");
                    $("#partial_amount").val(total_amount * (val_selected/100));
                } else {
                    $("#partial_amount").val("");
                    $(".partial-container").addClass("md:hidden");
                }
                // console.log($(this).val());
            });
            $('#addForm').submit(function(e) {
                e.preventDefault();
                var payment_account_id = $("#payment_method").find('option:selected').attr('class');;
                var formData = new FormData(this);
                formData.append('payment_account_id', payment_account_id);
                
                $.ajax({
                    url: 'api/payment/add_payment',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log("response: ", response);
                        if(response == 1){
                            $.toast('Success! New payment was added.');
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

        function deletePayment(payment_id) {
            $("#delete-confirmation-modal").modal("show");
            $("#payment_id").val(payment_id);
        }

        $(".delete-btn").click( function(){
            $("#delete-confirmation-modal").modal("hide");
            var payment_id = $("#payment_id").val();
            var formData = new FormData();
            formData.append("payment_id", payment_id);

            $.ajax({
                url: 'api/payment/delete',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $.toast("Success! Selected payment was removed.");
                    $(".payment-"+payment_id).fadeOut(500)
                    setTimeout(()=>{window.location.reload();},2000);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        });
    </script>
</x-app-layout>