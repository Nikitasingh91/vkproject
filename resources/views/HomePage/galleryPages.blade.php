@extends('layouts.webSite')
@section('title', 'Events')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>Events</span></h1>
    </div>
</div>
<div id="about" data-aos="fade-up">
    <div class="default-content pt-5 pb-5">
        <div class="custom-container">
            <div class=" mb-4">
                <h1 class="text-center" style="color: #ff6b35;font-family:'Playfair Display', serif;font-weight:600">Gallery</h1>
            </div>
            {{-- <div class="shuffle_wrapper text-center pt-2 pb-4">
                <button class="default-btn" id='all'><span>All</span></button>
                @if (isset($filter_category)) --}}
                    {{-- @foreach ($filter_category as $item)
                    <button class="default-btn filter" data-filter_category="{{ $item->filter_category }}" ><span>{{ $item->filter_category }}</span></button>
                    @endforeach
                    @else
                    <button class="default-btn" id='btn-travel'><span>Event</span></button>
                    <button class="default-btn" id='btn-travel_one'><span>Event One</span></button>
                @endif
            </div> --}}
            <div class="row my-shuffle-container">
                {{-- @if (empty($galleryImages))
                @foreach ($galleryImages as $item)
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["{!!  $item->filter_category !!}"]'><img src="{{ $item->local_image?url($item->local_image):$item->image_link}}" class="img-fluid" width="" height="" alt="Destinations"></div>
                @endforeach --}}

            {{-- @else --}}
    @if($galleryImages->isNotEmpty())
    @foreach ($galleryImages as $GalleryImage)
    <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
        <a data-fancybox="gallery" href="<?=$GalleryImage['local_image'];?>" >
            <div style="width: auto;height: 350px;overflow: hidden;">
                <img src="<?=$GalleryImage['local_image'];?>" class="img-fluid" width="" height="" alt="<?=$GalleryImage['title']?>" style="width: 100%;height: 100%;object-fit: cover;">
             </div>
            <div class="gallery-caption">
                <h3><?php echo  $GalleryImage['title'] !== '' ? $GalleryImage['title'] : $GalleryImage['alternate_text']  ?></h3>
                <p><?=$GalleryImage['description']?></p>
            </div>
        </a>
    </div>
    @endforeach
    @else
<div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Community-Engagement.jpg" >
                  <img src="https://www.ansys.com/content/dam/campaigns/abm/siemens/2020-10-3d-design-business-value.jpg?wid=1200" class="img-fluid" alt="Destinations">
      <div class="gallery-caption">
                            <h3>Community Engagement</h3>
                            <p>Fostering collaboration and understanding within the community.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Wheat.jpg" >
                        <img src="https://media.istockphoto.com/id/1415537875/photo/asian-graphic-designer-working-in-office-artist-creative-designer-illustrator-graphic-skill.jpg?s=612x612&w=0&k=20&c=9ufB0QZ-LPcz14zLh909QEEbmDmcfIYzhBsST3hXbMs=" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Wheat</h3>
                            <p>Wheat, the golden grain that has sustained civilizations for millennia, holds a central place in our diets and cultures worldwide.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Vermicompost.jpg" >
                        <img src="https://dlcdnwebimgs.asus.com/files/media/2b4b3565-8f3f-4f49-a336-52713c675179/v1/assets/image/proart/article_cover.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Vermicompost</h3>
                            <p>Vermicompost, also known as worm compost or worm castings, is a nutrient-rich organic fertilizer produced through the natural decomposition of organic matter by earthworms.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/entrepreneurship-development.jpg" >
                        <img src="https://www.shutterstock.com/image-photo/young-3d-designer-creates-develops-260nw-2503867477.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Entrepreneurship Development</h3>
                            <p>Training and guidance to help farmers become successful entrepreneurs.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/main-peas.jpg" >
                        <img src="data:image/jpeg;base64,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" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Peas</h3>
                            <p>Peas, those delightful green orbs, are a beloved vegetable cherished for their sweet taste and versatility.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Market-Access.jpg" >
                        <img src="https://damassets.autodesk.net/content/dam/autodesk/draftr/28447/3d-modelling-works-thumb-1172x660.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Market Access</h3>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </a>
                </div>

                @endif

                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Community-Engagement.jpg" >
                        <img src=" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Community Engagement</h3>
                            <p>Fostering collaboration and understanding within the community.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Wheat.jpg" >
                        <img src="assets/img/Wheat.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Wheat</h3>
                            <p>Wheat, the golden grain that has sustained civilizations for millennia, holds a central place in our diets and cultures worldwide.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel"]'>
                    <a data-fancybox="gallery" href="assets/img/Vermicompost.jpg" >
                        <img src="assets/img/Vermicompost.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Vermicompost</h3>
                            <p>Vermicompost, also known as worm compost or worm castings, is a nutrient-rich organic fertilizer produced through the natural decomposition of organic matter by earthworms.</p>
                        </div>
                    </a>
                </div> --}}
                {{-- <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/entrepreneurship-development.jpg" >
                        <img src="assets/img/entrepreneurship-development.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Entrepreneurship Development</h3>
                            <p>Training and guidance to help farmers become successful entrepreneurs.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/main-peas.jpg" >
                        <img src="assets/img/main-peas.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Peas</h3>
                            <p>Peas, those delightful green orbs, are a beloved vegetable cherished for their sweet taste and versatility.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Market-Access.jpg" >
                        <img src="assets/img/Market-Access.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Market Access</h3>
                            <p>Connecting farmers with buyers and ensuring fair prices.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/Quality-Assurance.jpg" >
                        <img src="assets/img/Quality-Assurance.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Quality Assurance</h3>
                            <p>Maintaining high production standards for premium products.</p>
                        </div>
                    </a>
                </div>
                <div class="mb-3 col-md-4 col-sm-6 picture-item" data-groups='["travel_one"]'>
                    <a data-fancybox="gallery" href="assets/img/tomato.jpg" >
                        <img src="assets/img/tomato.jpg" class="img-fluid" width="" height="" alt="Destinations">
                        <div class="gallery-caption">
                            <h3>Tomato</h3>
                            <p>The tomato, often referred to as the "love apple," is a culinary gem cherished for its vibrant color, juicy texture, and versatile flavor.</p>
                        </div>
                    </a>
                </div> --}}

                <div class="col-1@sm my-sizer-element"></div>
            {{-- @endif --}}

            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Shuffle/6.1.0/shuffle.min.js"></script>
<script>
var gallary_page = window.location.pathname;
var split_name = gallary_page.split("/").pop();
const getpage = () => {
    var Shuffle = window.Shuffle;
    var element = document.querySelector('.my-shuffle-container');
    var sizer = element.querySelector('.my-sizer-element');
    var shuffleInstance = new Shuffle(element, {
        itemSelector: '.picture-item'
    });
    // shuffleInstance.filter('animal');
    $("#all").on("click", function () {
        shuffleInstance.filter();
    });
    $("#btn-travel").on("click", function () {
        shuffleInstance.filter('travel');
    });
    $("#btn-travel_one").on("click", function () {
        shuffleInstance.filter('travel_one');
    });
    $(".filter").on("click", function () {
        let filterData = $(this).data("filter_category");
        shuffleInstance.filter(filterData);
    });
}
if(split_name == 'event'){
    getpage();
}
</script>
@endsection
