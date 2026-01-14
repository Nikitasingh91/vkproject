@extends('layouts.webSite')
@section('title', 'Our Services')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Our Services</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content service-page pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">Krishidha Services</h2>
                {{-- <p class="text-center pb-3">From basic treks to high-altitude mountaineering expeditions, we cater to adventurers of all levels.</p> --}}
            </div>
            <div class="midd-content">
                <div class="row">
                    @if($service->isNotEmpty())
                    @foreach ($service as $item)
                    <div class="col-md-4 mb-4">
                        <div class="destinations-block">
                            <div style="width: auto;height: 350px; overflow: hidden;">
                                <img src="{{url( $item->image )}}" class="img-fluid" alt="{!! $item->service_name !!}" style="width: 100%;height: 100%; object-fit: cover;">

                            </div>
                            <span class="destinations-title">{!! $item->service_name !!}</span>
                             {!! $item->service_details !!}

                        </div>
                    </div>
                    @endforeach

                    @else
                    {{-- <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Agricultural-Produce.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Market access</span>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </div> --}}
                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Market-Access.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Market access</span>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/entrepreneurship-development.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Entrepreneurial development</span>
                            <p>Training and guidance to help farmers become successful entrepreneurs.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Capacity-Building.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Training and capacity building</span>
                            <p>Programs to enhance farmers' knowledge and skills.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Quality-Assurance.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Quality assurance</span>
                            <p>Maintaining high production standards for premium products.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Community-Engagement.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Community engagement</span>
                            <p>Fostering collaboration and understanding within the community.</p>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-12 mb-4">
                        <div class="destinations-block">
                            <div class="destinations-figure">
                                <img src="assets/img/Community-Engagement.jpg" class="img-fluid" width="" height="" alt="Destinations">
                            </div>
                            <span class="destinations-title mh-auto">Support for women farmers</span>
                            <p>KRISHIDHA FPO has a specific focus on empowering women in agriculture.</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
