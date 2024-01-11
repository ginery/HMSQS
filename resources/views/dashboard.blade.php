@php
    $users = App\Models\User::where('role', 2)->get()->count();
    $available = App\Models\Room::where('status', 1)->get()->count();
    $occupied = App\Models\Room::where('status', 0)->get()->count();
    $total_sales = App\Models\Payment::where('status', 1)->sum('total_amount');
@endphp
<x-app-layout>
    @if(Auth::user()->role != 2)
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-9 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        General Report
                    </h2>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-theme-10"></i> 
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{number_format($total_sales,2)}}</div>
                                <div class="text-base text-gray-600 mt-1">Total Sales</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="book" class="report-box__icon text-theme-11"></i> 
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{$occupied}}</div>
                                <div class="text-base text-gray-600 mt-1">Occupied Rooms</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="book-open" class="report-box__icon text-theme-12"></i> 
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{$available}}</div>
                                <div class="text-base text-gray-600 mt-1">Available Rooms</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-theme-9"></i> 
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{$users}}</div>
                                <div class="text-base text-gray-600 mt-1">Total Customer</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
        
        </div>
    </div>
    @else
    <div class="intro-y box py-10 sm:py-20 mt-5">
        <div class="px-5 mt-10">
            <div id="qrcode" style="display: flex; justify-content: center;">

            </div>
            <br/>
            <div class="font-medium text-center text-lg">Welcome to Hometel, <span style="color: #1C3FAA">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</span></div>
            <div class="text-gray-600 text-center mt-2">Enjoy our offers exclusive for you.</div>
            <br>
            <center>
            <a href="{{route('book')}}" class="button w-32 mr-2 mb-2 flex items-center justify-center bg-theme-1 text-white"> <i data-feather="book" class="w-4 h-4 mr-2"></i> Book Now! </a>
            </center>
           
        </div>
    </div>
    @endif
    <!-- FOR QR -->
</x-app-layout>
<script>
function generateQR() {  
    var qrcode = new QRCode(document.getElementById("qrcode"));
    qrcode.makeCode("https://my-work-desk.online/book");
}
$(document).ready(function(){ 
    generateQR();
});
</script>