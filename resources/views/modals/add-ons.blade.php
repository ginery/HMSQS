<!-- ADD USER MODAL -->
<div class="modal" id="add-modal">
    <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Add-Ons</h2>
        </div>
        <div>
            <form id="addForm" class="p-5 grid grid-cols-12 gap-4 row-gap-3" enctype="multipart/form-data">
                <input type="hidden" name="user_id" value="{{Auth::id()}}">                
                <input type="hidden" name="reservation_id" value="{{ request()->route('reservation_id') }}">
                <div class="col-span-12 sm:col-span-12">
                    <label>Services</label>
                    <select name="service_id" id="service_id" class="select2 w-full border mt-2 flex-1" required>
                        <option value="0">--Select Service--</option>
                        @foreach ($services as $service)                           
                        <option value="{{$service->id}}"><strong>{{$service->service_name}}</strong> - Php.{{number_format($service->price,2)}}</option>
                        @endforeach
                       
                        
                    </select>
                </div>
                
                <div class="col-span-12 sm:col-span-12">
                    <label>Description</label>
                    <input type="text" name="total_amount" class="input w-full border mt-2 flex-1" placeholder="Description">
                </div>           
            </div>
            <div class="px-5 py-3 text-right border-t border-gray-200">
                <button type="button" class="button w-20 border text-gray-700 mr-1" data-dismiss="modal">Cancel</button>
                <button type="submit" class="button w-20 bg-theme-1 text-white">Add</button>
            </div>
        </form>
    </div>
</div>