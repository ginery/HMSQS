<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add Rooms</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <div class="col-span-12 sm:col-span-12">
                    <label>Room Name</label>
                    <input type="text" name="room_name" class="input w-full border mt-2 flex-1" placeholder="Room Name">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Room Type</label>
                    <select name="room_type" class="select2 w-full border mt-2 flex-1">
                        <option value="0">-- Select Type --</option>
                        <option value="1">Single</option>                        
                        <option value="2">Family</option> 
                        <option value="3">Presidential</option> 
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Price</label>
                    <input type="number" name="price" class="input w-full border mt-2 flex-1" placeholder="Price">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Description</label>
                    <input type="text" name="description" class="input w-full border mt-2 flex-1" placeholder="Description">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Image</label>
                    <input type="file" name="image" class="input w-full border mt-2 flex-1" placeholder="Password">
                </div>                
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button>
            </div>
        </form>
    </div>
</div>