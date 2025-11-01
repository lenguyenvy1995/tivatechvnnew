<section id="procedure" class=" procedure-style-1 py-5" @style($variablesStyle)>
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
        {{-- strategy/procedure-tabs.blade.php on desktop- --}}
        <div class="procedure-tabs d-none d-lg-block">

            {{-- Tabs header --}}
            <ul class="nav nav-tabs justify-content-center" id="procedureTab" role="tablist">
                @foreach ($tabs as $item)
                    @php $title = Arr::get($item, 'title'); @endphp
                    @continue(!$title)

                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="proc-{{ $loop->index }}-tab"
                            data-bs-toggle="tab" data-bs-target="#proc-{{ $loop->index }}" type="button"
                            role="tab" aria-controls="proc-{{ $loop->index }}"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            <h3 class="nav-link-title">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}. {!! BaseHelper::clean($title) !!}
                            </h3>
                        </button>
                    </li>
                @endforeach
            </ul>
            {{-- Tabs content  --}}
            <div class="tab-content pt-4" id="procedureTabContent">
                @foreach ($tabs as $item)
                    @php $title = Arr::get($item, 'title'); @endphp
                    @continue(!$title)

                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="proc-{{ $loop->index }}"
                        role="tabpanel" aria-labelledby="proc-{{ $loop->index }}-tab">

                        <div class="row">
                            <div class="col-lg-7 mb-40">
                                <div class="procedure-item-left">
                                    <div class="procedure-item-left-img">
                                        @if ($iconImage = Arr::get($item, 'icon_image'))
                                            {{ RvMedia::image($iconImage, 'icon_image') }}
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 m-auto">
                                <div class="procedure-item-right">
                                    <div class="procedure-item-right-content">
                                        {{-- <h4 class="card-info-title">{!! BaseHelper::clean($title) !!}</h4> --}}
                                        @if ($description = Arr::get($item, 'description'))
                                            {!! BaseHelper::clean($description) !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
        {{-- MOBILE (<992px) --}}
        <div class="procedure-mobile d-lg-none">
            <div class="procedure-mobile-row g-3">
                @php $count = count($tabs); @endphp
                @foreach ($tabs as $item)
                    @php
                        $title = Arr::get($item, 'title');
                        $desc = Arr::get($item, 'description');
                        $img = Arr::get($item, 'icon_image');
                    @endphp
                    @continue(!$title)
                    {{-- Note 1: ở đầu --}}
                    @if ($loop->first)
                        <div class="row">
                            <div class="col-12 note-position">
                                <p class="text-center note-style note-style-1">
                                    {!! $shortcode->mobile_note_1 !!}
                                </p>
                           
                            </div>
                        </div>
                    @endif
                    <div class="row {{ $loop->iteration % 2 == 0 ? 'd-flex justify-content-end' : '' }}">
                        {{-- Nút mở popup --}}
                        <div class="col-10 col-sm-6   my-3">
                            <button type="button" class="w-100 text-start mobile-step-btn" data-bs-toggle="modal"
                                data-bs-target="#stepModal" data-step-id="step-{{ $loop->index }}">
                                <h3 class="step-title">{{ str_pad($loop->iteration, 2, '0z', STR_PAD_LEFT) }}.
                                    {!! BaseHelper::clean($title) !!}</span>
                            </button>
                        </div>
                    </div>
                    {{-- Note 2: ở giữa --}}
                    @if ($loop->iteration == ceil($count / 2))
                        <div class="row">
                            <div class="col-12 note-position">
                                <p class="text-center note-style note-style-2">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    {!! $shortcode->mobile_note_2 !!}
                                </p>
                             
                            </div>
                        </div>
                    @endif
                    {{-- Note 3: ở cuối --}}
                    @if ($loop->last)
                        <div class="row">
                            <div class="col-12 note-position">
                                <p class="text-center note-style note-style-3">
                                    {!! $shortcode->mobile_note_3 !!}
                                </p>

                            
                            </div>
                        </div>
                    @endif
                    {{-- Nội dung ẩn tương ứng (sẽ được nạp vào modal) --}}
                    <div id="content-step-{{ $loop->index }}" class="d-none">
                        <div class="pm-card">
                            @if ($iconImage = Arr::get($item, 'icon_image'))
                                {{ RvMedia::image($iconImage, 'icon_image') }}
                            @endif
                            <div class="pm-body">
                                @if ($description = Arr::get($item, 'description'))
                                    {!! BaseHelper::clean($description) !!}
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- Modal dùng chung --}}
        <div class="modal fade" id="stepModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md">
                <div class="modal-content mobile-popover">
                    <button type="button" class="btn-close pop-close ms-auto me-2 mt-2" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                    <div class="modal-body">
                        <div id="stepModalBody"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
