@extends('layouts.webSite')
@section('title', '3dprecission ')
@section('content')
    {{-- @include('include.navigation') --}}
    @include('include.slider')

    <!-- aboutus Section -->
    <div class="destinations pt-5 pb-2">
    <div class="custom-container">
        <div class="col-12 mb-4 offerings-container">
            <div class="">
                <h1 class="text-start" style="color: #ff6b35;font-family:'Playfair Display', serif;font-weight:500">About <span style="color:green">Us</span></h1>
            </div>

            <div class="row align-items-center">
                <!-- Text Content -->
                <div class="col-lg-7 col-md-12 mb-3 mb-lg-0">
                    <div class="offerings-content">
                        <p class="text-justify">
                            {!! $home_about_content ?? 
                            '3D Precision is dedicated to delivering cutting-edge 3D scanning, measurement, and engineering solutions to clients worldwide. With over 12 years of industry expertise, we work with the latest technologies to provide accurate, reliable, and high-quality results for industries ranging from automotive and aerospace to manufacturing and product design.

Our team is committed to precision at every stage — from capturing the smallest details to delivering complete, ready-to-use digital models. By combining technical excellence with transparency and customer-focused service, we ensure that every project meets the highest standards of accuracy and quality.' 
                            !!}
                        </p>
<a href="{{ route('aboutUs') }}">
    <button style="background:linear-gradient(135deg, #ff6b35, #f7931e);padding:10px 25px;color:black;border:1px solid white;">
        Read More
    </button>
</a>                    </div>
                </div>

                <!-- Image -->
<div class="col-lg-5 col-md-12 text-center" data-aos="fade-right">
    <div class="offerings-figure pro-3d-effect" style="">
        <img src="{{ asset($home_about_image ?? './assets/img/about.jpg') }}" 
             class="img-fluid rounded shadow" 
             alt="Bikaner">
    </div>
</div>

            </div>
        </div>
    </div>
</div>

   <style>
    /* Container styling */
.card-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  padding: 20px;
  max-width: 1250px;
  margin: 0 auto;
  box-sizing: border-box;

}

/* Card setup */
.card {
  width: 100%;
  aspect-ratio: 4 / 4;
  perspective: 1000px; /* Required for 3D effect */
}

/* Inner wrapper that rotates */
.card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  transition: transform 0.6s ease-in-out;
  transform-style: preserve-3d;
}

/* Rotate the whole inner on hover */
.card:hover .card-inner,
.card:focus-within .card-inner {
  transform: rotateY(180deg);
  cursor: pointer;
}

/* Front & back */
.card-front,
.card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  
  padding: 20px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  text-align: center;
  box-sizing: border-box;
}

/* Front side */
.card-front {
  background: white;
  color: #333;
}

/* Back side */
.card-back {
  background: #ff6b35;
  color: white;
  transform: rotateY(180deg);
}

/* Responsive tweaks */

/* Medium devices (tablets, small laptops) */
@media (max-width: 1024px) {
  .card-container {
    padding: 30px 20px;
    gap: 18px;
  }
}

/* Small devices (phones in landscape) */
@media (max-width: 768px) {
  .card-container {
    padding: 20px 15px;
    gap: 15px;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  }
  .card {
    aspect-ratio: 3 / 4;
  }
}

/* Extra small devices (phones portrait) */
@media (max-width: 480px) {
  .card-container {
    padding: 15px 10px;
    gap: 12px;
    grid-template-columns: 1fr;
    width: 100%;
    max-width: 100%;
  }
  .card {
    aspect-ratio: auto; /* let height adjust based on content */
    min-height: 320px;  /* minimum height for usability */
  }
  .card-front img,
  .card-back img {
    width: 50px !important;
    margin-bottom: 12px !important;
  }
  .card-front h3,
  .card-back h3 {
    font-size: 1.1rem;
  }
  .card-front p,
  .card-back p {
    font-size: 0.9rem;
    padding: 0 5px;
  }
}

/* Accessibility: focus state for keyboard users */
.card:focus-within {
  outline: 2px solid #4cafef;
  outline-offset: 4px;
}

</style>

