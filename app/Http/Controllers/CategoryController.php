<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        // $category = category::all();
        return view('category');
    }

    public function getCategory()
    {
        $category = category::all();
        return response()->json(['status' => 'success', 'category' => $category], 200);
    }
}
