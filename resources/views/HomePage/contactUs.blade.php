{{-- @extends('layouts.webSite')
@section('title', 'Contact Us')
@section('content')
    <div class="information-page-slider">
        <div class="information-content">
            <h1><a href="{{ url('/') }}">Home</a><span>Contact Us</span></h1>
</div>
</div>
<div id="about">
    <div class="default-content pt-4 pb-5">
        <div class="custom-container">
            <div class="pb-4">
                <h1 class="text-center" style="color: #ff6b35;font-family:'Playfair Display', serif;font-weight:500">
                    Contact Us</span>
                </h1>
            </div>

            <div class="row d-flex align-items-stretch"
                style="background:#f2f2f2; border-radius: 10px; padding: 20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                <!-- Contact Form -->
                <div class="col-md-6 col-sm-12 pt-5 d-flex flex-column">
                    <div class="contact-form-area mb-2 flex-grow-1">
                        <div class="midd-content section-title mb-3">
                            <h3>Get in touch</h3>
                        </div>
                        <form enctype="multipart/form-data" method="POST" id="contactUsForm"
                            action="{{ route('saveContactUsDetails') }}">
                            @csrf
                            <input type="hidden" name="country_code" value="" id="country_code_id">

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="First name" required>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Last name" required>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35;"><i
                                                class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email ID" required>
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone_numbers">Phone</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-phone"></i></span>
                                        <input type="tel" pattern="^[1-9][0-9]*$" class="form-control"
                                            id="phone_numbers" name="phone_number" placeholder="Phone number" required>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-md-12 mb-3">
                                    <label for="message">Message</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-comment"></i></span>
                                        <textarea class="form-control" id="message" name="message" maxlength="1000"
                                            minlength="30" rows="3" placeholder="Your message" required></textarea>
                                    </div>
                                </div>

                                <!-- Captcha -->
                                <div class="col-md-12 mb-3">
                                    <label for="captcha">Captcha</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-shield-alt"></i></span>
                                        <input type="text" class="form-control" id="captcha" name="captcha"
                                            placeholder="Enter captcha" required>
                                    </div>
                                </div>

                                <!-- Captcha Image & Refresh -->
                                <div class="col-md-8 col-sm-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 pt-4">
                                            <img src="{{ captcha_src() }}" class="img-thumbnail h-100"
                                                id="captcha_img_id">
                                        </div>
                                        <div class="col-md-6 pt-4">
                                            <button type="button" class="btn default-btn btn-block font-weight-bold"
                                                style="background: #ff6b35; border:1px solid white;color:white"
                                                onclick="refreshCapthca('captcha_img_id','captcha')">
                                                <i class="fas fa-sync-alt"></i> Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tnc" required>
                                        <label class="form-check-label" for="tnc">Agree to terms and conditions</label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12">
                                    <button class="default-btn" id="submitButton" type="submit"
                                        style="background: #ff6b35; border:1px solid white;padding:8px 30px;border-radius:5px;color:white;">
                                        <i class="fas fa-paper-plane"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Map (Unchanged) -->
                <div class="col-md-6 col-sm-6 col-xs-12 pt-5 d-flex flex-column">
                    <div class="map-area flex-grow-1">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3511.200813371878!2d77.2981389!3d28.352777799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDIxJzEwLjAiTiA3N8KwMTcnNTMuMyJF!5e0!3m2!1sen!2sin!4v1755950309962!5m2!1sen!2sin"
                            style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.contact-form-area,
.map-area {
    height: 100%;
}

.input-group-text {
    background: #f8f9fa;
}
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@endsection
--}}



@extends('layouts.webSite')
@section('title', 'Contact Us')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Contact Us</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-4 pb-5">
        <div class="custom-container">
            <div class="pb-4">
                <h1 class="text-center" style="color: #ff6b35;font-family:'Playfair Display', serif;font-weight:500">
                    Contact Us
                </h1>
            </div>

            <div class="row d-flex align-items-stretch"
                style="background:#f2f2f2; border-radius: 10px; padding: 20px;box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
                <!-- Contact Form -->
                <div class="col-md-6 col-sm-12 pt-5 d-flex flex-column">
                    <div class="contact-form-area mb-2 flex-grow-1">
                        <div class="midd-content section-title mb-3">
                            <h3>Get in touch</h3>
                        </div>
                        <!-- IMPORTANT: Added novalidate to disable HTML5 validation -->
                        <form enctype="multipart/form-data" method="POST" id="contactUsForm" novalidate>
                            @csrf
                            <input type="hidden" name="country_code" value="" id="country_code_id">

                            <div class="row">
                                <!-- First Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="first_name">First name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="first_name" name="first_name"
                                            placeholder="First name">
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-6 mb-3">
                                    <label for="last_name">Last name <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="last_name" name="last_name"
                                            placeholder="Last name">
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35;"><i
                                                class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email ID">
                                    </div>
                                </div>

                                <!-- Phone -->
                                <div class="col-md-6 mb-3">
                                    <label for="phone_number">Phone <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-phone"></i></span>
                                        <input type="tel" class="form-control" id="phone_number" name="phone_number"
                                            placeholder="Phone number">
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="col-md-12 mb-3">
                                    <label for="message">Message <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-comment"></i></span>
                                        <textarea class="form-control" id="message" name="message" maxlength="1000"
                                            rows="3" placeholder="Your message (minimum 30 characters)"></textarea>
                                    </div>
                                </div>

                                <!-- Captcha -->
                                <div class="col-md-12 mb-3">
                                    <label for="captcha">Captcha <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="color:#ff6b35"><i
                                                class="fas fa-shield-alt"></i></span>
                                        <input type="text" class="form-control" id="captcha" name="captcha"
                                            placeholder="Enter captcha">
                                    </div>
                                </div>

                                <!-- Captcha Image & Refresh -->
                                <div class="col-md-8 col-sm-12 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 pt-4">
                                            <img src="{{ captcha_src() }}" class="img-thumbnail h-100"
                                                id="captcha_img_id">
                                        </div>
                                        <div class="col-md-6 pt-4">
                                            <button type="button" class="btn default-btn btn-block font-weight-bold"
                                                style="background: #ff6b35; border:1px solid white;color:white"
                                                id="refreshCaptchaBtn">
                                                <i class="fas fa-sync-alt"></i> Refresh
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms -->
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="tnc">
                                        <label class="form-check-label" for="tnc">
                                            Agree to terms and conditions <span class="text-danger">*</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit -->
                                <div class="col-md-12">
                                    <button class="default-btn" id="submitButton" type="submit"
                                        style="background: #ff6b35; border:1px solid white;padding:8px 30px;border-radius:5px;color:white;">
                                        <i class="fas fa-paper-plane"></i> Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Map -->
                <div class="col-md-6 col-sm-6 col-xs-12 pt-5 d-flex flex-column">
                    <div class="map-area flex-grow-1">
                        {{-- <iframe
                                src="{{ $map_link ?? 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3511.200813371878!2d77.2981389!3d28.352777799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDIxJzEwLjAiTiA3N8KwMTcnNTMuMyJF!5e0!3m2!1sen!2sin!4v1755950309962!5m2!1sen!2sin' }}"
                        style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                        </iframe> --}}
                        <iframe
                            src="{{ strip_tags($map_link ?? '') ?: 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3511.200813371878!2d77.2981389!3d28.352777799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDIxJzEwLjAiTiA3N8KwMTcnNTMuMyJF!5e0!3m2!1sen!2sin!4v1755950309962!5m2!1sen!2sin' }}"
                            style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.contact-form-area,
