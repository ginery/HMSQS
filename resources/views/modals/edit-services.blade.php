<!-- ADD USER MODAL -->
<div class="modal" id="edit-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Edit Services</h2>
        </div>
        <div>
            <form id="editForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <div class="col-span-12 sm:col-span-12">
                    <label>Services Name</label>
                    <input type="text" name="service_name" id="service_name" class="input w-full border mt-2 flex-1" placeholder="Services Name">
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Service Type</label>
                    <select name="service_type" id="service_type" class="select2 w-full border mt-2 flex-1">
                        <option value="0">-- Select Type --</option>
                        <option value="1">Foods</option>
                        <option value="2">Others</option>
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>price</label>
                    <input type="number" name="price" id="price" class="input w-full border mt-2 flex-1" placeholder="Price">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Description</label>
                    <input type="text" name="description" id="description" class="input w-full border mt-2 flex-1" placeholder="Description">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Image</label>
                    <input type="file" name="image" class="input w-full border mt-2 flex-1" placeholder="Password" required>
                </div>
        </div>
        <div class="px-5 py-3 text-right border-t border-gray-200">
            <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
            <button type="submit" class="button w-30 bg-theme-1 text-white">Save Changes</button>
        </div>
        </form>
    </div>
</div>