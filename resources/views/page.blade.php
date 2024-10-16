
@if(isset($_GET['type'])&& $_GET['type']=='web')
@include('emails.email_header')
@endif
<style>
    article, aside, details, figcaption, figure, footer, header, hgroup, main, menu, nav, section, summary {
        display: none;
    }
</style>
<header>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('public/admintheme/bootstrap/css/bootstrap.min.css') }}">        
    <link rel="shortcut icon" href="{{ url('public/assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('public/assets/img/favicon.ico') }}" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</header>
<div class="container">
    <div class="row" style="margin-left: 10%; margin-right: 10%;margin-top: 1%;">
        

        <p>
            <?php
            echo $page->content;
            ?>
        </p>
    </div>
</div>
@if(isset($_GET['type'])&& $_GET['type']=='web')
@include('emails.email_footer')
@endif
