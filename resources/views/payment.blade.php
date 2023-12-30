<x-app-layout>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
            <button button="button" onclick="addModal()" class="button text-white bg-theme-1 shadow-md mr-2">Add Payment</button>
           
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
                        <th class="whitespace-no-wrap">PAYMENT ID</th>
                        <th class="whitespace-no-wrap">RESERVATION ID</th>
                        <th class="text-center whitespace-no-wrap">PAYMENT TYPE</th>
                        <th class="text-center whitespace-no-wrap">REFERENCE NUMBER</th>
                        <th class="text-center whitespace-no-wrap">AMOUNT</th>
                        <th class="text-center whitespace-no-wrap">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($payments as $payment)                       
                    
                    <tr class="intro-x">
                        <td class="w-40">
                            {{$payment->id}}
                        </td>
                        <td>
                           {{$payment->reservation_id}}
                        </td>
                        <td class="text-center">
                            {{$payment->payment_type == 'C' ? 'Cash':'Online'}}
                        </td>
                        <td class="w-40">
                            {{$payment->reference_number}}
                        </td>
                        <td class="w-40">
                            Php. {{number_format($payment->total_amount, 2)}}
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" href="javascript:;"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                <a class="flex items-center text-theme-6" href="javascript:;" data-toggle="modal" data-target="#delete-confirmation-modal"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
@include('modals.add-payment')
<script>
function addModal() {        
    $("#add-modal").modal("show");       
}
$(document).ready(function(){
    $('#payment_type').on('change', function() {
        let val_selected = $(this).val();
        if(val_selected == 'O'){
            $("#reference_number").show();
        }else{
            $("#reference_number").val("");
            $("#reference_number").hide();
        }
        // console.log($(this).val());
    });
    $('#addForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: 'api/payment/add_payment',
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
</script>
</x-app-layout>