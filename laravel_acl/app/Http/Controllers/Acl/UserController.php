<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Acl\Role;
use App\Models\Acl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btn_name = 'Save';
        $title = 'Add User';
        return view('acl.user.index',['user' => new User(),
                                           'role' => Role::all(),
                                           'data'=>User::all(),
                                           'btn_name' => $btn_name,'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->user_id, 'id')
            ],
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
            'role_id' => 'required',
        ]);

        try {
            if ($request->get('user_id')){
                $user->exists = true;
                $user->id = $request->get('user_id'); //already exists in database.
                $user->fill($request->all());
                $data = $user->save();
                $message = 'Data update successfully';
            }else{
                $user->fill($request->all());
                $user->password=Hash::make($request->get('password'));
                $user->remember_token= Str::random(10);
                $data = $user->save();
                $message = 'Data save successfully';
            }

            if ($data){
                Session::flash('m-class', 'alert-success');
                Session::flash('message', $message);
                return redirect()->route('user.index');
            }
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', 'Failed data save');
            return redirect()->route('user.index')->withInput();
        }catch (\Exception $exception){
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', $exception->getMessage());
            return redirect()->route('user.index')->withInput();
        }
    }

    /**
     * Display the specified resource.

     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $btn_name = 'Update';
        $title = 'Edit User';
        return view('acl.user.index', ['data' => User::all(),
                                            'user' => User::find($id),
                                            'role' => Role::all(),
                                            'btn_name' => $btn_name,
                                            'title' => $title]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,User $user)
    {
        $data = $user->find($id);
        $status = $data->delete();
        if ($status)
            Session::flash('m-class', 'alert-success');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('role.index');

        Session::flash('m-class', 'alert-danger');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('role.index');
    }

}
