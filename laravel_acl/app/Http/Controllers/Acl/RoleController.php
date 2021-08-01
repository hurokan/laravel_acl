<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Acl\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btn_name = 'Save';
        $title = 'Add Role';
        return view('acl.role.index',['data' => Role::all(),'role' => new Role(),'btn_name' => $btn_name,'title' => $title]);
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
    public function store(Request $request, Role $role)
    {
        try {
            if ($request->get('role_id')){
                $message = 'Data update successfully';
                $role->exists = true;
                $role->id = $request->get('role_id'); //already exists in database.
                $role->fill($request->all());
                $data = $role->save();
            }else{
                $message = 'Data save successfully';
                $role->fill($request->all());
                $data = $role->save();
            }

            if ($data){
                Session::flash('m-class', 'alert-success');
                Session::flash('message', $message);
                return redirect()->route('role.index');
            }
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', 'Failed data save');
            return redirect()->route('role.index');
        }catch (\Exception $exception){
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', $exception->getMessage());
            return redirect()->route('role.index');
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
        $title = 'Edit Role';
        return view('acl.role.index',['data' => Role::all(),'role' => Role::find($id),'btn_name' => $btn_name,'title' => $title]);
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
    public function destroy($id,Role $role)
    {
        $data = $role->find($id);
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
