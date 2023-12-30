<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            @if (Auth::user()->role == 0)
            <button button="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Add Reservation</button>
            @endif
            <button button="button" onclick="scanQr()" class="button box flex text-white bg-theme-9 shadow-md mr-2"><i data-feather="maximize" class="mr-1"></i> QR Scan</button>
            <div class="hidden md:block mx-auto text-gray-600">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-gray-700">
                    <input type="text" class="input w-56 box pr-10 placeholder-theme-13" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i> 
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-no-wrap">ROOMS</th>
                        <th class="whitespace-no-wrap">ROOM NAME</th>
                        <th class="whitespace-no-wrap">CUSTOMER NAME</th>
                        <th class="text-center whitespace-no-wrap">CHECKIN & CHECK OUT</th>
                        <th class="text-center whitespace-no-wrap">STATUS</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)                       
                    
                    <tr class="intro-x" style="cursor: pointer">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="{{getRoomName($reservation->room_id)}}" class="tooltip rounded-full" src="{{getRoomImage($reservation->room_id)}}" title="{{getRoomName($reservation->room_id)}}">
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-no-wrap">{{getRoomName($reservation->room_id)}}</a> 
                            <div class="text-gray-600 text-xs whitespace-no-wrap">{{number_format(getRoomPrice($reservation->room_id),2)}}</div>
                        </td>
                        <td>
                            {{getUserName($reservation->user_id)}}
                        </td>
                        <td class="text-center">{{$reservation->checkin_date}} - {{$reservation->checkin_date}}</td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-theme-6"> <i data-feather="check-square" class="w-4 h-4 mr-2"></i> {{$reservation->status}} </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                            
                                <a class="flex items-center mr-3 text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                              
                                <a class="flex items-center mr-3" onclick="generateQR({{$reservation->room_id}})" href="#"> <i data-feather="maximize" class="w-4 h-4 mr-1"></i> Generate </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
            <ul class="pagination">
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-left"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-left"></i> </a>
                </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li> <a class="pagination__link" href="">1</a> </li>
                <li> <a class="pagination__link pagination__link--active" href="">2</a> </li>
                <li> <a class="pagination__link" href="">3</a> </li>
                <li> <a class="pagination__link" href="">...</a> </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevron-right"></i> </a>
                </li>
                <li>
                    <a class="pagination__link" href=""> <i class="w-4 h-4" data-feather="chevrons-right"></i> </a>
                </li>
            </ul>
            <select class="w-20 input box mt-3 sm:mt-0">
                <option>10</option>
                <option>25</option>
                <option>35</option>
                <option>50</option>
            </select>
        </div>
        <!-- END: Pagination -->
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
@include('modals.add-reservation')
@include('modals.scan-qr')
@include('modals.generate-qr')
<script>
    $(document).ready(function(){
        if ($('#generate-qr').is('hidden')) {
            console.log('Modal closed!');
            // Your logic for when the modal is closed goes here
        } else {
            // If modal is open, perform some action or continue monitoring
        }
        $('#addForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'api/reservation/add_reservation',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log("response: ", response);
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });

        });
    });

    
    const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    function onScanSuccess(decodedText, decodedResult) {
    // handle the scanned code as you like, for example:
        // console.log(`Code matched = ${decodedText}`, decodedResult);
        checkInCheckOut(`${decodedText}`);
    }

    function onScanFailure(error) {
    // handle scan failure, usually better to ignore and keep scanning.
    // for example:
        console.warn(`Code scan error = ${error}`);
    }

    let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    { fps: 10, qrbox: {width: 250, height: 250} },
    /* verbose= */ false);
    html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    
    function scanQr(){
        $("#scan_qr").modal("show");
    }

    function addModal() {        
        $("#add-modal").modal("show");       
    }
    function closeModal(id){
        console.log("QR Cleared", id);
        $("#"+id).modal('hide');
        var qrcode = new QRCode(document.getElementById("qrcode"));
        qrcode.clear();
    }
    function generateQR(room_id){
        
        console.log("generate qr:", room_id);
        $("#generate-qr").modal('show');
        $('#generate-qr').on('click', function(e) {
            e.stopPropagation();
        });
        // , {
        //     drawer: 'png',
        //     text: "test",
        //     width: 300,
        //     height: 300,
        // }
        var qrcode = new QRCode(document.getElementById("qrcode"));
        qrcode.makeCode("HOMETEL-"+room_id);
        // qrcode.clear();
    }

    function checkInCheckOut(id){
        let explode = id.split('HOMETEL-');
        console.log("Scaned: ", explode[1]);
    }
    
</script>
</x-app-layout>