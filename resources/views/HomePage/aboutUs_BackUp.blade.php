@extends('layouts.webSite')
@section('title', 'About Us')
@section('content')
<div class="information-page-slider">
    <div class="information-content">
        <h1><a href="{{ url('/') }}">Home</a><span>About Us</span></h1>
    </div>
</div>
<div id="about">
    <div class="default-content pt-5 pb-3">
        <div class="custom-container">
            <div class="site-title pb-3">
                <h2 class="text-center">AboutUs </h2>
            </div>
            <div class="midd-content">
                <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio eos cum, labore nostrum commodi ullam quidem ducimus distinctio atque quasi delectus iure dignissimos debitis expedita accusamus? Eum consectetur at autem laborum vitae rerum ut similique ipsam quas sed non voluptates iure quos minus enim exercitationem omnis, eveniet molestias repudiandae. Totam animi earum laborum illum quod quae officiis in eum. Eius et a ab at saepe sequi! Amet ut sequi sunt odit odio culpa sint, inventore ipsam quibusdam? Quod aut quisquam excepturi commodi adipisci sit perferendis eos quam qui veniam illo exercitationem id tempora, suscipit omnis labore praesentium quos cum neque!</p>
                <div class="about-block" id="mission-sec">
                    <div class="about-item about-item-left">
                        <h3><b>Vision</b></h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita architecto labore illo eveniet magnam veniam porro enim nam, a corporis, blanditiis nobis at tempora alias. Consequatur sequi voluptatum architecto sit.</p>
                    </div>
                    <div class="about-item about-item-right">
                        <h3><b>Mission</b></h3>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error repellat praesentium repellendus suscipit, officia rerum, officiis vel nobis voluptatibus libero ipsam, eos magnam velit eum! Magni, aut modi? Quidem, incidunt.</p>
                    </div>
                </div>

                <h3><b>Goal:</b></h3>
                <p class="text-justify">We offer farmers a comprehensive suite of high-quality agricultural inputs and capacity-building programs. These services aim to increase farmer income, ensure the authenticity and marketability of their produce, promote sustainable farming practices, and maintain healthy soil conditions.</p>

                <h3><b>Core values:</b></h3>
                <ol>
                    <li><p><b>Empowerment:</b> Empowering farmers, especially women, through knowledge, resources, and market access.</p></li>
                    <li><p><b>Sustainability:</b> Promoting sustainable agricultural practices to ensure long-term prosperity for farmers and the environment.</p></li>
                    <li><p><b>Integrity:</b> Conducting business with honesty, transparency, and ethical standards.</p></li>
                    <li><p><b>Collaboration:</b> Collaborating with stakeholders to create a supportive ecosystem for agricultural development.</p></li>
                    <li><p><b>Innovation:</b> Embracing innovation to address challenges and optimize opportunities in the agricultural sector.</p></li>
                </ol><hr>

                <div class="site-title pt-2" id="teams-sec">
                    <h2 class="text-left">Our Team</h2>
                </div>
                <div class="our-teams">
                    <div class="about-our-team">
                        <div class="about-our-item about-our-item-left">
                            <img src="assets/img/Mukesh-Kumar-Pandey-ji.png" alt="team-01" height="200" width="200">
                        </div>
                        <div class="about-our-item about-our-item-right">
                            <h5>Founder/Director/Chairperson</h5>
                            <h6>Mr. Mukesh Kumar Pandey</h6>
                            <i><b>Education:</b> Postgraduate Diploma in NGO Management from EDII Ahmedabad,Gujarat, </i>
                            <i><b>Occupation:</b> Environmentalist</i>
                            <p class="text-justify"><b>Area of Expertise:</b> Climate change mitigation, agroforestry, water conservation, green entrepreneurship</p>
                        </div>
                    </div>
                    <div class="about-our-team">
                        <div class="about-our-item about-our-item-left">
                            <img src="assets/img/Nirmal-Pandey.png" alt="team-02" height="200" width="200">
                        </div>
                        <div class="about-our-item about-our-item-right">
                            <h5>CEO</h5>
                            <h6>Nirmal Pandey</h6>
                            <i>Janaki Nagar Colony Varanasi</i>
                            <i><b>Education:</b> MBA in Marketing and Finance</i>
                            <p><b>Expertise:</b> Marketing and Finance</p>
                        </div>
                    </div>
                </div>
                <div class="site-title pt-2 pb-4">
                    <h2 class="text-center">Directors</h2>
                </div>
                <div class="row director-container">
                    <div class="col-md-4">
                        <div class="director-item">
                            <div class="director-figure">
                                <img src="assets/img/Chandramauli-Pandey.png" alt="" class="img-fluid">
                            </div>
                            <div class="director-content">
                                <h3>Chandramauli Pandey</h3>
                                <span><b>Education:</b> Mirzapur Purvanchal University</span>
                                <p><b>Expertise:</b> Dairy Farming and Market Linkages</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="director-item">
                            <div class="director-figure">
                                <img src="assets/img/Vishal-Pandey.png" alt="" class="img-fluid">
                            </div>
                            <div class="director-content">
                                <h3>Vishal Kumar Pandey</h3>
                                <span><b>Education:</b> Banaras Hindu University (BHU), Hospitality</span>
                                <span><b>Occupation:</b> Struggling Young Farmer</span>
                                <p><b>Expertise:</b> Dairy Farming and Market Linkages</p>
                                <p><b>Focus:</b> Transitioning from a background in hospitality education at Banaras Hindu University (BHU) to pursue a career as a young farmer, showcasing determination and adaptability in agricultural endeavors.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="director-item">
                            <div class="director-figure">
                                <img src="assets/img/Meenu-devi.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="director-content">
                                <h3>Meenu Devi</h3>
                                <span><b>Education:</b> Rural Agri-Business Development</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="director-item">
                            <div class="director-figure">
                                <img src="assets/img/Tusar-pandey.png" alt="" class="img-fluid">
                            </div>
                            <div class="director-content">
                                <h3>Tushar Pandey</h3>
                                <span><b>Education:</b> MA Economics, MSW</span>
                                <p><b>Expertise:</b> Plant obeserver</p>
                            </div>
                        </div>
                    </div>
                </div><hr>

                <p class="text-justify"><b>At Adiyogiglobal , we invite you to embark on a journey of discovery, where every experience is crafted with care and passion. Let us be your guide to the wonders of India.</b></p>

                <img src="assets/img/logo.png" width="100" height="" class="img-fluid mb-2" style="width: 100px;" />
                <span> - Symbolize our spirit to <i>Either Find Ways Or Make One.</i></span><br><br>

            </div>
        </div>
    </div>
</div>
@endsection
