<?php

use Botble\Base\Forms\FieldOptions\AlertFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption; // <-- thêm
use Botble\Base\Forms\Fields\AlertField;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\SelectField; // <-- thêm
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\FieldOptions\ShortcodeTabsFieldOption;
use Botble\Shortcode\Forms\Fields\ShortcodeTabsField;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Illuminate\Routing\Events\RouteMatched;
use Illuminate\Support\Facades\Event;

if (! is_plugin_active('contact')) {
    return;
}

Event::listen(RouteMatched::class, function (): void {
    add_filter(CONTACT_FORM_TEMPLATE_VIEW, function () {
        return Theme::getThemeNamespace('partials.shortcodes.contact-form.index');
    }, 120);

    Shortcode::setPreviewImage('contact-form', Theme::asset()->url('images/ui-blocks/contact-form.png'));

    Shortcode::modifyAdminConfig('contact-form', function (ShortcodeForm $form) {
        $attributes = is_array($form->getModel()) ? $form->getModel() : [];

        $form
            ->withLazyLoading()
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Title'))
                    ->toArray()
            )
            ->add(
                'description',
                TextareaField::class,
                DescriptionFieldOption::make()
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
                        'icon' => [
                            'title' => __('Icon'),
                            'type' => 'coreIcon',
                        ],
                        'icon_image' => [
                            'title' => __('Icon image'),
                            'type' => 'image',
                        ],
                        'description' => [
                            'title' => __('Description'),
                            'type' => 'textarea',
                        ],
                    ])
                    ->toArray()
            )
            ->add(
                'service_group',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Service group to show'))
                    ->choices([
                        'ads'     => 'ADS',
                        'website' => 'Website',
                        'all'     => 'All (ADS + Website)',
                    ])
                    ->placeholder(__('Select group'))
                    ->required() // bắt buộc chọn
                    ->toArray()
            )
    
            // 2) Giá trị mặc định trong dropdown ngoài FE (nếu có)
            ->add(
                'default_service',
                SelectField::class,
                SelectFieldOption::make()
                    ->label(__('Default service'))
                    ->choices([
                        'ads' => [
                            'ads_gg_search' => 'ADS - GG Search',
                            'ads_gg_gdn'    => 'ADS - GG GDN',
                            'ads_zalo'      => 'ADS - Zalo ADS',
                        ],
                        'website' => [
                            'web_thiet_ke'  => 'Website - Thiết kế website',
                            'web_seo'       => 'Website - SEO',
                            'web_cskh'      => 'Website - Chăm sóc website',
                            'web_giam_sat'  => 'Website - Giám sát website',
                        ],
                    ])
                    ->allowClear()
                    ->placeholder(__('Select default service'))
                    ->toArray()
            )
            ->add(
                'open_contact_form_fieldset',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('<fieldset class="form-fieldset">')
                    ->toArray()
            )
            ->add(
                'contact_form_alert',
                AlertField::class,
                AlertFieldOption::make()
                    ->content(__('Contact form information config'))
                    ->toArray()
            )
            ->add(
                'form_title',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Form title'))
                    ->toArray()
            )
            ->add(
                'form_description',
                TextareaField::class,
                TextareaFieldOption::make()
                    ->label(__('Form description'))
                    ->toArray()
            )
            ->add(
                'form_button_label',
                TextField::class,
                TextFieldOption::make()
                    ->label(__('Form button label'))
                    ->toArray()
            )
            ->add(
                'closed_contact_form_fieldset',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content('</fieldset>')
                    ->toArray()
            )
        ;

        return $form;
    });
});
