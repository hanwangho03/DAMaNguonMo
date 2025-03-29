@include('clients.blocks.header')
@include('clients.blocks.banner')

<!-- Search -->
<form action="{{ route('tours.index') }}" method="GET">
    <div class="container container-1400">
        <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
            <div class="filter-item clearfix">
                <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                <span class="title">Điểm đến</span>
                <select name="destination" id="destination" class="form-select select2">
                    <option value="">Chọn hoặc nhập điểm đến</option>
                    <option value="Đà Nẵng">Đà Nẵng</option>
                    <option value="Côn Đảo">Côn Đảo</option>
                    <option value="Hà Nội">Hà Nội</option>
                    <option value="TP. Hồ Chí Minh">TP. Hồ Chí Minh</option>
                    <option value="Hạ Long">Hạ Long</option>
                    <option value="Ninh Bình">Ninh Bình</option>
                    <option value="Phú Quốc">Phú Quốc</option>
                    <option value="Đà Lạt">Đà Lạt</option>
                    <option value="Quảng Trị">Quảng Trị</option>
                    <option value="Khánh Hòa">Khánh Hòa (Nha Trang)</option>
                    <option value="Cần Thơ">Cần Thơ</option>
                    <option value="Vũng Tàu">Vũng Tàu</option>
                    <option value="Quảng Ninh">Quảng Ninh</option>
                    <option value="Lào Cai">Lào Cai (Sa Pa)</option>
                    <option value="Bình Định">Bình Định (Quy Nhơn)</option>
                </select>
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

        @if ($tours->isEmpty())
            <div class="text-center text-white">
                <p>Không tìm thấy tour nào phù hợp.</p>
            </div>
        @else
            <div class="row justify-content-center">
                @foreach ($tours->items() as $tour)
                    <div class="col-xxl-3 col-xl-4 col-md-6" style="margin-bottom: 30px">
                        <div class="destination-item block_tours" data-aos="fade-up" data-aos-duration="1500"
                            data-aos-offset="50">
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <a href="{{ route('tour-detail', ['id' => $tour->tourId]) }}">
                                    <img src="{{ $tour->images[0] ?? asset('clients/assets/images/default.jpg') }}"
                                        alt="Destination" class="tour-image">
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
                {{ $tours->appends(request()->query())->links('pagination') }}
            </div>
        @endif
    </div>
</section>
<!-- Destinations Area end -->

@include('clients.blocks.footer')

<!-- Thêm CSS và JS cho Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Khởi tạo Select2 -->
<script>
    $(document).ready(function() {
        $('#destination').select2({
            placeholder: "Chọn hoặc nhập điểm đến",
            allowClear: true,
            tags: true, // Cho phép nhập giá trị mới không có trong danh sách
            width: '100%',
            dropdownCssClass: 'custom-select2-dropdown' // Thêm class để tùy chỉnh dropdown
        });

        // Giữ giá trị đã chọn từ query string
        var selectedDestination = "{{ request()->query('destination') }}";
        if (selectedDestination) {
            // Nếu giá trị không có trong danh sách, thêm nó vào
            if (!$('#destination option[value="' + selectedDestination + '"]').length) {
                $('#destination').append(new Option(selectedDestination, selectedDestination, true, true));
            }
            $('#destination').val(selectedDestination).trigger('change');
        }
    });
</script>

<!-- CSS tùy chỉnh -->
<style>
    /* Ẩn select gốc nếu cần */
    .select2-hidden-accessible + .select2-container {
        display: block !important;
    }

    /* Tùy chỉnh Select2 */
    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 38px;
        border-radius: 5px;
        border: 1px solid #ced4da;
        background-color: #fff;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px;
        color: #495057;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }

    /* Tùy chỉnh dropdown */
    .custom-select2-dropdown {
        z-index: 1050; /* Đảm bảo dropdown hiển thị trên các phần tử khác */
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #007bff;
        color: white;
    }

    .search-filter-inner {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .filter-item {
        flex: 1;
        min-width: 200px;
    }

    .search-button {
        margin-left: auto;
    }

    /* Đảm bảo không có trùng lặp */
    .form-select:not(.select2-hidden-accessible) {
        display: none !important;
    }
    .destination-item .image {
    position: relative;
    width: 100%;
    height: 200px; /* Chiều cao cố định cho tất cả ảnh */
    overflow: hidden; /* Ẩn phần ảnh vượt quá kích thước */
}

.destination-item .image img.tour-image {
    width: 100%;
    height: 100%;
    object-fit: cover; /* Đảm bảo ảnh được cắt và lấp đầy khung mà không bị méo */
    display: block;
}

.destination-item .heart {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
    color: #fff;
    font-size: 20px;
}
</style>