<div class="card-container"  data-aos="fade-up">
  <!-- Card 1 -->
  <div class="card">
    <div class="card-inner">
      <div class="card-front">
        <img class="img1" src="assets/icons/High-Resolution.png" alt="High-Resolution 3D Digitizing" style="width:160px;height:160px;">
        <h3 style="font-size:17px;font-weight:bold">High-Resolution 3D Digitizing</h3>
        <p>Capture every minute detail with precision scanning technology...</p>
      </div>
      <div class="card-back">
        <p>Our advanced 3D digitizing ensures unmatched clarity and accuracy for your components.</p>
      </div>
    </div>
  </div>

  <!-- Card 2 -->
  <div class="card">
    <div class="card-inner">
      <div class="card-front">
        <img class="img1" src="assets/icons/reverse_engineering.png" alt="Reverse Engineering" style="width:160px;height:160px;">
        <h3 style="font-size:17px;font-weight:bold">Reverse Engineering Solutions</h3>
        <p>Recreate parts and components from existing physical samples...</p>
      </div>
      <div class="card-back">
        <p>We transform your physical objects into precise CAD models for redesign and improvement.</p>
      </div>
    </div>
  </div>

  <!-- Card 3 -->
  <div class="card">
    <div class="card-inner">
      <div class="card-front">
        <img class="img1" src="assets/icons/dimensional_accuracy.png" alt="Dimensional Accuracy" style="width:160px;height:160px;">
        <h3 style="font-size:17px;font-weight:bold">Dimensional Accuracy Verification</h3>
        <p>Ensure every measurement meets exact engineering specifications...</p>
      </div>
      <div class="card-back">
        <p>Our accuracy checks guarantee your parts meet tolerance requirements flawlessly.</p>
      </div>
    </div>
  </div>

  <!-- Card 4 -->
  <div class="card">
    <div class="card-inner">
      <div class="card-front">
        <img class="img1" src="assets/icons/specialized_automation.png" alt="Automotive Scanning" style="width:160px;height:160px;">
        <h3 style="font-size:17px;font-weight:bold">Specialized Automotive Component Scanning</h3>
        <p>Detailed scanning for automotive parts and custom components...</p>
      </div>
      <div class="card-back">
        <p>We deliver precise digital models for automotive design, repair, and quality control.</p>
      </div>
    </div>
  </div>
</div>

   <!-- Destinations Section -->
<style>
  @media (max-width: 576px) {
    /* Your CSS here */
.img1{
  width: 200px !important;
  height: 100px !important;
}
}
/* Swiper slide base */
.swiper-slide .hover-overlay {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 0;
  background: #ff6b35; /* orange */
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 15px;
  font-weight: 600;
  font-size: 1.1rem;
  white-space: nowrap;
  overflow: hidden;
  border-radius: 8px;
  
  opacity: 0;
  pointer-events: none;

  transition:
    width 0.4s ease,
    opacity 0.4s ease;
  z-index: 10;
}

.swiper-slide:hover .hover-overlay {
  width: 100%;
  opacity: 1;
  pointer-events: auto;
}

</style>

<div class="destinations pt-5 pb-4" data-aos="fade-up">
  <div class="custom-container">
    <div class="pb-4">
      <h1 class="text-center" style="font-family:'Playfair Display', serif; font-weight:500; color:#ff6b35;">
        Our <span style="color:green">Services</span>
      </h1>
    </div>

    <div class="swiper we-offer">
      <div class="swiper-wrapper">

        @if ($services->count())
          {{-- Dynamic Services --}}
          @foreach ($services as $item)
            <div class="swiper-slide">
              <a href="{{ route('service.details', $item->slug) }}" class="card-link" style="text-decoration:none; color:inherit;">
              <div class="destinations-block">
                <div class="destinations-figure">
                  <img src="{{ asset($item->banner_image) }}" class="img-fluid" alt="{{ $item->heading_top }}" />
                </div>
                <span class="destinations-title mh-auto text-center" style="background:#ff6b35; margin:0px; padding:20px; color:white">
                  {{ $item->heading_top }}
                </span>
                <div class="hover-overlay">
    {!! implode('<br>', array_map(function($chunk) {
        return implode(' ', $chunk);
    }, array_chunk(explode(' ', e($item->heading_middle)), 3))) !!}
