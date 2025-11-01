<section class="py-4 pb-5 choose-area shortcode-about-us-information shortcode-about-us-information-style-8"
    @style($variablesStyle)>
    <div class=" about-us-container p-3 p-md-5 container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-0 order-lg-2">
                <div class="choose-img-wrap pb-0" data-aos="fade-left">
                    @if ($image = $shortcode->image)
                        {{ RvMedia::image($image, 'image') }}
                    @endif

                    @if ($image1 = $shortcode->image_1)
                        {{ RvMedia::image($image1, 'image', attributes: ['data-parallax' => '{"x" : 50 }']) }}
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="choose-content">

                    <div class="section-title  mb-3 tg-heading-subheading animation-style3">
                        @if ($subtitle = $shortcode->subtitle)
                            <p class="sub-title mb-3" data-aos="fade-right" data-aos-delay="300"                            >{!! BaseHelper::clean($subtitle) !!}</p>
                        @endif

                        @if ($title = $shortcode->title)
                            <h2 class="title tg-element-title" data-aos="fade-right"  data-aos-delay="500"  >{!! BaseHelper::clean($title) !!}</h2>
                        @endif
                    </div>

                    @if ($description = $shortcode->description)
                        <p data-aos="fade-right" data-aos-delay="700"  >{!! BaseHelper::clean($description) !!}</p>
                    @endif

                    @if (count($tabs) > 0)
                        <div class="choose-list" data-aos="fade-right" data-aos-delay="900"  >
                            {!! Theme::partial('shortcodes.about-us-information.partials.featured-list', compact('tabs')) !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
