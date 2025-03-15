@include('clients.blocks.header')
@include('clients.blocks.banner')
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
                    <form method="post" action="clients/contact.html">
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
                    <a href="clients/contact.html"><i class="fab fa-twitter"></i></a>
                    <a href="clients/contact.html"><i class="fab fa-facebook-f"></i></a>
                    <a href="clients/contact.html"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                </div>
            </div>
        </section>
        <!--End Hidden Sidebar -->
       
        
        <!-- Page Banner Start -->
        <section class="page-banner-two rel z-1">
            <div class="container-fluid">
                <hr class="mt-0">
                <div class="container">
                    <div class="banner-inner pt-15 pb-25">
                    <h2 class="page-title mb-10 aos-init aos-animate" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">{{ $tourDetail->destination }}</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb justify-content-center mb-20" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Tour Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <!-- Page Banner End -->
        
        
<!-- Tour Gallery start -->
@if (!empty($tourDetail->images) && count($tourDetail->images) > 0)
    <div class="tour-gallery">
        <div class="container-fluid">
            <div class="row gap-10 justify-content-center rel">
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item">
                        <img src="{{ asset(str_replace('\\', '/', $tourDetail->images[0])) }}" alt="Destination">
                    </div>
                    @if (isset($tourDetail->images[3]))
                        <div class="gallery-item">
                            <img src="{{ asset(str_replace('\\', '/', $tourDetail->images[3])) }}" alt="Destination">
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-6">
                    @if (isset($tourDetail->images[1]))
                        <div class="gallery-item">
                            <img src="{{ asset(str_replace('\\', '/', $tourDetail->images[1])) }}" alt="Destination">
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-md-6">
                    @if (isset($tourDetail->images[2]))
                        <div class="gallery-item">
                            <img src="{{ asset(str_replace('\\', '/', $tourDetail->images[2])) }}" alt="Destination">
                        </div>
                    @endif
                </div>
                <div class="col-lg-12">
                    <div class="gallery-more-btn">
                        <a href="" class="theme-btn style-two bgc-secondary">
                            <span data-hover="See All Photos">See All Photos</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!-- Tour Gallery End -->
        
        
        <!-- Tour Header Area start -->
        <section class="tour-header-area pt-70 rel z-1">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-6 col-lg-7">
                        <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <span class="location d-inline-block mb-10" style="color: black;">
                                <i class="fal fa-map-marker-alt"></i> {{ $tourDetail->destination }}
                            </span>
                            <div class="section-title pb-5">
                                <h2>{{ $tourDetail->titlle }}</h2>
                            </div>
                            <div class="ratting">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 text-lg-end" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <div class="tour-header-social mb-10">
                            <a href="#"><i class="far fa-share-alt"></i>Share tours</a>
                            <a href="#"><i class="fas fa-heart bgc-secondary"></i>Wish list</a>
                        </div>
                    </div>
                </div>
                <hr class="mt-50 mb-70">
            </div>
        </section>
        <!-- Tour Header Area end -->
        
        
        <!-- Tour Details Area start -->
        <section class="tour-details-page pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="tour-details-content">
                            <h3>Khám Phá Tour</h3>
                            <p>{{ $tourDetail->description }} </p>
                            <div class="row pb-55">
                                <div class="col-md-6">
                                    <div class="tour-include-exclude mt-30">
                                        <h5>Bao gồm và không bao gồm</h5>
                                        <ul class="list-style-one check mt-25">
                                            <li><i class="far fa-check"></i> Dịch vụ đón và trả khách</li>
                                            <li><i class="far fa-check"></i> 1 bữa ăn mỗi ngày</li>
                                            <li><i class="far fa-check"></i> Bữa tối trên du thuyền & Sự kiện âm nhạc</li>
                                            <li><i class="far fa-check"></i> Tham quan 7 địa điểm tuyệt vời nhất trong thành phố
                                            </li>
                                            <li><i class="far fa-check"></i> Nước đóng chai trên xe buýt</li>
                                            <li><i class="far fa-check"></i> Phương tiện di chuyển Xe buýt du lịch hạng sang
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="tour-include-exclude mt-30">
                                        <h5>Không bao gồm</h5>
                                        <ul class="list-style-one mt-25">
                                            <li><i class="far fa-times"></i> Tiền boa</li>
                                            <li><i class="far fa-times"></i> Đón và trả khách tại khách sạn</li>
                                            <li><i class="far fa-times"></i> Bữa trưa, Đồ ăn & Đồ uống</li>
                                            <li><i class="far fa-times"></i> Nâng cấp tùy chọn lên một ly</li>
                                            <li><i class="far fa-times"></i> Dịch vụ bổ sung</li>
                                            <li><i class="far fa-times"></i> Bảo hiểm</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Hoạt động</h3>
                        <div class="tour-activities mt-30 mb-45">
                            <div class="tour-activity-item">
                                <i class="flaticon-hiking"></i>
                                <b>Leo núi</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-fishing"></i>
                                <b>Câu cá</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-man"></i>
                                <b>Bắn súng kayak</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-kayak-1"></i>
                                <b>Chèo thuyền kayak</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-bonfire"></i>
                                <b>Đốt lửa trại</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-flashlight"></i>
                                <b>Khám phá ban đêm</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-cycling"></i>
                                <b>Đạp xe</b>
                            </div>
                            <div class="tour-activity-item">
                                <i class="flaticon-meditation"></i>
                                <b>Yoga</b>
                            </div>
                        </div>

                        <h3>Lịch trình</h3>
                <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                    @php
                        $day = 1;
                    @endphp
                    @foreach ($tourDetail->timeline as $timeline)
                        <div class="accordion-item">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo{{ $timeline->timeLineId }}">
                                    Ngày {{ $day++ }} - {{ $timeline->title }}
                                </button>
                            </h5>
                            <div id="collapseTwo{{ $timeline->timeLineId }}" class="accordion-collapse collapse"
                                data-bs-parent="#faq-accordion-two">
                                <div class="accordion-body">
                                    <p>{!! $timeline->description !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                        <h3>Maps</h3>
                        <div class="tour-map mt-30 mb-50">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15679.59852528636!2d106.66017212570805!3d10.776889249759795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752fb5976424f3%3A0x3f7773b7c58b90f4!2zVFAuIEjhu5MgQ2jDrSBNaW5oLCBWaeG7h3QgTmFt!5e0!3m2!1sen!2sbd!4v1706508986625!5m2!1sen!2sbd" 
                                style="border:0; width: 100%;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <h3>Clients Reviews</h3>
                        <div class="clients-reviews bgc-black mt-30 mb-60">
                            <div class="left">
                                <b>4.8</b>
                                <span>(586 reviews)</span>
                                <div class="ratting">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            <div class="right">
                                <div class="ratting-item">
                                    <span class="title">Services</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Guides</span>
                                    <span class="line"><span style="width: 70%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Price</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Safety</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Foods</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <div class="ratting-item">
                                    <span class="title">Hotels</span>
                                    <span class="line"><span style="width: 80%;"></span></span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Clients Comments</h3>
                        <div class="comments mt-30 mb-60">
                            <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="clients/assets/images/blog/comment-author1.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>Lonnie B. Horwitz</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                            <div class="comment-body comment-child" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="clients/assets/images/blog/comment-author2.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>William G. Edwards</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                            <div class="comment-body" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="author-thumb">
                                    <img src="clients/assets/images/blog/comment-author3.jpg" alt="Author">
                                </div>
                                <div class="content">
                                    <h6>Jaime B. Wilson</h6>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span class="time">Venice, Rome and Milan – 9 Days 8 Nights</span>
                                    <p>Tours and travels play a crucial role in enriching lives by offering unique experiences, cultural exchanges, and the joy of exploration.</p>
                                    <a class="read-more" href="#">Reply <i class="far fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Add Reviews</h3>
                        <form id="comment-form" class="comment-form bgc-lighter z-1 rel mt-30" name="review-form" action="#" method="post" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                           <div class="comment-review-wrap">
                               <div class="comment-ratting-item">
                                    <span class="title">Services</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Guides</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Price</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Safety</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Foods</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                               <div class="comment-ratting-item">
                                    <span class="title">Hotels</span>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-30 mb-40">
                            <h5>Leave Feedback</h5>
                            <div class="row gap-20 mt-20">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="full-name">Name</label>
                                        <input type="text" id="full-name" name="full-name" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" id="phone" name="phone" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email-address">Email</label>
                                        <input type="email" id="email-address" name="email" class="form-control" value="" required="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Comments</label>
                                        <textarea name="message" id="message" class="form-control" rows="5" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn bgc-secondary style-two">
                                            <span data-hover="Submit reviews">Submit reviews</span>
                                            <i class="fal fa-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                        <div class="blog-sidebar tour-sidebar">
                           
                            <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Tour Booking</h5>
                                <form action="#">
                                    <div class="date mb-25">
                                        <b>From Date</b>
                                        <input type="date">
                                    </div>
                                    <hr>
                                    <div class="time py-5">
                                        <b>Time :</b>
                                        <ul class="radio-filter">
                                            <li>
                                                <input class="form-check-input" checked type="radio" name="time" id="time1">
                                                <label for="time1">12:00</label>
                                            </li>
                                            <li>
                                                <input class="form-check-input" type="radio" name="time" id="time2">
                                                <label for="time2">08:00</label>
                                            </li>
                                        </ul>
                                    </div>
                                    <hr class="mb-25">
                                    <h6>Tickets:</h6>
                                    <ul class="tickets clearfix">
                                        <li>
                                            Adult (18- years) <span class="price">$28.50</span>
                                            <select name="18-" id="18-">
                                                <option value="value1">01</option>
                                                <option value="value1">02</option>
                                                <option value="value1" selected>03</option>
                                            </select>
                                        </li>
                                        <li>
                                            Adult (18+ years) <span class="price">$50.40</span>
                                            <select name="18+" id="18+">
                                                <option value="value1">01</option>
                                                <option value="value1">02</option>
                                                <option value="value1">03</option>
                                            </select>
                                        </li>
                                    </ul>
                                    <hr class="mb-25">
                                    <h6>Add Extra:</h6>
                                    <ul class="radio-filter pt-5">
                                        <li>
                                            <input class="form-check-input" checked type="radio" name="AddExtra" id="add-extra1">
                                            <label for="add-extra1">Add service per booking <span>$50</span></label>
                                        </li>
                                        <li>
                                            <input class="form-check-input" type="radio" name="AddExtra" id="add-extra2">
                                            <label for="add-extra2">Add service per personal <span>$24</span></label>
                                        </li>
                                    </ul>
                                    <hr>
                                    <h6>Total: <span class="price">$74</span></h6>
                                    <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                        <span data-hover="Book Now">Book Now</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </button>
                                    <div class="text-center">
                                        <a href="clients/contact.html">Need some help?</a>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h5 class="widget-title">Need Help?</h5>
                                <ul class="list-style-one">
                                    <li><i class="far fa-envelope"></i> <a href="mailto:helpxample@gmail.com">helpxample@gmail.com</a></li>
                                    <li><i class="far fa-phone-volume"></i> <a href="tel:+00012345688">+000 (123) 456 88</a></li>
                                </ul>
                            </div>
                            
                            <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <div class="content text-white">
                                    <span class="h6">Explore The World</span>
                                    <h3>Best Tourist Place</h3>
                                    <a href="clients/tour-grid.html" class="theme-btn style-two bgc-secondary">
                                        <span data-hover="Explore Now">Explore Now</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>
                                <div class="image">
                                    <img src="clients/assets/images/widgets/cta-widget.png" alt="CTA">
                                </div>
                                <div class="cta-shape"><img src="clients/assets/images/widgets/cta-shape3.png" alt="Shape"></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Tour Details Area end -->
        
        @include('clients.blocks.new_letter')
        @include('clients.blocks.footer')
    <!--End pagewrapper-->
   
    
    <!-- Jquery -->
    <script src="clients/assets/js/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="clients/assets/js/bootstrap.min.js"></script>
    <!-- Appear Js -->
    <script src="clients/assets/js/appear.min.js"></script>
    <!-- Slick -->
    <script src="clients/assets/js/slick.min.js"></script>
    <!-- Magnific Popup -->
    <script src="clients/assets/js/jquery.magnific-popup.min.js"></script>
    <!-- Nice Select -->
    <script src="clients/assets/js/jquery.nice-select.min.js"></script>
    <!-- Image Loader -->
    <script src="clients/assets/js/imagesloaded.pkgd.min.js"></script>
    <!-- Skillbar -->
    <script src="clients/assets/js/skill.bars.jquery.min.js"></script>
    <!-- Isotope -->
    <script src="clients/assets/js/isotope.pkgd.min.js"></script>
    <!--  AOS Animation -->
    <script src="clients/assets/js/aos.js"></script>
    <!-- Custom script -->
    <script src="clients/assets/js/script.js"></script>

</body>
</html>