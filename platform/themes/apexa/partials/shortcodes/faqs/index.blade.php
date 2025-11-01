@php
    $isFloatingBlockEnabled = $shortcode->floating_block_title || $shortcode->floating_block_description;
@endphp

<section class="py-5 faqs__area-six shortcode-faq">
    <div class="circle" data-parallax='{"x" : 100 , "y" : 100 }'></div>
    <div class="container">
        <div class="row align-items-center justify-content-center">
            @if($isFloatingBlockEnabled)
                <div class="col-lg-5 mb-30">
                    <div class="box-need-help">
                        @if ($image = $shortcode->image)
                            {{ RvMedia::image($image, 'faq') }}
                        @endif

                        <div class="box-text-need-help d-none">
                            @if ($floatingBlockIcon = $shortcode->floating_block_icon)
                                <x-core::icon :name="$floatingBlockIcon"/>
                            @endif

                            @if ($floatingBlockTitle = $shortcode->floating_block_title)
                                <h3>{!! BaseHelper::clean($floatingBlockTitle) !!}</h3>
                            @endif

                            @if ($floatingBlockDescription = $shortcode->floating_block_description)
                                <p>{!! BaseHelper::clean($floatingBlockDescription) !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div @class(['mb-30', 'col-lg-7' => $isFloatingBlockEnabled, 'col-lg-8' => ! $isFloatingBlockEnabled])>
                <div class="box-faq-right">
                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title mb-20">{!! BaseHelper::clean($title) !!}</h2>
                    @endif

                    @if ($description = $shortcode->description)
                        <p class="tg-element-title mb-40">{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    <div class="block-faqs">
                        <div class="accordion wow fadeInUp" id="accordionFAQ">
                            @foreach($faqs as $faq)
                                @php
                                    $id = 'faq-item-' . $faq->getKey();
                                    $headingId = 'heading-faq-item-' . $faq->getKey();
                                    $isFirst = $loop->first; // mở sẵn item đầu tiên
                                @endphp

                                <div class="accordion-item">
                                    <h3 class="accordion-header" id="{{ $headingId }}">
                                        <button
                                            class="accordion-button text-heading-5 {{ $isFirst ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#{{ $id }}"
                                            aria-expanded="{{ $isFirst ? 'true' : 'false' }}"
                                            aria-controls="{{ $id }}"
                                        >
                                            {!! BaseHelper::clean($faq->question) !!}
                                        </button>
                                    </h3>

                                    <div
                                        class="accordion-collapse collapse {{ $isFirst ? 'show' : '' }}"
                                        id="{{ $id }}"
                                        aria-labelledby="{{ $headingId }}"
                                        data-bs-parent="#accordionFAQ"
                                    >
                                        <div class="accordion-body">
                                            {!! BaseHelper::clean($faq->answer) !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
