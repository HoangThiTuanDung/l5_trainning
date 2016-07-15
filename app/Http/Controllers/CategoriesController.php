<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', ['categories' => $categories]);
    }

    public function show($id)
    {
        $validate = Category::validateParams(['id' => $id]);

        if ($validate) {
            $category = Category::find($id);

            return view('categories.show', ['category' => $category]);
        } else {
            return view('errors.404', ['message' => 'Category not found!']);
        }
    }
}
