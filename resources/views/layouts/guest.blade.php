<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Bulk SMS - Send customized messages to a large audience quickly and efficiently. Enhance customer engagement, increase brand awareness, and drive conversions">
        <meta name="author" content="MACRO-IT">

        <title>{{ config('app.name', 'MACRO-IT') }}</title>
        <!-- Favicons -->
       <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
       <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Vendor CSS Files -->
  <link href="{{asset('landing-page/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing-page/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing-page/assets/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing-page/assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('landing-page/assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('landing-page/assets/vendor/aos/aos.css')}}" rel="stylesheet">

  <!-- External CSS File -->
  <link href="{{asset('landing-page/assets/css/style.css')}}" rel="stylesheet">

  <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="d17af46b-afdd-4665-8862-2ca604c2cadc" data-blockingmode="auto" type="text/javascript"></script>
  <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
  <style>
    /* Custom Scroll */

/* width */
::-webkit-scrollbar {
	width: 15px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
	box-shadow: inset 0 0 5px grey; 
	border-radius: 10px;
  }
   
  /* Handle */
  ::-webkit-scrollbar-thumb {
	background: #F9A826; 
	border-radius: 10px;
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
	background: #D48C1A; 
  }
/* End Custom Scroll */
  </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
    @include('sweetalert::alert')

    
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>




          <!-- Vendor JS Files -->
  <script src="{{asset('landing-page/assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('landing-page/assets/vendor/aos/aos.js')}}"></script>
  
  <script>
    function myFoo() {
      var x = document.getElementById("foo");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
        </script>

  <!-- Template Main JS File -->
  <script src="{{asset('landing-page/assets/js/main.js')}}"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5f7aa38f4704467e89f4a000/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->

  <script>
    var message="Right Click Disabled!";
  
  function clickIE4(){
  if (event.button==2){
  alert(message);
  return false;
   }
  }
  
  function clickNS4(e){
  if (document.layers||document.getElementById&&!document.all){
  if (e.which==2||e.which==3){
  alert(message);
  return false;
  }
  }
  }
  
  if (document.layers){
  document.captureEvents(Event.MOUSEDOWN);
  document.onmousedown=clickNS4;
  }
  else if (document.all&&!document.getElementById){
  document.onmousedown=clickIE4;
  }
  
  document.oncontextmenu=new Function("alert(message);return false")
  </script>
    </body>
</html>
