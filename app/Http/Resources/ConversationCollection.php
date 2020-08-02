<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Messages;
use App\User;
use JWTAuth;

class ConversationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($page){
                return [
                    'id' => $page->id,
                    'user_one' => [
                        'id' => $page->user_one_id,
                        'name' => User::find($page->user_one_id)->name,
                        'photo' => User::find($page->user_one_id)->photo,
                    ],
                    'user_two' => [
                        'id' => $page->user_two_id,
                        'name' => User::find($page->user_two_id)->name,
                        'photo' => User::find($page->user_two_id)->photo,
                    ],
                    'type_chat' => $page->type_chat,
                    'created_at' => $page->created_at,
                    'recent_message' => [
                        'message' => Messages::where('conversation_id', $page->id)->orderBy('created_at', 'desc')->first()->message,
                        'created_at' => Messages::where('conversation_id', $page->id)->orderBy('created_at', 'desc')->first()->created_at,
                        'read' => Messages::where('conversation_id', $page->id)->orderBy('created_at', 'desc')->first()->read,
                    ]
                ];
            }),
        ];
    }
}