.map-area {
    height: 100%;
}

.input-group-text {
    background: #f8f9fa;
}
</style>
@endsection

@section('script')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
// Toastr configuration
toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};

// Wait for DOM to be fully loaded
$(document).ready(function() {
    console.log('Contact form initialized'); // Debug log

    // Prevent default form submission
    $("#contactUsForm").submit(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        console.log('Form submit triggered'); // Debug log

        // Get form values
        var firstName = $('#first_name').val().trim();
        var lastName = $('#last_name').val().trim();
        var email = $('#email').val().trim();
        var phone = $('#phone_number').val().trim();
        var message = $('#message').val().trim();
        var captcha = $('#captcha').val().trim();
        var tnc = $('#tnc').is(':checked');

        // Validate all fields
        if (!firstName) {
            toastr.error('First name is required', 'Validation Error');
            return false;
        }
        if (!lastName) {
            toastr.error('Last name is required', 'Validation Error');
            return false;
        }
        if (!email) {
            toastr.error('Email is required', 'Validation Error');
            return false;
        }
        // Email format validation
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            toastr.error('Please enter a valid email address', 'Validation Error');
            return false;
        }
        if (!phone) {
            toastr.error('Phone number is required', 'Validation Error');
            return false;
        }
        if (!message || message.length < 30) {
            toastr.error('Message must be at least 30 characters long', 'Validation Error');
            return false;
        }
        if (!captcha) {
            toastr.error('Please enter the captcha', 'Validation Error');
            return false;
        }
        if (!tnc) {
            toastr.warning('Please agree to terms and conditions', 'Warning');
            return false;
        }

        // Create FormData
        var formData = new FormData(this);
        var submitBtn = $("#submitButton");

        // Disable button and show loading
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: '{{ route("saveContactUsDetails") }}',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log('Response:', response); // Debug log

                // Re-enable button
                submitBtn.prop('disabled', false).html(
                    '<i class="fas fa-paper-plane"></i> Submit');

                if (response.status) {
                    // Show success message
                    toastr.success(response.message ||
                        'Your message has been sent successfully!', 'Success!');

                    // Reset form after delay
                    setTimeout(function() {
                        $("#contactUsForm")[0].reset();
                        refreshCaptcha();
                    }, 500);
                } else {
                    // Show error message
                    toastr.error(response.message || 'Something went wrong!', 'Error');
                    refreshCaptcha();
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', xhr.responseJSON); // Debug log

                // Re-enable button
                submitBtn.prop('disabled', false).html(
                    '<i class="fas fa-paper-plane"></i> Submit');

                // Handle validation errors
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    const errorMessages = Object.values(errors).flat();

                    // Show each error with delay
                    errorMessages.forEach(function(msg, index) {
                        setTimeout(function() {
                            toastr.error(msg, 'Validation Error');
                        }, index * 300);
                    });
                } else {
                    // Show general error
                    toastr.error(xhr.responseJSON?.message ||
                        'Something went wrong. Please try again.', 'Error');
                }

                // Refresh captcha
                refreshCaptcha();
            }
        });

        return false; // Extra prevention
    });

    // Refresh captcha button
    $("#refreshCaptchaBtn").click(function(e) {
        e.preventDefault();
        refreshCaptcha();
    });
});

// Function to refresh captcha
function refreshCaptcha() {
    $.ajax({
        url: '{{ route("refreshCaptcha") }}',
        type: 'GET',
        success: function(response) {
            if (response.status && response.data) {
                $('#captcha_img_id').attr('src', response.data);
                $('#captcha').val('');
                console.log('Captcha refreshed'); // Debug log
            } else {
                toastr.warning('Could not refresh captcha', 'Warning');
            }
        },
        error: function() {
            toastr.error('Failed to refresh captcha. Please reload the page.', 'Error');
        }
    });
}
</script>
@endsection