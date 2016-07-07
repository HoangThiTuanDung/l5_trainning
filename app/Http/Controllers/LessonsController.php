<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Lesson;
use App\LessonWord;
use App\Word;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class LessonsController extends Controller
{
    public function show($lessonID)
    {
        $lesson = Lesson::getWord($lessonID);
        $totalWord = Lesson::find($lessonID)->words->count();

        return view('lessons.show', ['lesson' => $lesson, 'totalWord' => $totalWord]);
    }

    public function answer(Request $request)
    {
        $lessonID = (int)$request->lesson_id;
        $wordID = (int)$request->word_id;
        $wordAnswerID = (int)$request->word_answer_id;

        $lessonWord = LessonWord::where(['lesson_id' => $lessonID, 'word_id' => $wordID])->first();

        if (!count($lessonWord)) {
            $lessonWord = new LessonWord;
        }

        $lessonWord->user_id = Auth::id();
        $lessonWord->lesson_id = $lessonID;
        $lessonWord->word_id = $wordID;
        $lessonWord->word_answer_id = $wordAnswerID;

        if ($lessonWord->save()) {
            $nextWord = ($request->cur_word) + 1;
            $totalWord = Lesson::find($lessonID)->words->count();

            if (($nextWord == $totalWord) || (isset($request->re_learn))) {
                //Update the words which User have learned(word_answer.correct is true) in this lesson
                $totalWordCorrect = Lesson::wordsCorrect(Auth::id(), $lessonID);
                $activity = Activity::where(['lesson_id' => $lessonID, 'user_id' => Auth::id()])->get()->first();

                if (!count($activity)) {
                    $activity = new Activity;
                }
                $activity->lesson_id = $lessonID;
                $activity->words_numbers = $totalWordCorrect;
                $activity->user_id = Auth::id();
                $activity->save();

                return response()->json(['msg' => 'complete'], 200);
            }

            $lesson = Lesson::getWord($lessonID, $nextWord);

            $view = view('lessons.partial', ['lesson' => $lesson, 'totalWord' => $totalWord, 'wordNumber' => $nextWord]);

            return response()->json(['msg' => $view->render()], 200);
        } else {
            return response()->json(['msg' => 'Please reload page and try again!'], 400);
        }
    }

    public function reLearnWord($wordID)
    {
        $word = Word::with('wordAnswers')->find($wordID);

        return view('lessons.re_learn_word', ['word' => $word]);
    }

    public function result($lessonID)
    {
        $lessonWords = LessonWord::with('wordAnswer')->where(['lesson_id' => $lessonID, 'user_id' => Auth::id()])->paginate(10);

        return view('lessons.result', ['lesson_words' => $lessonWords]);
    }
}
