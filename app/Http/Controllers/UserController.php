<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;  
use App\Http\Requests\Auth\UserRequest;

class UserController extends Controller
{
    #ユーザー詳細
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('users.show')->with(['user' => $user]);
    }
    
    #ユーザー編集画面
    public function edit(User $user)
    {
        return view('users.edit');
    }
    
    #ユーザー更新
    public function update(UserRequest $request, User $user)
    {
        $input_user = $request['user'];
        $user->fill($input_user)->save();
        return redirect('/users/'. Auth::id());
    }
    


}
