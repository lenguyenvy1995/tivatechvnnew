{!! do_action('table_details_control_before_show', $model, $form) !!}

<x-core::card>
    <x-core::card.header>
        <x-core::tab class="card-header-tabs">
            <x-core::tab.item
                :is-active="true"
                :id="'details-' . $model->getKey()"
                icon="ti ti-info-circle"
                :label="trans('plugins/table-details-control::table.details')"
            />

            {!! apply_filters('table_details_control_register_tabs', null, $model, $form) !!}
        </x-core::tab>
    </x-core::card.header>

    <x-core::card.body>
        <x-core::tab.content>
            <x-core::tab.pane
                :id="'details-' . $model->getKey()"
                :is-active="true"
            >
                @if ($form)
                    @foreach ($form->getFields() as $key => $field)
                        @if (in_array($field->getType(), ['hidden', \Botble\Base\Forms\Fields\HiddenField::class]))
                            @break
                        @endif

                        @include('plugins/table-details-control::partials.field')
                    @endforeach
                @endif
            </x-core::tab.pane>

            {!! apply_filters('table_details_control_register_contents', null, $model, $form) !!}
        </x-core::tab.content>
    </x-core::card.body>
</x-core::card>
