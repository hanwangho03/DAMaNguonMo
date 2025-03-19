@include('clients.blocks.header')
@include('clients.blocks.banner')
<!--Search -->
<form >
        <div class="container container-1400">
            <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                    <span class="title">Điểm đến</span>
                    <select name="destination" id="destination">
                        <option value="">Chọn điểm đến</option>
                        <option value="dn">Đà Nẵng</option>
                        <option value="cd">Côn Đảo</option>
                        <option value="hn">Hà Nội</option>
                        <option value="hcm">TP. Hồ Chí Minh</option>
                        <option value="hl">Hạ Long</option>
                        <option value="nb">Ninh Bình</option>
                        <option value="pq">Phú Quốc</option>
                        <option value="dl">Đà Lạt</option>
                        <option value="qt">Quảng Trị</option>
                        <option value="kh">Khánh Hòa (Nha Trang)</option>
                        <option value="ct">Cần Thơ</option>
                        <option value="vt">Vũng Tàu</option>
                        <option value="qn">Quảng Ninh</option>
                        <option value="la">Lào Cai (Sa Pa)</option>
                        <option value="bd">Bình Định (Quy Nhơn)</option>
                    </select>
                    
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                    <span class="title">Ngày khởi hành</span>
                    <input type="text" id="start_date" name="start_date" class="datetimepicker datetimepicker-custom"
                        placeholder="Chọn ngày đi" readonly>
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                    <span class="title">Ngày kết thúc</span>
                    <input type="text" id="end_date" name="end_date" class="datetimepicker datetimepicker-custom"
                        placeholder="Chọn ngày về" readonly>
                </div>
                <div class="search-button">
                    <button class="theme-btn" type="submit">
                        <span data-hover="Tìm kiếm">Tìm kiếm</span>
                        <i class="far fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
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
            @foreach ($tours->items() as $tour)
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

        <!-- Hiển thị phân trang -->
        <div class="pagination-wrapper d-flex justify-content-center mt-4">
            {{ $tours->links('pagination') }}
        </div>
    </div>
</section>
<!-- Destinations Area end -->

@include('clients.blocks.footer')

<style>
    /* CSS cho phân trang */
    .pagination {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .pagination .page-item {
        margin: 0;
    }

    .pagination .page-link {
        padding: 8px 12px;
        font-size: 14px;
        color: #ffffff;
        background-color: #333;
        border: 1px solid #444;
        border-radius: 4px;
        text-align: center;
        min-width: 36px;
        display: flex;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: #ffffff;
        font-weight: 500;
    }

    .pagination .page-link:hover {
        background-color: #555;
        color: #ffffff;
        border-color: #666;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #222;
        color: #888;
        border-color: #333;
        cursor: not-allowed;
    }

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