</div>
              </div>
                </a>
            </div>
          @endforeach
        @else
          {{-- Static Fallback Services --}}
          <div class="swiper-slide">
            <div class="destinations-block">
              <div class="destinations-figure">
                <img src="./assets/img/Basmati rice.jpeg" class="img-fluid" alt="services" />
              </div>
              <span class="destinations-title mh-auto text-center" style="background:#ff6b35; margin:0px; padding:20px; color:white">services1</span>
              <div class="hover-overlay">
                More details about <br> our services
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="destinations-block">
              <div class="destinations-figure">
                <img src="./assets/img/Ground Spice.jpg" class="img-fluid" alt="Ground Spices" />
              </div>
              <span class="destinations-title mh-auto text-center" style="background:#ff6b35; margin:0px; padding:20px; color:white">services2</span>
              <div class="hover-overlay">
                More details about <br> our services
              </div>
            </div>
          </div>
          <div class="swiper-slide">
            <div class="destinations-block">
              <div class="destinations-figure">
                <img src="./assets/img/Ground Spice.jpg" class="img-fluid" alt="Ground Spices" />
              </div>
              <span class="destinations-title mh-auto text-center" style="background:#ff6b35; margin:0px; padding:20px; color:white">services3</span>
              <div class="hover-overlay">
                More details about <br> services
              </div>
            </div>
          </div>
        @endif

      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</div>

<style>
  .hover-overlay {
    position: absolute; 
    bottom: 0;
    left: 0;
    width: 100%;               /* Make it as wide as the card */
    min-height: auto;          /* Allow height to grow */
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
    padding: 15px;
    font-size: 16px;
    line-height: 1.4;
    white-space: normal;       /* Allow wrapping */
    word-wrap: break-word;     /* Break long words */
    overflow: visible;         /* Show all text */
    z-index: 2;
}

</style>

<!-- Destinations Section End -->


     <!-- Destinations Section -->
      <!-- <div class="destinations pt-5 pb-2">
        <div class="custom-container">
            <div class="site-title pb-0">
                <h2 class="text-center">Glimpse of Product</h2>
                <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="./assets/img/chilli.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Chilli</span>
                            </div>
            <p class="text-center">Embark on unforgettable journeys to exotic destinations with our expertly crafted travel experiences.</p> --}}
            </div>
            <div class="swiper glimpse">
                <div class="swiper-wrapper">
                    @if (!empty($getAllProduts))
                        @foreach ($getAllProduts as $product)
                            <div class="swiper-slide mb-4">
                                <div class="destinations-block">
                                    <div style="width: auto;height: 150px; overflow: hidden;">
                                        <img src="{{ url($product->p_img) }}" class="img-fluid"
                                        alt="{!! $product->p_name !!}" style="width: 100%;height: 100%; object-fit: cover;">
                                    </div>
                                    <span class="destinations-title mh-auto text-center">{!! $product->p_name !!}</span>
                                </div>
                            </div>
                        @endforeach
                        @else
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="./assets/img/chilli.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Chilli</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Wheat.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Wheat</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/tomato.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Tomato</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/main-peas.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Peas</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Paddy.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Paddy</span>
                            </div>
                        </div>
                        <div class="swiper-slide mb-4">
                            <div class="destinations-block">
                                <div class="destinations-figure">
                                    <img src="assets/img/Vermicompost.jpg" class="img-fluid" width="" height="" alt="Destinations">
                                </div>
                                <span class="destinations-title mh-auto text-center">Vermicompost</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div> --> 
    <!-- Destinations Section End -->

    <!-- {{-- Testimonial Section  --}}
    <section class="testimonial pt-5 pb-4">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Testimonial</h2>
                <p class="text-center text-white">Include quotes or stories from farmers who have benefited from <b>KRISHIDHA FPO's</b> services.</p>
            </div>
            <div class="swiper testimonials mb-5">
                <div class="swiper-wrapper" id="testimonialsData">

   @if(isset($testimonial))
   @foreach ($testimonial as $testimonialValue)

   <div class="swiper-slide">
    <div class="testimonials-block text-center">
        <div class="testimonials-title"><?=$testimonialValue->client_name?><span> </span></div>
        <p class="text-justify"><?=$testimonialValue->review_text?></p>
    </div>
