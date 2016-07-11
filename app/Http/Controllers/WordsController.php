<?php

namespace App\Http\Controllers;

use App\Category;
use App\Word;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class WordsController extends Controller
{
    const NOT_LEARNED = 0;
    const LEARNED = 1;
    const ALL = 2;

    public function index()
    {
        $categories = Category::lists('name', 'id')->all();
        array_unshift($categories, "--Choose option--");
        
        return view('words.list', ['categories' => $categories]);
    }

    public function show($id)
    {
        $validate = Word::validateParams(['id' => $id]);

        if ($validate) {
            $word = Word::with('wordAnswers')->find($id);
            
            return view('words.show', ['word' => $word]);
        } else {
            return view('errors.404', ['message' => 'Word not found!']);
        }
        
    }

    public function search(Request $request)
    {
        if (!Word::validateRequest($request->all())) {
            $validateErrors = Word::geterrors();
            
            return response()->json(['errors' => $validateErrors], 422);
        }

        $flag = $request->flag;
        $cateID = $request->category_id;
        $userID = Auth::id();

        if ($flag == self::ALL) {
            $words = Word::where('category_id', $cateID)->get();
        } elseif ($flag == self::LEARNED) {
            $words = Word::wordsCorrect($userID, self::LEARNED, $cateID);
        } else {
            $words = Word::wordsCorrect($userID, self::NOT_LEARNED , $cateID);
        }

        $view = view('words.search', ['words' => $words]);

        return response()->json(['results' => $view->render()], 200);
    }
}
