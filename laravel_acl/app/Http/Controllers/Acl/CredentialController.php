<?php

namespace App\Http\Controllers\Acl;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Acl\Menu;
use App\Models\Acl\Role;
use App\Models\Acl\RoleHasMenu;
use App\Models\Acl\RoleHasPermission;
use App\Models\Acl\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Helper\Helper;
class CredentialController extends Controller
{

    public function getMenuByRole($id,Menu $menu,Role $role,Permission $permission)
    {
        $roleData=$role->where('id',$id)->first();
        $roleHasMenuData=RoleHasMenu::where('role_id',$id)->get(['menu_id'])->sortBy('menu_id');
        $permissions=Permission::where('is_enabled',1)->get();
        $roleHasPermission=RoleHasPermission::where('role_id',$id)
                    ->get();
        $assigned_menu=array();
        $assigned_permission=array();
        foreach ($roleHasMenuData as $val){
            $assigned_menu[]=$val->menu_id;
        }
        foreach ($roleHasPermission as $per){
            $assigned_permission[]=$per->permission_id;
        }
        $menuData = $this->menu();
        $message = "";
        return view('acl.credential.index', [
            "menuList" => $menuData,
            'data' => $menu,
            'message' => $message,
            'rolaData'=>$roleData,
            'assignedMenu'=>$assigned_menu,
            'assignedPermission'=>$assigned_permission,
            'permissions'=>$permissions,
            'title' => 'Credential Setting'
        ]);

    }

    public function getPermissionByRole($id = null, RoleHasPermission $hasPermission, Permission $permission, Role $role)
    {
        $roleData = $role->find($id);
        $role_permission_data = $hasPermission->where('role_id', $id)->get(['permission_id'])->sortBy('permission_id');
        $menus = $role->find($id)->with('menus')->get();
        $roleMenus=$roleData->getMenus();

//        $modules = Permission::select('menu_id')->whereIn('menu_id', array_keys($menus))->groupBy('menu_id')->get()->sortBy('menu_id');
        // dd($modules);
        $selectedPermission = array();
        $permissions = $permission->get();
        foreach ($role_permission_data as $permission) {
            $selectedPermission[] = $permission->permission_id;
        }
        return view('acl.credential.permission', ['selectedPermission' => $selectedPermission,
            'permissions' => $permissions,
            'roleData' => $roleData,
            'menus' => $menus,
            'roleMenus' => $roleMenus,
            'title' => 'Add New Permission']);
    }

    public function menu() {
        //$val = $this->CategoryTree();
        $menu = new Menu();
        $menus = $menu->orderBy('sort_order', 'asc')->get(
            [
                'parent_menu_id as menu_id','route_name','menu_name as label', 'url', 'id',  'sort_order'
            ]
        )->toArray();
        return $this->menusToTree($menus);
    }

    function menusToTree(&$menus) {

        $map = array(
            0 => array('child' => array())
        );
        foreach ($menus as &$menu) {
            $menu['child'] = array();
            $map[$menu['id']] = &$menu;
        }

        foreach ($menus as &$menu) {
            $map[$menu['menu_id']]['child'][] =  &$menu;
        }
        return $map[0]['child'];
    }

    public function storeMenu($id = null,Menu $menu,Request $request,RoleHasMenu $roleHasMenu,RoleHasPermission $roleHasPermission)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod("POST")) {
                $roleHasMenu->where('role_id', $id)->delete();
                    $menuItems=$request->get('data');
                    if($menuItems){
                        foreach ($menuItems as $menu_item) {
                            $roleHasMenu=new RoleHasMenu();
                            $roleHasMenu->menu_id=$menu_item['menu_item_id'];
                            $roleHasMenu->role_id=$id;
                            $roleHasMenu->assigned_by=Auth::user()->id;
                            $data = $roleHasMenu->save();
                        }
                        if ($data) {
                            DB::commit();
                            $status_message='Menu Assigned Successfully Done';
                            return response(['success'=>true,'message'=>$status_message]);

                        }else{
                            DB::rollback();
                            $status_message='Failed to assigned menu';
                            return response(['success'=>true,'message'=>$status_message]);
                        }
                    }else{
                        DB::commit();
                        $status_message='No menu selected';
                        return response(['success'=>true,'message'=>$status_message]);
                }


            }
        } catch (\Exception $e) {
            DB::rollback();
            return response(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    public function storePermission($id = null,Menu $menu,Request $request,RoleHasMenu $roleHasMenu,RoleHasPermission $roleHasPermission)
    {
        DB::beginTransaction();
        try {
            if ($request->isMethod("POST")) {
                $roleHasPermission=RoleHasPermission::where('role_id', $id)->delete();
                $permissionItems=$request->get('data');
                if($permissionItems){
                        foreach ($permissionItems as $item){
                            $roleHasPermission=new RoleHasPermission();
                            $roleHasPermission->permission_id=$item['permission_item_id'];
                            $roleHasPermission->role_id=$id;
                            $roleHasPermission->assigned_by=Auth::user()->id;
                            $data = $roleHasPermission->save();
                        }
                    if ($data) {
                        DB::commit();
                        $status_message='Permission assigned successfully';
                        return response(['success'=>true,'message'=>$status_message]);
                    }else{
                        DB::rollback();
                        $status_message='Failed to assigned';
                        return response(['success'=>true,'message'=>$status_message]);
                    }
                }else{
                    DB::commit();
                    $status_message='No permission selected';
                    return response(['success'=>true,'message'=>$status_message]);
                }


            }
        } catch (\Exception $e) {
            DB::rollback();
            return response(['success'=>false,'message'=>$e->getMessage()]);
        }
    }


}
