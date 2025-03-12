@include('clients.blocks.header')
@include('clients.blocks.banner')

<!-- Tour Grid Area start -->
<section class="tour-grid-page py-100 rel z-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                <div class="shop-sidebar">
                    <div class="div_filter_clear">
                        <button class="clear_filter" name="btn_clear">
                            <a href="#">Clear</a>
                        </button>
                    </div>
                    <div class="widget widget-filter">
                        <h6 class="widget-title">Lọc theo giá</h6>
                        <div class="price-filter-wrap">
                            <div class="price-slider-range"></div>
                            <div class="price">
                                <span>Giá </span>
                                <input type="text" id="price" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="widget widget-activity">
                        <h6 class="widget-title">Điểm đến</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="id_mien_bac" value="b">
                                <label for="id_mien_bac">Miền Bắc</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="id_mien_trung" value="t">
                                <label for="id_mien_trung">Miền Trung</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="domain" id="id_mien_nam" value="n">
                                <label for="id_mien_nam">Miền Nam</label>
                            </li>
                        </ul>
                    </div>

                    <div class="widget widget-reviews">
                        <h6 class="widget-title">Đánh giá</h6>
                        <ul class="radio-filter">
                            <li>
                                <input class="form-check-input" type="radio" name="filter_star" id="5star" value="5">
                                <label for="5star">★★★★★</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="filter_star" id="4star" value="4">
                                <label for="4star">★★★★☆</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="filter_star" id="3star" value="3">
                                <label for="3star">★★★☆☆</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="filter_star" id="2star" value="2">
                                <label for="2star">★★☆☆☆</label>
                            </li>
                            <li>
                                <input class="form-check-input" type="radio" name="filter_star" id="1star" value="1">
                                <label for="1star">★☆☆☆☆</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop-shorter rel z-3 mb-20">
                    <div class="sort-text mb-15 me-4 me-xl-auto">Tours tìm thấy</div>
                    <div class="sort-text mb-15 me-4">Sắp xếp theo</div>
                    <select id="sorting_tours">
                        <option value="default" selected>Sắp xếp theo</option>
                        <option value="new">Mới nhất</option>
                        <option value="old">Cũ nhất</option>
                        <option value="hight-to-low">Cao đến thấp</option>
                        <option value="low-to-high">Thấp đến cao</option>
                    </select>
                </div>

                <div class="tour-grid-wrap">
                    <div class="loader"></div>
                    <div class="row" id="tours-container">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tour Grid Area end -->
@include('clients.blocks.footer')
