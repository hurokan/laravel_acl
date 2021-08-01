<?php

namespace App\Http\Controllers;

use App\Models\Acl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function changePassword(){
        return view('auth.passwords.change',['auth'=>Auth::user()]);
    }
    public function storeChangePassword(Request $request,User $user){
        $request->validate([
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ]);

        try {
            if ($request->get('user_id')){
                $user->exists = true;
                $user->id = $request->get('user_id'); //already exists in database.
                $user->fill($request->all());
                $user->password=Hash::make($request->get('password'));
                $user->remember_token= Str::random(10);
                $data = $user->save();
                $message = 'Password changed successfully';
            }
            if ($data){
                Session::flash('m-class', 'alert-success');
                Session::flash('message', $message);
                return redirect()->route('change-password');
            }
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', 'Failed data save');
            return redirect()->route('change-password')->withInput();
        }catch (\Exception $exception){
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', $exception->getMessage());
            return redirect()->route('change-password')->withInput();
        }
    }
}
