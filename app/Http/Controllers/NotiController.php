<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Noti;

class NotiController extends Controller
{
    public function index()
    {
        $my_id = auth()->user()->id;
        $notis = Noti::where('to',$my_id)->orderBy('created_at','desc')->get();

        Noti::where([
            ['to',$my_id]
        ])->update(['is_read' => 1]);
        
        return view('notification.show',[
            'notis' => $notis
        ]);
    }

    public function getNoti(Request $request)
    {
        $my_id = auth()->user()->id;
        $start = $request->start;

        $notis = Noti::where('to',$my_id)->orderBy('created_at','desc')->skip($start)->take(10)->get();

        Noti::where([
            ['to',$my_id]
        ])->update(['is_read' => 1]);
        
        return view('notification.index',[
            'notis' => $notis
        ]);
    }
}
