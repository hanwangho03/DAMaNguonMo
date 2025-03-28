@include('clients.blocks.header')
@include('clients.blocks.banner_home')


 <!--Form Back Drop-->
        <div class="form-back-drop"></div>
        
        <!-- Hidden Sidebar -->
        <section class="hidden-bar">
            <div class="inner-box text-center">
                <div class="cross-icon"><span class="fa fa-times"></span></div>
                <div class="title">
                    <h4>Get Appointment</h4>
                </div>

                <!--Appointment Form-->
                <div class="appointment-form">
                    <form method="post" action="https://webtendtheme.net/html/2024/ravelo/contact.html">
                        <div class="form-group">
                            <input type="text" name="text" value="" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" value="" placeholder="Email Address" required>
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Message" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="theme-btn style-two">
                                <span data-hover="Submit now">Submit now</span>
                                <i class="fal fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!--Social Icons-->
                <div class="social-style-one">
                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </section>
        <!--End Hidden Sidebar -->
<!-- Destinations Area start -->
<section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá kho báu Việt Nam cùng Travela</h2>
                    <p>Website<span class="count-text plus" data-speed="3000" data-stop="24080">0</span>
                        phổ biến nhất mà bạn sẽ nhớ</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach ($tours->take(4) as $tour) <!-- Giới hạn hiển thị 4 tour -->
                <div class="col-xxl-3 col-xl-4 col-md-6" style="margin-bottom: 30px">
                    <div class="destination-item block_tours" data-aos="fade-up" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                            <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">
                                <img src="{{ asset($tour->images[0] ?? 'clients/assets/images/default.jpg') }}" alt="Destination">
                            </a>
                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->destination }}</span>
                            <h5 class="tour-title">
                                <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">{{ $tour->titlle }}</a>
                            </h5> 
                            <p class="tour-description">{{ Str::limit($tour->description, 100, '...') }}</p> 
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>{{ number_format($tour->priceAdult, 0, ',', '.') }}</span> VND / người</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Destinations Area end -->
<style>
    /* CSS để đồng bộ kích thước các khung tour */
    .destination-item {
        height: 450px; /* Chiều cao cố định để đồng bộ tất cả khung */
        display: flex;
        flex-direction: column;
    }

    .destination-item .image {
        height: 200px; /* Chiều cao cố định cho hình ảnh */
        overflow: hidden;
    }

    .destination-item .image img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo */
        transition: transform 0.3s ease;
    }

    .destination-item .image img:hover {
        transform: scale(1.05);
    }

    .destination-item .content {
        padding: 15px;
        flex-grow: 1; /* Chiếm không gian còn lại */
    }

    .destination-item .destination-footer {
        padding: 10px 15px;
    }
</style>

        <!-- Popular Destinations Area start -->
<section class="popular-destinations-area rel z-1">
    <div class="container-fluid">
        <div class="popular-destinations-wrap br-20 bgc-lighter pt-100 pb-70">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-title text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h2>Explore Popular Destinations</h2>
                        <p>One site <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> most popular experience</p>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    @foreach($destinations as $index => $destination)
                        <div class="{{ $index < 2 || $index >= 4 ? 'col-xl-3 col-md-6' : 'col-md-6' }}">
                            <div class="destination-item style-two" data-aos="flip-up" data-aos-delay="{{ $index * 100 }}" data-aos-duration="1500" data-aos-offset="50">
                                <div class="image">
                                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                    <img src="{{ $destination->image ?? asset('clients/assets/images/destinations/default.jpg') }}" alt="{{ $destination->destination }}">
                                </div>
                                <div class="content">
                                    <h6>{{ $destination->destination }}</h6> <!-- Chỉ hiển thị tên destination -->
                                    <span class="time">{{ $destination->tourCount }} tours & activities</span>
                                    <a href="#" class="more"><i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Popular Destinations Area end -->
        <!-- Features Area start -->
        <section class="features-area pt-100 pb-45 rel z-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-6">
                        <div class="features-content-part mb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title mb-60">
                                <h2>The Ultimate Travel Experience Features That Set Our Agency Apart</h2>
                            </div>
                            <div class="features-customer-box">
                                <div class="image">
                                    <img src="{{ asset('clients/assets/images/features/features-box.jpg') }}" alt="Features">
                                </div>
                                <div class="content">
                                    <div class="feature-authors mb-15">
                                        <img src="{{ asset('clients/assets/images/features/feature-author1.jpg') }}" alt="Author">
                                        <img src="{{ asset('clients/assets/images/features/feature-author2.jpg') }}" alt="Author">
                                        <img src="{{ asset('clients/assets/images/features/feature-author3.jpg') }}" alt="Author">
                                        <span>4k+</span>
                                    </div>
                                    <h6>850K+ Happy Customer</h6>
                                    <div class="divider style-two counter-text-wrap my-25"><span><span class="count-text plus" data-speed="3000" data-stop="25">0</span> Years</span></div>
                                    <p>We pride ourselves offering personalized itineraries</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <div class="row pb-25">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <div class="icon"><i class="flaticon-tent"></i></div>
                                    <div class="content">
                                        <h5><a href="tour-details">Tent Camping</a></h5>
                                        <p>Tent camping is wonderful way to connect with nature</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="icon"><i class="flaticon-tent"></i></div>
                                    <div class="content">
                                        <h5><a href="tour-details">Kayaking</a></h5>
                                        <p>Kayaking is a thrilling outdoor activity that adventure</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item mt-20">
                                    <div class="icon"><i class="flaticon-tent"></i></div>
                                    <div class="content">
                                        <h5><a href="tour-details">Mountain Biking</a></h5>
                                        <p>Mountain biking is exhilarating sport that physical fitness</p>
                                    </div>
                                </div>
                                <div class="feature-item">
                                    <div class="icon"><i class="flaticon-tent"></i></div>
                                    <div class="content">
                                        <h5><a href="tour-details">Fishing & Boat</a></h5>
                                        <p>Fishing and boat bring joy quintessential activities that</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features Area end -->

        <!-- CTA Area start -->
        <section class="cta-area pt-100 rel z-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                        <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta1.jpg') }});">
                            <span class="category">Tent Camping</span>
                            <h2>Explore the world best tourism</h2>
                            <a href="tour-details" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Explore Tours">Explore Tours</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                        <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta2.jpg') }});">
                            <span class="category">Sea Beach</span>
                            <h2>World largest Sea Beach in Thailand</h2>
                            <a href="tour-details" class="theme-btn style-two">
                                <span data-hover="Explore Tours">Explore Tours</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta3.jpg') }});">
                            <span class="category">Water Falls</span>
                            <h2>Largest Water falls Bali, Indonesia</h2>
                            <a href="tour-details" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Explore Tours">Explore Tours</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA Area end -->
        @include('clients.blocks.footer')          
           
       