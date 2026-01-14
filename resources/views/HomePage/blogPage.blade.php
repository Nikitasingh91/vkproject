@extends('layouts.webSite')
@section('title', 'Blog')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Blog</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content blog-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Krishidha Blog</h2>
                {{-- <p class="text-center pb-3">From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels.</p> --}}
            </div>
            <div class="blog-container midd-content">
                <div class="row">
                    @if($getAllBlogs->isNotEmpty())
@foreach ($getAllBlogs as $BlogRow)

<div class="col-md-12 mb-4 offering s-container">
    <div class="offerings-block">
        <div class="offerings-content">
            <div class="offerings-content-inner">
                <h3>{{ $BlogRow['blog_title'] }}</h3>
                <p>{!! $BlogRow['blog_desc'] !!}</p>
            </div>
        </div>
        <div class="offerings-figure">
            <img src="{{ url($BlogRow['image']) }}" class="img-fluid rounded" width="" height="" alt="Bikaner" />
        </div>
    </div>
</div>
@endforeach
 @else
                      <div class="col-md-12 mb-4 offerings-container">
                        <div class="offerings-block">
                            <div class="offerings-content">
                                <div class="offerings-content-inner">
                                    <h3>Paddy</h3>
                                    <p>Paddy, the unhusked rice grain, is the cornerstone of global food security and cultural heritage. Growing in lush paddies across Asia and beyond, paddy fields sustain millions of livelihoods and feed billions of people worldwide. The transformation of paddy into rice involves a meticulous process, from planting and nurturing to harvesting and milling. This staple crop serves as the foundation of countless dishes, from steaming bowls of fragrant jasmine rice to crispy treats like rice crackers. Beyond its culinary significance, paddy cultivation is deeply ingrained in the cultural fabric of many societies, symbolizing traditions, rituals, and community bonds. As we savor the grains of rice on our plates, let us also honor the toil of farmers who cultivate paddy fields, ensuring a steady supply of this essential food source for generations to come.</p>
                                </div>
                            </div>
                            <div class="offerings-figure">
                                <img src="assets/img/Paddy.jpg" class="img-fluid rounded" width="" height="" alt="Bikaner" />
                            </div>
                        </div>
                    </div>
                      @endif

                </div><br><br>
                <h3>FAQs:</h3>
                <div id="main-faqs" class="mt-2">
                    @if ($getAllFaq->isNotEmpty())
                    @foreach ($getAllFaq as $FaqRow)
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="true" aria-controls="flush-collapseOne">Q: {!! $FaqRow['faq_question'] !!}</button>
                      <div id="flush-collapseOne" class="accordion-collapse collapse show" data-bs-parent="#main-faqs">
                        <div class="accordion-content">
                            {!! $FaqRow['faq_answer'] !!}
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @else
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">Q: What does the name "KRISHIDHA" mean?</button>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                        <div class="accordion-content">
                            <ul>
                                <li>A: KRISHIDHA is derived from the Vedic saying "Krishi hi Dhan h," which translates to "Agriculture is wealth."</li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">Q: What services does KRISHIDHA FPO offer to farmers?</button>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                        <div class="accordion-content">
                            <ul>
                                <li>A: KRISHIDHA FPO provides a combination of services to support farmers, including:</li>
                                <li>Supplying world-class agricultural inputs (seeds, fertilizers, crop protection products).</li>
                                <li>Conducting capacity building programs on sustainable farming practices, improved agricultural techniques, and financial literacy.</li>
                                <li>Facilitating market access by connecting farmers with reliable buyers and negotiating fair prices for their produce.</li>
                                <li>Offering specific support programs to empower women farmers.</li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">Q: How does KRISHIDHA FPO help farmers increase their income?</button>
                      <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                        <div class="accordion-content">
                            <ul>
                                <li>A: By providing access to high-quality inputs, training on improved practices, and fair market access, KRISHIDHA FPO equips farmers to:</li>
                                <li>Increase their crop yields.</li>
                                <li>Reduce production costs through sustainable practices.</li>
                                <li>Secure better prices for their produce.</li>
                            </ul>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">Q: Does KRISHIDHA FPO sell agricultural produce directly?</button>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                            <div class="accordion-content">
                                <ul>
                                    <li>A: The information suggests KRISHIDHA FPO's primary focus is empowering farmers, not directly selling their produce. They connect farmers with fair markets, enabling them to sell their crops independently.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsesix" aria-expanded="false" aria-controls="flush-collapsesix">Q: What types of agricultural inputs can farmers expect from KRISHIDHA FPO?</button>
                        <div id="flush-collapsesix" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                            <div class="accordion-content">
                                <ul>
                                    <li>A: The specific types of inputs might vary, but they likely include high-quality seeds, fertilizers, and crop protection products chosen based on effectiveness and potentially sustainable practices.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-list">
                        <button class=" collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseseven" aria-expanded="false" aria-controls="flush-collapseseven">Q: What is KRISHIDHA FPO's vision for the future?</button>
                        <div id="flush-collapseseven" class="accordion-collapse collapse" data-bs-parent="#main-faqs">
                            <div class="accordion-content">
                                <ul>
                                    <li>A: KRISHIDHA FPO envisions thriving rural communities where empowered farmers, particularly women, cultivate a legacy of abundance through sustainable practices and fair market access.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <p><b>Case studies:</b> Showcase the positive impact KRISHIDHA FPO has had on specific communities or farmers.</p>
            </div>
        </div>
    </div>
</div>
@endsection
