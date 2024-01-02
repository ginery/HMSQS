<x-app-layout>
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Reservation Details
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button button="button text-white bg-theme-1 shadow-md mr-2" onclick="addOns()" class="button text-white bg-theme-1 shadow-md mr-2">Add-ons </button>
        </div>
    </div>
    
    <!-- BEGIN: Invoice -->
    <div class="intro-y box overflow-hidden mt-5">
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
            @if ($payment)               
        
            <div class="mt-10 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-base text-gray-600">Receipt</div>
                <div class="text-lg text-theme-1 font-medium mt-2">#{{$payment->id}}</div>
                <div class="mt-1">{{$payment->created_at}}</div>
            </div>
            @else
            <div class="mt-10 lg:mt-0 lg:ml-auto lg:text-right">
                <div class="text-base text-gray-600">Receipt</div>
                <div class="text-lg text-theme-1 font-medium mt-2"># Unpaid</div>
                <div class="mt-1"> Unpaid</div>
            </div>
            @endif
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">DESCRIPTION</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">PAX</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">PRICE</th>
                        </tr>
                    </thead>
                    <tbody>                            
                        @foreach ($reservations as $reservation)                           
                        <tr>
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">{{getRoomName($reservation->room_id)}} </div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">Reservation</div>
                            </td>
                            <td class="text-right border-b"><?php $ex = explode(',',$reservation->pax); 
                            
                            echo "Adult: ".$ex[0].", Child: ".$ex[1];
                            
                            ?></td>
                            <td class="text-right border-b w-32">{{number_format(getRoomPrice($reservation->room_id),2)}}</td>
                        </tr>
                        @endforeach
                        @foreach ($add_ons as $add_on)
                        <tr class="bg-gray-200">
                            <td class="border-b">
                                <div class="font-medium whitespace-no-wrap">1 </div>
                                <div class="text-gray-600 text-xs whitespace-no-wrap">Add ons</div>
                            </td>
                            <td class="text-right border-b">2</td>
                            <td class="text-right border-b w-32">3</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-gray-600">Bank Transfer</div>
                <div class="text-lg text-theme-1 font-medium mt-2">Elon Musk</div>
                <div class="mt-1">Bank Account : 098347234832</div>
                <div class="mt-1">Code : LFT133243</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-gray-600">Total Amount</div>
                <div class="text-xl text-theme-1 font-medium mt-2">$20.600.00</div>
                <div class="mt-1 tetx-xs">Taxes included</div>
            </div>
        </div>
    </div>
@include('modals.add-ons')
<script> 
function addOns(){
    $("#add-modal").modal('show');
}
$(document).ready(function(){
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
                    setTimeout(()=>{window.location.reload();},2000);
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