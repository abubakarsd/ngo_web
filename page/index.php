<section class="bg-half-260" id="home">
    <div class="bg-overlay bg-gradient-overlay"></div>
    <div class="container">
        <div class="row align-items-center mt-5">
            <div class="col-lg-7 col-md-8 order-md-1 order-2">
                <div class="title-heading">
                    <h1 class="heading text-white title-dark fw-bold mb-4 text-capitalize" id="hero-title"></h1>
                    <p class="para-desc text-white-50" id="hero-desc"></p>
                    <div class="mt-4 pt-2">
                        <a class="btn btn-primary me-1" id="dynamic_button" target="" href=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-4 order-md-2 order-1">
                <div class="position-absolute top-50 start-50 translate-middle">
                    <a class="avatar avatar-md-md rounded-pill shadow card d-flex justify-content-center align-items-center lightbox" href="#" onclick="viewVideo(event)">
                        <i class="mdi mdi-play mdi-24px text-primary"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 order-1 order-md-2">
                <div class="features-absolute">
                    <div class="p-4 rounded shadow position-relative bg-white">
                        <div class="section-title">
                            <h4 class="title mb-3">Make a Donation</h4>
                            <p class="mb-0 text-muted">Your ₦40.00 monthly donation can give 12 people clean water every year. 100% funds water projects.</p>
                        </div>
                        <form class="mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="name">Your Name : </label>
                                        <input name="name" id="name" type="text" class="form-control" placeholder="Your Name :">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="email"> Your Mail : </label>
                                        <input name="email" id="email" type="email" class="form-control" placeholder="Your Mail :">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="number2">Phone No. : </label>
                                        <input name="number" type="number" class="form-control" id="number2" placeholder="Phone :">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold">I Want to Donate for</label>
                                        <select class="form-select form-control" name="item_name">
                                            <option value="Donate For Food">Quality Education</option>
                                            <option value="Food For Orphan">Climate change</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">How much do you want to donate ?</label>
                                    <div class="mb-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">₦</span>
                                            <input type="number" class="form-control" min="1" max="1000" placeholder="Enter Amount" id="amount" aria-describedby="inputGroupPrepend" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="flexCheckDefault" value="">
                                        <label class="form-check-label" for="flexCheckDefault">I agree to the <a class="text-primary" href="/">Terms and Conditions</a>.</label>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" id="donatefund" name="send" class="btn btn-primary">Donate Us</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 order-2 order-md-1">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="position-relative">
                            <div class="me-4">
                                <img src="/ngo_web/static/media/Project Four.jpg" class="img-fluid rounded shadow" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-4 pt-2 mt-lg-0 pt-lg-0">
                        <div class="section-title">
                            <h6 class="fw-normal text-primary">ABOUT US</h6>
                            <h4 class="title mb-4">About <br> the Foundation</h4>
                            <p class="text-muted mb-0 about-info"></p>
                            <div class="mt-4">
                                <a class="btn btn-primary" href="/ngo_web/about">Read More <i class="mdi mdi-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-light">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="section-title text-center mb-4 pb-2">
                <h4 class="title mb-3">We are <span class="text-primary">Conducting Projects</span> in Nigeria <br> in the Following Areas</h4>
            </div>
        </div>
    </div>
    <div class="row" id="prioritiesContainer"></div>                          
</div>
</section>
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title mb-3">Recent Blog</h4>
                </div>
            </div>
        </div>
        <div class="row" id="recentBlogsContainer"></div>
    </div>
</section>
<section class="section">
    <div class="cta-video-section position-relative">
        <video class="" loop autoplay muted playsinline>
            <source src="/ngo_web/static/media/videoblocks-22_02_33_k_group_of_african_kids_playing_with_water_hooqv710h__553d1d3c28dcaa83ce855b4ec735859e__P360.mp4" type="video/mp4">
        </video>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-5 col-10">
                    <div class="position-relative z-1 p-4 rounded shadow bg-white overflow-hidden" style="height: 300px;">
                        <div class="tiny-single-item">
                            <div class="tns-outer">
                                <div class="tns-ovh">
                                    <div class="tns-inner">
                                        <div class="tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="testimonial-slider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <i class="mdi mdi-format-quote-open text-primary position-absolute top-50 start-50 translate-middle z-n1 testi-icon"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="section-title text-center mb-4 pb-2">
                    <h4 class="title mb-3">Our Partners</h4>
                    <p class="text-muted para-desc mx-auto mb-0">We are proud to collaborate with our esteemed partners to achieve our goals</p>
                </div>
            </div>
        </div>
        <!-- Swiper Slider -->
         <div class="row">
            <div class="col-12">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper" id="partnersContainer"></div>
                    <!-- Swiper Pagination -->
                     <div class="swiper-pagination"></div>
                     <!-- Swiper Navigation Buttons -->
                      <div class="swiper-button-next"></div>
                      <div class="swiper-button-prev"></div>
                    </div>
                </div>
            </div>
        </div>
</section>