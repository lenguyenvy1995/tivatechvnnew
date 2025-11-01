@php
    $icons = ['ti ti-discount-check', 'ti ti-crown', 'ti ti-diamond'];
@endphp
<section class="pricing__area py-4 py-md-5 pricing__bg shortcode-pricing shortcode-pricing-style2" @style($variablesStyle)>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8">
                <div class="section-title text-center mb-30 tg-heading-subheading animation-style3">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="pricing__item-wrap">
            <div class="row pt-4">
                @foreach ($packages as $package)
                    <div @class($itemWrapperClass)>
                        <div class="pricing__box pricing__box_{{ $loop->iteration }}" data-aos="fade-left"
                            data-aos-duration="{{ $loop->iteration * 500 }}">
                            {{-- Ribbon chỉ hiện ở item 2 --}}
                            @if ($loop->iteration === 2)
                                <span class="ribbon ribbon--popular">HOT</span>
                            @endif
                            <div class="pricing__head">
                                <x-core::icon :name="$icons[$loop->iteration - 1]" />
                                {{-- Icon tương ứng theo vị trí --}}
                                <h3 class="title">{{ $package->name }}</h3>
                            </div>
                            <div class="pricing__price">
                                <h4 class="price"> {{ $package->price }} <span>VND</span> </h4>

                            </div>
                            <div class="pricing_content">
                                {!! $package->content !!}

                                <div class="pricing__list">
                                    <ul class="list-wrap">
                                        @foreach ($package->feature_list as $feature)
                                            <li>
                                                <span>
                                                    @if ($feature['is_available'])
                                                        <i class="fa fa-check text-success"></i>
                                                    @else
                                                        <i class="fa fa-ban text-danger"></i>
                                                    @endif
                                                    <span class="ms-2">{{ $feature['value'] }}</span>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            @if (($buttonLabel = $package->action_label) && ($buttonUrl = $package->action_url))
                                <div class="pricing__btn">
                                    <a href="{{ $buttonUrl }}" class="btn">{!! BaseHelper::clean($buttonLabel) !!}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="protect">
            <div class="protect-inner">
                <x-core::icon name="ti ti-shield-check-filled" />
                <p class="protect-content">Bảo hành vĩnh viễn khi dùng hosting tại <span><a href="tivatech.vn">Tivatech</a></span> </p>
            </div>
        </div>
    </div>

</section>
{{-- <div class="tiva-shape tiva-shape-bottom">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none" fill="#f15b2a17" preserveAspectRatio="none"
    width="100%" height="150">
        <path class="shape-fill" d="M421.9,6.5c22.6-2.5,51.5,0.4,75.5,5.3c23.6,4.9,70.9,23.5,100.5,35.7c75.8,32.2,133.7,44.5,192.6,49.7
    c23.6,2.1,48.7,3.5,103.4-2.5c54.7-6,106.2-25.6,106.2-25.6V0H0v30.3c0,0,72,32.6,158.4,30.5c39.2-0.7,92.8-6.7,134-22.4
    c21.2-8.1,52.2-18.2,79.7-24.2C399.3,7.9,411.6,7.5,421.9,6.5z"></path>
    </svg>
</div> --}}
