<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function getIndex()
    {
        return view('empty');
    }
}