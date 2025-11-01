<?php

use Botble\Base\Forms\FieldOptions\ColorFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Blog\Models\Post;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;
use Theme\Apexa\FormDecorators\PostByCategoriesFormDecorator;
use Theme\Apexa\FormDecorators\PostFormDecorator;

app()->booted(function (): void {
    if (! is_plugin_active('blog')) {
        return;
    }
    Shortcode::register(
        'blog-posts',
        __('Blog Posts'),
        __('Blog Posts'),
        function (ShortcodeCompiler $shortcode): ?string {
            $limit = (int) $shortcode->limit ?: 4;
            $categoryIds = Shortcode::fields()->getIds('category_ids', $shortcode);

            // Đếm tổng số bài viết trong danh mục đã chọn
            $totalPostsCount = Post::query()
                ->wherePublished()
                ->when(!empty($categoryIds), function ($query) use ($categoryIds): void {
                    $query->whereHas('categories', function ($query) use ($categoryIds): void {
                        $query->whereIn('categories.id', $categoryIds);
                    });
                })
                ->count();

            // Lấy danh sách bài viết giới hạn limit
            $posts = Post::query()
                ->with('slugable')
                ->wherePublished()
                ->when(!empty($categoryIds), function ($query) use ($categoryIds): void {
                    $query->whereHas('categories', function ($query) use ($categoryIds): void {
                        $query->whereIn('categories.id', $categoryIds);
                    });
                })
                ->limit($limit)
                ->latest()
                ->get();

            if ($posts->isEmpty()) {
                return null;
            }

            // Nếu có nhiều hơn limit => hiển thị nút xem thêm
            $showLoadMoreButton = $totalPostsCount > $limit;

            // Lấy URL danh mục đầu tiên
            $categoryUrl = null;
            if (!empty($categoryIds)) {
                $firstCategory = \Botble\Blog\Models\Category::query()
                    ->where('id', $categoryIds[0])
                    ->with('slugable')
                    ->first();

                if ($firstCategory && $firstCategory->slug) {
                    $categoryUrl = route('public.single', $firstCategory->slug);
                }
            }

            return Theme::partial('shortcodes.blog-posts.index', compact('shortcode', 'posts', 'showLoadMoreButton', 'categoryUrl'));
        }
    );

    Shortcode::setAdminConfig('blog-posts', function (array $attributes) {
        $form = ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn ($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/blog-posts/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            );

        return PostByCategoriesFormDecorator::createFrom(PostFormDecorator::createFrom($form, 'style'), 'style')
            ->addAfter(
                'title',
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'background_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Background image'))
                    ->toArray()
            )
            ->add(
                'background_color',
                ColorField::class,
                ColorFieldOption::make()
                    ->label(__('Background color'))
                    ->toArray(),
            )
        ;
    });
});
