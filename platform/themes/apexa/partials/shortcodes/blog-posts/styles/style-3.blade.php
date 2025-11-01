<section class="blog__post-area-three blog__post-bg-three py-5 shortcode-blog-posts shortcode-blog-posts-style-3" @style($variablesStyle)>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center mb-50 tg-heading-subheading animation-style3">
                    @if ($subtitle = $shortcode->subtitle)
                        <span class="sub-title">{!! BaseHelper::clean($subtitle) !!}</span>
                    @endif

                    @if ($title = $shortcode->title)
                        <h2 class="title tg-element-title">{!! BaseHelper::clean($title) !!}</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($posts as $post)
                <div class="col-lg-4 col-md-6">
                    {!! Theme::partial('blog.post-styles.style-3', compact('post')) !!}
                </div>
            @endforeach
            @if (!empty($showLoadMoreButton) && !empty($categoryUrl))
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <a href="{{ $categoryUrl }}" class="btn btn-primary">
                        Xem thêm 
                    </a>
                </div>
            </div>
        @endif
        </div>
    </div>
</section>
