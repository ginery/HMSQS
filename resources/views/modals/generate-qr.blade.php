<!-- ADD USER MODAL -->
<div class="modal" id="generate-qr">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add new user</h2>
        </div>
        <div>
            <form id="add-user-form" class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                <div class="col-span-12 sm:col-span-12">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="input w-full border mt-2 flex-1" placeholder="First Name">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="input w-full border mt-2 flex-1" placeholder="Last Name">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Email</label>
                    <input type="email" name="email" class="input w-full border mt-2 flex-1" placeholder="Email">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Password</label>
                    <input type="password" name="password" class="input w-full border mt-2 flex-1" placeholder="Password" value="12345">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label>Role</label>
                    <select name="role" class="select2 w-full border mt-2 flex-1">
                        <option value="0">Admin</option>
                        <option value="1">Staff</option>
                        <option value="2">Customer</option>
                    </select>
                </div>
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button>
            </div>
        </form>
    </div>
</div>