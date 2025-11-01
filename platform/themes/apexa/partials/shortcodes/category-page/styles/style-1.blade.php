<section id="category-pages" class="category-pages-style-1  py-5" @style($variablesStyle)>
    <div class="container">
        {{-- Title --}}
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-5">
                <div class="section-title tg-heading-subheading animation-style3" data-aos="fade-right">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>

            @if ($description = $shortcode->description)
                <div class="col-xl-7 col-lg-7">
                    <div class="section-content" data-aos="fade-left">
                        <i class="fa-solid fa-quote-left"></i>
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Hiển thị tabs (thay vì pages) --}}
        @if (!empty($tabs))
            <div class="section-category-pages mt-4">
                <div class="row justify-content-center gutter-24">
                    <div class="col-12">
                        <div class="swiper category-pages">
                            <div class="swiper-wrapper">
                                @foreach ($tabs as $tab)
                                    <div class="swiper-slide">
                                        <div class="services__item-slider">
                                            {{-- Icon hình ảnh --}}
                                            <div class="services-slider__icon-two icon-large text-center mt-3">
                                                <a href="{{ $tab['url'] }}">
                                                    @if ($iconImage = Arr::get($tab, 'image'))
                                                        {!! RvMedia::image($iconImage, 'image') !!}
                                                    @endif
                                                </a>
                                            </div>

                                            {{-- Nội dung --}}
                                            <div class="services-slider__content-two p-3 text-center">
                                                <a href="{{ $tab['url'] }}">
                                                    <h3 class="title mb-2">
                                                        {{ $tab['title'] ?? '' }}
                                                    </h3>
                                                </a>
                                                @if (!empty($tab['description']))
                                                    <p class="truncate-3-custom mb-3">
                                                        {!! BaseHelper::clean(Str::limit($tab['description'], 150)) !!}
                                                    </p>
                                                @endif

                                                {{-- Nút chuyển trang nếu có URL --}}
                                                @if (!empty($tab['url']))
                                                    <a href="{{ $tab['url'] }}" class="btn btn-outline-primary">
                                                        Xem Ngay
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="swiper-button-next d-none d-md-flex"></div>
                            <div class="swiper-button-prev d-none d-md-flex"></div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
