<section id="service-banner" @style($variablesStyle) class="service-banner-style-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="service-banner-left">
                    <div class="section-title tg-heading-subheading animation-style3">
                        @if ($title = $shortcode->title)
                            <h1 class="title tg-element-title  text-center">{!! BaseHelper::clean($title) !!}</h1>
                        @endif
                    </div>
                    <div class="section-content">
                        @if ($data_count_description = $shortcode->data_count_description)
                            <p class="intro-description">{!! BaseHelper::clean($data_count_description) !!}</p>
                        @endif
                    </div>
                    @php
                        $btnTitle = trim($shortcode->title_btn ?? '') ?: 'Báo Giá Ngay';
                        $btnUrl = trim($shortcode->btn_url ?? '') ?: '#bao-gia';
                    @endphp

                    <a href="{{ $btnUrl }}" class="btn btn-style">
                        <span class="aos-init aos-animate" data-aos="fade-right" data-aos-offset="0"
                            data-aos-duration="1800">
                            {{ $btnTitle }}
                        </span>
                    </a>

                    <div class="scroll-bottom">
                        <span class="aos-init aos-animate" data-aos="fade-right" data-aos-offset="0"
                            data-aos-duration="1800">
                            » hoặc kéo xuống để tìm hiểu thêm
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 m-auto ">
                <div class="service-banner-right">
                    @if ($image = $shortcode->image)
                        <div class="introduction-image">
                            {{ RvMedia::image($image, 'image') }}
                        </div>
                    @endif


                </div>
            </div>
        </div>

    </div>
    @php
        $quantity = (int) ($shortcode->quantity ?? 0);
    @endphp

    <div class="animation-icon-box">
        @for ($i = 1; $i <= $quantity; $i++)
            @php
                $data = $shortcode->toArray();

                $image = Arr::get($data, "image_$i");
                if (!$image) {
                    continue;
                }

                // vị trí
                $numOrUnit = function ($v, $fallback = null) {
                    if ($v === null || $v === '') {
                        return $fallback;
                    }
                    return is_numeric($v) ? $v . 'px' : $v;
                };
                $top = $numOrUnit(Arr::get($data, "top_$i"));
                $right = $numOrUnit(Arr::get($data, "right_$i"));
                $bottom = $numOrUnit(Arr::get($data, "bottom_$i"));
                $left = $numOrUnit(Arr::get($data, "left_$i"));

                // animation
                $anim = Arr::get($data, "animation_$i"); // up-down | left-right | rot-cw | rot-ccw | ''
                $duration = Arr::get($data, "duration_$i", '3'); // giây
                $delay = Arr::get($data, "delay_$i", '0'); // giây
                $ampl = $numOrUnit(Arr::get($data, "amplitude_$i"), '12px');
                $rotate = $numOrUnit(Arr::get($data, "rotate_$i"), '10deg');

                $animClass = match ($anim) {
                    'up-down' => 'ai-float-y',
                    'left-right' => 'ai-float-x',
                    'rot-cw'       => 'ai-rot-cw',
                    'rot-ccw'      => 'ai-rot-ccw',
                    'rot-cw-full' => 'ai-rot-cw-full', // mới
                    'rot-ccw-full' => 'ai-rot-ccw-full', // mới
                    default => '',
                };

                // style inline
                $styleParts = collect([
                    'top' => $top,
                    'right' => $right,
                    'bottom' => $bottom,
                    'left' => $left,
                    '--ampl' => $ampl,
                    '--rot' => $rotate,
                ])
                    ->filter()
                    ->map(fn($v, $k) => "$k: $v");

                if ($animClass) {
                    $styleParts->push("animation-duration: {$duration}s");
                    $styleParts->push("animation-delay: {$delay}s");
                }

                $style = $styleParts->implode('; ');
            @endphp

            <div class="animation-icon animation-icon_{{ $i }} {{ $animClass }}"
                @if ($style) style="{{ $style }}" @endif>
                <img src="{{ RvMedia::getImageUrl($image) }}" alt="Image {{ $i }}" class="icon-inner">
            </div>
        @endfor
    </div>
    <div class="rounded">
    </div>
    <div class="banner-shape">
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none"
            width="100%" height="220">
            <path fill="#fff"
                d="M0,256L40,250.7C80,245,160,235,240,224C320,213,400,203,480,176C560,149,640,107,720,106.7C800,107,880,149,960,181.3C1040,213,1120,235,1200,234.7C1280,235,1360,213,1400,202.7L1440,192L1440,320L0,320Z" />
        </svg>
    </div>
</section>
