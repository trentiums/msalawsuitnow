@extends('layout.app')

@section('content')
<main id="thank_you_page" class="my-5">
    <div class="container margin_60_35">
        <div class="main_title_2">
            <span><em></em></span>
            <h2>Thank You!</h2>
            <p>We have received your information.</p>
        </div>
        <div class="text-center">
            <p>Thank you for reaching out to us. Our team will review your information and get back to you as soon as possible.</p>
            <p>If you have any urgent inquiries, feel free to call us at <a href="tel:18667401419">866-514-0714</a>.</p>
            <a href="{{url('/')}}" class="btn btn-primary">Go Back to Home</a>
        </div>
    </div>
</main>
@endsection
