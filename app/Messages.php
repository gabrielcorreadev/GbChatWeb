<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    //
    protected $fillable = ['id', 'recipent_id', 'sender_id', 'conversation_id', 'message', 'read', 'trash', 'hide'];
}
