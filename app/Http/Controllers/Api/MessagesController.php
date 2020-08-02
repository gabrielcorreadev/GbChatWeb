<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Conversation;
use App\Messages;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\MessageResource as MessageResource;

class MessagesController extends Controller
{
    //
    public function index()
    {
        $messages = Messages::get();

        return MessageResource::collection($messages);
    }

    public function getMessageById($id)
    {
        $message = Messages::find($id); //id comes from route
        if( $message ){
            return new MessageResource($message);
        }
        return response()->json("Message Not found", 400);
    }

    public function sendMessage(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'sender_id' => 'required|integer|max:11',
            'recipent_id' => 'required|integer|max:11',
            'message' => 'required|string|max:255',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $conversation_id = $request->get('conversation_id');

        if(!$request->get('conversation_id'))
        {
            $conversation = Conversation::create([
                'user_one_id' => $request->get('sender_id'),
                'user_two_id' => $request->get('recipent_id'),
                'type_chat' => 1,
            ]);

            $conversation_id = $conversation->id;
        }

        $message = Messages::create([
            'sender_id' => $request->get('sender_id'),
            'recipent_id' => $request->get('recipent_id'),
            'conversation_id' => $conversation_id,
            'message' => $request->get('message'),
        ]);

        return response()->json(compact('message'),201);
    }
}
