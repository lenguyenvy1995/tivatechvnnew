<section class="pb-50 pt-50 shortcode-ecommerce-products">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-8">
                <div class="section-title text-center tg-heading-subheading animation-style3">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>
        </div>

        <div class="row position-relative mb-50">
            @include(EcommerceHelper::viewPath('includes.product-items'))
        </div>

        @if (($buttonLabel = $shortcode->button_label) && ($buttonUrl = $shortcode->button_url))
            <div class="text-center">
                <a href="{{ $buttonUrl }}" class="btn">{!! BaseHelper::clean($buttonLabel) !!}</a>
            </div>
        @endif
    </div>
</section>

