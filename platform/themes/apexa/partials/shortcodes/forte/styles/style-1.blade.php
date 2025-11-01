@php
    $inlineVars = collect($variablesStyle ?? [])->keys()->implode(';');
@endphp
{{-- @dd($shortcode) --}}
<section id="forte" class="sc-forte forte-style-1 py-4 " @if($inlineVars) style="{{ $inlineVars }}" @endif>
    <div class="container">
        <div class="row">
            {{-- LEFT --}}
            <div class="col-lg-6 my-auto">
                <div class="forte-content-left">
                    <div class="section-title forte-content-left-title text-star mb-30 tg-heading-subheading animation-style3">
                        @if ($title = ($shortcode->title ?? null))
                            <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                        @endif
                    </div>
                    @if ($subtitle = ($shortcode->subtitle ?? null))
                    <p class="forte-content-left-subtitle">{!! BaseHelper::clean($subtitle) !!}</p>
                @endif
                    <div class="forte-content-left-img">
                        @if ($image = ($shortcode->image ?? null))
                            <div class="introduction-image">
                                {{ RvMedia::image($image, 'image') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- RIGHT --}}
            <div class="col-lg-6">
                <div class="forte-content-right row">
                    {{-- Cột bên trái: 2 item đầu --}}
                    <div class="col-6 my-auto py-5 overflow-hidden">
                        @foreach(($tabs ?? []) as $idx => $item)
                            @php
                                $itemTitle = $item['title'] ?? '';
                                $itemDesc  = $item['description'] ?? '';
                                $iconUrl   = $item['image'] ?? null;
                                $bgColor   = $item['bg_color'] ?? null;
                                $itemStyle = $bgColor ? 'background-color:' . $bgColor . ';' : '';
                            @endphp
                            @continue(!$itemTitle)
                            @break($idx >= 2) {{-- chỉ lấy 2 item đầu --}}
                
                            <div class="mb-30">
                                <div class="card-forte"  data-aos="fade-left"
                                data-aos-duration="{{ 1000 + (($loop->iteration - 1) * 500) }}">
                                    <div class="card-icon" style="{{ $itemStyle }}">
                                        @if($iconUrl)
                                            <img src="{{ $iconUrl }}" alt="icon" class="icon">
                                        @endif
                                    </div>
                                    <div class="card-info">
                                        <h3 class="card-info-title">{!! BaseHelper::clean($itemTitle) !!}</h3>
                                        @if($itemDesc)
                                            <p class="card-info-itemdes">{!! BaseHelper::clean($itemDesc) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                
                    {{-- Cột bên phải: các item còn lại --}}
                    <div class="col-6">
                        @foreach(($tabs ?? []) as $idx => $item)
                            @continue($idx < 2) {{-- bỏ qua 2 item đầu --}}
                            @php
                                $itemTitle = $item['title'] ?? '';
                                $itemDesc  = $item['description'] ?? '';
                                $iconUrl   = $item['image'] ?? null;
                                $bgColor   = $item['bg_color'] ?? null;
                                $itemStyle = $bgColor ? 'background-color:' . $bgColor . ';' : '';
                            @endphp
                            @continue(!$itemTitle)
                
                            <div class="mb-30">
                                <div class="card-forte"  data-aos="fade-left"
                                data-aos-duration="{{ 1000 + (($loop->iteration - 1) * 500) }}">
                                    <div class="card-icon" style="{{ $itemStyle }}">
                                        @if($iconUrl)
                                            <img src="{{ $iconUrl }}" alt="icon" class="icon">
                                        @endif
                                    </div>
                                    <div class="card-info">
                                        <h3 class="card-info-title">{!! BaseHelper::clean($itemTitle) !!}</h3>
                                        @if($itemDesc)
                                            <p class="card-info-itemdes">{!! BaseHelper::clean($itemDesc) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DECOR / ANIMATION --}}
    @if(!empty($tabs_position))
        <div class="animation-icon-box">
            @foreach($tabs_position as $d)
                @php
                    $anim = $d['anim'] ?? [];
                    $animClass = match($anim['type'] ?? '') {
                        'up-down'      => 'ai-float-y',
                        'left-right'   => 'ai-float-x',
                        'rot-cw'       => 'ai-rot-cw',
                        'rot-ccw'      => 'ai-rot-ccw',
                        'rot-cw-full'  => 'ai-rot-cw-full',
                        'rot-ccw-full' => 'ai-rot-ccw-full',
                        default        => '',
                    };

                    $stylePlus = collect([
                        $d['style'] ?? '',
                        !empty($anim['duration']) ? 'animation-duration:' . $anim['duration'] . 's' : null,
                        !empty($anim['delay'])    ? 'animation-delay:'    . $anim['delay']    . 's' : null,
                        !empty($anim['amp'])      ? '--ampl:'             . $anim['amp']           : null,
                        !empty($anim['rotate'])   ? '--rot:'              . $anim['rotate']        : null,
                    ])->filter()->implode(';');
                @endphp

                @if(!empty($d['image']))
                    <div class="animation-icon {{ $animClass }}" @if($stylePlus) style="{{ $stylePlus }}" @endif>
                        <img src="{{ $d['image'] }}" alt="decor" class="icon-inner">
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    <div class="shape-e">
    </div>
</section>