</div>
@endforeach
@endif
</div>
</div>
 Why Choose Us Section Starts -->
<section class="industries"  >
  <!-- Black overlay -->
  <div class="bg-overlay"></div>

  <h2 class="section-title">Industries We Serve</h2>
  
  <div class="industries-grid" data-aos="fade-up">
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/telecommunicationss.png"/>
      <p>Telecom</p>
    </div>
    <div class="industry-item">
       <img class="icon-bounce" src="./assets/img/airplane.png"/>
     <p>Aerospace</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/factory.png"/>
      <p>Automobile</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/worker (1).png"/>
      <p>Construction</p>
    </div>
    <div class="industry-item">
       <img class="icon-bounce" src="./assets/img/electric-factory.png"/>
     <p>Manufacturing</p>
    </div>
    <div class="industry-item">
     <img class="icon-bounce" src="./assets/img/oil-pump.png"/>
       <p>Oil and Gas</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/hydroelectric.png"/>
      <p>Hydro Power Plant</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/3d-object (1).png"/>
      <p>3D Printing</p>
    </div>
    <div class="industry-item">
     <img class="icon-bounce" src="./assets/img/electric-vehicle.png"/>
       <p>Thermal Power Plant</p>
    </div>
    <div class="industry-item">
     <img class="icon-bounce" src="./assets/img/cruise-ship.png"/>
       <p>Marine</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/welder.png"/>
      <p>Steel Plant</p>
    </div>
    <div class="industry-item">
      <img class="icon-bounce" src="./assets/img/laboratory.png"/>
      <p>Chemical Plant</p>
    </div>
  </div>
</section>

<style>
.industries {
  position: relative;
  text-align: center;
  padding: 50px 20px;
  background: url('./assets/img/banner_new2.webp') no-repeat center center;
  background-size: cover;
  background-attachment: fixed;
  z-index: 1;
}

.bg-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5); /* Black opacity */
  z-index: -1;
}

.section-title {
  font-size: 2rem;
  font-weight: bold;
  margin-bottom: 40px;
  color: #fff;
  position: relative;
}

.industries-grid {
  max-width: 1250px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 30px;
  background: rgba(255, 255, 255, 0.9);
  padding: 30px;
  border-radius: 10px;
  position: relative;
  z-index: 1;
}

.industry-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  transition: all 0.3s ease;
  border: 1px solid #eee;
}

.industry-item p {
  margin: 0;
  font-size: 1rem;
  color: #333;
}

.industry-item:hover {
  transform: translateY(-5px);
  border-color: #4a3aff;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

@keyframes upDown {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-10px);
  }
}

.icon-bounce {
  display: inline-block;
  animation: upDown 1s infinite ease-in-out;
}

@media (max-width: 768px) {
  .industries-grid {
    gap: 20px;
    padding: 20px;
  }
}

