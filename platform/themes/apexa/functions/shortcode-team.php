<?php

use Botble\Base\Forms\FieldOptions\ColorFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\FieldOptions\UiSelectorFieldOption;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\Fields\UiSelectorField;
use Botble\Shortcode\Compilers\Shortcode as ShortcodeCompiler;
use Botble\Shortcode\Facades\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Team\Models\Team;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Arr;

if (! is_plugin_active('team')) {
    return;
}

app()->booted(function (): void {
    Shortcode::register('team', __('Team'), __('Team'), function (ShortcodeCompiler $shortcode): ?string {
        if (! $teamIds = Shortcode::fields()->getIds('team_ids', $shortcode)) {
            return null;
        }

        $teams = Team::query()
        ->with(['metadata', 'slugable'])
        ->wherePublished()
        ->whereIn('id', $teamIds)
        ->get()
        ->sortBy(function ($team) use ($teamIds) {
            return array_search($team->id, $teamIds);
        });


        if ($teams->isEmpty()) {
            return null;
        }

        return Theme::partial('shortcodes.team.index', compact('shortcode', 'teams'));
    });

    Shortcode::setAdminConfig('team', function (array $attributes) {
        return ShortcodeForm::createFromArray($attributes)
            ->withLazyLoading()
            ->add(
                'style',
                UiSelectorField::class,
                UiSelectorFieldOption::make()
                    ->choices(
                        collect(range(1, 6))
                            ->mapWithKeys(fn ($number) => [
                                ($style = "style-$number") => [
                                    'label' => __('Style :number', ['number' => $number]),
                                    'image' => Theme::asset()->url("images/shortcodes/team/$style.png"),
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
                'team_ids',
                SelectField::class,
                SelectFieldOption::make()
                    ->searchable()
                    ->multiple()
                    ->choices(function () use ($attributes) {
                        $selectedIds = explode(',', Arr::get($attributes, 'team_ids'));
            
                        $selected = Team::query()
                            ->wherePublished()
                            ->whereIn('id', $selectedIds)
                            ->get()
                            ->sortBy(function ($item) use ($selectedIds) {
                                return array_search($item->id, $selectedIds);
                            })
                            ->pluck('name', 'id')
                            ->toArray();
            
                        $others = Team::query()
                            ->wherePublished()
                            ->whereNotIn('id', $selectedIds)
                            ->pluck('name', 'id')
                            ->toArray();
            
                        return $selected + $others;
                    })
                    ->selected(explode(',', Arr::get($attributes, 'team_ids')))
                    ->label(__('Choose team member'))
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
});
