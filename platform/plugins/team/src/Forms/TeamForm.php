<?php

namespace Botble\Team\Forms;

use Botble\Base\Forms\FieldOptions\ContentFieldOption;
use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\EditorField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\Team\Http\Requests\TeamRequest;
use Botble\Team\Models\Team;
use Illuminate\Support\Arr;
class TeamForm extends FormAbstract
{
    public function setup(): void
    {
        $socials = $this->model->socials ?? [];

        $this
            ->model(Team::class)
            ->setValidatorClass(TeamRequest::class)
            ->columns()
            ->add('name', TextField::class, NameFieldOption::make()->required()->colspan(2))
            ->add('description', TextareaField::class, DescriptionFieldOption::make()->colspan(2))
            ->add('content', EditorField::class, ContentFieldOption::make()->allowedShortcodes()->colspan(2))
            ->add(
                'title',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/team::team.forms.title'))
                    ->placeholder(trans('plugins/team::team.forms.title_placeholder'))
                    ->maxLength(120)
                    ->colspan(2)
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/team::team.forms.phone_number'))
                    ->placeholder(trans('plugins/team::team.forms.phone_number'))
                    ->maxLength(120)
            )
            ->add(
                'email',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/team::team.forms.email'))
                    ->placeholder(trans('plugins/team::team.forms.email'))
                    ->maxLength(120)
            );

        // Giữ lại Facebook và thêm Zalo
        foreach (['facebook', 'zalo'] as $social) {
            $this->add(
                "socials[$social]",
                TextField::class,
                TextFieldOption::make()
                    ->label(ucfirst($social)) // hoặc dùng trans nếu cần đa ngôn ngữ
                    ->placeholder("Nhập liên kết $social")
                    ->maxLength(120)
                    ->value(Arr::get($socials, $social))
                    ->colspan(2)
            );
        }

        $this
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->add('photo', MediaImageField::class, MediaImageFieldOption::make()->label(trans('plugins/team::team.forms.photo')))
            ->setBreakFieldPoint('status');
    }
}
