<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomController;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    #メッセージ登録
    public function store(MessageRequest $request, User $user, Message $message)
    {
        $input_message = $request['message'];
        $message->fill($input_message)->save();
        $room_controller = new RoomController();
        $room_controller->update($input_message['body'],$user->id,Auth::id());
        return redirect('/DM/' . $user->id);
    }
}
