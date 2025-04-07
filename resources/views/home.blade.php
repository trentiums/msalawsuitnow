@extends('layout.app')

@section('content')
<div class="container">
    <div id="form_container">
        <div class="row no-gutters">
            <div class="col-lg-4">
                <div id="left_form">
                    <figure><img src="{{ asset('img/justice.png') }}" alt="" width="100" height="100">
                    </figure>
                    <h2>MSA LAWSUIT <span>Help Starts Here</span></h2>
                    <p>If so, a new law may allow you to seek justice and compensation for your suffering regardless of
                        how long ago the abuse occurred. Herman Law exclusively represents victims of sexual abuse and
                        is here to help you start your healing journey today.</p>
                    <a href="tel:8665140714" class="btn_1 rounded yellow purchase" target="_parent"><i
                            class="icon-call"></i>866-514-0714</a>
                    <a href="#wizard_container" class="btn_1 rounded mobile_btn yellow">Start Your Claim!</a>
                    <a href="#0" id="more_info" data-toggle="modal" data-target="#more-info"><i
                            class="pe-7s-info"></i></a>
                </div>
            </div>
            <div class="col-lg-8">
                <div id="wizard_container">
                    <div id="top-wizard">
                        <div id="progressbar"></div>
                        <span id="location"></span>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        {{ session('error') }}
                    </div>
                    @endif
                    <form method="post" action="{{ route('store-inquiry') }}" id="inquiry-form"
                        data-tf-element-role="offer">
                        @csrf
                        @if($errors->any())
                        <div class="row alert-danger alert">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </div>
                        @endif
                        {{-- <div class="row">
                            <h4>Were you sexually abused while in a Maryland Juvenile Facility? Take the first step
                                toward justice & healing today.
                            </h4>
                        </div>
                        <div class="row radio-btn-group">
                            <div class="col-md-6 col-sm-6" style="text-align: center">
                                <label for="check-1">
                                    <input type="radio" name="rideshare_victim" value="Yes" id="check-1"
                                        required="required" data-gtm-form-interact-field-id="0">
                                    <span class="yes">Yes</span>
                                </label>
                            </div>
                            <div class="col-md-6 col-sm-6" style="text-align: center">
                                <label for="check-11">
                                    <input type="radio" name="rideshare_victim" value="No" id="check-11"
                                        data-gtm-form-interact-field-id="1">
                                    <span class="no">No</span>
                                </label>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control required" placeholder="First Name *"
                                        id="first_name" oninput="checkValidInput(this)" required name="first_name"
                                        data-tf-element-role="consent-grantor-first_name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name *" id="last_name"
                                        oninput="checkValidInput(this)" required name="last_name"
                                        data-tf-element-role="consent-grantor-last_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone number</label>
                                    <input type="text" id="phone" placeholder="Phone number *" maxlength="10" required
                                        onkeypress="return isNumber(this)" name="phone" class="form-control"
                                        data-tf-element-role="consent-grantor-phone">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" placeholder="Email *" required name="email"
                                        oninput="checkValidInput(this)" class="form-control"
                                        data-tf-element-role="consent-grantor-email">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="container_check" data-tf-element-role="contact-method">
                                        By checking this box and clicking “SUBMIT CLAIM REVIEW” I represent that I am
                                        the line subscriber or primary user of the phone number above (including my
                                        wireless number if provided) and provide my express consent authorizing All Tort
                                        Solutions to contact me by telephone (including text messages), delivered via
                                        automated technology to the phone number above regarding legal products and/or
                                        offerings even if I am on a Federal, State or Do-Not-Call registry. I understand
                                        that these calls/texts may be delivered via automated technology, at any time in
                                        any way, including but not limited to telemarketing calls using an auto-dialer,
                                        text, fax, or email, even if these result in charges by my carrier. I further
                                        represent that I am a U.S. Resident over the age of 18, understand and agree to
                                        the <a href="{{route('privacy-policy')}}">Privacy Policy</a>, <a
                                            href="{{route('terms-condition')}}">Terms & Conditions</a>, and and agree to
                                        receive email
                                        promotions from TortJustice.org and our marketing partners. I understand and
                                        agree that this site uses third-party visit recording technology, including, but
                                        not limited to, Trusted Form and Jornaya. I understand that my consent is not
                                        required to continue with my application or is a condition to search for legal
                                        products and/offerings. I understand I can revoke consent at any time.
                                        <input type="checkbox" name="accept_terms" value="Yes"
                                            data-tf-element-role="consent-opt-in" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="g-recaptcha" data-sitekey="{{ config('settings.captcha_site_key') }}" required>
                            </div>
                            <div><input type="hidden" name="hiddenRecaptcha" id="hiddenRecaptcha" required></div>

                        </div>
                        <div id="captchaMessage" style="color: red; display: none; margin-bottom: 20px;">
                            Security Verification Pending...!
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="bot" value="bot">
                                <input type="hidden" name="bot_capture" value="">
                                <p><input type="submit" value="SUBMIT CLAIM REVIEW" data-tf-element-role="submit"
                                        class="btn_1 add_bottom_15" id="submit-contact"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Wizard container -->
            </div>
        </div><!-- /Row -->
    </div><!-- /Form_container -->

    <main id="general_page">
        <div class="container margin_60_35">
            <div class="main_title_2">
                <span><em></em></span>
                <h2 id="get_started">GET STARTED</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6" id="left_form" style="background-color: #424242;text-align: left">


                    <p>If you were sexually abused while in a Maryland juvenile detention facility, you are not
                        alone—and you have the right to pursue justice. Thanks to recent changes in Maryland law,
                        survivors can now file claims regardless of when the abuse occurred.</p>

                    <p>Facilities like the Cheltenham Youth Detention Center, Hickey School, and others have come under
                        scrutiny for failing to protect the youth in their care. At <strong>Master Settlement Agreement
                            Law Suit Now</strong>, we are committed to standing up for survivors and holding these
                        institutions accountable.</p>

                    <p>Our experienced legal team offers confidential, compassionate support and a free case evaluation.
                        Now is the time to come forward—your voice matters, and justice is possible.</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('img/get_started.png') }}">
                </div>
            </div>
        </div>
        <!-- /container -->

        <div class="container margin_60_35">
            <div class="main_title_2">
                <span><em></em></span>
                <h2 id="background_info">BACKGROUND INFO</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('img/background_info.png') }}">
                </div>
                <div class="col-lg-6 col-md-6" id="left_form" style="background-color: #6c757d;text-align: left">
                    <p>Were you sexually abused while in a Maryland juvenile facility? A powerful new law has removed
                        the time limits for survivors to take legal action—no matter how long ago the abuse occurred.
                        This means survivors can now pursue justice and hold the responsible institutions accountable.
                    </p>

                    <p>At <strong>Master Settlement Agreement Law Suit Now</strong>, our experienced legal team is
                        committed to supporting survivors of institutional abuse. If you or a loved one suffered abuse
                        in a youth facility, reach out for a 100% free and confidential case evaluation today.</p>
                </div>

            </div>
        </div>

        <div class="container margin_60_35">
            <div class="main_title_2">
                <span><em></em></span>
                <h2 id="who_is_eligible">WHO IS ELIGIBLE?</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6" id="left_form" style="background-color: #1c7430;text-align: left">
                    <p>Not sure if you’re eligible to file a claim under the Maryland Child Victims Act? You may qualify
                        if:</p>
                    <ul class="list">
                        <li>1. You experienced sexual abuse as a minor while in a Maryland juvenile facility.</li>
                        <li>2. The abuse was committed by a staff member, supervisor, or other authority figure.</li>
                        <li>3. The institution failed to prevent or properly respond to the abuse.</li>
                        <li>4. You have not previously filed a civil case due to time restrictions that are now lifted.
                        </li>
                        <li>5. You are seeking justice, accountability, and financial compensation for the harm endured.
                        </li>
                    </ul>
                    <p>Our legal team at <strong>Master Settlement Agreement Law Suit Now</strong> is ready to help. Get
                        a free, confidential case review today. Your story deserves to be heard.</p>
                </div>
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('img/who_is_eligible.png') }}">
                </div>
            </div>
        </div>

        <div class="container margin_60_35">
            <div class="main_title_2">
                <span><em></em></span>
                <h2 id="free_case_evaluation">FREE CASE EVALUATION</h2>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('img/free_case_evaluation.png') }}">
                </div>
                <div class="col-lg-6 col-md-6" id="left_form" style="text-align: left">
                    <p>If you were abused in a Maryland juvenile facility, you may be entitled to compensation—even if
                        the abuse happened decades ago. Thanks to Maryland's Child Victims Act, survivors can now come
                        forward without fear of time limits.</p>

                    <p>At <strong>Master Settlement Agreement Law Suit Now</strong>, we offer a free, confidential case
                        evaluation to help you understand your legal options. There are no upfront costs, and you pay
                        nothing unless we win your case.</p>

                    <p><strong>Your voice matters. Contact us today to begin your path to justice.</strong></p>
                </div>

            </div>
        </div>


    </main>
