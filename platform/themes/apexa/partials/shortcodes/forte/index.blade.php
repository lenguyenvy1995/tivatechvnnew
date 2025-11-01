@php
    // ===== Style =====
    $style = $shortcode->style ?? null;
    $style = in_array($style, ['style-1','style-2','style-3','style-4']) ? $style : 'style-1';

    // ===== Nền =====
    $bgColor = $shortcode->background_color ?? null;
    $bgImage = $shortcode->background_image ? RvMedia::getImageUrl($shortcode->background_image) : null;

    $variablesStyle = array_filter([
        "--background-color: {$bgColor}"      => $bgColor,
        "--background-image: url({$bgImage})" => $bgImage,
    ]);

    // Helper: lấy ảnh đầu tiên nếu là "a,b,c" hoặc mảng
    $firstMedia = function ($value) {
        if (!$value) return null;
        if (is_array($value)) $value = reset($value);
        elseif (is_string($value) && str_contains($value, ',')) $value = trim(explode(',', $value)[0]);
        return $value ? RvMedia::getImageUrl($value) : null;
    };

    // ===== TABS (content) =====
    $tabs = collect(json_decode($shortcode->tabs ?? '[]', true))
        ->map(function ($t) use ($firstMedia) {
            return [
                'title'       => $t['title']        ?? '',
                'description' => $t['description']  ?? '',
                'image'       => $firstMedia($t['icon_image'] ?? null),
                'bg_color'    => $t['item_bg_color'] ?? null,
            ];
        })
        ->filter(fn($i) => $i['title'] || $i['description'] || $i['image'])
        ->values()
        ->all();

    // Fallback nếu không có JSON -> lấy theo kiểu đánh số *_1, *_2...
    if (!count($tabs)) {
        $attrs = $shortcode->toArray();
        $max = 0;
        foreach ($attrs as $k => $v) {
            if (preg_match('/^(title|description|icon_image|item_bg_color)_(\d+)$/', $k, $m)) {
                $max = max($max, (int)$m[2]);
            }
        }
        for ($i = 1; $i <= $max; $i++) {
            $title = $attrs["title_{$i}"] ?? '';
            $desc  = $attrs["description_{$i}"] ?? '';
            $img   = $firstMedia($attrs["icon_image_{$i}"] ?? null);
            $bg    = $attrs["item_bg_color_{$i}"] ?? null;

            if ($title || $desc || $img) {
                $tabs[] = [
                    'title'       => $title,
                    'description' => $desc,
                    'image'       => $img,
                    'bg_color'    => $bg,
                ];
            }
        }
    }

    // ===== DECOR (tabs_position) =====
    $tabs_position = collect(json_decode($shortcode->tabs_position ?? '[]', true))
        ->map(function ($p) use ($firstMedia) {
            $numOrUnit = fn($v,$fb=null) => ($v === '' || $v===null) ? $fb : (is_numeric($v) ? $v.'px' : $v);
            $stylePos = collect([
                'top'      => $numOrUnit($p['top'] ?? null),
                'right'    => $numOrUnit($p['right'] ?? null),
                'bottom'   => $numOrUnit($p['bottom'] ?? null),
                'left'     => $numOrUnit($p['left'] ?? null),
                'position' => 'absolute',
            ])->filter()->map(fn($v,$k)=>"$k:$v")->implode(';');

            return [
                'image' => $firstMedia($p['decor_image'] ?? null),
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

    // Fallback decor nếu không có JSON: quantity + decor_image_i, top_i...
    if (!count($tabs_position)) {
        $attrs = $shortcode->toArray();
        $qty = (int)($attrs['quantity'] ?? 0);
        $numOrUnit = fn($v,$fb=null) => ($v === '' || $v===null) ? $fb : (is_numeric($v) ? $v.'px' : $v);

        for ($i = 1; $i <= $qty; $i++) {
            $img = $firstMedia($attrs["decor_image_{$i}"] ?? null);
            if (!$img) continue;

            $anim = $attrs["animation_{$i}"] ?? '';
            $animClass = match ($anim) {
                'up-down'      => 'ai-float-y',
                'left-right'   => 'ai-float-x',
                'rot-cw'       => 'ai-rot-cw',
                'rot-ccw'      => 'ai-rot-ccw',
                'rot-cw-full'  => 'ai-rot-cw-full',
                'rot-ccw-full' => 'ai-rot-ccw-full',
                default        => '',
            };

            $styleInline = collect([
                'top'      => $numOrUnit($attrs["top_{$i}"]    ?? null),
                'right'    => $numOrUnit($attrs["right_{$i}"]  ?? null),
                'bottom'   => $numOrUnit($attrs["bottom_{$i}"] ?? null),
                'left'     => $numOrUnit($attrs["left_{$i}"]   ?? null),
                '--ampl'   => $numOrUnit($attrs["amplitude_{$i}"] ?? '12px','12px'),
                '--rot'    => $numOrUnit($attrs["rotate_{$i}"] ?? '10deg','10deg'),
                $animClass ? 'animation-duration' : null => ($attrs["duration_{$i}"] ?? null) ? ($attrs["duration_{$i}"].'s') : null,
                $animClass ? 'animation-delay'    : null => ($attrs["delay_{$i}"] ?? null) ? ($attrs["delay_{$i}"].'s') : null,
            ])->filter()->map(fn($v,$k)=>"$k:$v")->implode(';');

            $tabs_position[] = ['image'=>$img,'style'=>$styleInline,'class'=>$animClass];
        }
    }
@endphp

{!! Theme::partial("shortcodes.forte.styles.$style", compact('shortcode','variablesStyle','tabs','tabs_position')) !!}