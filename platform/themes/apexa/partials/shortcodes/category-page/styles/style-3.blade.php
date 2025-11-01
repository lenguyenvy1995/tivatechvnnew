<section id="category-pages" class="category-pages-style-3  py-5" @style($variablesStyle)>
    <div class="container-xxl">
        <div class="row align-items-center" style="justify-content: space-around;">
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
                <div class="col-lg-6">
                    <div class="section-content" data-aos="fade-left">
                        <i class="fa-solid fa-quote-left"></i>
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Hiển thị tabs (thay vì pages) --}}
        @if (!empty($tabs))
            <div class="section-category-pages mt-5">
                <div class="row justify-content-center gutter-24">
                    @foreach ($tabs as $tab)
                        <div class="col-12 col-md-6 col-lg-3 mb-4">
                            @php
                                $isEven = $loop->index % 2 !== 0;
                            @endphp

                            <div class="services__item-card  {{ $isEven ? 'services__item-card-style' : '' }} shine-animate-item">
                                {{-- Icon hình ảnh --}}
                                <a href="{{ $tab['url'] }}">
                                    <div class="services__content-top icon-large text-center">
                                        <div class="services__content-top-icon  shine-animate">
                                            @if ($iconImage = Arr::get($tab, 'image'))
                                                {!! RvMedia::image($iconImage, 'image') !!}
                                            @elseif($icon = Arr::get($tab, 'icon'))
                                                <x-core::icon :name="$icon" />
                                            @endif
                                        </div>
                                   
                                    </div>

                                    {{-- Nội dung --}}
                                    <div class="services__content-body">
                                        <h2 class="title">
                                            {{ $tab['title'] ?? '' }}
                                        </h2>
                                        @if (!empty($tab['description']))
                                            <p class="truncate-3-custom mt-0 mb-3">
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
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
