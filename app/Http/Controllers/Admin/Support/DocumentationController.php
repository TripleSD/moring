<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Parsedown;

/**
 * Class DocumentationController
 */
class DocumentationController extends Controller
{
    public function getIndex()
    {
        return view('admin.documentation.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function getChangeLog()
    {
        $file = file_get_contents('../CHANGELOG.md');
        $markdownParse = new Parsedown();
        $text = $markdownParse->text($file);

        return view('admin.documentation.changelog', compact('text'));
    }

    /**
     * @return Application|Factory|View
     */
    public function about()
    {
        $file = file_get_contents('../README.md');
        $markdownParse = new Parsedown();
        $text = $markdownParse->text($file);

        return view('admin.documentation.about', compact('text'));
    }
}
