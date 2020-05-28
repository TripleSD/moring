<?php

namespace App\Http\Controllers\Admin\Support;

use Parsedown;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    public function getIndex()
    {
        return view('admin.documentation.index');
    }

    public function getChangeLog()
    {
        $file = file_get_contents('../CHANGELOG.md');
        $markdownParse = new Parsedown();
        $text = $markdownParse->text($file);

        return view('admin.documentation.changelog', compact('text'));
    }

    public function about()
    {
        $file = file_get_contents('../README.md');
        $markdownParse = new Parsedown();
        $text = $markdownParse->text($file);

        return view('admin.documentation.about', compact('text'));
    }
}
