@php
    use App\Models\ServicesModel;
    $services = ServicesModel::where('slide_status', 'live')->get();
@endphp

<div class="sticky-navigation">
    <div class="custom-container">
        <ul class="sticky-content p-0 m-0">
            <li><a href="mailto:{!! $email_2 ?? "support@communicationrn.com" !!}"><i
                        class="fa fa-envelope"></i>&nbsp;<span>{!! $email_2 ?? "info@3dprecission.com" !!}</span></a></li>
            <li><a
                    href="tel:+91{!! isset($contact_us_contact_number) ? str_replace(" ", "", $contact_us_contact_number) : "+919266747031" !!}"><i
                        class="fa fa-phone"></i>&nbsp;<span>{!! $contact_us_contact_number ?? "+91 926 674 7031" !!}</span></a>
            </li>
        </ul>
        {{-- <div class="gtranslate_wrapper"></div> --}}
    </div>
</div>
<!-- Header section Start -->
<header class="main-header">
    <div class="header-contaner">
        <div class="logo-section">
            <div class="mobile-bars" hidden></div>
            <a href="{{ url('/') }}" aria-level="Main logo"><img src="{{ asset($Logo ?? "./assets/img/logo.png") }}"
                    class="img-fluid" width="120" height="90" alt="Home Styler"></a>
        </div>
        <div class="slide-navigation">
            <div class="navbar-wrapper">
                <ul class="navbar-block">
                    <li>
                        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('aboutUs') }}" class="{{ request()->is('about-us') ? 'active' : '' }}">About
                            Us</a>
                    </li>
                    <li class="dropdown">
                        <a href="#">
                            Our Services
                        </a>
                        <ul class="dropdown-menu">
                            @foreach($services as $service)
                                <li style="width:100%; margin:0px;">
                                    <a href="{{ route('service.details', $service->slug) }}">
                                        {{ $service->heading_top }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('contactUs') }}"
                            class="{{ request()->is('contact-us') ? 'active' : '' }}">Contact Us</a>
                    </li>
                    <li>
                        <a href="{{ route('galleryPages') }}"
                            class="{{ request()->is('') ? 'active' : '' }}">Gallery</a>
                    </li>
                </ul>
            </div>
            {{-- <ul class="social-media">
                <li><a href="{!! $facebook_link ?? 'https://www.facebook.com/3dprecission' !!}"
                        aria-label="Read more about 3dprecission  facebook"><i class="fa-brands fa-facebook"></i></a>
                </li>
                <li><a href="{!! $linkedin_link ?? '/' !!}" aria-label="Read more about 3dprecission  Linkedin"><i
                            class="fab fa-linkedin"></i></a></li>
                <li><a href="{!! $instagram_link ?? 'https://www.instagram.com/adiyogi_global/' !!}"
                        aria-label="Read more about 3dprecission  Instagram"><i class="fa-brands fa-instagram"></i></a>
                </li>
                <li><a href="{!! $youtube_link ?? 'https://www.youtube.com/@3dprecission' !!}"
                        aria-label="Read more about 3dprecission  Youtube"><i class="fa-brands fa-youtube"></i></a></li>
            </ul> --}}
        </div>
    </div>
</header>
<Style>
    /* Base dropdown menu (hidden by default) */
    /* Base dropdown menu (hidden by default) */
    .navbar-block .dropdown-menu {
        display: none !important;
        /* hidden initially */
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        background: white !important;
        min-width: 280px !important;
        /* fallback */
        list-style: none !important;
        z-index: 100 !important;
        padding: 15px 10px !important;
        border: none !important;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        gap: 10px !important;
        flex-wrap: wrap !important;
    }

    /* Dropdown menu items (desktop: 2 columns) */
    .navbar-block .dropdown-menu li {
        flex: 0 0 48% !important;
        /* 2 items per row */
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Dropdown links */
    .navbar-block .dropdown-menu li a {
        display: block !important;
        padding: 8px 10px !important;
        color: black !important;
        font-family: 'Gill Sans MT' !important;
        font-size: 16px !important;
        text-decoration: none !important;
        transition: all 0.3s ease !important;
    }

    /* Hover effect */
    .navbar-block .dropdown-menu li a:hover {
        background: orange !important;
        color: white !important;
    }

    /* Show dropdown on hover (desktop only) */
    @media (min-width: 993px) {
        .navbar-block li.dropdown:hover .dropdown-menu {
            display: flex !important;
            width: 600px !important;
            /* fixed width for large devices */
        }


    }

    /* Mobile / tablet: vertical dropdown */
    @media (max-width: 992px) {
        .navbar-block .dropdown-menu {
            position: static !important;
            display: none !important;
            flex-direction: column !important;
            width: 100% !important;
            gap: 0 !important;
            padding: 0 !important;
            text-align: left !important;
            justify-content: flex-start !important;
            align-items: flex-start !important;
        }

        .navbar-block li.dropdown.open .dropdown-menu {
            display: flex !important;
            /* show when clicked */
        }

        .navbar-block .dropdown-menu li {
            flex: 0 0 100% !important;
            /* full width */
        }

        .navbar-block .dropdown-menu li a {
            padding: 12px 20px !important;
            border-bottom: 1px solid #ddd !important;
            text-align: left !important;
        }
    }

    /* Parent menu item */
    .dropdown-menu li {
        position: relative;
        padding: 0px !important;

    }

    /* Dropdown menu container */
    .navbar-block .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        min-width: 280px;
        list-style: none;
        z-index: 100;
        padding: 0px !important;
        border: none !important;
        padding-top: 15px !important;

    }

    /* Dropdown menu links */
    .navbar-block .dropdown-menu li a {
        display: block;
        padding: 8px 20px;
        color: 666;
        font-family: 'Gill Sans MT';
        font-weight: normal;
        font-size: 14px;
        text-decoration: none;
        transition: all 0.3s ease;
        color: black;


    }

    .dropdown:hover .dropdown-menu {
        opacity: 1;
        transform: translateX(0);
        /* slide into place */
        pointer-events: auto;
    }

    .navbar-block .dropdown-menu li a:hover {
        background: orange;
        color: white;

    }

    /* Show on hover */
    .navbar-block li.dropdown:hover .dropdown-menu {
        display: block;
    }





















    /* Navbar container */
    .navbar {
        background: #fff;
        padding: 10px 0;
    }

    /* Remove default UL styles */

    /* Orange text on hover */
    .navbar-block li a:hover {
        color: orange;
    }

    /* Orange underline animation */


    .navbar-block li a:hover::after {
        width: 100%;
    }

    /* Active link stays orange */
    .navbar-block li a.active {
        color: orange;
    }

    .navbar-block li a.active::after {
        width: 100%;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('.navbar-block li.dropdown');

        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('click', function (e) {
                // Only for small devices
                if (window.innerWidth <= 992) {
                    const link = this.querySelector('a'); // parent link
                    if (e.target === link) {
                        e.preventDefault(); // prevent navigation
                        this.classList.toggle('open'); // toggle dropdown
                    }
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', function (e) {
            dropdowns.forEach(dd => {
                if (!dd.contains(e.target)) {
                    dd.classList.remove('open');
                }
            });
        });
    });

</script>