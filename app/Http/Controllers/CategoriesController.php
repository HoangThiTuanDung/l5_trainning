<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index',['categories' => $categories]);
    }

    public function show($catID)
    {
        $category = Category::find($catID);
        return view('categories.show', ['category' => $category]);
    }
}
