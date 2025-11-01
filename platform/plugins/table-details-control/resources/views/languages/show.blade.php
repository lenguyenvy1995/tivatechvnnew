@php
    use Plugin\TableDetailsControl\Supports\DetailsControlSupport;
@endphp

@foreach ($form->getFields() as $key => $field)
    @if (in_array($key, $columns))
        @php
            $value = $model->translations->where('lang_code', $locale)->value($key);
        @endphp

        <div class="mb-3 position-relative">
            <x-core::form.label
                for="show-detail-{{ $model->getKey() }}-{{ $field->getName() }}-{{ $locale }}"
                :label="$field->getOption('label') . ':'"
                @class(['d-inline'])
            />
            <div class="d-inline">
                {!! DetailsControlSupport::getItem($model, $field, $key, $value) !!}
            </div>
        </div>
    @endif
@endforeach
