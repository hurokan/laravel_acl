<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use App\Models\Acl\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $btn_name = 'Save';
        $title = 'Add Menu';
        return view('acl.menu.index',['data' => Menu::all(),'menu' => new Menu(),'btn_name' => $btn_name,'title' => $title]);
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
    public function store(Request $request, Menu $menu)
    {
        try {
            if ($request->get('menu_id')){
                $message = 'Data update successfully';
                $menu->exists = true;
                $menu->id = $request->get('menu_id'); //already exists in database.
                $menu->fill($request->all());
                $data = $menu->save();
            }else{
                $message = 'Data save successfully';
                $menu->fill($request->all());
                $data = $menu->save();
            }

            if ($data){
                Session::flash('m-class', 'alert-success');
                Session::flash('message', $message);
                return redirect()->route('menu.index');
            }
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', 'Failed data save');
            return redirect()->route('menu.index');
        }catch (\Exception $exception){
            Session::flash('m-class', 'alert-danger');
            Session::flash('message', $exception->getMessage());
            return redirect()->route('menu.index');
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
        $title = 'Update Menu';
        return view('acl.menu.index',['menu' => Menu::find($id),'data' => Menu::all(),'btn_name' => $btn_name,'title' => $title]);
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
    public function destroy($id,Menu $menu)
    {
        $data = $menu->find($id);
        $status = $data->delete();
        if ($status)
            Session::flash('m-class', 'alert-success');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('menu.index');

        Session::flash('m-class', 'alert-danger');
        Session::flash('message', 'Data delete successfully');
        return redirect()->route('menu.index');
    }

}
