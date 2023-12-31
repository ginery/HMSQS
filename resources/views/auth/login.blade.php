<!DOCTYPE html>
<!--
created by: ginx
-->

<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Midone admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Midone admin template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="dist/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <script>
        function register(){
            // alert("test");
            window.location = "{{ route('register') }}";
        }
    </script>
    <body class="login">
        
        <div class="container sm:px-10">
           
            <form method="POST" action="{{ route('login') }}">
                @csrf
            <div class="block xl:grid grid-cols-2 gap-4">
                
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="{{route('welcome')}}" class="-intro-x flex items-center pt-5">
                        <img alt="Midone Tailwind HTML Admin Template" class="w-6" style="width: 94px;" src="assets/images/logo-3.jpg">
                        
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/illustration.svg">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            A few more clicks to 
                            <br>
                            sign in to your account.
                        </div>

                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
              
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">

                        @if (session('errors'))
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-circle" class="w-6 h-6 mr-2"></i> {{ session('errors')->get('email')[0] }} </div>
                        @endif
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your account. </div>
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" placeholder="Email" name="email" :value="old('email')"" required>
                            <input type="password" name="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" placeholder="Password" required>
                        </div>
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                            <button onclick="register()" type="button" class="button button--lg w-full xl:w-32 text-gray-700 border border-gray-300 mt-3 xl:mt-0">Register</button>
                        </div>

                    </div>
                </div>
          
                <!-- END: Login Form -->
            </div>
        </form>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </body>
</html>