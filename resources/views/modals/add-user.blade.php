<!-- ADD USER MODAL -->
<div class="modal" id="add-user-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add new user</h2>
            <!-- <button class="button border items-center text-gray-700 hidden sm:flex"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </button> -->
            <!-- <div class="dropdown relative sm:hidden"> <a class="dropdown-toggle w-5 h-5 block" href="javascript:;"> <i data-feather="more-horizontal" class="w-5 h-5 text-gray-700"></i> </a>
                    <div class="dropdown-box mt-5 absolute w-40 top-0 right-0 z-20">
                        <div class="dropdown-box__content box p-2"> <a href="javascript:;" class="flex items-center p-2 transition duration-300 ease-in-out bg-white hover:bg-gray-200 rounded-md"> <i data-feather="file" class="w-4 h-4 mr-2"></i> Download Docs </a> </div>
                    </div>
                </div> -->
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
                <button type="submit" class="button w-20 bg-theme-1 text-white">Send</button>
            </div>
        </form>
    </div>
</div>