<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add Payment</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <div class="col-span-12 sm:col-span-12">
                    <label>Payment Type</label>
                    <select name="room_id" class="select2 w-full border mt-2 flex-1">
                        <option value="0">--Select Type--</option>
                        <option value="">Cash</option>
                        <option value="">Online</option>
                       
                        
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Customer Name</label>
                    <select name="room_id" class="select2 w-full border mt-2 flex-1">
                        <option value="0">--Select Room--</option>
                        @foreach ($rooms as $room)
                        <option value="{{$room->id}}">{{$room->room_name}} - {{number_format($room->price,2)}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Total Price</label>
                    <input type="number" name="price" class="input w-full border mt-2 flex-1" placeholder="Price">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Description</label>
                    <input type="text" name="description" class="input w-full border mt-2 flex-1" placeholder="Description">
                </div>             
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button>
            </div>
        </form>
    </div>
</div>