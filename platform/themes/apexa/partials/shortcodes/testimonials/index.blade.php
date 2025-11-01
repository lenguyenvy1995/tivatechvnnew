@php
    $style = $shortcode->style;
    $style = $style ? (in_array($style, ['style-1', 'style-2', 'style-3', 'style-4', 'style-5', 'style-6']) ? $style : 'style-1') : null;
    $bgColor = $shortcode->background_color;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;
    $titleColor = $shortcode->title_color;
    $titleColor = $titleColor === 'transparent' ? 'inherit' : $titleColor;

    $variablesStyle = [
        "--background-color: $bgColor" => $bgColor,
        "--background-image: url($bgImage)" => $bgImage,
        "--title-color: $titleColor" => $titleColor,
    ];
@endphp

{!! Theme::partial("shortcodes.testimonials.styles.$style", compact('shortcode', 'testimonials', 'variablesStyle')) !!}
