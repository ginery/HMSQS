<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add Payment Account</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <div class="col-span-12 sm:col-span-12">
                    <label>Account Name</label>
                    <input type="text" name="account_name" class="input w-full border mt-2 flex-1" placeholder="Account Name" required>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Account Holder's Name</label>
                    <input type="text" name="account_holder_name" class="input w-full border mt-2 flex-1" placeholder="Account Holder's Name" required>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Account Number</label>
                    <input type="text" name="account_number" class="input w-full border mt-2 flex-1" placeholder="Account Number" required>
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