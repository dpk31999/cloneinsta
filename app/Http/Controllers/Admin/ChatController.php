<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin;

class ChatController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.chat.show',compact('admins'));
    }
}
