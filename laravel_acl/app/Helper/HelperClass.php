<?php

namespace App\Helper;

use App\Models\Acl\Menu;
use App\Models\Acl\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\This;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class HelperClass
{

    public static function menuList()
    {
         return $menuData = self::menu();
    }

    public static function menu()
    {
        //$val = $this->CategoryTree();
        $menu = new Menu();
        $menus = $menu->orderBy('sort_order', 'asc')->get(
            [
                'menu_name','menu_icon', 'url', 'id', 'sort_order', 'parent_menu_id','route_name'
            ]
        )->toArray();
        return self::menusToTree($menus);
    }

    public static function menusToTree(&$menus)
    {
        $map = array(
            0 => array('child' => array())
        );

        foreach ($menus as &$menu) {
            $menu['child'] = array();
            $map[$menu['id']] = &$menu;
        }

        foreach ($menus as &$menu) {
            $pid = $menu['parent_menu_id']?:0;
            $map[$pid]['child'][] =  &$menu;
        }

        return $map[0]['child'];
    }

}