@media (max-width: 480px) {
  .section-title {
    font-size: 1.5rem;
  }
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- 
<section class="our-service pt-5 pb-5">
    <div class="custom-container">
        <div class="section-heading mb-4">
            <h1 class="text-center" style="color:#ff6b35;font-family:'Playfair Display', serif">Why Choose <span style="color:green"> Us ?</span></h1>
        </div>
        <div class="row" id="ourServices">
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-sliders"></i></div>
                    <div class="our-content">
                        <p class="mb-0 text-center">Audio-Video Support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-award"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Live Streaming</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-regular fa-star"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Event Management - Townhall</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-headphones"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Audio-Video Rentals</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-fire"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Onsite Support</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="our-block">
                    <div class="our-block-figure"><i class="fa-solid fa-wallet"></i></div>
                    <div class="our-content">

                        <p class="mb-0 text-center">Specialized AV Solutions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Why Choose Us Section Ends -->

<section class="why-choose-us py-5">
  <div class="container" data-aos="fade-up">
    <!-- Section Header -->
    <div class="text-center mb-5">
      <h2 class="fw-bold" style="font-family: 'Playfair Display', serif;color:#ff6b35">
        Why <span style="color:green">Choose Us</span>
      </h2>
      <p class="text-muted">We combine innovation, quality, and dedication to deliver exceptional results.</p>
    </div>

    <!-- 4 Cards in One Row -->
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center p-4">
          <i class="bi bi-award-fill text-primary"></i>
          <h5 class="mt-3">Experienced Team</h5>
          <p class="text-muted">Our experts bring years of industry knowledge to deliver excellence.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center p-4">
          <i class="bi bi-graph-up-arrow text-success"></i>
          <h5 class="mt-3">Proven Results</h5>
          <p class="text-muted">A track record of measurable growth and success for our clients.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center p-4">
          <i class="bi bi-lightbulb-fill text-warning"></i>
          <h5 class="mt-3">Innovative Solutions</h5>
          <p class="text-muted">Creative and tech-driven approaches to complex challenges.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="feature-card text-center p-4">
          <i class="bi bi-people-fill text-danger"></i>
          <h5 class="mt-3">Customer Focused</h5>
          <p class="text-muted">Your satisfaction is our priority, and we go the extra mile to achieve it.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
/* 3D Animation Setup */
.why-choose-us {
  background: #f9f9f9;
  perspective: 1000px;
}

.feature-card {
  background: #fff;
  border-radius: 15px;
  transition: transform 0.4s ease, box-shadow 0.4s ease;
  transform-style: preserve-3d;
  cursor: pointer;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
}

.feature-card i {
  font-size: 3rem;
  display: inline-block;
  transition: transform 0.4s ease;
}

/* Hover Card 3D Effect */
.feature-card:hover {
  transform: rotateY(10deg) rotateX(5deg) scale(1.05);
  box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

/* Infinite Up-Down Icon Animation ONLY on Hover */
@keyframes iconUpDown {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
.feature-card:hover i {
  animation: iconUpDown 0.8s infinite ease-in-out;
  color: #ff6b35 !important;
}

.feature-card h5 {
  font-weight: bold;
}
.feature-card p {
  font-size: 0.95rem;
  color: #555;
}
</style>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">



<!-- Testimonial Section -->
<section class="testimonial-section" >
  <div class="container text-center" data-aos="fade-up">
    <h2 class="fw-bold" style="font-family: 'Playfair Display', serif; margin-bottom: 40px; color: #fff !important;">
      What People <span>Say About Us?</span>
    </h2>

    <!-- Swiper Container -->
    <div class="swiper testimonial-slider">
      <div class="swiper-wrapper">
        
        @if($testimonials->count() > 0)
          @foreach($testimonials as $testimonial)
            <div class="swiper-slide" style="display: flex; justify-content: center; align-items: center;">
              <p class="testimonial-text">
                “{{ $testimonial->message }}”
              </p>
            </div>
          @endforeach
        @else
          <!-- Fallback static testimonials -->
          <div class="swiper-slide" style="display: flex; justify-content: center; align-items: center;">
            <p class="testimonial-text">
              “I got an exact solution for my CMM inspection report from here. The employees are very good and supportive. They completed my work on time. Scanotech Informatics is the best scanning company I have ever seen.”
            </p>
          </div>

          <div class="swiper-slide" style="display: flex; justify-content: center; align-items: center;">
            <p class="testimonial-text">
              “Exceptional service and attention to detail. They really care about delivering top-quality results.”
            </p>
          </div>

          <div class="swiper-slide" style="display: flex; justify-content: center; align-items: center;">
            <p class="testimonial-text">
              “Professional team and quick turnaround. I recommend them without hesitation.”
            </p>
          </div>
        @endif

      </div>

      <!-- Pagination -->
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section>


<!-- Swiper CSS -->

<style>
/* Section Background */
.testimonial-section {
  display: flex !important;
  flex-direction: column !important; /* stack title + slider vertically */
  align-items: center !important;
  min-height: 300px !important; /* increased height */
  padding: 40px 20px !important; /* more padding */
  background: linear-gradient(rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.9)),
    url('https://cdn.pixabay.com/photo/2023/08/07/10/45/bird-8172910_1280.jpg') center/cover no-repeat !important;
  box-sizing: border-box !important;
}

/* Swiper Slide Centering */


/* Testimonial Text */
.testimonial-text {
  max-width: 900px !important;
  color: #fff !important;
  font-size: 15px !important;
  line-height: 1.6 !important;
  padding: 0 15px 30px 15px !important; /* bottom padding creates space before pagination */
}

/* Pagination Dots */
.swiper-pagination {
  margin-top: 15px !important; /* extra space from text */
  display: flex !important;
    justify-content: center !important;
}

.swiper-pagination-bullet {
  width: 12px !important;
  height: 12px !important;
  background: orange !important;
  border: 2px solid white !important;
  border-radius: 50% !important;
  opacity: 1 !important;
}

.swiper-pagination-bullet-active {
  background: white !important;
  border: 2px solid orange !important;
}

</style>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper('.testimonial-slider', {
  loop: true,
  autoplay: {
    delay: 4000,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});
</script>




<!-- Swiper CSS -->
<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
/* ========================
   "Our Clients" Section Only
======================== */
.clients-section {
  padding: 20px 0; /* reduced padding */
  text-align: center;
height:300px;
}

.clients-section .section-title {
  font-size: 2rem;
  font-weight: bold;
}

.clients-section .green-text {
  color: green;
}

.clients-section .blue-text {
  color: #1e2a8a;
}

/* Container fixed width */
.clients-section .clients-container {
  max-width: 1250px;
  margin: 0 auto;
}

/* Swiper slide style */
.clients-section .clients-slider .swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
   
    box-sizing: border-box; /* ensures padding doesn't affect width */
    height: 100px; /* full height of the section */
  
}

/* Logo style */
.clients-section .clients-slider .swiper-slide img {
  width: 250px;
  height: 120px;
  border: 1px solid #ddd;
  background: white;

  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
  display: block; /* removes default image inline gap */
}

</style>

<section class="client-section py-5" style="background-color: #f8f9fa;">
    <div class="container text-center">
        <h2 class="fw-bold mb-4" style="font-family: 'Playfair Display', serif;">
            Our <span>Clients</span>
        </h2>

        <div class="row justify-content-center">
            @if($clients->count())
                @foreach($clients as $client)
                    <div class="col-6 col-md-3 col-lg-2 mb-4">
                                      
                        <img src="{{ asset($client->image) }}"
     alt="Client Logo"
     class="img-fluid"
     style="max-height: 100px;">
                    </div>
                @endforeach
            @else
                {{-- Fallback Static Logos --}}
                <div class="col-6 col-md-3 col-lg-2 mb-4">
                    <img src="{{ asset('images/default-client1.png') }}" class="img-fluid" style="max-height: 100px;">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-4">
                    <img src="{{ asset('images/default-client2.png') }}" class="img-fluid" style="max-height: 100px;">
                </div>
                <div class="col-6 col-md-3 col-lg-2 mb-4">
                    <img src="{{ asset('images/default-client3.png') }}" class="img-fluid" style="max-height: 100px;">
                </div>
            @endif
        </div>
    </div>
</section>



<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper('.clients-slider', {
  loop: true,
  slidesPerView: 5, // adjust for desktop
  spaceBetween: 5, // your required gap
  autoplay: {
    delay: 2000, // time between slides in ms
    disableOnInteraction: false, // keep autoplay after manual interaction
  },
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  breakpoints: {
    320: {
      slidesPerView: 1, // small screens
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    },
  },
});
</script>



{{-- new letter --}}
 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Newsletter Section</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"> --}}
    <style>
        .newsletter-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }

        .newsletter-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(0,123,255,0.05) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .newsletter-content {
            position: relative;
            z-index: 2;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .newsletter-title {
            font-weight: 500;
            color: #2c3e50;
            animation-delay: 0.2s;
        }

        .newsletter-subtitle {
            animation-delay: 0.4s;
        }

        .newsletter-form {
            animation-delay: 0.6s;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 4px 12px rgba(0,123,255,0.15);
            transform: translateY(-2px);
        }

        .btn-subscribe {
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none;
            border-radius: 10px;
            padding: 12px 24px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,123,255,0.3);
        }

        .btn-subscribe:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,123,255,0.4);
            background: linear-gradient(45deg, #0056b3, #004085);
        }

        .newsletter-icon {
            font-size: 1.6rem;
            color: #ff6b35;
            margin-bottom: 1rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        .privacy-text {
            animation-delay: 0.8s;
            transition: color 0.3s ease;
        }

        .privacy-text:hover {
            color: #007bff !important;
        }

        .floating-shape {
            position: absolute;
            background: rgba(0,123,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .shape-1 {
            width: 60px;
            height: 60px;
            top: 20%;
            right: 10%;
            animation-delay: -2s;
        }

        .shape-2 {
            width: 40px;
            height: 40px;
            bottom: 30%;
            left: 15%;
            animation-delay: -4s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>

    <section class="newsletter-section py-2">
        <div class="floating-shape shape-1"></div>
        <div class="floating-shape shape-2"></div>

        <div class="container newsletter-content">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="newsletter-icon fade-in-up">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                    <h5 class="newsletter-title  fade-in-up">Subscribe to Our Newsletter</h5>
                    <p class="newsletter-subtitle mb-4 text-muted fade-in-up">Stay updated with our latest news and updates.</p>

                     <form class="d-flex flex-column flex-md-row align-items-center justify-content-center gap-2" id="simpleNewsletterForm" autocomplete="off">
  <input type="email" class="form-control form-control-sm w-100 w-md-auto" placeholder="Your email" id="simpleEmail" required style="max-width:250px;border: 1px solid black;">

  <!-- CAPTCHA canvas -->
  <canvas id="simpleCaptcha" width="100" height="34" style="border-radius:5px; background:#f8f9fa;"></canvas>

  <!-- Refresh button -->
  <button type="button" class="btn btn-outline-secondary btn-sm px-2" style="border: 1px solid black;" onclick="drawSimpleCaptcha()" title="Refresh Captcha">
    <i class="fas fa-sync-alt"></i>
  </button>

  <!-- CAPTCHA input -->
  <input type="text" class="form-control form-control-sm" placeholder="Enter code" id="simpleCaptchaInput" required style="max-width:120px;border: 1px solid black;">
  
  <!-- Subscribe -->
<button class="btn btn-sm subscribe-btn" style="background-color: #ff6b35; color: white; padding:10px 0px; font-size:15px;border-radius:5px;text-align:justify;width:113px" type="submit">
    <i class="fas fa-paper-plane me-1"></i>Subscribe
</button></form>
                    <small class="privacy-text text-muted mt-3 d-block fade-in-up">
                        <i class="fas fa-shield-alt me-1"></i>
                        We respect your privacy. Unsubscribe at any time.
                    </small>
                </div>
            </div>
        </div>
    </section>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
   <script>
let simpleCaptchaCode = '';

function drawSimpleCaptcha() {
    const canvas = document.getElementById('simpleCaptcha');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Background
    ctx.fillStyle = '#f1f1f1';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    // Generate code
    const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
    simpleCaptchaCode = '';
    for (let i = 0; i < 5; i++) {
        simpleCaptchaCode += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    // Draw text
    ctx.font = '20px Arial';
    ctx.fillStyle = '#333';
    ctx.textBaseline = 'middle';
    ctx.textAlign = 'center';
    ctx.fillText(simpleCaptchaCode, canvas.width / 2, canvas.height / 2);

    // Optional: noise lines
    for (let i = 0; i < 3; i++) {
        ctx.strokeStyle = '#ccc';
        ctx.beginPath();
        ctx.moveTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.lineTo(Math.random() * canvas.width, Math.random() * canvas.height);
        ctx.stroke();
    }
}

// Handle form submit
document.getElementById('simpleNewsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const email = document.getElementById('simpleEmail').value.trim();
    const captchaInput = document.getElementById('simpleCaptchaInput').value.trim();

    if (captchaInput.toUpperCase() !== simpleCaptchaCode) {
        alert('Invalid captcha code.');
        drawSimpleCaptcha();
        return;
    }

    alert('Subscribed successfully with ' + email);
    this.reset();
    drawSimpleCaptcha();
});

// Draw captcha on page load
window.onload = drawSimpleCaptcha;
</script>


{{-- new letter --}}

        <!-- </div>
    </section> -->
    <!-- <section class="our_partner pt-5 pb-2">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Our Partner</h2>
            </div>
            <div class="row">
                @if(!empty($partnersImages))
                @foreach ($partnersImages as $PartnerRow)
                <div class="col-4">
                    <div style="width:auto;height:150px;overflow:hidden;">
                        <img src="{{ url($PartnerRow->image) }}" alt="deHaat"  class="img-fluid" />
                    </div>
                </div>
                @endforeach
                 @else
                 <div class="col-4">
                    <img src="assets/img/deHaat-logo.png" alt="deHaat" width="200" height="" class="img-fluid" />
                </div>
                <div class="col-4">
                    <img src="assets/img/amrit.jpg" alt="deHaat" width="200" height="" class="img-fluid" />
                </div>
                <div class="col-4">
                    <img src="assets/img/guiding.jpg" alt="deHaat" width="200" height="" class="img-fluid" />
                </div>
                 @endif

            </div>
        </div>
    </section> -->
    <!-- {{-- Testimonial Section End  --}} -->
@endsection
<style>
    .about-image{
        display:flex;
    }
    .about-text{
        display:end;
    }

.our_services-title + p {font: 400 14px/normal var(--font-josefin);color: rgb(var(--black-color));}
.our_services-title + p{margin-bottom: 10px; display: -webkit-box;max-width: 100%;-webkit-line-clamp: 2;-webkit-box-orient: vertical;overflow: hidden;}

.custom-container, .header-contaner{
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}
#ourServices {
    justify-content: center;
}
 .our-block {

    padding: 1rem;
    transition: var(--transition);
    cursor: pointer;
    background-color: #fff;
    position: relative;
    z-index: 0;
    min-height: 100px;
}
.our-block::before {
    transition: var(--transition);
    content: '';
    position: absolute;
    top: 0rem;
    right: 0rem;
    bottom: 0rem;
    left: 0rem;
    background-color: #fff;
    box-shadow: 0px 0px 15px -5px rgb(0 0 0 / 30%);
    z-index: -1;
}
.our-block:hover:before {
    top: -0.4rem;
    right: -0.4rem;
    bottom: -0.4rem;
    left: -0.4rem;
}
.our-block-figure > svg {
    font-size: 30px;
    color: var(--primary-bg);
    transition: var(--transition);
    position: relative;
    left: 0;
    top: 0;
}
.our-block-figure {
    float: left;
    position: relative;
    transition: var(--transition);
}
.our-block-figure::after {
    content: '';
    position: absolute;
    left: -1rem;
    top: -1rem;
    width: calc(100% + 2rem);
    height: calc(100% + 2rem);
    background-color: rgba(1,0,102,255);
    border: 5px solid rgba(1,0,102,255);
    border-bottom-right-radius: 100%;
    transform: scale(0) translate(-100%, -100%);
    transition: var(--transition);
    z-index: -1;
}
.our-block:hover > .our-content h4.our-title{color: rgba(1,0,102,255);font-weight: 700;}
.our-block:hover .our-block-figure > svg {
    color: #fff;
    top: -5px;
    left: -5px;
}
.our-block:hover .our-block-figure::after {
    transform: scale(1) translate(0%, 0%);
}
.our-block:hover {
    border-color:rgba(1,0,102,255) ;
}
 .our-block:hover:before {
    background-color: #fff;
    top: 0rem;
    bottom: 0rem;
    right: 0rem;
    left: 0rem;
}
.our-block > .our-content {
    margin-left: 50px;
    text-align: left;
    margin-top:14px;
}
.our-block > .our-content h4.our-title {
    font: 500 16px/normal var(--lato-font);
    margin-bottom: 10px;
    color: var(--primary-bg);
    transition: var(--transition);
}
.our-content p {
    font-size: 15px;
    line-height: 20px;
}
    </style>

    
@section('script')
    <script>
        let site_url = '{{ url('/') }}';
    </script>
    {{-- <script src="js/homePage.js?v=2"></script> --}}
@endsection

