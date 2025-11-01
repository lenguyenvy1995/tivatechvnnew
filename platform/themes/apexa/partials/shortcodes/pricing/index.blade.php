@php
    $style = in_array($shortcode->style, ['style-1','style-2','style-3']) ? $shortcode->style : 'style-1';

    $bgColor = $shortcode->background_color;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;
    $variablesStyle = [
        "--background-color: $bgColor" => $bgColor,
        "--background-image: url($bgImage)" => $bgImage,
    ];

    $numberOfItemsPerRow = (int) ($shortcode->number_of_items_per_row ?: 4);
    $itemWrapperClass = match ($numberOfItemsPerRow) {
        1 => 'col-lg-12',
        2 => 'col-lg-6',
        3 => 'col-lg-4 col-md-6',
        default => 'col-lg-3 col-md-6',
    };
@endphp

{!! Theme::partial("shortcodes.pricing.styles.$style", compact(
    'shortcode', 'variablesStyle', 'itemWrapperClass', 'packages'
)) !!}