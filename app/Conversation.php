<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = ['id', 'user_one_id', 'user_two_id', 'type_chat'];
}
