<?php

namespace App\Http\Controllers\Api;

use App\Conversation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Resources\ConversationResource as ConversationResource;
use App\Http\Resources\ConversationCollection as ConversationCollection;

class ConversationController extends Controller
{
    public function index()
    {
        $conversation = Conversation::all();

        return new ConversationCollection($conversation);
    }

    public function getConversationById($id)
    {
        $conversation = Conversation::find($id); //id comes from route

        if($conversation){
            return new ConversationResource($conversation);
        }
        return response()->json("Conversation Not found", 400);
    }

    public function getConversationByUserId($id)
    {
        $conversation = Conversation::where('user_one_id', $id)->orWhere('user_two_id', $id)->get(); //id comes from route
        if($conversation){
            return new ConversationCollection($conversation);
        }
        return response()->json("Conversation Not found", 400);
    }

    public function sendConversation(Request $request)
    {
            $validator = Validator::make($request->all(), [
            'user_one_id' => 'required|integer|max:11',
            'user_two_id' => 'required|integer|max:11',
            'type_chat' => 'required|integer|max:11',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
        }

        $conversation = Conversation::create([
            'user_one_id' => $request->get('user_one_id'),
            'user_two_id' => $request->get('user_two_id'),
            'type_chat' => $request->get('type_chat'),
        ]);

        return response()->json(compact('conversation'),201);
    }
}
