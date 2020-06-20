<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;
use App\MessageGroup;

class ChatController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $messages = MessageGroup::all();
        return view('admin.chat.show',compact('admins','messages'));
    }
}
