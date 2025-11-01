<section
    class="py-5 team__area-three marketing__area-home8 services__bg-seven shortcode-services shortcode-services-style-7"
    @style($variablesStyle)>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-7 col-lg-6 mb-30">
                <div class="section-title tg-heading-subheading animation-style3" data-aos="fade-down-right">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title text-white">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>

            @if ($description = $shortcode->description)
                <div class="col-xl-5 col-lg-6 mb-50">
                    <div class="section-content">
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    </div>
                </div>
            @endif
        </div>
        <div class="row gutter-24 d-none d-md-flex justify-content-center">
            @foreach ($services as $service)
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="card-services-type-01" data-aos="zoom-out" >
                        <div class="card-info">
                            <a title="{{ $service->name }}" href="{{ $service->url }}">
                                <h5>{{ $service->name }}</h5>
                            </a>
                            @if ($description = $service->description)
                                <a href="{{ $service->url }}">
                                    <p class="truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                                </a>
                            @endif
                        </div>
                        <div class="card-icon-custom">
                            <a title="{{ $service->name }}" href="{{ $service->url }}">
                                <div class=" services-icon icon-large">
                                    @if ($iconImage = $service->getMetaData('icon_image', true))
                                        {{ RvMedia::image($iconImage, 'icon') }}
                                    @elseif($icon = $service->getMetaData('icon', true))
                                        <x-core::icon :name="$icon" />
                                    @endif
                                </div>
                            </a>
                            <div class="link-arrow link-arrow-two">
                                <a href="{{ $service->url }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 15" fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.6293 3.27956C17.7117 2.80339 17.4427 2.34761 17.0096 2.17811C16.9477 2.15384 16.8824 2.13551 16.8144 2.12375L6.96087 0.419136C6.4166 0.325033 5.89918 0.689841 5.80497 1.23409C5.71085 1.77828 6.0757 2.29576 6.61988 2.38991L14.0947 3.68293L1.3658 12.6573C0.914426 12.9756 0.806485 13.5994 1.12473 14.0508C1.44298 14.5022 2.06688 14.6101 2.51825 14.2919L15.2471 5.31752L13.954 12.7923C13.8599 13.3365 14.2248 13.854 14.7689 13.9481C15.3132 14.0422 15.8306 13.6774 15.9248 13.1332L17.6293 3.27956Z"
                                            fill="currentcolor" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M17.6293 3.27956C17.7117 2.80339 17.4427 2.34761 17.0096 2.17811C16.9477 2.15384 16.8824 2.13551 16.8144 2.12375L6.96087 0.419136C6.4166 0.325033 5.89918 0.689841 5.80497 1.23409C5.71085 1.77828 6.0757 2.29576 6.61988 2.38991L14.0947 3.68293L1.3658 12.6573C0.914426 12.9756 0.806485 13.5994 1.12473 14.0508C1.44298 14.5022 2.06688 14.6101 2.51825 14.2919L15.2471 5.31752L13.954 12.7923C13.8599 13.3365 14.2248 13.854 14.7689 13.9481C15.3132 14.0422 15.8306 13.6774 15.9248 13.1332L17.6293 3.27956Z"
                                            fill="currentcolor" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
        <div class="row d-block d-md-none">
            <div class="swiper swiper-services">
                <div class="swiper-wrapper">
                    @foreach ($services as $service)
                        <div class="swiper-slide">
                            <div class="card-services-type-01">
                                <div class="card-info">
                                    <a title="{{ $service->name }}" href="{{ $service->url }}">
                                        <h5>{{ $service->name }}</h5>
                                    </a>
                                    @if ($description = $service->description)
                                        <a href="{{ $service->url }}">
                                            <p class="truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                                        </a>
                                    @endif
                                </div>
                                <div class="card-icon-custom">
                                    <a title="{{ $service->name }}" href="{{ $service->url }}">
                                        <div class="services-icon icon-large">
                                            @if ($iconImage = $service->getMetaData('icon_image', true))
                                                {{ RvMedia::image($iconImage, 'icon') }}
                                            @elseif($icon = $service->getMetaData('icon', true))
                                                <x-core::icon :name="$icon" />
                                            @endif
                                        </div>
                                    </a>
                                    <div class="link-arrow link-arrow-two">
                                        <a href="{{ $service->url }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 15" fill="none">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.6293 3.27956C17.7117 2.80339 17.4427 2.34761 17.0096 2.17811C16.9477 2.15384 16.8824 2.13551 16.8144 2.12375L6.96087 0.419136C6.4166 0.325033 5.89918 0.689841 5.80497 1.23409C5.71085 1.77828 6.0757 2.29576 6.61988 2.38991L14.0947 3.68293L1.3658 12.6573C0.914426 12.9756 0.806485 13.5994 1.12473 14.0508C1.44298 14.5022 2.06688 14.6101 2.51825 14.2919L15.2471 5.31752L13.954 12.7923C13.8599 13.3365 14.2248 13.854 14.7689 13.9481C15.3132 14.0422 15.8306 13.6774 15.9248 13.1332L17.6293 3.27956Z"
                                                    fill="currentcolor" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M17.6293 3.27956C17.7117 2.80339 17.4427 2.34761 17.0096 2.17811C16.9477 2.15384 16.8824 2.13551 16.8144 2.12375L6.96087 0.419136C6.4166 0.325033 5.89918 0.689841 5.80497 1.23409C5.71085 1.77828 6.0757 2.29576 6.61988 2.38991L14.0947 3.68293L1.3658 12.6573C0.914426 12.9756 0.806485 13.5994 1.12473 14.0508C1.44298 14.5022 2.06688 14.6101 2.51825 14.2919L15.2471 5.31752L13.954 12.7923C13.8599 13.3365 14.2248 13.854 14.7689 13.9481C15.3132 14.0422 15.8306 13.6774 15.9248 13.1332L17.6293 3.27956Z"
                                                    fill="currentcolor" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
        {{-- <div class="services-bottom-content">
            @if (($buttonLabel = $shortcode->button_label) && ($buttonUrl = $shortcode->button_url))
                <a href="{{ $buttonUrl }}" class="btn btn-two">{{ $buttonLabel }}</a>
            @endif
        </div> --}}
    </div>
</section>
