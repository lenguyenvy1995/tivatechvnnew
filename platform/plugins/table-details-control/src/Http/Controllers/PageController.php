<?php

namespace Plugin\TableDetailsControl\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Page\Forms\PageForm;
use Botble\Page\Models\Page;
use Plugin\TableDetailsControl\Supports\DetailsControlSupport;

class PageController extends BaseController
{
    public function show(Page $page)
    {
        $form = DetailsControlSupport::createForm(PageForm::class, $page);

        return $this
            ->httpResponse()
            ->setData([
                'html' => view('plugins/table-details-control::pages.show', compact('page', 'form'))->render(),
            ])
            ->toApiResponse();
    }
}
