@php
    $bgColor = $shortcode->background_color;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;
    $variablesStyle = [
        "--background-color: $bgColor" => $bgColor,
        "--background-image: url($bgImage)" => $bgImage,
    ];
@endphp

<div class="brand-ads py-5" @style($variablesStyle)>
    <div class="container">

        {{-- Title & Subtitle --}}
        @if ($title = $shortcode->title)
            <div class="row">
                <div class="col-12 section-title text-center  mb-4" data-aos="zoom-in">
                    <div class="brand__content tg-heading-subheading animation-style3">
                        <h2 class="title tg-element-title">
                            {!! BaseHelper::clean($title) !!}
                        </h2>
                    </div>
                    @if ($title = $shortcode->subtitle)
                        <p class="sub-title mt-2 text-muted">
                            {!! BaseHelper::clean($shortcode->subtitle ?? 'Default subtitle') !!}
                        </p>
                    @endif
                </div>
            </div>
        @endif

        {{-- Logo grid --}}
        <div class="row justify-content-center g-4">
            @foreach ($tabs as $tab)
                @continue(!($image = Arr::get($tab, 'image')))
                @php $name = Arr::get($tab, 'name'); @endphp
                <div class="col-6 col-md-4 col-xl-3 text-center m-auto" data-aos="zoom-out-up" data-aos-delay="350">
                    <a href="{{ Arr::get($tab, 'url') }}" title="{{ $name }}"
                        class="d-block text-decoration-none">
                        <div class="bg-white p-3 rounded-3 shadow-sm h-100 hover-shadow transition">
                            {{ RvMedia::image($image, $name) }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</div>
