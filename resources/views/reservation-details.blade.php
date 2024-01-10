<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Reservation Details
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button button="button text-white bg-theme-1 shadow-md mr-2" onclick="addOns({{ request()->route('reservation_id') }})" class="button text-white bg-theme-1 shadow-md mr-2">Add-ons </button>
        </div>
    </div>
    
    <!-- BEGIN: Invoice -->
    <div class="intro-y box overflow-hidden mt-5">
        @if (($reservation->checkin_date == NULL || $reservation->checkout_date == NULL ) && $reservation->status == 1)
            <div id="qrcode" style=" display: flex; justify-content: center;">
            </div>
        @endif
      
        <div class="flex flex-col lg:flex-row pt-10 px-5 sm:px-20 sm:pt-20 lg:pb-20 text-center sm:text-left">
           
            <div class="font-semibold text-theme-1 text-3xl">RESERVATION - #{{$reservation->id}}</div>
            <div class="mt-20 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-xl text-theme-1 font-medium">{{getUserName($reservation->user_id)}}</div>
                <div class="mt-1">{{getUserEmail($reservation->user_id)}}</div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row border-b px-5 sm:px-20 pt-10 pb-10 sm:pb-20 text-center sm:text-left">
            <div>
                <div class="text-base text-gray-600">Client Details</div>
                <div class="text-lg font-medium text-theme-1 mt-2">{{getUserName($reservation->user_id)}}</div>
                <div class="mt-1">{{getUserEmail($reservation->user_id)}}</div>
            </div>
           
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                          
                            <th class="border-b-2 whitespace-no-wrap">DESCRIPTION</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">PAX</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">PRICE</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total_reservation = 0;
                            $total_service = 0;
                            // echo count($add_ons);
                        @endphp                            
                        @foreach ($reservations as $reservation)  
                        @php
                            $total_reservation += getRoomPrice($reservation->room_id);
                        @endphp                         
                        <tr>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{getRoomName($reservation->room_id)}} </div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">Reservation</div>
                            </td>
                            <td class="text-right border-b"><?php $ex = explode(',',$reservation->pax); 
                            
                            echo "Adult: ".$ex[0].", Child: ".$ex[1];
                            
                            ?></td>
                            <td class="text-right border-b w-32">{{number_format(getRoomPrice($reservation->room_id),2)}}</td>
                            <td class="text-right border-b w-32">{!!getPaymentStatus1($reservation->id,0)!!}</td>
                        </tr>
                        @endforeach
    
                    </tbody>
                </table>
            </br>
            <hr style=" border: 1px solid #1C3FAA;">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 whitespace-no-wrap">SERVICE</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">DATE</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">PRICE</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($add_ons as $add_on)
                        @php
                            $total_reservation += $add_on->total_amount;
                        @endphp
                        <tr class="bg-gray-200">
                            <td class="text-center border-b w-32">{{$add_on->id}}</td>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{getServiceName($add_on->service_id)}} </div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">Add ons</div>
                            </td>
                            <td class="text-right border-b">{{date('F j, Y H:i:A', strtotime($add_on->created_at))}}</td>
                            <td class="text-right border-b w-32">{{number_format($add_on->total_amount,2)}}</td>
                            <td class="text-right border-b w-32">{!!getPaymentStatus1($reservation->id,$add_on->id)!!}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-gray-600">Bank Transfer</div>
                <div class="text-lg text-theme-1 font-medium mt-2">Owner Name</div>
                <div class="mt-1">Bank Account : 098347234832</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-gray-600">Total Amount</div>
                <div class="text-xl text-theme-1 font-medium mt-2">{{number_format($total_reservation,2)}}</div>
                <div class="mt-1 tetx-xs">Taxes included</div>
            </div>
        </div>
    </div>
@include('modals.add-ons')
<script> 
function addOns(reservation_id){
    // $("#add-modal").modal('show');
    window.location.href = "/view-reservation/add-ons/"+reservation_id;
}
function generateQR(room_id) {
  
    var qrcode = new QRCode(document.getElementById("qrcode"));
    qrcode.makeCode("HOMETEL-RES-" + room_id);
}
$(document).ready(function(){
    var res_id = '{{$reservation->id}}';
    generateQR(res_id);
    $('#addForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: '../api/reservation/add_ons',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // console.log("response: ", response);
                if(response == 1){
                    $.toast('Add-ons successfully added.');
                    $("#add-modal").modal('hide');
                    setTimeout(()=>{
                        window.location.reload();
                    },1000);
                }
            },
            error: function(error) {
                console.log("error: ", error);
            }
        });

    });
});
</script>
</x-app-layout>