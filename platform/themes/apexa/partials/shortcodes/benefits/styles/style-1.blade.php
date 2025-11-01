@php
    function fix_smart_quotes($string)
    {
        // Chuyển smart quotes thành chuẩn
        $string = str_replace(['“', '”'], '"', $string);
        $string = str_replace(['‘', '’'], "'", $string);

        // Nếu có dư nhiều dấu "", gom lại thành một dấu "
    $string = preg_replace('/"+/', '"', $string); // Gộp nhiều " liên tiếp

        return $string;
    }
@endphp
<section id="benefits" class="benefits-style-1 py-5" @style($variablesStyle)>
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
    </div>
    <div class="container-fluid p-0">
        @foreach ($tabs as $item)
            @continue(!($title = Arr::get($item, 'title')))
            @php
                $isOdd = $loop->iteration % 2 !== 0;
                $bgClass = 'bg-img-' . $loop->iteration;

                $backgroundImage = Arr::get($item, 'background_image');
                $backgroundColor = Arr::get($item, 'background_color');

                $bgStyle = '';
                if ($backgroundImage) {
                    $bgStyle = 'style="background-image: url(' . RvMedia::getImageUrl($backgroundImage) . ');"';
                } elseif ($backgroundColor) {
                    $bgStyle = 'style="background-color: ' . $backgroundColor . ';"';
                }
            @endphp

            <div class="section-benefits-bg my-3 {{ $bgClass }}" {!! $bgStyle !!}>
                <div class="container">
            
                    <div class="row justify-content-center reverse-on-mobile {{ $isOdd ? 'row-reverse' : '' }}">
                        {{-- Benefits right --}}
                        <div class="col-lg-7 my-auto py-3 benefits-right"
                             data-aos="{{ $isOdd ? 'fade-left' : 'fade-right' }}">
                            <div class="benefits-right">
                                <h3 class="benefits-right-title">{!! BaseHelper::clean($title) !!}</h3>
                                @if ($description = Arr::get($item, 'description'))
                                    <div class="benefits-right-list">{!! fix_smart_quotes(BaseHelper::clean($description)) !!}</div>
                                @endif
                            </div>
                        </div>
                    
                        {{-- Benefits left --}}
                        <div class="col-lg-4 my-auto benefits-left benefits-left-{{ $loop->iteration }}"
                             data-aos="{{ $isOdd ? 'fade-right' : 'fade-left' }}">
                            @if ($iconImage = Arr::get($item, 'icon_image'))
                                {{ RvMedia::image($iconImage, 'icon') }}
                            @elseif($icon = Arr::get($item, 'icon'))
                                <x-core::icon :name="$icon" />
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

