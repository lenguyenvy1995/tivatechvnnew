@php
    Theme::set('pageTitle', __('Team Details'));
@endphp
@php
    $socials = $team->socials ?? [];
@endphp
<section class="team__details-area">
    <div class="container">
        <div class="team__details-inner">
            <div class="row align-items-center">
                @if ($image = $team->photo)
                    <div class="col-36">
                        <div class="team__details-img">
                            {{ RvMedia::image($image, $team->name, 'medium-square') }}
                        </div>
                    </div>
                @endif

                <div class="{{ $image ? 'col-64' : 'col-100' }}">
                    <div class="team__details-content">
                        <h2 class="title">{{ $team->name }}
                            @if ($title = $team->title)
                                {!! BaseHelper::clean($title) !!}
                            @endif
                        </h2>
                        @if ($description = $team->description)
                            <p class="slogan">{!! Basehelper::clean($description) !!}</p>
                        @endif
                        @if ($content = $team->content)
                            <div class="content">
                                {!! BaseHelper::clean($content) !!}
                            </div>
                        @endif
                        <div class="team__details-info">
                            <ul class="list-wrap">
                                @if ($phone = $team->phone)
                                    <li>
                                        <a href="tel:{{ $phone }}">  <i class="flaticon-phone-call"></i>
                                       {!! BaseHelper::clean($phone) !!}</a>
                                    </li>
                                @endif

                                @if ($email = $team->email)
                                    <li>
                                        <a href="mailto:{{ $email }}">  <i class="flaticon-mail"></i>
                                       {!! BaseHelper::clean($email) !!}</a>
                                    </li>
                                @endif

                                @php
                                    $socials = $team->socials ?? [];
                                @endphp

                                @if (!empty($socials['zalo']))
                                    {{-- Hiển thị Zalo --}}
                                    <li>
                                        <a href="https://zalo.me/{{ $socials['zalo'] }}" target="_blank" rel="noopener">
                                            {{-- SVG Zalo icon --}}
                                            {{-- Bạn có thể rút gọn, ở đây giữ nguyên theo yêu cầu --}}
                                            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="600.000000pt"
                                                height="600.000000pt" viewBox="0 0 600.000000 600.000000"
                                                preserveAspectRatio="xMidYMid meet">

                                                <g transform="translate(0.000000,600.000000) scale(0.100000,-0.100000)"
                                                    fill="#000000" stroke="none">
                                                    <path d="M1396 5539 c-249 -32 -473 -143 -646 -318 -181 -183 -271 -374 -304
                        -646 -14 -114 -16 -316 -16 -1565 0 -1586 0 -1593 62 -1790 127 -400 449 -675
                        874 -747 102 -17 203 -18 1629 -18 1386 0 1529 2 1621 17 302 51 555 208 727
                        451 86 120 155 285 177 423 6 38 15 94 20 124 5 30 12 111 16 180 l6 125 -83
                        -81 c-169 -163 -302 -256 -524 -365 -286 -141 -599 -231 -975 -281 -131 -17
                        -721 -17 -860 0 -446 56 -905 207 -1180 388 l-35 24 -65 -26 c-118 -48 -285
                        -85 -416 -91 -137 -7 -194 0 -194 24 0 8 17 36 39 62 50 60 103 158 132 246
                        32 96 33 215 3 265 -149 245 -209 368 -273 550 -286 827 -205 1820 206 2494
                        131 216 320 421 503 548 24 16 16 17 -175 16 -110 0 -231 -4 -269 -9z" />
                                                    <path d="M3820 3296 c0 -706 -12 -646 126 -646 l84 0 0 620 0 620 -105 0 -105
                        0 0 -594z" />
                                                    <path d="M1647 3873 c-4 -3 -7 -51 -7 -105 l0 -98 340 0 c212 0 340 -4 340
                        -10 0 -5 -13 -24 -28 -42 -16 -18 -112 -136 -213 -262 -495 -616 -469 -580
                        -469 -668 l0 -38 483 0 484 0 21 23 c18 19 22 35 22 95 l0 72 -355 0 c-195 0
                        -355 3 -355 8 0 4 47 66 103 137 57 72 194 245 305 385 111 140 216 273 234
                        294 50 61 68 105 68 163 l0 53 -483 0 c-266 0 -487 -3 -490 -7z" />
                                                    <path d="M4529 3586 c-144 -42 -252 -138 -311 -275 -31 -71 -33 -83 -33 -191
                        l0 -115 43 -87 c51 -106 123 -181 216 -226 93 -45 144 -55 250 -50 78 4 105
                        10 161 37 160 74 264 218 289 399 8 58 -9 160 -41 240 -36 90 -143 200 -234
                        241 -124 56 -218 63 -340 27z m261 -201 c56 -29 115 -92 142 -152 26 -58 22
                        -178 -7 -238 -25 -50 -82 -108 -137 -137 -59 -31 -183 -32 -248 -2 -92 43
                        -158 138 -167 242 -7 71 8 126 50 188 82 122 239 164 367 99z" />
                                                    <path d="M3034 3581 c-153 -44 -261 -148 -316 -305 -97 -281 83 -578 381 -627
                        94 -16 183 -1 277 46 40 19 75 35 78 35 3 0 6 -9 6 -20 0 -40 38 -60 117 -60
                        l73 0 0 460 0 460 -95 0 c-95 0 -95 0 -95 -25 0 -31 -8 -31 -70 0 -110 56
                        -241 69 -356 36z m243 -190 c213 -97 239 -382 47 -509 -136 -91 -317 -49 -403
                        93 -28 47 -35 69 -39 129 -4 63 -1 81 20 127 35 77 70 113 140 148 75 38 167
                        42 235 12z" />
                                                </g>
                                            </svg>
                                            {{ $team->name }}
                                        </a>
                                    </li>
                                @else
                                    {{-- Không có Zalo, tìm xem có Facebook không --}}
                                    @foreach ($socials as $name => $social)
                                        @if ($name === 'facebook' && !empty($social))
                                            <li>
                                                <a href="{{ $social }}" target="_blank" rel="noopener">
                                                    <x-core::icon name="ti ti-brand-facebook" />
                                                </a>
                                            </li>
                                            @break
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
