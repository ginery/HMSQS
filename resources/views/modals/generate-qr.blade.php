<!-- ADD USER MODAL -->
<div class="modal" id="generate-qr">
    {{-- <div class="modal__content">
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Please Scan QR</h2>
        </div>
        <div>
            <div id="qrcode" style=""></div>
    </div> --}}
    <div class="modal__content relative"> 
        <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
            <h2 class="font-medium text-base mr-auto">Please Scan QR</h2>
        </div> 
        <a href="#" onclick="closeModal('generate-qr')" class="absolute right-0 top-0 mt-3 mr-3"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
        <div class="p-5 text-center"> 
           
            <div id="qrcode1" style="display: flex; justify-content: center;"></div>
        </div>
      
    </div>
</div>