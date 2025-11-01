<div class="brand-area py-5" @style(["background-color: $shortcode->background_color" => $shortcode->background_color])>
    <div class="container">
        @if ($title = $shortcode->title)
            <div class="row">
                <div class="col-12 section-title">
                    <div class="brand__content tg-heading-subheading animation-style3">
                        <h2 class="title tg-element-title">
                            {!! BaseHelper::clean($title) !!}
                        </h2>
                    </div>
                    <p class="sub-title ">
                        {!! BaseHelper::clean($shortcode->subtitle ?? 'Default subtitle') !!}
                    </p>
                </div>
            </div>
        @endif

        <div class="swiper-container  brand-active-left py-3">
            <div class="swiper-wrapper">
                @foreach ($tabs as $index => $tab)
                    @continue(!($image = Arr::get($tab, 'image')))
                    @if ($index % 2 === 0)
                        {{-- Chỉ lấy các index chẵn --}}
                        <div class="swiper-slide">
                            <div class="brand-item">
                                {{ RvMedia::image($image, Arr::get($tab, 'name')) }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <div class="swiper-container  brand-active-right py-3">
            <div class="swiper-wrapper">
                @foreach ($tabs as $index => $tab)
                    @continue(!($image = Arr::get($tab, 'image')))
                    @if ($index % 2 !== 0)
                        {{-- Chỉ lấy các index lẻ --}}
                        <div class="swiper-slide">
                            <div class="brand-item">
                                {{ RvMedia::image($image, Arr::get($tab, 'name')) }}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
