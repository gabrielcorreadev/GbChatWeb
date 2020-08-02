<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'sender_id' => $this->sender_id,
            'message' => $this->message,
            'read' => $this->read,
            'created_at' => $this->created_at,
            'user' => [
                'id' => User::find($this->sender_id)->id,
                'name' => User::find($this->sender_id)->name,
                'email' => User::find($this->sender_id)->email,
                'photo' => User::find($this->sender_id)->photo,
                'phone' => User::find($this->sender_id)->phone
            ],
        ];
    }
}