</div>
<!-- /container -->

<!-- Modal info -->
<div class="modal fade" id="more-info" tabindex="-1" role="dialog" aria-labelledby="more-infoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="more-infoLabel">MSA Lawsuit – Frequently Asked Questions (FAQs)
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <strong>1. What is this lawsuit about?</strong>
                <p>This legal action seeks justice for individuals who were sexually abused while in Maryland juvenile
                    facilities. Survivors can now take legal action thanks to the elimination of the statute of
                    limitations under the Child Victims Act.</p>

                <strong>2. Who can file a claim?</strong>
                <p>You may qualify if:</p>
                <ul>
                    <li>You were abused as a minor in a Maryland juvenile detention facility.</li>
                    <li>The abuse was committed by staff or other authority figures.</li>
                    <li>You previously couldn't file due to expired legal deadlines.</li>
                </ul>

                <strong>3. What compensation is available?</strong>
                <p>Compensation may include:</p>
                <ul>
                    <li>Emotional and psychological damages.</li>
                    <li>Medical and therapy expenses.</li>
                    <li>Pain, suffering, and long-term trauma.</li>
                </ul>

                <strong>4. How do I get started?</strong>
                <p>Contact our legal team at <strong>Master Settlement Agreement Law Suit Now</strong> for a free,
                    confidential case evaluation. We’ll guide you through the process with no upfront fees.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn_1" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection


