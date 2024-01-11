<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Payment</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                @if (Auth::user()->role == 2)
                <div class="col-span-12 sm:col-span-12">
                    <label>Payment Type</label>
                    <input type="text" readonly name="payment_type" class="input w-full border mt-2 flex-1" value="Online">
                   
                </div>
                @else
                <div class="col-span-12 sm:col-span-12">
                    <label>Payment Type</label>
                    <select name="payment_type" id="payment_type" class="select2 w-full border mt-2 flex-1">
                        <option value="0">--Select Payment Type--</option>
                        <option value="C">Cash</option>
                        <option value="O">Online</option>
                    </select>
                </div>
                @endif

               <div class="col-span-12 sm:col-span-12">
                <div class="mt-3"> <label>Select Payment</label>
                    <div class="flex flex-col sm:flex-row mt-2">
                        <div class="flex items-center text-gray-700 mr-2"> 
                            <input type="radio" class="input border mr-2" id="reservation" name="reservation" value="0" checked> 
                            <label class="cursor-pointer select-none" for="reservation">Reservation</label> 
                        </div>
                        <div class="flex items-center text-gray-700 mr-2 mt-2 sm:mt-0"> 
                            <input type="radio" class="input border mr-2" id="service" name="service" value="1"> 
                            <label class="cursor-pointer select-none" for="service">Add Ons</label> 
                        </div>
                    </div>
                </div>
               </div>
                <div class="col-span-12 sm:col-span-12" id="reservation_dropdown">
                    <label>Reservation</label>
                    <select name="reservation_id" id="reservation_id" class="select2 w-full border mt-2 flex-1">

                        <option value="0">--Select Reservation--</option>
                        @foreach ($reservations as $reservation)
                        <option value="{{$reservation->id}}" class="{{$reservation->room_id}}">#{{$reservation->id}} - {{getRoomName($reservation->room_id)}} - [{{getUserName($reservation->user_id)}}]</option>
                        @endforeach     

                    </select>
                </div>
                <div class="hidden col-span-12 sm:col-span-12" id="service_dropdown">
                    <label>Add Ons</label>
                    <br>
                    <input type="hidden" name="input_reservation_id" id="input_reservation_id" class="input_reservation_id">
                    <select required id="add_ons_id" name="add_ons_id" class="select2 w-full border mt-2 flex-1" style="width: 100%">
                        <option value="0">--Select Add Ons--</option>
                        @foreach ($add_ons as $add_on)
                        <option value="{{$add_on->id}}" class="{{$add_on->reservation_id}}" >

                            # {{$add_on->id}} -
                            {{getServiceName($add_on->service_id)}}
                            @if (Auth::user()->role == 0)
                            [{{getUserName($add_on->user_id)}}]
                            @endif
                        
                        </option>
                        @endforeach
                        
                    </select>
                </div>
               
                <div class="col-span-12 sm:col-span-12">
                    <label>Amount</label>
                    <input type="number" readonly name="total_amount" id="total_amount" class="input w-full border mt-2 flex-1" placeholder="Price" required>
                </div>
                <div class="col-span-12 sm:col-span-12" id="reference_number" required>
                    <label>Reference Number</label>
                    <input type="text" name="reference_number" class="input w-full border mt-2 flex-1" placeholder="Reference Number">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Image</label>
                    <input type="file" name="image" class="input w-full border mt-2 flex-1" placeholder="Password" required>
                </div>    
                
                
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Pay Now</button>
            </div>
        </form>
    </div>
</div>