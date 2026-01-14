<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/swiper-bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<div class="gtranslate_wrapper"></div>
<script>window.gtranslateSettings = {"default_language":"en","native_language_names":true,"detect_browser_language":true,"languages":["en","fr","es","de"],"wrapper_selector":".gtranslate_wrapper"}</script>
<script src="https://cdn.gtranslate.net/widgets/latest/lc.js" defer></script>

<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

<a class="footer-whatsapp" aria-label="Whatsapp Button" href="https://wa.me/+91{!! $whatsapp_footer_link ?? '9266747031' !!}?text=Let%27s+start+build+a+project"><img src="/assets/img/whatsapp.png" alt="Whatsapp" class="img-fluid" height="" width="150"></a>
{{-- <!-- <a class="footer-whatsapp footer-call" aria-label="Phone Call Button" href="tel:{{ isset($WebSetting['0']->call_no) ? $WebSetting['0']->call_no : '+91 926 674 7031' }}"><img src="./assets/img/phone-call.png" alt="Phone Call" class="img-fluid" height="" width="150"></a> --> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset("dashboard/assets/js/website.js")}}"></script>

<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
  // Navigation bar dropdown
document.addEventListener('DOMContentLoaded', () => {
    // Code here runs after DOM content is fully loaded
    const dropdowns = document.querySelectorAll('.dropdown-list');
    dropdowns.forEach(dropdown => {
        const toggleBtn = dropdown.querySelector('.drop-plus');
        const sublist = dropdown.querySelector('.sublist');
        dropdown.addEventListener("mouseover", (event) => {
            const isDropdown = event.currentTarget === event.target;
            if (isDropdown) {
                sublist.classList.add('active-list');
            }
        });
        dropdown.addEventListener("mouseleave", () => {
            sublist.classList.remove('active-list');
        });
        if (toggleBtn && sublist) {
            toggleBtn.addEventListener('click', (event) => {
                sublist.classList.toggle('active');
                toggleBtn.textContent = sublist.classList.contains('active') ? '-' : '+';
                event.stopPropagation(); // Prevent event from bubbling up
            });
        } else {
            console.error('Toggle button or sublist not found in dropdown:', dropdown);
        }
        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            if (sublist) {
                sublist.classList.remove('active');
                toggleBtn.textContent = '+';
            }
        });
        // Prevent closing dropdown when clicking inside
        dropdown.addEventListener('click', (event) => {
            event.stopPropagation();
        });
    });
});
// Navigation bar dropdown End
  Fancybox.bind('[data-fancybox="gallery"]', {});
function successMessage(success_message,reload=false){
Swal.fire({
    icon: 'success',
    title: 'Success',
    text: success_message
  }).then(function(){
      if (reload) {
      window.location.reload();
    }
  });
}
function errorMessage(error_message){
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: error_message
  });
}
$(function() {
    $(window).on('scroll', function () {
		if ($(window).scrollTop() > 150) {
			$('.main-header').addClass('fixed-header');
		} else {
			$('.main-header').removeClass('fixed-header');
		}
	});
});
var togglemenu = document.querySelector('.mobile-bars');
togglemenu.addEventListener("click", function(){
	document.body.classList.toggle('open-menu');
})
var swiper = new Swiper(".main-slider", {
  spaceBetween: 30,
  effect: "fade",
  loop: true,
  autoplay: {
    delay: 4500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
});
var swiper = new Swiper(".glimpse", {
  spaceBetween: 10,
  // effect: "fade",
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    320: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    480: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 5,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 10,
    },
  },
});
var swiper = new Swiper(".we-offer", {
  spaceBetween: 10,
  // effect: "fade",
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    480: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
  },
});
var swiper = new Swiper(".testimonials", {
  spaceBetween: 30,
  // effect: "fade",
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    320: {
      autoHeight: true,
      slidesPerView: 1,
      spaceBetween: 10,
    },
    767: {
      slidesPerView: 1,
      spaceBetween: 10,
    },
  },
});
var swiper = new Swiper(".recognitions-self", {
  spaceBetween: 30,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    280: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    460: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    640: {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    768: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});
</script>


