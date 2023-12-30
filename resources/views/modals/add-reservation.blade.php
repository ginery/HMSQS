<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add Reservation</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{Auth::id()}}">
                <div class="col-span-12 sm:col-span-12">
                    <label>Book</label>
                    <select name="book_id" class="select2 w-full border mt-2 flex-1">
                        <option value="0">--Select Room--</option>
                        @foreach ($rooms as $room)
                        <option value="{{$room->id}}">{{$room->room_name}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>No. Adult</label>
                    <select name="adult" class="select2 w-full border mt-2 flex-1">
                        <option value="0">0</option>
                        <option value="1">1</option>                        
                        <option value="2">2</option> 
                        <option value="3">3</option> 
                        <option value="4">4</option> 
                        <option value="5">5</option> 
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>No. Child</label>
                    <select name="child" class="select2 w-full border mt-2 flex-1">
                        <option value="0">0</option>
                        <option value="1">1</option>                        
                        <option value="2">2</option> 
                        <option value="3">3</option> 
                        <option value="4">4</option> 
                        <option value="5">5</option>                       
                    </select>
                </div>
                {{-- <div class="col-span-12 sm:col-span-12">
                    <label>Check-In</label>
                    <input type="datetime-local" name="checkin" class="input w-full border mt-2 flex-1">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Check-Out</label>
                    <input type="datetime-local" name="checkout" class="input w-full border mt-2 flex-1">
                </div>             --}}
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Submit</button>
            </div>
        </form>
    </div>
</div>