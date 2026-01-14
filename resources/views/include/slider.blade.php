<!-- main Video Section -->
<div class="video-banner">
  <div class="video-block a">
    <div class="swiper main-slider">
      <div class="swiper-wrapper">
        @foreach ($sliders as $slide)
          <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="{{ asset($slide->image) }}" />
            <div class="video-content">
              <!-- Dynamic content from the database -->
              <!-- <h2>{!!$slide->heading_top !!}</h2> -->
              <h3>{!! $slide->heading_middle !!}</h3>
              <!-- <p>{!! $slide->heading_bottom !!}</p> -->
              {{-- Uncomment the following line if you have a contact route for each slide --}}
              {{-- <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a> --}}
            </div>
          </div>
        @endforeach

        {{--
        This block will only render if the $sliders collection is empty.
        This ensures that either dynamic slides OR static slides are shown, but not both.
        --}}
        @unless (count($sliders) > 0)
          <!-- Static slides - example content added for structure, currently commented out -->
          <div class="swiper-slide" style="">
            <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/banner_new1.jpg" />
            <div class="video-content">

              <h2>3d Precission</h2>
              <!-- <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
                          <p>A short descriptive text for Banner Pic 1.</p>
                          <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a> -->

            </div>
          </div>
          <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/banner_new2.webp" />
            <div class="video-content">

              <h2>3d Precission</h2>
              <!-- <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
                          <p>A short descriptive text for Banner Pic 2.</p>
                          <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a> -->

            </div>
          </div>
          {{-- <div class="swiper-slide">
            <img class="img-fluid" width="" height="" alt="Image" src="./assets/img/ab.jpg" />
            <div class="video-content">

              <h2>Adiyogi Global</h2>
              <!-- <h3>Grow with Innovation: Solutions for Sustainable Farming</h3>
                          <p>A short descriptive text for Banner Pic 2.</p>
                          <a href="{{ route('contactUs') }}" aria-label="Explore The World">Get in touch</a> -->

            </div>
          </div> --}}

        @endunless
      </div>
    </div>
  </div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>

</div>
<style>
  .swiper-slide-active .video-content h2 {
    animation: fadeUp 0.8s ease forwards;
  }

  .swiper-slide-active .video-content h3 {
    animation: fadeUp 0.8s ease 0.3s forwards;
  }

  .swiper-slide-active .video-content p {
    animation: fadeUp 0.8s ease 0.6s forwards;
  }

  @keyframes fadeUp {
    0% {
      opacity: 0;
      transform: translateY(100px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* Common arrow button style */
  .swiper-button-prev,
  .swiper-button-next {
    width: 40px !important;
    height: 40px !important;
    border-radius: 50% !important;
    position: absolute !important;
    top: 50% !important;
    transform: translateY(-50%) !important;
    z-index: 3 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    overflow: hidden !important;
    font-size: 10px;
  }

  /* Default arrows */
  .swiper-button-prev::after,
  .swiper-button-next::after {
    font-family: "Font Awesome 5 Free";

    font-size: 5px;
    color: white;
    line-height: 60px;
    text-align: center;
    display: block;
  }

  /* Left arrow icon */
  .swiper-button-prev::after {
    content: "\f104";
    /* fa-angle-left */
    font-size: 10px;
  }

  /* Right arrow icon */
  .swiper-button-next::after {
    content: "\f105";
    /* fa-angle-right */
  }

  /* Hover state: show image */
  .swiper-button-prev:hover {
    background: url('./assets/img/logo.png') center/cover no-repeat;
  }

  .swiper-button-next:hover {
    background: url('./assets/img/logo.png') center/cover no-repeat;
  }

  /* Keep arrow visible above image */
  .swiper-button-prev:hover::after,
  .swiper-button-next:hover::after {
    border-radius: 50%;
    color: black;
  }

  .video-block.a .swiper-slide {
    position: relative;
    /* Needed for ::after to be positioned relative to slide */
  }

  .video-block.a .swiper-slide::after {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    /* background: rgba(0, 0, 0, 0.5); */
    /* Semi-transparent black overlay */
    z-index: 1;
    /* Places overlay above image */
  }

  /* Default style for desktop and large screens */

  /* Extra large devices (large desktops) */

  /* Large devices (desktops) */
  @media (min-width: 992px) and (max-width: 1199px) {
    .video-banner {
      height: 500px;
    }

    .video-content {
      bottom: 50%;
    }
  }

  @media (min-width: 992px) and (max-width: 2009px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 500px;
    }
  }

  @media (min-width: 1500px) and (max-width: 1600px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 550px;
    }

  }

  /* Medium devices (tablets) */
  @media (min-width: 768px) and (max-width: 991px) {
    .video-banner {
      height: 500px;
    }

  }

  @media (min-width: 768px) and (max-width: 991px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 500px;
    }

    .video-content {
      bottom: 20%;
    }
  }

  /* Small devices (landscape phones) */
  @media (min-width: 576px) and (max-width: 767px) {
    .video-banner {
      height: 200px;
    }

  }

  @media (min-width: 576px) and (max-width: 767px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 200px;
    }

  }

  /* Extra small devices (portrait phones) */
  @media (max-width: 575px) {
    .video-banner {
      height: 250px;
    }
  }

  @media (max-width: 575px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 250;
    }
  }

  @media (max-width: 500px) {
    .video-banner {
      height: 250px;
    }

    .video-content {
      bottom: 80%;

    }
  }

  @media (width: 344px) {
    .video-block>.main-slider .swiper-slide img.img-fluid {
      height: 200px;
    }
  }



  /* Default style for all devices */
</style>