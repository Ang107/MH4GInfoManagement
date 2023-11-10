<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Room extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    public function invite_user()
    {
        return $this->belongsTo(User::class);
    }
    public function invited_user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function messages()   
    {
        return $this->hasMany(Message::class);  
    }
    
    public function  getPaginateByLimit()
    {   
        return $this->where('invite_user_id',Auth::id())->orWhere('invited_user_id', Auth::id())->orderBy('last_sent_at', 'DESC')->paginate(20);
        
    }
    
    protected $fillable = [
    'invite_user_id',
    'invited_user_id',
    'last_sent_message'
    
    ];
    protected $dates = [
    'last_sent_at',
    ];
}
