<section id="tiva-customer-reviews" class="tiva-customer-reviews-style-1 py-5" @style($variablesStyle)>
    <div class="container">
        <div class="row justify-content-center mb-35">
            <div class="col-lg-8">
                <div class="section-title section-title-customner text-center tg-heading-subheading animation-style3">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif
                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
               
                </div>
            </div>
        </div>

        <div id="tiva-review-grid" class="review-grid">
            @foreach ($reviews as $item)
                <a
                    class="review-item gallery-item"
                    href="{{ RvMedia::getImageUrl($item['image']) }}"
                    data-sub-html="<h4>{{ $item['title'] }}</h4>"
                >
                    <img src="{{ RvMedia::getImageUrl($item['image']) }}" alt="{{ $item['title'] }}">
                </a>
            @endforeach
        </div>
    </div>
</section>