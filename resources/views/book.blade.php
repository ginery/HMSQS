<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> {{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=|Roboto+Sans:400,700|Playfair+Display:400,700">

    <link rel="stylesheet" href="assets/sogo/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/sogo/css/animate.css">
    <link rel="stylesheet" href="assets/sogo/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/sogo/css/aos.css">
    <link rel="stylesheet" href="assets/sogo/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/sogo/css/jquery.timepicker.css">
    <link rel="stylesheet" href="assets/sogo/css/fancybox.min.css">
    
    <link rel="stylesheet" href="assets/sogo/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/sogo/fonts/fontawesome/css/font-awesome.min.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="assets/sogo/css/style.css">
  </head>
  <body>
    
    <header class="site-header js-site-header">
      <div class="container-fluid">
        <div class="row align-items-center">
          <div class="col-6 col-lg-4 site-logo" data-aos="fade"><a href="{{route('welcome')}}">Hometel</a></div>
          <div class="col-6 col-lg-8">


            <!-- <div class="site-menu-toggle js-site-menu-toggle"  data-aos="fade">
              <span></span>
              <span></span>
              <span></span>
            </div> -->
            <!-- END menu-toggle -->

            <!-- <div class="site-navbar js-site-navbar">
              <nav role="navigation">
                <div class="container">
                  <div class="row full-height align-items-center">
                    <div class="col-md-6 mx-auto">
                      <ul class="list-unstyled menu">
                        <li class="active"><a href="index.html">Home</a></li>
                        <li><a href="rooms.html">Rooms</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="events.html">Events</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="reservation.html">Reservation</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </nav>
            </div> -->
          </div>
        </div>
      </div>
    </header>
    <!-- END head -->

    <section class="site-hero overlay" style="background-image: url(assets/sogo/images/hero_4.jpg)" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
          <div class="col-md-10 text-center" data-aos="fade-up">
            <span class="custom-caption text-uppercase text-white d-block  mb-3">Welcome To 5 <span class="fa fa-star text-primary"></span>   Hotel</span>
            <h1 class="heading">A Best Place To Stay</h1>
          </div>
        </div>
      </div>

      <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
          <span class="mouse-wheel"></span>
        </div>
      </a>
    </section>
    <!-- END section -->

    <section class="section bg-light pb-0"  >
      <div class="container">
       
        <div class="row check-availabilty" id="next">
          <div class="block-32" data-aos="fade-up" data-aos-offset="-200">

            <form id="check-available-rooms" action="#">
              <div class="row">
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                  <label for="checkin_date" class="font-weight-bold text-black">Check In</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input type="text" id="checkin_date" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 mb-3 mb-lg-0 col-lg-3">
                  <label for="checkout_date" class="font-weight-bold text-black">Check Out</label>
                  <div class="field-icon-wrap">
                    <div class="icon"><span class="icon-calendar"></span></div>
                    <input type="text" id="checkout_date" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 mb-3 mb-md-0 col-lg-3">
                  <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                      <label for="adults" class="font-weight-bold text-black">Pax</label>
                      <div class="field-icon-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="adults" class="form-control" required>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4+</option>
                        </select>
                      </div>
                    </div>
                    <!-- <div class="col-md-6 mb-3 mb-md-0">
                      <label for="children" class="font-weight-bold text-black">Children</label>
                      <div class="field-icon-wrap">
                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                        <select name="" id="children" class="form-control" required>
                          <option value="0">0</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4+</option>
                        </select>
                      </div>
                    </div> -->
                    <input type="hidden" name="" id="children" value="0" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3 align-self-end">
                  <button type="submit" class="btn btn-primary btn-block text-white">Check Availabilty</button>
                </div>
              </div>
            </form>
          </div>


        </div>
      </div>
    </section>

    <!-- <section class="py-5 bg-light">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 ml-auto order-lg-2 position-relative mb-5" data-aos="fade-up">
            <figure class="img-absolute">
              <img src="assets/sogo/images/food-1.jpg" alt="Image" class="img-fluid">
            </figure>
            <img src="assets/sogo/images/img_1.jpg" alt="Image" class="img-fluid rounded">
          </div>
          <div class="col-md-12 col-lg-4 order-lg-1" data-aos="fade-up">
            <h2 class="heading">Welcome!</h2>
            <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
            <p><a href="#" class="btn btn-primary text-white py-2 mr-3">Learn More</a> <span class="mr-3 font-family-serif"><em>or</em></span> <a href="https://vimeo.com/channels/staffpicks/93951774"  data-fancybox class="text-uppercase letter-spacing-1">See video</a></p>
          </div>
          
        </div>
      </div>
    </section> -->

    <section id="rooms-list" class="section py-5 bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Rooms &amp; Suites</h2>
            <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          </div>
        </div>
        <div id="rooms-available" class="row">
          
        </div>
      </div>
    </section>
    
    
    <section class="section slider-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">Photos</h2>
            <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="home-slider major-caousel owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
              <div class="slider-item">
                <a href="assets/sogo/images/slider-1.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-1.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-2.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-2.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-3.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-3.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-4.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-4.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-5.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-5.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-6.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-6.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
              <div class="slider-item">
                <a href="assets/sogo/images/slider-7.jpg" data-fancybox="images" data-caption="Caption for this image"><img src="assets/sogo/images/slider-7.jpg" alt="Image placeholder" class="img-fluid"></a>
              </div>
            </div>
            <!-- END slider -->
          </div>
        
        </div>
      </div>
    </section>
    <!-- END section -->
    
    <section class="section bg-image overlay" style="background-image: url('assets/sogo/images/hero_3.jpg');">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading text-white" data-aos="fade">Service & Amenities</h2>
            <p class="text-white" data-aos="fade" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
          </div>
        </div>
        <div class="food-menu-tabs" data-aos="fade">
          <ul class="nav nav-tabs mb-5" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active letter-spacing-2" id="mains-tab" data-toggle="tab" href="#mains" role="tab" aria-controls="mains" aria-selected="true">Foods</a>
            </li>
            <li class="nav-item">
              <a class="nav-link letter-spacing-2" id="desserts-tab" data-toggle="tab" href="#desserts" role="tab" aria-controls="desserts" aria-selected="false">Others</a>
            </li>
          </ul>
          <div class="tab-content py-5" id="myTabContent">
            
            
            <div class="tab-pane fade show active text-left" id="mains" role="tabpanel" aria-labelledby="mains-tab">
              <div class="row">
                @foreach ($services as $service)   
                <div class="col-md-6">
                                             
                  <div class="food-menu mb-5">
                    <span class="d-block text-primary h4 mb-3">{{number_format(getServicePrice($service->id),2)}}</span>
                    <h3 class="text-white"><a href="#" class="text-white">{{$service->service_name}}</a></h3>
                    <p class="text-white text-opacity-7">{{$service->description}}</p>
                  </div>
                 
                  
                </div>
                @endforeach
              </div>
              

            </div> <!-- .tab-pane -->

            <div class="tab-pane fade text-left" id="desserts" role="tabpanel" aria-labelledby="desserts-tab">
              <div class="row">
                @foreach ($amenities as $amenity)
                <div class="col-md-6">
                  <div class="food-menu mb-5">
                    <span class="d-block text-primary h4 mb-3">{{number_format(getServicePrice($amenity->id),2)}}</span>
                    <h3 class="text-white"><a href="#" class="text-white">{{$amenity->service_name}}</a></h3>
                    <p class="text-white text-opacity-7">{{$amenity->description}}</p>
                  </div>
                </div>
                @endforeach
              </div>
            </div> <!-- .tab-pane -->
          </div>
        </div>
      </div>
    </section>
    
    <!-- END section -->
    <section class="section testimonial-section">
      <div class="container">
        <div class="row justify-content-center text-center mb-5">
          <div class="col-md-7">
            <h2 class="heading" data-aos="fade-up">People Says</h2>
          </div>
        </div>
        <div class="row">
          <div class="js-carousel-2 owl-carousel mb-5" data-aos="fade-up" data-aos-delay="200">
            
            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; Jean Smith</em></p>
            </div> 

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>
                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>


            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_1.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; Jean Smith</em></p>
            </div> 

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_2.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>
                <p>&ldquo;Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

            <div class="testimonial text-center slider-item">
              <div class="author-image mb-3">
                <img src="assets/sogo/images/person_3.jpg" alt="Image placeholder" class="rounded-circle mx-auto">
              </div>
              <blockquote>

                <p>&ldquo;When she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane.&rdquo;</p>
              </blockquote>
              <p><em>&mdash; John Doe</em></p>
            </div>

          </div>
            <!-- END slider -->
        </div>

      </div>
    </section>
    

    <section class="section bg-image overlay" style="background-image: url('assets/sogo/images/hero_4.jpg');">
        <div class="container" >
          <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0 text-md-left" data-aos="fade-up">
              <h2 class="text-white font-weight-bold">A Best Place To Stay. Reserve Now!</h2>
            </div>

          </div>
        </div>
    </section>

    
    <!-- Modal -->
    <div class="modal fade" id="modal-reservation" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
          @if(!Auth::check())
            <h3 class="mb-3"><i class="fa fa-exclamation-circle"></i> Login required</h3>
            <form id="form-login">
            @csrf
              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="modal-footer">                
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>              
                <button type="submit" class="btn btn-info">Login</button>                
              </div>
              <span>No Account? <a href="{{route('register')}}">Register</a></span>
            </form>
          @else
            <form id="addForm" enctype="multipart/form-data">
                  <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                  <div class="form-group">
                      <label>Room</label>
                      <select id="room_id" name="room_id" class="select2 form-control">
                          <option value="0">--Select Room--</option>
                          @foreach ($rooms as $room)
                          <option value="{{$room->id}}">{{$room->room_name}}</option>
                          @endforeach
                          
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Services</label>
                      <select name="service_id" class="select2 form-control">
                          <option value="0">--Select Service--</option>
                          @foreach ($services as $service)
                          <option value="{{$service->id}}">{{$service->service_name}}</option>
                          @endforeach
                          
                      </select>
                  </div>
                  <div class="form-group">
                      <label>Pax</label>
                      <select name="adult" class="select2 form-control">
                          <option value="0">0</option>
                          <option value="1">1</option>                        
                          <option value="2">2</option> 
                          <option value="3">3</option> 
                          <option value="4">4</option> 
                          <option value="5">5</option> 
                      </select>
                  </div>
                  <!-- <div class="form-group">
                      <label>No. Child</label>
                      <select name="child" class="select2 form-control">
                          <option value="0">0</option>
                          <option value="1">1</option>                        
                          <option value="2">2</option> 
                          <option value="3">3</option> 
                          <option value="4">4</option> 
                          <option value="5">5</option>                       
                      </select>
                  </div> -->
                  <input type="hidden" name="child" value="0" />
                  <div class="form-group">
                      <label>Check-In</label>
                      <input type="date" name="checkin" class="input form-control" value="{{date('Y-m-d', strtotime(request()->input('checkInDate')))}}">
                  </div>
                  <div class="form-group">
                      <label>Check-Out</label>
                      <input type="date" name="checkout" class="input form-control" value="{{date('Y-m-d', strtotime(request()->input('checkOutDate')))}}">
                  </div>
                  <input type="hidden" name="total_amount" value="0"/>
              </div>
              <div class="px-5 py-3 text-right border-t border-gray-200">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
          @endif
          </div>
        </div>
      </div>
    </div>
    
    <script src="assets/sogo/js/jquery-3.3.1.min.js"></script>
    <script src="assets/sogo/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="assets/sogo/js/popper.min.js"></script>
    <script src="assets/sogo/js/bootstrap.min.js"></script>
    <script src="assets/sogo/js/owl.carousel.min.js"></script>
    <script src="assets/sogo/js/jquery.stellar.min.js"></script>
    <script src="assets/sogo/js/jquery.fancybox.min.js"></script>
    
    
    <script src="assets/sogo/js/aos.js"></script>
    
    <script src="assets/sogo/js/bootstrap-datepicker.js"></script> 
    <script src="assets/sogo/js/jquery.timepicker.min.js"></script> 

    <script src="assets/sogo/js/main.js"></script>
    <script>
      $(document).ready(function() {
        if("{{request()->input('checkInDate')}}" !== ""){
          get_available_rooms("{{request()->input('checkInDate')}}");
        }else{
          get_available_rooms("{{date('Y-m-d')}}");
        }
      });

      $("#check-available-rooms").submit( function(e){
        e.preventDefault();
        const checkInDate = $("#checkin_date").val();
        const checkOutDate = $("#checkout_date").val();
        const adults = $("#adults").val();
        const children = $("#children").val();
        if(adults == "0"){
          alert("Please fill in required fields.")
        }else{
          window.location.href="/book?checkInDate="+checkInDate+"&checkOutDate="+checkOutDate+"&adults="+adults+"&children="+children;
        }
      });

      if("{{request()->input('checkInDate');}}" !== ""){
        
        var rooms = $("#rooms-list")[0];
        rooms.scrollIntoView({behavior: "smooth"});

        $("#checkin_date").val("{{request()->input('checkInDate')}}");
        $("#checkout_date").val("{{request()->input('checkOutDate')}}");
        $("#adults").val("{{request()->input('adults')}}");
        $("#children").val("{{request()->input('children')}}");
      }else{
        $("#checkin_date").val("{{date('Y-m-d')}}");
        $("#checkout_date").val("{{date('Y-m-d', strtotime('+1 day'))}}");
        $("input[name=checkin]").val("{{date('Y-m-d')}}");
        $("input[name=checkout]").val("{{date('Y-m-d', strtotime('+1 day'))}}");
      }

      $("#form-login").submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();

        $.ajax({
          type: "POST",
          url: "login-user",
          data: data,
          success: function(res){
            if(res == 1){
              window.location.reload();
            }else{
              alert("Username or Password is incorrect.");
            }
          }
        })
      });

      function onSelectRoom(roomId){
        console.log(roomId)
        $("select[name=adult]").val("{{request()->input('adults')}}");
        $("select[name=child]").val("{{request()->input('children')}}");
        $("#modal-reservation").modal();
        $("#room_id").val(roomId);
      }

      $('#addForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: 'api/reservation/add_guest_reservation',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                  if(response == 1){
                    window.location.href="/reservation";
                  }else{
                    if(response == 2){
                      alert("Notice: You already have a reservation for this room.");
                    }
                  }
                },
                error: function(error) {
                    console.log("error: ", error);
                }
            });

        });

        function get_available_rooms(date){
          $.ajax({
            type: "POST",
            url: "api/room/rooms_available",
            data: {checkin_date: date},
            success: function(res){
              var o = JSON.parse(res);
              let container = $('#rooms-available');
                if(o.length != 0){
                    o.forEach(item => {
                        const toAppend = `
                        <div class="col-md-6 col-lg-4" data-aos="fade-up">
                          <a href="#" class="room" onclick="onSelectRoom(${item.id})">
                            <figure class="img-wrap">
                              <img src="assets/uploads/rooms/${item.image}" alt="Free website template" class="img-fluid mb-3">
                            </figure>
                            <div class="p-3 text-center room-info">
                              <h2>${item.room_name}</h2>
                              <span class="text-uppercase letter-spacing-1">PHP ${Number(item.price).toFixed(2)} / per night</span>
                            </div>
                          </a>
                        </div>`;
                        container.append(toAppend);
                    });
                }else{
                    container.append("<h6>No data available.</h6>")
                }
            }
          });
        }
    </script>
  </body>
</html>