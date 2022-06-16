<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class userManagerController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user-manager.index',compact('users'));
    }

    public function makeAdmin(Request $request){
        $currentUser = User::find($request->id);
        if ($currentUser->role == 1){
            $currentUser->role = '0';
            $currentUser->update();
        }
        return redirect()->back();
    }

    public function BanUser(Request $request){
        $currentUser = User::find($request->id);
        if ($currentUser->isBaned == 0){
            $currentUser->isBaned = '1';
            $currentUser->update();
        }
        return redirect()->back();
    }

    public function RestoreUser(Request $request){
        $currentUser = User::find($request->id);
        if ($currentUser->isBaned == 1){
            $currentUser->isBaned = '0';
            $currentUser->update();
        }
        return redirect()->back();
    }

    public function changeUserPassword(Request $request){
        $validator = Validator::make($request->all(),[
           "password" =>"required|string|min:8"
        ]);
        if ($validator->fails()){
            return response()->json(["status"=>422,"message"=>$validator->errors()]);
        }
        $currentUser = User::find($request->id);
        if ($currentUser->role == 1){
            $currentUser->password = Hash::make($request->password);
            $currentUser->update();
        }
        return response()->json(["status"=>200,"message"=>"Password Change for $currentUser->name is complete"]);
    }
}
