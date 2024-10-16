@extends('frontend.layouts.layout1')

@section('content')
    <main>
        <section class="banner-sec mb-5">
            <div class="container-fluid">
                <div class="row m-0">
                    <div class="col-md-12">
                        <div class="banner-text get-touch">
                            <h3>Term & Condition</h3>
                            <p class="pra">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt assumenda
                                consequuntur ex reiciendis, vel officiis quisquam natus voluptate porro optio,
                                necessitatibus illo. Nisi dolorum at aut nihil qui. Accusantium, officiis. At behere, we are
                                proud to be a Kiwi company, and we are passionate about supporting local business like
                                yours.</p>
                            <p class="pra">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, optio totam ipsa
                                quod sint libero asperiores aliquam, vitae aperiam veniam maiores quaerat illo in
                                doloremque? Aperiam sint expedita tempore ut! That's why we invite you to become a rewards
                                partner with behere, where Kiwis Back Kiwis </p>

                            <a href="{{ route('businessregister') }}" class="btn btn-primary px-xl-5 py-xxl-3"
                                type="submit">Feature on Behere</a>
                        </div>
                    </div>



                </div>
            </div>
        </section>
    </main>

    @include('frontend.includes.footer')
@endsection
