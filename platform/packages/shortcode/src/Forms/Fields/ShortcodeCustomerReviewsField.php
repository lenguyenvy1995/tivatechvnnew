<?php

namespace Botble\Shortcode\Forms\Fields;

use Botble\Base\Forms\FormField;

class ShortcodeCustomerReviewsField extends FormField
{
    protected function getTemplate(): string
    {
        return 'packages/shortcode::forms.fields.customer-reviews';
    }

    public function getDefaults(): array
    {
        return [
            'fields' => [],
            'shortcode_attributes' => [],
            'min' => 1,
            'max' => 60, // Cho phép nhập tới 50 ảnh
            'key' => null,
        ];
    }
}