<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RoomController;

class RoomController extends Controller
{
    #ルーム登録
    public function store($invite_user_id,$invited_user_id)
    {
        $room = new Room();
        $room->fill(['invite_user_id' => $invite_user_id, 'invited_user_id' => $invited_user_id])->save();
        
        $message = new Message();
        return ($room);
    }
    
    #ルーム一覧
    public function index(Room $room)
    {
        return view('room.index')->with(['rooms' => $room-> getPaginateByLimit()]);
    }
    
    #ルーム詳細
    public function show(User $user)
    {
        $messages = new Message();
        $room = new Room();
        
        if ($room->where('invite_user_id', $user->id)->where('invited_user_id', Auth::id())->exists()){
            $room = $room->where('invite_user_id', $user->id)->where('invited_user_id', Auth::id())->first();
            $messages = $messages->where('room_id',$room->id)->get();
            return view('room.show')->with(['messages' => $messages, 'user' => $user, 'room' => $room]);
        }
        else if ($room->where('invited_user_id', $user->id)->where('invite_user_id', Auth::id())->exists()){
            $room = $room->where('invited_user_id', $user->id)->where('invite_user_id', Auth::id())->first();
            $messages = $messages->where('room_id',$room->id)->get();
            return view('room.show')->with(['messages' => $messages, 'user' => $user, 'room' => $room]);
        }
        else{
            $room = $this->store(Auth::id(), $user->id);
            $messages = $messages->where('room_id',$room->id)->get();
            return view('room.show')->with(['messages' => $messages, 'user' => $user, 'room' => $room]);
        }
        
    }
    
    #最終メッセージ更新
    public function update($last_sent_message, $user_id_1, $user_id_2)
    {   
        $room = $this->get_room($user_id_1, $user_id_2);
        if ( mb_strlen($last_sent_message) > 20){
            $last_sent_message = mb_substr($last_sent_message, 0, 20) . '...';
        }
        $room->fill(['last_sent_message' => $last_sent_message])->save();
       
    }
    
    #二人のユーザIDからルーム取得
    private function get_room($user_id_1, $user_id_2)
    {
        $room = new Room();
        
        if ($room->where('invite_user_id', $user_id_1)->where('invited_user_id', $user_id_2)->exists())
        {
            $room = $room->where('invite_user_id', $user_id_1)->where('invited_user_id', $user_id_2)->first();
            return $room;
        }
        else
        {
            $room = $room->where('invited_user_id', $user_id_1)->where('invite_user_id', $user_id_2)->first();
            return $room;
        }
    }
    
}
