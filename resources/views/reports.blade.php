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
        <!-- <table id="tbl_report" class="table table-report table-report--bordered display datatable w-full dataTable no-footer dtr-inline">
            <thead>
                <tr role="row">
                    <th>CUSTOMER NAME</th>
                    <th>ROOM</th>
                    <th>CHECK IN DATE</th>
                    <th>CHECK OUT DATE</th>
                </tr>
            </thead>
        </table> -->
        <table id="tbl_report" class="table-report--bordered display w-full dataTable no-footer dtr-inline" style="width:100%">
            <thead>
                <tr>
                    <th>CUSTOMER NAME</th>
                    <th>ROOM</th>
                    <th>CHECK IN DATE</th>
                    <th>CHECK OUT DATE</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>Tiger Nixon</td>
                    <td>System Architect</td>
                    <td>Edinburgh</td>
                    <td>61</td>
                </tr> -->

            </tbody>

        </table>
    </div>
    <!-- FOR QR -->
</x-app-layout>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        var start_date = $j("#date_start").val();
        var end_date = $j("#date_end").val();
        get_report(start_date, end_date);
    });

    function get_report(strDate, endDate) {
        $j('#tbl_report').DataTable().destroy();
        $j('#tbl_report').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],
            ajax: {
                type: "POST",
                url: "/api/reports/get_transactions",
                data: {
                    start: strDate,
                    end: endDate
                }
            },
            "columns": [{
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
        });
    }

    // function get_report(strDate, endDate) {
    //     $j("#tbl_report").DataTable().destroy();
    //     $j("#tbl_report").DataTable({
    //         "ajax": {
    //             "type": "POST",
    //             "url": "/api/reports/get_transactions",
    //             "data": {
    //                 start: strDate,
    //                 end: endDate
    //             }
    //         },
    //         "dom": 'Bfrtip',
    //         "buttons": [
    //             'print'
    //         ],
    //         "processing": true,
    //         "bFilter": true,
    //         "columns": [{
    //                 "data": "customer_name"
    //             },
    //             {
    //                 "data": "room_name"
    //             },
    //             {
    //                 "data": "checkin_date"
    //             },
    //             {
    //                 "data": "checkout_date"
    //             },
    //         ],

    //     });
    // }

    function generateReport() {
        var start_date = $j("#date_start").val();
        var end_date = $j("#date_end").val();

        get_report(start_date, end_date);
    }
</script>