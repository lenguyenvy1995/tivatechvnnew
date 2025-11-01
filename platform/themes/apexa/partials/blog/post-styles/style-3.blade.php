@use(Theme\Apexa\Support\ThemeHelper)
<div class="blog__post-three_customer shine-animate-item">
    <div class="blog__post-thumb-three_customer">
        <a href="{{ $post->url }}" class="shine-animate">
            {{ RvMedia::image($post->image, $post->name, 'medium-square') }}
        </a>
    </div>
    <div class="blog__post-content-three_customer">
        <div class="blog-post-meta">
            <ul class="list-wrap">
                @if (ThemeHelper::isShowPostMeta('list', 'category', true))
                    <li>
                        {!! Theme::partial('blog.post-meta.category-badge', [
                            'post' => $post,
                            'wrapperClass' => 'blog__post-tag-three_customer',
                        ]) !!}
                    </li>
                @endif

                @if (ThemeHelper::isShowPostMeta('list', 'published_date', true))
                    <li>{!! Theme::partial('blog.post-meta.published-date', compact('post')) !!}</li>
                @endif
            </ul>
        </div>
        <h2 class="title">
            <a class="truncate-2-custom text-uppercase " title="{{ $post->name }}" href="{{ $post->url }}">{{ $post->name }}</a>
        </h2>
        <a class="truncate-3-custom" href="{{ $post->url }}">
            <p class="description">
                {{ $post->description }}
            </p>
        </a>
    </div>
</div>
