<section id="section-staff" class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                {!! Theme::partial('shortcodes.team.partials.header', [
                    'shortcode' => $shortcode,
                    'wrapperClass' => 'text-center',
                ]) !!}
            </div>
        </div>
        <div class="row justify-content-center" style="overflow: hidden;">
            @if ($teams->count())
                {{-- Phần tử đầu tiên hiển thị riêng --}}
                @php $firstTeam = $teams->first(); @endphp
                <div class="col-12 col-md-3 mb-4">
                    <div class="team__item-four shine-animate-item">
                        <div class="team__thumb-four shine-animate">
                            <a href="{{ $firstTeam->url }}">
                                {{ RvMedia::image($firstTeam->photo, $firstTeam->name) }}
                            </a>
                        </div>
                        <div class="team__content-four">
                            <h2 class="title"><a href="{{ $firstTeam->url }}">{{ $firstTeam->name }}</a></h2>
                            @if ($title = $firstTeam->title)
                                <span>{{ $title }}</span>
                            @endif
                            <div class="team__social-four d-none">
                                {!! Theme::partial('shortcodes.team.partials.socials', ['team' => $firstTeam]) !!}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Swiper phần còn lại --}}
                <div class="col-12 col-md-9">
                    <div class="swiper swiper-team">
                        <div class="swiper-wrapper">
                            @foreach ($teams->slice(1) as $team)
                                <div class="swiper-slide">
                                    <div class="team__item-four shine-animate-item">
                                        <div class="team__thumb-four shine-animate">
                                            <a href="{{ $team->url }}">
                                                {{ RvMedia::image($team->photo, $team->name) }}
                                            </a>
                                        </div>
                                        <div class="team__content-four">
                                            <h2 class="title"><a href="{{ $team->url }}">{{ $team->name }}</a>
                                            </h2>
                                            @if ($title = $team->title)
                                                <span>{{ $title }}</span>
                                            @endif
                                            <div class="team__social-four d-none">
                                                {!! Theme::partial('shortcodes.team.partials.socials', ['team' => $team]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

