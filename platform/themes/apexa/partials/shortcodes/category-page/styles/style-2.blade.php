<section id="category-pages" class="category-pages-style-2  py-5" @style($variablesStyle)>
    <div class="container">
        {{-- Title --}}
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-6 ">
                <div class="section-title text-center tg-heading-subheading animation-style3" >
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>
        </div>
        {{-- Hiển thị tabs (thay vì pages) --}}
        @if (!empty($tabs))
            <div class="section-category-pages mt-4">
                <div class="row justify-content-center gutter-24">
                    @foreach ($tabs as $tab)
                        <div class="col-12 col-md-6 col-lg-4 mb-4">
                            @php
                                $isEven = $loop->index % 2 !== 0;
                            @endphp

                            <div
                                class="services__item-card  {{ $isEven ? 'services__item-card-style' : '' }} shine-animate-item">
                                {{-- Icon hình ảnh --}}
                                <a href="{{ $tab['url'] }}" >
                                    <div class="services__content-top icon-large text-center mb-3">
                                        <div class="services__content-top-icon shine-animate">
                                            @if ($iconImage = Arr::get($tab, 'image'))
                                                {!! RvMedia::image($iconImage, 'image') !!}
                                            @elseif($icon = Arr::get($tab, 'icon'))
                                                <x-core::icon :name="$icon" />
                                            @endif
                                        </div>
                                    </div>
                        
                                    <div class="services__content-body">
                                        <h2 class="title">
                                            {{ $tab['title'] ?? '' }}
                                        </h2>
                                        @if (!empty($tab['description']))
                                            <p class="truncate-3-custom mt-0 mb-3">
                                                {!! BaseHelper::clean(Str::limit($tab['description'], 150)) !!}
                                            </p>
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
