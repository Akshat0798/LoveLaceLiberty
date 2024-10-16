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
    <meta property="og:image" content="{{ asset('public/assets/images/logo.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body class="dashboardBg overflow-auto h-auto p-0 m-0">
    <!-- Success Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastPlacement">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Error Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3" id="toastPlacement">
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
    @include('frontend.includes.header')

    @yield('content')


    @yield('script-map')

    @yield('script')
    <!-- Scripts -->
    <script src="{{ asset('public/assetss/js/jquery.js') }}"></script>
    <script src="{{ asset('public/assetss/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/assetss/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('public/assetss/js/custom.js') }}"></script>
    <script type="text/javascript">
     document.addEventListener("DOMContentLoaded", function() {
        // Show success toast if there's a success message in the session
        @if (session('success'))
            var successToast = new bootstrap.Toast(document.getElementById('successToast'));
            successToast.show();
        @endif

        // Show error toast if there's an error message in the session
        @if (session('error'))
            var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
            errorToast.show();
        @endif
    });
        

        setInterval(function() {
            $('.alert').hide();
        }, 4000);
       

        function checkBusiness() {
            alert('Please enter the mandatory information below')
        }
        //  setInputFilter(document.getElementById("numberInput"), function(value) {
        //         return /^-?\d*$/.test(value);
        //     }, "Input only number");

        function confirmation() {
            return confirm('Are you sure, you want to delete');
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('website').addEventListener('input', function() {
                validateWebsite(this.value);
            });

            function validateWebsite(website) {
                // Simple URL validation using a regular expression
                var urlRegex = /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/;

                if (urlRegex.test(website)) {
                    // Valid URL, you can update UI or perform other actions
                    $("#submit").removeClass("disabled");
                    $("#event").removeClass("disabled");
                    $("#business_hours").removeClass("disabled");
                    document.getElementById('website-error').innerText = '';
                } else {
                    // Invalid URL, update UI to inform the user
                    document.getElementById('website-error').innerText = 'Invalid website URL';
                    $("#submit").addClass("disabled");
                    $("#event").addClass("disabled");
                    $("#business_hours").addClass("disabled");
                }
            }
        });

        document.getElementById('myForm').addEventListener('keydown', function(event) {
      if (event.key === 'Enter') {
        event.preventDefault();
      }
    });
    </script>
</body>
</html>
