<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::with('lesson')->where('user_id', Auth::id())->get();
        $totalLearned = DB::table('activities')->where('user_id', Auth::id())->sum('words_numbers');

        return view('home', ['user' => Auth::user(), 'activities' => $activities, 'totalLearned' => $totalLearned]);
    }
}
