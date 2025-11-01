<section id="why-us" class="why-us-style-1 py-5" @style($variablesStyle)>
    <div class="container">
        {{-- @dd($shortcode) --}}
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
        <div class="row">
            @foreach($tabs as $item)
            @continue(! $title = Arr::get($item, 'title'))

            <div class="col-lg-4 mb-40">
                <div class="card card-why-us">
                    <div class="card-icon">
                        @if($iconImage = Arr::get($item, 'icon_image'))
                            {{ RvMedia::image($iconImage, 'icon') }}
                        @elseif($icon = Arr::get($item, 'icon'))
                            <x-core::icon :name="$icon"/>
                        @endif
                    </div>
                    <div class="card-info">
                        <h3 class="card-info-title">{!! BaseHelper::clean($title) !!}</h3>

                        @if ($description = Arr::get($item, 'description'))
                            <p class="card-info-description">{!! BaseHelper::clean($description) !!}</p>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</section>
