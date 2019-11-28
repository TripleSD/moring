<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function getIndex()
    {
        return view('empty');
    }
}