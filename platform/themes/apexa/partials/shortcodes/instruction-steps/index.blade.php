@php
    // ===== Style =====
    $style = $shortcode->style ?? null;
    $style = in_array($style, ['style-1','style-2','style-3','style-4']) ? $style : 'style-1';

    // ===== Nền =====
    $bgColor = $shortcode->background_color ?? null;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;

    // CSS variables
    $variablesStyle = array_filter([
        "--background-color: {$bgColor}"      => $bgColor,
        "--background-image: url({$bgImage})" => $bgImage,
    ]);

    // Helper: lấy ảnh đầu tiên (nếu media trả "a,b,c" hoặc mảng)
    $firstMedia = function ($value) {
        if (!$value) return null;
        if (is_array($value)) {
            $value = reset($value);
        } elseif (is_string($value) && str_contains($value, ',')) {
            $value = trim(explode(',', $value)[0]);
        }
        return $value ? RvMedia::getImageUrl($value) : null;
    };

    // ===== TABS (content) =====
    $tabs = collect(json_decode($shortcode->tabs ?? '[]', true))
        ->map(function ($t) use ($firstMedia) {
            return [
                'title'       => $t['title']        ?? '',
                'description' => $t['description']  ?? '',
                // lấy từ icon_image (đúng key mới), fallback image nếu có
                'image'       => $firstMedia($t['icon_image'] ?? ($t['image'] ?? null)),
                // màu nền từng item
                'bg_color'    => $t['item_bg_color'] ?? null,
            ];
        })
        ->filter(fn($i) => !empty($i['title']) || !empty($i['description']) || !empty($i['image']))
        ->values()
        ->all();

    // ===== TABS_POSITION (decor + animation) =====
    $tabs_position = collect(json_decode($shortcode->tabs_position ?? '[]', true))
        ->map(function ($p) use ($firstMedia) {
            $img = $firstMedia($p['decor_image'] ?? null);

            // vị trí + animation style
            $numOrUnit = function ($v, $fallback = null) {
                if ($v === null || $v === '') return $fallback;
                return is_numeric($v) ? ($v . 'px') : $v;
            };

            $stylePos = collect([
                'top'      => $numOrUnit($p['top']    ?? null),
                'right'    => $numOrUnit($p['right']  ?? null),
                'bottom'   => $numOrUnit($p['bottom'] ?? null),
                'left'     => $numOrUnit($p['left']   ?? null),
                'position' => 'absolute',
            ])->filter()->map(fn($v,$k) => "$k:$v")->implode(';');

            return [
                'image' => $img,
                'style' => $stylePos,
                'anim'  => [
                    'type'     => $p['animation'] ?? '',
                    'duration' => $p['duration']  ?? '',
                    'delay'    => $p['delay']     ?? '',
                    'amp'      => $p['amplitude'] ?? '',
                    'rotate'   => $p['rotate']    ?? '',
                ],
            ];
        })
        ->filter(fn($d) => !empty($d['image']))
        ->values()
        ->all();
@endphp

{!! Theme::partial("shortcodes.forte.styles.$style", compact(
    'shortcode',
    'variablesStyle',
    'tabs',
    'tabs_position'
)) !!}