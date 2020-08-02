<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

use App\Http\Resources\UserResource as UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::get();
        return UserResource::collection($users);
    }

    public function getusers()
    {
        $users = User::get();
        return UserResource::collection($users);
    }
}
