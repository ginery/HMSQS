<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
      

 
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <div id="reader" width="600px"></div>
        </div>
    </div>
    <!-- BEGIN: Delete Confirmation Modal -->
    <div class="modal" id="delete-confirmation-modal">
        <div class="modal__content">
            <div class="p-5 text-center">
                <i data-feather="x-circle" class="w-16 h-16 text-theme-6 mx-auto mt-3"></i> 
                <div class="text-3xl mt-5">Are you sure?</div>
                <div class="text-gray-600 mt-2">Do you really want to delete these records? This process cannot be undone.</div>
            </div>
            <div class="px-5 pb-8 text-center">
                <button type="button" data-dismiss="modal" class="button w-24 border text-gray-700 mr-1">Cancel</button>
                <button type="button" class="button w-24 bg-theme-6 text-white">Delete</button>
            </div>
        </div>
    </div>
@include('modals.scan-qr')
@include('modals.success-scan')
<script>
const html5QrCode = new Html5Qrcode(/* element id */ "reader");
function onScanSuccess(decodedText, decodedResult) {
    console.log(`Code matched = ${decodedText}`, decodedResult);
    scanQR(decodedText);
}

function onScanFailure(error) {
    console.warn(`Code scan error = ${error}`);
}
let html5QrcodeScanner = new Html5QrcodeScanner(
"reader",
{ fps: 10, qrbox: {width: 250, height: 250} },
/* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);
function scanQR(scan_data){
        // console.log(scan_data);
        $("#success-modal").modal("show");

        let explode = scan_data.split('-');
        console.log("Scaned: ", scan_data);
        if(explode[1] == "RES"){
            var formData = new FormData();
            formData.append("scan_data", scan_data);
            $.ajax({
                url: 'api/qr/scanqr',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("response: ", response);
                    $("#status").html("checked in to your room! Enjoy!");
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        }else if(explode[1] == "OUT"){
            var formData = new FormData();
            formData.append("scan_data", scan_data);
            $.ajax({
                url: 'api/qr/scanqr',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("response: ", response);
                    $("#status").html("checked out to your room! Thank you and come again.");
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });
        }else{
            $("#success-modal").modal('hide');
            $.toast('Success! Redirecting to invoice..');            
            setTimeout(()=>{
                window.location.href = "/invoice/" + explode[2];
            },2000);
           
        }
}

</script>
</x-app-layout>