<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Profile;
use App\Message;
use Pusher\Pusher;

class MessageController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $following = auth()->user()->following->pluck('user_id')->toArray();
        if($following != []){
        $count_mess = DB::table('messages')->whereIn('from',$following)->where([
            ['to',auth()->user()->id],
            ['is_read','0']
        ])->distinct()->pluck('from')->count();
        $count_request = DB::table('messages')->whereNotIn('from',$following)->where([
            ['to',auth()->user()->id],
            ['is_read','0']
        ])->distinct()->pluck('from')->count(); 
        $users = DB::select('select `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`,count(is_read) as unread from `users` left join `messages` on `users`.`id` = `messages`.`from` and is_read = 0 and messages.to = ' . auth()->user()->id .'  left join `profiles` on (`users`.`id` = `profiles`.`user_id`) where `users`.`id` != ' . auth()->user()->id .' and `users`.`id`  in (' . implode(',', array_map('intval', $following)) . ') group by `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`;');
        return view('messages.show', \compact('users','count_mess','count_request'));    
        }
        // dd($users);
        // $users = DB::table('users')
        //         ->leftJoin('messages',[
        //             ['users.id','=','messages.from'],
        //         ])
        //         ->leftJoin('profiles',[
        //             ['users.id','=','profiles.user_id']
        //         ])
        //         ->select('users.id','users.name','users.email', DB::raw('COUNT(messages.is_read) as unread'),'profiles.url_thumb')
        //         // ->whereIn('users.id',$following)
        //         ->where([
        //             ['users.id','!=',auth()->user()->id],
        //             ['is_read', 0],
        //             ['messages.to', auth()->user()->id]
        //         ])
        //         ->groupBy('users.id','users.name','users.email','profiles.url_thumb')
        //         ->get(); 
        
        // dd($users);

        return view('messages.show'); 
    }


    public function getMessage($user_id)
    {   
        $my_id = auth()->user()->id;
        Message::where([
            ['from',$user_id],
            ['to',$my_id]
        ])->update(['is_read' => 1]);
        $messages = Message::where(function ($query) use ($user_id,$my_id){
            $query->where('from',$my_id)->where('to',$user_id);
        })->orWhere(function($query) use($user_id,$my_id){
            $query->where('from',$user_id)->where('to',$my_id);
        })->get();

        return view('messages.index',['messages' => $messages]);
    }

    public function sendMessage(Request $request)
    {
        $from = auth()->user()->id;
        $to = $request->receiver_id;
        $message = $request->message;

        $data = new Message();
        $data->from = $from;
        $data->to = $to;
        $data->message = $message;
        $data->is_read = 0; // message will be unread when sending message
        $data->save();

        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $user = User::find($to);
        $followers = $user->following->pluck('user_id');
        $checkInFl = false;
        for($i = 0;$i<count($followers);$i++){
            if($followers[$i] == $from){
                $checkInFl = true;
                break;
            }
        }

        $data = ['from' => $from, 'to' => $to,'check'=>$checkInFl]; // sending from and to user id when pressed enter
        $pusher->trigger('channel-message', 'event-message', $data);
    }

    public function getRequest()
    {
        $following = auth()->user()->following->pluck('user_id')->toArray();
        if($following != []){
            $users = DB::select('select `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`,count(is_read) as unread from `users` left join `messages` on `users`.`id` = `messages`.`from` and is_read = 0 and messages.to = ' . auth()->user()->id .'  left join `profiles` on (`users`.`id` = `profiles`.`user_id`) where `users`.`id` != ' . auth()->user()->id .' and `users`.`id` not in (' . implode(',', array_map('intval', $following)) . ') and messages.to = ' . auth()->user()->id .'  group by `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`;');
            return view('messages.request', [
                'users' => $users
            ]);
        }
        
        return view('messages.request');
    }

    public function getReccent()
    {   
        $following = auth()->user()->following->pluck('user_id')->toArray();
        if($following != []){
        $users = DB::select('select `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`,count(is_read) as unread from `users` left join `messages` on `users`.`id` = `messages`.`from` and is_read = 0 and messages.to = ' . auth()->user()->id .'  left join `profiles` on (`users`.`id` = `profiles`.`user_id`) where `users`.`id` != ' . auth()->user()->id .' and `users`.`id`  in (' . implode(',', array_map('intval', $following)) . ') group by `users`.`id`, `users`.`name`, `users`.`email`, `profiles`.`url_thumb`;');
        
        return view('messages.reccent',[
            'users' => $users
        ]);
    }

        return view('messages.reccent');
    }
}
