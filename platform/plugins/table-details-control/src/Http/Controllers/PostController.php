<?php

namespace Plugin\TableDetailsControl\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Blog\Forms\PostForm;
use Botble\Blog\Models\Post;
use Plugin\TableDetailsControl\Supports\DetailsControlSupport;

class PostController extends BaseController
{
    public function show($post)
    {
        abort_unless(is_plugin_active('blog'), 404);

        $post = Post::query()->findOrFail($post);

        $form = DetailsControlSupport::createForm(PostForm::class, $post);

        return $this
            ->httpResponse()
            ->setData([
                'html' => view('plugins/table-details-control::posts.show', compact('post', 'form'))->render(),
            ])
            ->toApiResponse();
    }
}
