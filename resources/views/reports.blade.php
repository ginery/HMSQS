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
        let dateObj = new Date(strDate);
        let dateObj1 = new Date(endDate);

        let options = { year: 'numeric', month: 'long', day: 'numeric' };
        let formattedDate = dateObj.toLocaleDateString("en-US", options);
        let formattedDate1 = dateObj1.toLocaleDateString("en-US", options);

        $j('#tbl_report').DataTable().destroy();
        $j('#tbl_report').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    // title: 'As of '+formattedDate+' - '+formattedDate1+' Transaction Report',
                    customize: function (win) {
                        $(win.document.body)
                        .css('font-size', '10pt')
                        .prepend('<span style="font-weight: bold;">As of '+formattedDate+' - '+formattedDate1+' Transaction Report</span>');
                        $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    }
                }
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