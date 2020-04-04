<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profile;

class ProfileController extends Controller
{   
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(User $user){
        $follow = DB::table('profile_user')->where([
            ['user_id', auth()->user()->id],
            ['profile_id', $user->profile->id],
        ])->get();
        $follows = false;
        if($follow->count() > 0){
            $follows = true;
        }
        return view('profiles.index', [
            'user' => $user,
            'follows' => $follows
        ]);
    }

    public function edit(){
        $user = auth()->user();
        $profile = DB::table('profiles')->where('user_id', $user->id)->first();
        return view('profiles.edit', [
            'user' => $user,
            'profile' => $profile
        ]);
    }

    public function changepass(){
        $user = auth()->user();
        return view('profiles.changepass', [
            'user' => $user
        ]);
    }

    public function updatepass(Request $request,User $user){
        $data = $request->validate([
            'old_password' => 'required',
             'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if (Hash::check($data['old_password'], $user->password)) {
            $user->password = Hash::make($data['password']);
            $user->save();
            return redirect('/profile/' . $user->id);
        }
        else{
            return redirect()->route('profile.editpass')->with('error_pass', 'Old password not correct !');
        }
    }

    public function changePassView()
    {
        return view('profiles.changepass' , [ 'user' => auth()->user()->id ]);
    }

    public function create(){
        return view('completeprofile');
    }

    public function store(Request $request){
        $data =  $request->validate([
            'title' => 'required|unique:profiles|max:255',
            'description' => 'required|unique:profiles|max:255',
            'url' => 'required|unique:profiles|max:255',
        ]);

        $user_id = auth()->user()->id;

        auth()->user()->profile()->create([
            'user_id' => $user_id,
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url']
        ]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function changeimage(Request $request){
        // $data = $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $user_id = auth()->user()->id;
        $profile = DB::table('profiles')->where('user_id',$user_id)->first();
        if(File::exists(public_path('thumbs/' . $profile->url_thumb))){

            File::delete(public_path('thumbs/' . $profile->url_thumb));
        }

        $image = $request->file('image');
        $image_path = time() . '.' . $image->getClientOriginalExtension();
        
        $path = public_path('/thumbs');   

        $image->move($path ,$image_path);

        DB::table('profiles')
            ->updateOrInsert(
                ['user_id' => $user_id],
                ['url_thumb' => $image_path]);
        
        return redirect('/profile/'. $user_id);
    }

    public function update(User $user, Request $request){
        $data =  $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'url' => 'required|unique:profiles|max:255',
        ]);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();

        $profile = $user->profile;
        $profile->title = $data['title'];
        $profile->description = $data['description'];
        $profile->url =$data['url'];
        $profile->save();

        return redirect('/profile/'. $user->id);
    }
}
