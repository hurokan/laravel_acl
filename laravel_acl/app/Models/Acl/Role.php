<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $primaryKey='id';
    protected $fillable=['role_name','role_key','has_grand_access','is_enabled'];
    public $timestamps=true;

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_has_permissions' , 'role_id', 'permission_id');
    }

    public function menus() {
        return $this->belongsToMany(Menu::class, 'role_has_menus' , 'role_id', 'menu_id');
    }

    /**
     * GET Permission
     *
     * @return array
     */
    public function getPermissions() {
        $permissions = [];
        $rolePermission = $this->permissions;
        $slugs = $rolePermission->pluck('key','id');
        $arr = is_null($rolePermission)
            ? []
            : $slugs->all();
        $permissions = array_unique(array_merge($permissions,$arr));
        return $permissions;
    }

    /**
     * @return array
     */
    public function getMenus() {
        $menus = [];
        $rolePermission = $this->menus;
        $slugs = $rolePermission->pluck('id','route_name');

        $arr = is_null($rolePermission)
            ? []
            : $slugs->all();

        $menus = array_unique($arr);

        return $menus;
    }

    /**
     * User has menus
     *
     * @param $route_name
     * @return bool
     */
    public function hasMenuPermission($route_name) {
        if($this->has_grand_access){
            return true;
        }
        $_menus = $this->getMenus();

            return in_array($route_name, $_menus);

    }

    /**
     * Role has permission
     *
     * @param $key
     * @return bool
     */
    public function hasPermission($key) {
        $_permissions = $this->getPermissions();
        return in_array($key, $_permissions);
    }

}
