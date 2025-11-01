@php
    $style = $shortcode->style;
    $style = $style ? (in_array($style, ['style-1', 'style-2', 'style-3', 'style-4']) ? $style : 'style-1') : null;
    $bgColor = $shortcode->background_color;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;
   

    $variablesStyle = [
        "--background-color: $bgColor" => $bgColor,
        "--background-image: url($bgImage)" => $bgImage,
    ];                
    

@endphp
@php
       $tabs = json_decode($shortcode->tabs ?? '[]', true);
@endphp

{!! Theme::partial("shortcodes.service-banner.styles.$style", compact('shortcode', 'variablesStyle', 'tabs')) !!}