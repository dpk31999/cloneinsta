<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $students = User::where('username', 'like', '%' . $request->value . '%')->orWhere('name', 'like', '%' . $request->value . '%')->get();

        return response()->json($students);
    }
}
