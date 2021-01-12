<?php

namespace App\Http\Controllers\Elements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class HeaderController extends Controller
{
    public function show()
    {
        $data = [
            'categories' => Category::all(),
        ];
        return view('elements.header', $data);
    }
}
