<section class="py-2 services__area-two shortcode-services shortcode-services-style-2" @style($variablesStyle)>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-5">
                <div class="section-title tg-heading-subheading animation-style3" data-aos="fade-right">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h3 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h3>
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

    </div>
    <div class="section-swiper-ads">
        <div class="container">
            <div class="row justify-content-center gutter-24">
                <div class="col-12">
                    <!-- Swiper container -->
                    <div class="swiper swiper-ads">
                        <div class="swiper-wrapper">
                            @foreach ($services as $service)
                                <div class="swiper-slide">
                                    <div class="services__item-slider ">
                                        <div class="services-slider__icon-two  icon-large">
                                            <a class="truncate-1-custom" title="{{ $service->name }}"
                                                href="{{ $service->url }}">
                                                @if ($iconImage = $service->getMetaData('icon_image', true))
                                                    {{ RvMedia::image($iconImage, 'icon') }}
                                                @elseif($icon = $service->getMetaData('icon', true))
                                                    <x-core::icon :name="$icon" />
                                                @endif
                                            </a>
                                        </div>
                                        <div class="services-slider__content-two">
                                            <h3 class="title">
                                                <a class="truncate-1-custom" title="{{ $service->name }}"
                                                    href="{{ $service->url }}">{{ $service->name }}</a>
                                            </h3>
                                            @if ($description = $service->description)
                                                <p class="truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                                            @endif
                                            <a href="{{ $service->url }}" class="btn">{{ __('Read More') }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Navigation buttons -->
                        <div class="swiper-button-next d-none d-md-flex"></div>
                        <div class="swiper-button-prev d-none d-md-flex"></div>
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
