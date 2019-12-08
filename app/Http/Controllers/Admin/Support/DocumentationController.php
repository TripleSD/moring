<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    public function getIndex()
    {
        return view('admin.documentation.index');
    }
}
