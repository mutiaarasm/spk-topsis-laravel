<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function registerpage (){
        return view ('register');
    }
    public function register(Request $request)
     {
         // Validasi data
         $validator = Validator::make($request->all(), [
             'name' => ['required', 'string', 'max:255'],
             'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
             'password' => ['required', 'string', 'min:8', 'confirmed'],
         ]);
 
         if ($validator->fails()) {
             return redirect()->back()
                              ->withErrors($validator)
                              ->withInput();
         }
 
         // Buat pengguna baru
         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
         ]);

         event(new Registered($user));

         Auth::login($user);
 
         // Redirect atau bisa langsung login
         return redirect('/email/verify');
     }
}
