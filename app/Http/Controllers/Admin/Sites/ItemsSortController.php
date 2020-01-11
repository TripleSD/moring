<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Http\Controllers\Controller;
use App\Models\ItemsSort;
use App\Repositories\ItemsSortRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsSortController extends Controller
{
    public function __invoke(Request $request)
    {
        $id = Auth::id();
        (new ItemsSortRepository())->store($request, $id);
    }
}
