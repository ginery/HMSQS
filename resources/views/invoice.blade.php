<x-app-layout>
     <!-- BEGIN: Invoice -->
     <div class="intro-y box overflow-hidden mt-5">
        <div class="border-b border-gray-200 text-center sm:text-left">
            <div class="px-5 py-10 sm:px-20 sm:py-20">
                <div class="text-theme-1 font-semibold text-3xl">INVOICE</div>
                <div class="mt-2"> Receipt <span class="font-medium">#{{$payment->id}}</span> </div>
                <div class="mt-1">{{date('F j, Y', strtotime($payment->created_at))}}</div>
            </div>
            <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-10 pb-10 sm:pb-20">
                <div class="">
                    <div class="text-base text-gray-600">Client Details</div>
                    <div class="text-lg font-medium text-theme-1 mt-2">{{getUserName($payment->user_id)}}</div>
                    <div class="mt-1">{{getUserEmail($payment->user_id)}}</div>
                </div>
                <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                    <div class="text-base text-gray-600">Payment to</div>
                    <div class="text-lg font-medium text-theme-1 mt-2">Hometel</div>
                    <div class="mt-1">info@example.com</div>
                </div>
            </div>
        </div>
        <div class="px-5 sm:px-16 py-10 sm:py-20">
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="border-b-2 whitespace-no-wrap">ID</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">ROOM NAME</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">SERVICE</th>
                            <th class="border-b-2 text-right whitespace-no-wrap">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{dd(json_encode($reservations))}} --}}
                        @php
                            $total_amount = 0;
                        @endphp
                        @foreach ($payment_data as $pd)
                        @php
                            $total_amount += $pd->total_amount;
                        @endphp                  
                                <tr>
                                    <td class="border-b">
                                        <div class="font-medium whitespace-no-wrap">{{$pd->id}}</div>
                                        <div class="text-gray-600 text-xs whitespace-no-wrap">test</div>
                                    </td>
                                    <td class="text-right border-b">
                                        <div class="font-medium whitespace-no-wrap">{{getRoomName($pd->room_id)}}</div>
                                        <div class="text-gray-600 text-xs whitespace-no-wrap"> {{number_format($pd->r_total,2)}}</div>
                                    </td>
                                    <td class="text-right border-b">
                                        <div class="font-medium whitespace-no-wrap"> {{getServiceName($pd->service_id)}}</div>
                                        <div class="text-gray-600 text-xs whitespace-no-wrap"> {{number_format($pd->ao_total,2)}}</div>
                                    </td>
                                    <td class="text-right border-b font-medium">Php. {{number_format($pd->total_amount,2)}}</td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
            <div class="text-center sm:text-left mt-10 sm:mt-0">
                <div class="text-base text-gray-600">{{$payment->payment_type == 'O' ? 'Online':'Cash'}}</div>
                <div class="text-lg text-theme-1 font-medium mt-2">{{getUserName($payment->user_id)}}</div>
                <div class="mt-1">User ID : {{$payment->user_id}}</div>
            </div>
            <div class="text-center sm:text-right sm:ml-auto">
                <div class="text-base text-gray-600">Total Amount</div>
                <div class="text-xl text-theme-1 font-medium mt-2">{{number_format($total_amount,2)}}</div>
                <div class="mt-1 tetx-xs">Taxes included</div>
            </div>
        </div>
    </div>
    <!-- END: Invoice -->
</x-app-layout>