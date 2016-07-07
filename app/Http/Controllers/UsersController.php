<?php

namespace App\Http\Controllers;

use App\User;;
use Illuminate\Http\Request;
use App\Http\Requests;

class UsersController extends Controller
{
    public function show($userID)
    {
        $user = User::find($userID);

        return view('users.update', compact('user'));
    }

    public function update(Request $request, $userID)
    {
        if (!User::validateUpdate($request->all())) {
            return redirect()->back()->withErrors(User::getErrors());
        }
        
        $user = User::find($userID);
        $user->name = $request->name;

        if ($request->file()) {
            $fileName = uploadImg($request);
            $user->avatar = '/img/' . $fileName;
        }

        if ($user->save()) {
            return redirect('users/' . $user->id)->with(['flash_message' => 'update successfully!', 'flash_message_type' => 'success']);
        }
    }
}
