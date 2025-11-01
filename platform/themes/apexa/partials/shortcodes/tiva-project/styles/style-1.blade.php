<section id="tiva-project" class="tiva-project-style-1 py-5" @style($variablesStyle)>
    <div class="container-fluid">
        <div class="row justify-content-center mb-35">
            <div class="col-lg-8">
                <div class="section-title section-title-customner text-center tg-heading-subheading animation-style3">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title ">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                    <div class="underline m-auto"></div>
                </div>
            </div>
        </div>
        {{-- @dd($shortcode) --}}
        <div class="row">
            {{-- Swiper timeline --}}
            <div class="swiper tiva-projec-swiper">
                <div class="swiper-wrapper">
                    @foreach ($tabs as $item)
                        @php
                            $title = Arr::get($item, 'title');
                            $image = Arr::get($item, 'image');
                        @endphp
                        @continue(!$title)

                        <div class="swiper-slide">
                            <div class="tiva-project-item text-center">
                                <div class="tiva-project-icon">
                                    @if ($iconImage = Arr::get($item, 'image'))
                                        {{ RvMedia::image($iconImage, 'image') }}
                                    @else
                                    @endif
                                </div>
                                <h3 class="tiva-project-title">{!! BaseHelper::clean($title) !!}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Pagination chỉ hiện trên mobile --}}
                <div class="swiper-pagination d-lg-none"></div>
                {{-- Navigation (mobile) --}}
                <div class="swiper-button-prev d-lg-none"></div>
                <div class="swiper-button-next d-lg-none"></div>
            </div>

        </div>
    </div>
    @if ($bgImage = $shortcode->image_position)
        <div class="bg-gradient">
            {{ RvMedia::image($bgImage, 'full') }}
        </div>
    @endif
</section>
