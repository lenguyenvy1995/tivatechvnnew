<section id="procedure" class="procedure-timeline shortcode-procedure-style2 py-5" @style($variablesStyle)>
    <div class="container">
        {{-- Tiêu đề --}}
        <div class="row justify-content-center mb-35">
            <div class="col-xl-4 col-lg-4">
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
                <div class="col-xl-8 col-lg-8">
                    <div class="section-content" data-aos="fade-left">
                        <i class="fa-solid fa-quote-left"></i>
                        <p>{!! BaseHelper::clean($description) !!}</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Swiper timeline --}}
        <div class="swiper procedure-swiper">
            <div class="swiper-wrapper">
                @foreach ($tabs as $item)
                    @php
                        $title = Arr::get($item, 'title');
                        $icon = Arr::get($item, 'icon');
                        $description = Arr::get($item, 'description');
                    @endphp
                    @continue(!$title)

                    <div class="swiper-slide">
                        <div class="step-item text-center">
                            <h3 class="step-title">{!! BaseHelper::clean($title) !!}</h3>
                            <div class="step-icon">
                                @if ($iconImage = Arr::get($item, 'icon_image'))
                                    {{ RvMedia::image($iconImage, 'icon') }}
                                @elseif($icon = Arr::get($item, 'icon'))
                                    <x-core::icon :name="$icon" />
                                @else
                                    <span class="default-icon">{{ $loop->iteration }}</span>
                                @endif
                            </div>
                            <p class="step-desc">{!! BaseHelper::clean($description) !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            {{-- Pagination chỉ hiện trên mobile --}}
            <div class="swiper-pagination d-lg-none"></div>
        </div>

    </div>
</section>
