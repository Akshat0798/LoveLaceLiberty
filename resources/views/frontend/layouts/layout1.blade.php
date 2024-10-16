<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lovelaceliberty</title>
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/owl-carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/responsive.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/assets/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/assets/images/favicon-16x16.png') }}">
    <link rel="icon" href="images/favicon.png">
    <meta property="og:image" content="images/logo.svg">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="dashboardBg loginBg">

    @yield('content')

    
    @yield('script-map')

    <!-- Scripts -->
    <script src="{{ asset('public/assetss/js/jquery.js') }}"></script>
    <script src="{{ asset('public/assetss/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/assetss/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('public/assetss/js/custom.js') }}"></script>
    
    <script>


        @if (session::has('success'))
    </script>
    @php $success = session::has('success') @endphp
    <script>
        @if ($success)
            toastr.options = {
                "positionClass": "toast-bottom-right",
                "closeButton": true,
                "toastClass": "toaster-message"
            }
            toastr.success("{{ session('success') }}");
            setTimeout(function() {
                window.location.reload();
            }, 15000);
        @endif
        @endif


   
    var typing=new Typed(".text", {
        strings: ["","Events",  "ACTIVITIES", "EXPERIENCE", "ADVENTURE", "DISCOVERY", "MEET UP"],
        typeSpeed: 100,
        backSpeed: 40,
        loop: true,
    });
    setInterval(function(){
        $('.alert').hide();
      }, 4000);

    //  setInputFilter(document.getElementById("numberInput"), function(value) {
    //         return /^-?\d*$/.test(value);
    //     }, "Input only number");
         document.querySelector("#num").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});
 </script>
  @yield('script')
</body>
</html>

