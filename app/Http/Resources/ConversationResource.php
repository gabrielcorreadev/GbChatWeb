<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Messages;

class ConversationResource extends JsonResource
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
            'user_one_id' => $this->user_one_id,
            'user_two_id' => $this->user_two_id,
            'type_chat' => $this->type_chat,
            'created_at' => $this->created_at,
            'messages' => Messages::where('conversation_id', $this->id)->orderBy('created_at', 'asc')->get()
            ];
    }
}
