<section id="introduction" class="py-5" @style($variablesStyle)>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title mb-35 tg-heading-subheading animation-style3">


                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title  text-center">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title text-center">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row col-reverse">
            <div class="col-12 col-md-6 m-auto introduction-left">
                <div class="introduction-right-image" data-aos="flip-left">
                    @if ($image = $shortcode->image)
                        <div class="introduction-image">
                            {{ RvMedia::image($image, 'image') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-12 col-md-6 m-auto introduction-right">
                <div class="introduction-left-content">
                    @if ($subtitle_inner = $shortcode->subtitle_inner)
                        <div class="intro-title">
                            <h4>
                                {!! BaseHelper::clean($subtitle_inner) !!}
                            </h4>
                        </div>
                    @endif
                    @if ($data_count_description = $shortcode->data_count_description)
                        <p class="intro-description">{!! BaseHelper::clean($data_count_description) !!}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
