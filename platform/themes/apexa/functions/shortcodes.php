<?php

use Botble\Base\Forms\FieldOptions\AlertFieldOption;
use Botble\Base\Forms\FieldOptions\ColorFieldOption;
use Botble\Base\Forms\FieldOptions\CoreIconFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\OnOffFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\AlertField;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\OnOffField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Supports\ThemeSupport;
use Illuminate\Support\Arr;
use Botble\Page\Models\Page;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeCustomerReviewsField;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeCustomerReviewsFieldOption;

app()->booted(function (): void {
    ThemeSupport::registerGoogleMapsShortcode();
    ThemeSupport::registerYoutubeShortcode();

    Shortcode::register('brands', __('Brands'), __('Brands'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['name', 'image', 'url'], $shortcode);

        if (! $tabs) {
            return null;
        }

        return Theme::partial('shortcodes.brands.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setPreviewImage('brands', Theme::asset()->url('images/ui-blocks/brands.png'));

    Shortcode::setAdminConfig('brands', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'name' => [
                            'title' => __('Name'),
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                        'url' => [
                            'title' => __('URL'),
                        ],
                    ])
            )
            ->add(
                'background_color',
                ColorField::class,
                ColorFieldOption::make()
                    ->label(__('Background color'))
                    ->toArray(),
            );
    });

    Shortcode::register('site-statistics', __('Site Statistics'), __('Site Statistics'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'data', 'unit', 'image'], $shortcode);

        if (! $tabs) {
            return null;
        }

        return Theme::partial('shortcodes.site-statistics.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('site-statistics', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/site-statistics/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->toArray()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->toArray(),
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'data' => [
                            'title' => __('Data'),
                        ],
                        'unit' => [
                            'title' => __('Unit'),
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                    ])
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
            );
    });

    Shortcode::register('hero-banner', __('Hero Banner'), __('Hero Banner'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.hero-banner.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('hero-banner', Theme::asset()->url('images/ui-blocks/hero-banner.png'));

    Shortcode::setAdminConfig('hero-banner', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->helperText(__('if you want highlight text, wrap it in a &lt;span&gt; tag. Ex: &lt;span&gt; highlight text &lt;/span&gt;'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->toArray()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->toArray()
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
                    ->toArray()
            )
            ->add(
                'display_social_links',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(__('Display social links?'))
                    ->helperText(__('You can edit your social links in the Appearance → Theme Options → Social Links.'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'display_button_scroll_down',
                OnOffField::class,
                OnOffFieldOption::make()
                    ->label(__('Display button scroll down?'))
                    ->defaultValue(true)
                    ->toArray()
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
                    ->toArray()
            )
            ->add(
                'image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image 1'))
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
            );
    });

    Shortcode::register('contact-block', __('Contact Block'), __('Contact Block'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.contact-block.index', compact('shortcode'));
    });

    Shortcode::setAdminConfig('contact-block', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/contact-block/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add('description', TextareaField::class, DescriptionFieldOption::make())
            ->add(
                'phone_number',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Phone number'))
                    ->toArray()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->toArray()
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
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
            );
    });

    Shortcode::register('about-us-information', __('About Us Information'), __('About Us Information'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'icon', 'icon_image'], $shortcode);

        return Theme::partial('shortcodes.about-us-information.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('about-us-information', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 16))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/about-us-information/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->rows(3)
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
                    ->toArray()
            )
            ->add(
                'image_1',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image :number', ['number' => 1]))
                    ->toArray()
            )
            ->add(
                'image_2',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image :number', ['number' => 2]))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->label(__('Tabs'))
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image (It will override icon above if set)'),
                            'type' => 'image',
                        ],
                    ])
                    ->toArray()
            )
            ->add(
                'data_count',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Data count'))
                    ->toArray()
            )
            ->add(
                'data_count_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Data count description'))
                    ->toArray()
            )
            ->add(
                'author_config_open',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<fieldset class="form-fieldset">')
                    ->toArray()
            )
            ->add(
                'author_config_title',
                AlertField::class,
                AlertFieldOption::make()
                    ->content(__('Author information'))
            )
            ->add(
                'author_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Author name'))
                    ->toArray()
            )
            ->add(
                'author_title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Author title'))
                    ->toArray()
            )
            ->add(
                'author_avatar',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Author avatar'))
                    ->toArray()
            )
            ->add(
                'author_signature',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Author signature'))
                    ->toArray()
            )
            ->add(
                'author_config_closed',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('</fieldset>')
                    ->toArray()
            )
            ->add(
                'contact_config_open',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<fieldset class="form-fieldset">')
                    ->toArray()
            )
            ->add(
                'contact_config_title',
                AlertField::class,
                AlertFieldOption::make()
                    ->content(__('Contact information'))
                    ->toArray()
            )
            ->add(
                'contact_title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact title'))
                    ->toArray()
            )
            ->add(
                'contact_subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact subtitle'))
                    ->toArray()
            )
            ->add(
                'contact_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Contact URL'))
                    ->toArray()
            )
            ->add(
                'contact_icon',
                CoreIconField::class,
                CoreIconFieldOption::make()
                    ->label(__('Contact icon'))
                    ->toArray()
            )
            ->add(
                'contact_icon_image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Contact icon image (It will override icon above if set)'))
                    ->toArray()
            )
            ->add(
                'contact_config_closed',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('</fieldset>')
                    ->toArray()
            )
            ->add(
                'button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button label'))
                    ->toArray()
            )
            ->add(
                'button_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Button URL'))
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
            );
    });

    Shortcode::register('content-quote', __('Content quote'), __('Content quote'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.content-quote.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('content-quote', Theme::asset()->url('images/ui-blocks/content-quote.png'));

    Shortcode::setAdminConfig('content-quote', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'content_text',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Content'))
                    ->toArray()
            )
            ->add(
                'background_color',
                ColorField::class,
                ColorFieldOption::make()
                    ->label(__('Background color')),
            );
    });

    Shortcode::register('content-featured', __('Content Featured'), __('Content Featured'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.content-featured.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('content-featured', Theme::asset()->url('images/ui-blocks/content-featured.png'));

    Shortcode::setAdminConfig('content-featured', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                    ])
            );
    });

    Shortcode::register('content-feature-list', __('Content Feature List'), __('Content Feature List'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.content-feature-list.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('content-feature-list', Theme::asset()->url('images/ui-blocks/content-feature-list.png'));

    Shortcode::setAdminConfig('content-feature-list', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'featured_list',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image (It will override icon above if set)'),
                            'type' => 'image',
                        ],
                    ])
            );
    });

    Shortcode::register('consulting-block', __('Consulting Block'), __('Consulting Blocksdcsdcsdcsdccccc'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.consulting-block.index', compact('shortcode'));
    });

    Shortcode::setPreviewImage('consulting-block', Theme::asset()->url('images/ui-blocks/consulting-block.png'));

    Shortcode::setAdminConfig('consulting-block', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )
            ->add(
                'data_count',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Data count'))
            )
            ->add(
                'data_count_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Data count description'))
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
            );
    });

    Shortcode::register('instruction-steps', __('Instruction Steps'), __('Instruction Steps'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'icon', 'icon_image', 'button_label', 'button_url'], $shortcode);

        return Theme::partial('shortcodes.instruction-steps.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setPreviewImage('instruction-steps', Theme::asset()->url('images/ui-blocks/instruction-steps.png'));

    Shortcode::setAdminConfig('instruction-steps', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image'),
                            'type' => 'image',
                        ],
                        'button_label' => [
                            'title' => __('Button Label'),
                        ],
                        'button_url' => [
                            'title' => __('Button URL'),
                        ],
                    ])
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
            );
    });
    Shortcode::register('brand-ads', __('Đối tác ADS'), __('Đối tác ADS'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['name', 'image', 'url'], $shortcode);

        if (! $tabs) {
            return null;
        }

        return Theme::partial('shortcodes.brand-ads.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setPreviewImage('brand-ads', Theme::asset()->url('images/ui-blocks/brand-ads.png'));

    Shortcode::setAdminConfig('brand-ads', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([

                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                        'url' => [
                            'title' => __('URL'),
                        ],
                    ])
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
            );
    });
    Shortcode::register('introduction', __('Giới Thiệu '), __('Giới thiệu'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.introduction.index', compact('shortcode'));
    });

    Shortcode::setAdminConfig('introduction', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 4))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/introduction/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'subtitle_inner',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Tiêu đề phụ'))
                    ->toArray()
            )
            ->add(
                'data_count_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Data count description'))
                    ->toArray()
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
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
            );
    });
    Shortcode::register('service-banner', __('Banner Dịch Vụ '), __('Thông Tin Banner Dịch Vụ'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.service-banner.index', compact('shortcode'));
    });

    Shortcode::setAdminConfig('service-banner', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 4))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/service-banner/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'data_count_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Data count description'))
                    ->toArray()
            )

            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
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
            ->add(
                'btn_url',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Nhập URL'))
                    ->toArray(),
            )
            ->add(
                'title_btn',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('title hiển thị'))
                    ->toArray(),
            )

            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'image'  => ['title' => __('Image'), 'type' => 'image'],

                        'top'    => ['title' => __('Vị trí Top'),    'type' => 'text'],
                        'right'  => ['title' => __('Vị trí Right'),  'type' => 'text'],
                        'bottom' => ['title' => __('Vị trí Bottom'), 'type' => 'text'],
                        'left'   => ['title' => __('Vị trí Left'),   'type' => 'text'],

                        'animation' => [
                            'title' => __('Hiệu ứng'),
                            'type'  => 'select',
                            'options' => [
                                ''           => __('Không dùng'),
                                'up-down'    => __('Di chuyển lên xuống'),
                                'left-right' => __('Di chuyển trái phải'),
                                'rot-cw'     => __('Xoay phải (thuận chiều kim đồng hồ)'),
                                'rot-ccw'    => __('Xoay trái (ngược chiều kim đồng hồ)'),
                                'rot-cw-full'  => __('Xoay tròn 360° thuận chiều'),
                                'rot-ccw-full' => __('Xoay tròn 360° ngược chiều'),
                            ],
                        ],
                        'duration' => [
                            'title' => __('Thời gian 1 chu kỳ (giây)'),
                            'type'  => 'text', // nhập: 2, 3.5...
                        ],
                        'delay' => [
                            'title' => __('Trễ bắt đầu (giây)'),
                            'type'  => 'text',
                        ],
                        'amplitude' => [
                            'title' => __('Biên độ dịch chuyển (px/%)'),
                            'type'  => 'text', // vd: 12px, 8%, mặc định 12px
                        ],
                        'rotate' => [
                            'title' => __('Góc xoay tối đa (deg)'),
                            'type'  => 'text', // vd: 10deg, mặc định 10deg
                        ],
                    ])
                    ->toArray()
            );
    });

    Shortcode::register('why-us', __('Vì Sao Chọn Chúng Tôi'), __('Thông Tin'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'icon', 'icon_image'], $shortcode);

        return Theme::partial('shortcodes.why-us.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('why-us', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/why-us/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image'),
                            'type' => 'image',
                        ],
                    ])
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
            );
    });
    Shortcode::register('benefits', __('Lợi ý  dịch vụ'), __('Bảng Thông Tin'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'icon', 'icon_image', 'background_image'], $shortcode);

        return Theme::partial('shortcodes.benefits.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('benefits', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/why-us/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image'),
                            'type' => 'image',
                        ],
                        'background_image' => [
                            'title' => __('Background image'),
                            'type' => 'image',
                        ],


                    ])
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
            );
    });

    Shortcode::register('procedure', __('Quy trình  làm việc Tại Tivatech'), __('Bảng Thông Tin'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description',  'icon', 'icon_image'], $shortcode);

        return Theme::partial('shortcodes.procedure.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('procedure', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/procedure/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'image-title',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image title'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],

                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image'),
                            'type' => 'image',
                        ],


                    ])
                    ->toArray()
            )
            ->add(
                'mobile_note_1',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Note trên mobile 1 '))
                    ->toArray()
            )
            ->add(
                'mobile_note_2',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Note trên mobile 2 '))
                    ->toArray()
            )
            ->add(
                'mobile_note_3',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Note trên mobile 3 '))
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
            );
    });
    // Lợi thế khi chọn Tivatech
    Shortcode::register('forte', __('Lợi Thế khi Chọn Tivatech '), __('Thông Tin Section Lợi Thế Tivatech'), function (ShortcodeCompiler $shortcode): ?string {
        return Theme::partial('shortcodes.forte.index', compact('shortcode'));
    });

    Shortcode::setAdminConfig('forte', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 4))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/service-banner/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'image',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image'))
            )

            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)

                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],

                        'icon_image' => [
                            'title' => __('Image icon'),
                            'type' => 'image'
                        ],
                        'item_bg_color' => [
                            'title' => __('Background color'),
                            'type'  => 'color',

                        ],


                    ])
                    ->toArray()
            )
            ->add(
                'tabs_position',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'decor_image' => [
                            'title' => __('Decor image'),
                            'type' => 'image'
                        ],

                        'top'    => ['title' => __('Vị trí Top'),    'type' => 'text'],
                        'right'  => ['title' => __('Vị trí Right'),  'type' => 'text'],
                        'bottom' => ['title' => __('Vị trí Bottom'), 'type' => 'text'],
                        'left'   => ['title' => __('Vị trí Left'),   'type' => 'text'],

                        'animation' => [
                            'title' => __('Hiệu ứng'),
                            'type'  => 'select',
                            'options' => [
                                ''           => __('Không dùng'),
                                'up-down'    => __('Di chuyển lên xuống'),
                                'left-right' => __('Di chuyển trái phải'),
                                'rot-cw'     => __('Xoay phải (thuận chiều kim đồng hồ)'),
                                'rot-ccw'    => __('Xoay trái (ngược chiều kim đồng hồ)'),
                                'rot-cw-full'  => __('Xoay tròn 360° thuận chiều'),
                                'rot-ccw-full' => __('Xoay tròn 360° ngược chiều'),
                            ],
                        ],
                        'duration' => [
                            'title' => __('Thời gian 1 chu kỳ (giây)'),
                            'type'  => 'text', // nhập: 2, 3.5...
                        ],
                        'delay' => [
                            'title' => __('Trễ bắt đầu (giây)'),
                            'type'  => 'text',
                        ],
                        'amplitude' => [
                            'title' => __('Biên độ dịch chuyển (px/%)'),
                            'type'  => 'text', // vd: 12px, 8%, mặc định 12px
                        ],
                        'rotate' => [
                            'title' => __('Góc xoay tối đa (deg)'),
                            'type'  => 'text', // vd: 10deg, mặc định 10deg
                        ],
                    ])
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
            );
    });

    // Dự  án đã thự hiện Tại Tivatech
    Shortcode::register('tiva-project', __('Dự án đã thực hiện Tại Tivatech'), __('Bảng Thông Tin'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'image'], $shortcode);

        return Theme::partial('shortcodes.tiva-project.index', compact('shortcode', 'tabs'));
    });

    Shortcode::setAdminConfig('tiva-project', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/tiva-project/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
            )
            ->add(
                'image_position',
                MediaImageField::class,
                MediaImageFieldOption::make()
                    ->label(__('Image position'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],


                    ])
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
            );
    });
    Shortcode::register('category_page', __('Danh Mục Trang Page'), __('Tuỳ Chỉnh Các Trang Page'), function (ShortcodeCompiler $shortcode): ?string {
        $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'url', 'icon', 'image'], $shortcode);
        return Theme::partial('shortcodes.category-page.index', compact('shortcode', 'tabs'));
    });
    Shortcode::setAdminConfig('category_page', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/category-page/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Description'))
                    ->toArray()
            )
            ->add(
                'tabs',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)

                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                        'url' => [
                            'title' => __('URL'),
                        ],

                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],



                    ])
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
            );
    });
    //  Hình ảnh khách hàng đánh giá về Tivatech
    Shortcode::register('review-gallery', __('Review Gallery'), __('Review Gallery'), function (ShortcodeCompiler $shortcode): ?string {
        $reviews = Shortcode::fields()->getTabsData(['title', 'image'], $shortcode);

        return Theme::partial('shortcodes.review-gallery.index', compact('shortcode', 'reviews'));
    });

    Shortcode::setAdminConfig('review-gallery', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 3))
                            ->mapWithKeys(fn($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/review-gallery/$style.png"),
                                ],
                            ])
                            ->toArray()
                    )
                    ->selected(Arr::get($attributes, 'style', 'style-1'))
                    ->withoutAspectRatio()
                    ->numberItemsPerRow(1)
                    ->toArray()
            )
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'subtitle',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Subtitle'))
                    ->toArray()
            )

            ->add(
                'reviews',
                ShortcodeTabsField::class,
                ShortcodeTabsFieldOption::make()
                    ->attrs($attributes)
                    ->fields([
                        'title' => [
                            'title' => __('Title'),
                        ],
                        'image' => [
                            'title' => __('Image'),
                            'type' => 'image',
                        ],
                    ])
                    ->max(100)
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
            );
    });
});
