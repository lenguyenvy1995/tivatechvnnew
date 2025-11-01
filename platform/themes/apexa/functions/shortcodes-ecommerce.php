<?php

use Botble\Base\Forms\FieldOptions\NumberFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Ecommerce\Facades\EcommerceHelper;
use Botble\Ecommerce\Models\Product;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Ecommerce\Repositories\Interfaces\ProductInterface;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Shortcode\ShortcodeField;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;

app()->booted(function (): void {
    if (! is_plugin_active('ecommerce')) {
        return;
    }

    Shortcode::register(
        'ecommerce-products',
        __('Ecommerce Products'),
        __('Ecommerce Products'),
        function (ShortcodeCompiler $shortcode) {
            $condition = [];

            $products = app(ProductInterface::class)->filterProducts([
                'categories' => $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode),
            ], [
                'take' => (int) $shortcode->limit ?: 12,
                'order_by' => [
                    'order' => 'ASC',
                    'created_at' => 'DESC',
                ],
                'condition' => $condition,
                ...EcommerceHelper::withReviewsParams(),
            ]);

            $products = $products instanceof Product ? collect([$products]) : $products;

            if ($products->isEmpty()) {
                return null;
            }

            return Theme::partial(
                'shortcodes.ecommerce-products.index',
                compact('shortcode', 'products')
            );
        }
    );

    Shortcode::setAdminConfig('ecommerce-products', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add('title', TextField::class, TextFieldOption::make()->label(__('Title')))
            ->add('subtitle', TextField::class, TextFieldOption::make()->label(__('Subtitle')))
            ->add(
                'category_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Categories'))
                    ->multiple()
                    ->ajaxSearch()
                    ->ajaxUrl(route('admin.ajax.search-categories'))
                    ->selected(
                        ProductCategory::query()
                            ->whereIn('id', ShortcodeField::parseIds(Arr::get($attributes, 'category_ids')))
                            ->pluck('name', 'id')
                            ->all()
                    )
            )
            ->add(
                'limit',
                NumberField::class,
                NumberFieldOption::make()
                    ->label(__('Number of products to show'))
                    ->defaultValue(12)
            )
            ->add('button_label', TextField::class, TextFieldOption::make()->label(__('Button Label')))
            ->add('button_url', TextField::class, TextFieldOption::make()->label(__('Button URL')));
    });
});