@section('script')
<style>
    .radio-btn-group {
        display: flex;
        margin-top: 10px;
        margin-bottom: 10px;
        justify-content: center;
        position: relative;
    }

    .radio-btn-group input {
        display: block !important;
        position: absolute;
        opacity: 0;
        visibility: hidden;
    }

    .radio-btn-group label {
        width: 130px;
        margin-right: 15px !important;
        cursor: pointer;
    }

    .radio-btn-group label {
        font-size: 1.1em;
        font-weight: 600;
        color: #4c4c4c;
        font-family: "Roboto", sans-serif;
        line-height: 1.4;
        margin: 0;
    }

    .radio-btn-group label span.yes {
        color: #1b9b00;
        border: 2px solid;
    }

    .radio-btn-group label span.no {
        color: #ff0000;
        border: 2px solid;
    }

    .radio-btn-group label input:checked~span.yes {
        color: #1b9b00;
        border-color: #1b9b00;
        box-shadow: inset 0 0 15px #1b9b00;
    }

    .radio-btn-group label input:checked~span.no {
        color: #ff0000;
        border-color: #ff0000;
        box-shadow: inset 0 0 15px #ff0000;
    }

    .radio-btn-group label span {
        text-align: center;
        display: inline-block;
        padding: 25px 10px;
        width: 100%;
        max-width: 150px;
        border: 1px solid #444;
        color: #444;
        border-radius: 4px;
        font-size: 18px !important;
        text-transform: uppercase;
    }
</style>
<script type="text/javascript">
    (function () {
            var tf = document.createElement('script');
            tf.type = 'text/javascript';
            tf.async = true;
            tf.src = ("https:" == document.location.protocol ? 'https' : 'http') +
                '://api.trustedform.com/trustedform.js?field=xxTrustedFormCertUrl&ping_field=xxTrustedFormPingUrl&l=' +
                new Date().getTime() + Math.random();
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(tf, s);
        })();
</script>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        var recaptchaResponse = grecaptcha.getResponse();
        var captchaMessage = document.getElementById('captchaMessage');

        if (recaptchaResponse.length === 0) {
            event.preventDefault();
            captchaMessage.style.display = 'block'; // Show the error message
        } else {
            captchaMessage.style.display = 'none'; // Hide the message if CAPTCHA is complete
            document.getElementById('hiddenRecaptcha').value = recaptchaResponse;
        }
    });
</script>
<noscript>
    <img src='https://api.trustedform.com/ns.gif' />
</noscript>
@endsection
