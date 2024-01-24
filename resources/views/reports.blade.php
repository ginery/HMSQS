@php
$users = App\Models\User::where('role', 2)->get()->count();
$available = App\Models\Room::where('status', 1)->get()->count();
$occupied = App\Models\Room::where('status', 0)->get()->count();
$total_sales = App\Models\Payment::where('status', 1)->sum('total_amount');
@endphp
<x-app-layout>
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-no-wrap items-center mt-2">
        <div class="grid grid-cols-12 gap-2">
            <label class="pt-3">Start Date:</label>
            <input id="date_start" class="datepicker input w-full border col-span-2">
            <label class="pt-3 ml-2">End Date:</label>
            <input id="date_end" class="datepicker input w-full border col-span-2">
            <button button="button" class="button text-white bg-theme-1 shadow-md mr-2 col-span-2" onclick="generateReport()">Generate</button>
        </div>
    </div>

    <div class="intro-y datatable-wrapper box p-5 mt-5">
        <table id="tbl_report" class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline">
            <thead>
                <tr role="row">
                    <th>CUSTOMER NAME</th>
                    <th>ROOM</th>
                    <th>CHECK IN DATE</th>
                    <th>CHECK OUT DATE</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td class="border-b sorting_1" tabindex="0">
                        <div class="font-medium whitespace-no-wrap">Dell XPS 13</div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">Dell XPS 13</div>
                    </td>
                    <td class="text-center border-b">
                        <div class="flex sm:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-9.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-10.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-12.jpg">
                            </div>
                        </div>
                    </td>
                    <td class="text-center border-b">113</td>
                    <td class="w-40 border-b">
                        <div class="flex items-center sm:justify-center text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg> Inactive </div>
                    </td>
                    <td class="border-b w-5">
                        <div class="flex sm:justify-center items-center">
                            <a class="flex items-center mr-3" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg> Edit </a>
                            <a class="flex items-center text-theme-6" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg> Delete </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="border-b sorting_1" tabindex="0">
                        <div class="font-medium whitespace-no-wrap">Dell XPS 13</div>
                        <div class="text-gray-600 text-xs whitespace-no-wrap">Dell XPS 13</div>
                    </td>
                    <td class="text-center border-b">
                        <div class="flex sm:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-9.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-10.jpg">
                            </div>
                            <div class="intro-x w-10 h-10 image-fit -ml-5">
                                <img alt="Midone Tailwind HTML Admin Template" class="rounded-full" src="dist/images/preview-12.jpg">
                            </div>
                        </div>
                    </td>
                    <td class="text-center border-b">113</td>
                    <td class="w-40 border-b">
                        <div class="flex items-center sm:justify-center text-theme-6"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg> Inactive </div>
                    </td>
                    <td class="border-b w-5">
                        <div class="flex sm:justify-center items-center">
                            <a class="flex items-center mr-3" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-1">
                                    <polyline points="9 11 12 14 22 4"></polyline>
                                    <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                </svg> Edit </a>
                            <a class="flex items-center text-theme-6" href=""> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg> Delete </a>
                        </div>
                    </td>
                </tr> -->
            </tbody>
        </table>
    </div>
    <!-- FOR QR -->
</x-app-layout>
<script>
    $(document).ready(function() {
        var start_date = $("#date_start").val();
        var end_date = $("#date_end").val();
        get_report(start_date, end_date);
    });

    function get_report(strDate, endDate) {
        $("#tbl_report").DataTable().destroy();
        $("#tbl_report").DataTable({
              "ajax": {
                "type": "POST",
                "url": "/api/reports/get_transactions",
                 "data": { start: strDate, end: endDate }
              },
              "processing": true,
              "bFilter": true,
              "columns": [
              {
                "data": "customer_name"
              },
              {
                "data": "room_name"
              },
              {
                "data": "checkin_date"
              },
              {
                "data": "checkout_date"
              },
              ],
              buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
    }

    function generateReport(){
        var start_date = $("#date_start").val();
        var end_date = $("#date_end").val();

        get_report(start_date, end_date);
    }
</script>