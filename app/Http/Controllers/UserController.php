<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class UserController extends Controller
{
   public function signup(Request $request){

    $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'zipcode' => 'required',
        'address' => 'required',
        'file' => 'required'
        ]);

        $storage = Storage::put('files/' .Str::random(20), $request->file);

        // for now i am using storage path directly when we do implementation we can set that in config file properly
        $final_url_for_file = 'http://localhost/assignment/storage/app/'.$storage;
          $user = \App\Models\User::create([
                'name' => $request->name,
                'email' =>  $request->email,
                 'phone' =>  $request->phone,
                'address' =>  $request->address,
                'zipcode' => $request->zipcode,
                'file' => $final_url_for_file
            ]);
            return response($user, 200);
   }
}
