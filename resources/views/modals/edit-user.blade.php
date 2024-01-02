<!-- ADD USER MODAL -->
<div class="modal" id="edit-user-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">User details</h2>
        </div>
        <div>
            <form id="edit-user-form" class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-12">
                    <label>First Name</label>
                    <input type="text" name="first_name" id="first_name" class="input w-full border mt-2 flex-1" placeholder="First Name">
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Last Name</label>
                    <input type="text" name="last_name" id="last_name" class="input w-full border mt-2 flex-1" placeholder="Last Name">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="input w-full border mt-2 flex-1" placeholder="Email">
                </div>
                <!-- <div class="col-span-12 sm:col-span-12">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="input w-full border mt-2 flex-1" placeholder="Password" readonly>
                </div> -->
                <div class="col-span-12 sm:col-span-12">
                    <label>Role</label>
                    <select name="role" id="role" class="select2 w-full border mt-2 flex-1">
                        <option value="0">Admin</option>
                        <option value="1">Staff</option>
                        <option value="2">Customer</option>
                    </select>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Update</button>
            </div>
        </form>
    </div>
</div>