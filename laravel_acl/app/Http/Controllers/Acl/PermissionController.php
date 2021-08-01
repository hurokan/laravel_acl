<?php

namespace App\Http\Controllers\Acl;


use App\Http\Controllers\Controller;
use App\Models\Acl\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btn_name = 'Save';
        $title = 'Add Permission';
        return view('acl.permission.index',
            ['data' => Permission::all(),
            'permission' => new Permission(),
            'btn_name' => $btn_name,
            'title' => $title]);
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
    public function store(Request $request, Permission $permission)
    {
        try {
            if ($request->get('permission_id')){
                $message = 'Data update successfully';
                $permission->exists = true;
                $permission->id = $request->get('permission_id'); //already exists in database.
                $permission->fill($request->all());
                $data = $permission->save();
            }else{
                $message = 'Data save successfully';
                $permission->fill($request->all());
                $data = $permission->save();
            }

            if ($data){
                Session::flash('m-class', 'alert-success');
                Session::flash('message', $message);
                return redirect()->route('permission.index');
            }
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', 'Failed data save');
            return redirect()->route('permission.index');
        }catch (\Exception $exception){
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', $exception->getMessage());
            return redirect()->route('permission.index');
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
        $title = 'Edit Permission';
        return view('acl.permission.index',
            ['permission' => Permission::find($id),
             'data'=>Permission::all(),
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
    public function destroy($id,Permission $permission)
    {
        $data = $permission->find($id);
        $status = $data->delete();
        if ($status)
            Session::flash('m-class', 'alert-success');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('permission.index');

        Session::flash('m-class', 'alert-danger');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('permission.index');
    }


}
