@php
    $tabs = Shortcode::fields()->getTabsData(['title', 'description', 'icon', 'icon_image'], $shortcode);
@endphp

<section class="py-5 contact__area shortcode-contact-form">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="contact__content">
                    <div class="section-title mb-35">
                        @if ($title = $shortcode->title)
                            <h2 class="title">{!! BaseHelper::clean($title) !!}</h2>
                        @endif

                        @if ($description = $shortcode->description)
                            <p>{!! BaseHelper::clean($description) !!}</p>
                        @endif
                    </div>

                    @if (count($tabs))
                        <div class="contact__info">
                            <ul class="list-wrap">
                                @foreach($tabs as $item)
                                    @continue(! $title = Arr::get($item, 'title'))
                                    <li>
                                        <div class="icon">
                                            @if ($iconImage = Arr::get($item, 'icon_image'))
                                                {{ RvMedia::image($iconImage, 'icon') }}
                                            @elseif ($icon = Arr::get($item, 'icon'))
                                                <x-core::icon :name="$icon"/>
                                            @endif
                                        </div>
                                        <div class="content">
                                            <h4 class="title">{!! BaseHelper::clean($title) !!}</h4>

                                            @if ($desc = Arr::get($item, 'description'))
                                                <p>{!! BaseHelper::clean($desc) !!}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact__form-wrap">
                    @if ($formTitle = $shortcode->form_title)
                        <h2 class="title">{!! BaseHelper::clean($formTitle) !!}</h2>
                    @endif

                    @if ($formDescription = $shortcode->form_description)
                        <p class="truncate-2-custom">{!! BaseHelper::clean($formDescription) !!}</p>
                    @endif

                    @php
                        // --- cấu hình hiển thị từ admin ---
                        $group = $shortcode->service_group ?? 'all';          // ads | website | all
                        $defaultKey = $shortcode->default_service ?? null;     // ví dụ: ads_gg_gdn

                        // danh sách lựa chọn
                        $ads = [
                            'ADS - GG Search' => 'ADS - GG Search',
                            'ADS - GG GDN'    => 'ADS - GG GDN',
                            'ADS - Zalo ADS'  => 'ADS - Zalo ADS',
                        ];
                        $web = [
                            'Website - Thiết kế website' => 'Website - Thiết kế website',
                            'Website - SEO'              => 'Website - SEO',
                            'Website - Chăm sóc website' => 'Website - Chăm sóc website',
                            'Website - Giám sát website' => 'Website - Giám sát website',
                        ];

                        // map key default -> label
                        $keyMap = [
                            'ads_gg_search' => 'ADS - GG Search',
                            'ads_gg_gdn'    => 'ADS - GG GDN',
                            'ads_zalo'      => 'ADS - Zalo ADS',
                            'web_thiet_ke'  => 'Website - Thiết kế website',
                            'web_seo'       => 'Website - SEO',
                            'web_cskh'      => 'Website - Chăm sóc website',
                            'web_giam_sat'  => 'Website - Giám sát website',
                        ];

                        // lọc theo group
                        if ($group === 'ads') {
                            $choices = $ads;
                        } elseif ($group === 'website') {
                            $choices = $web;
                        } else {
                            $choices = $ads + $web; // gộp
                        }

                        // giá trị mặc định (nếu thuộc group)
                        $defaultValue = $keyMap[$defaultKey] ?? null;
                        if ($defaultValue && !array_key_exists($defaultValue, $choices)) {
                            $defaultValue = null;
                        }

                        // --- chỉnh form: bỏ field thừa + chèn subject (select) ngay sau phone ---
                        $form
                            ->remove('address')   // bỏ địa chỉ nếu plugin còn field này
                            ->remove('subject')   // bỏ subject text mặc định của plugin
                            ->addAfter('phone', 'subject', 'select', [
                                'label'       => __('Dịch vụ quan tâm'),
                                'choices'     => $choices,
                                'empty_value' => __('Chọn dịch vụ quan tâm'),
                                'attr'        => ['class' => 'form-select'],
                                'value'       => $defaultValue,
                                // đặt vị trí/width: cùng hàng với "Điện thoại"
                                'wrapper'     => ['class' => 'form-grp col-md-6'],
                            ]);
                    @endphp

                    {!! $form
                        ->setFormInputClass('')
                        ->setFormInputWrapperClass('form-grp')
                        ->setFormLabelClass('form-label')
                        ->modify(
                            'submit',
                            'submit',
                            ['attr' => ['class' => 'btn'], 'label' => $shortcode->form_button_label ?: __('Submit')],
                            true
                        )
                        ->renderForm()
                    !!}

                    <p class="ajax-response mb-0"></p>
                </div>
            </div>
        </div>
    </div>
</section>