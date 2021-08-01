<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table='menus';
    protected $fillable=['menu_name','menu_icon','url','route_name','route_name','parent_menu_id','is_enabled','sort_order'];
    public $timestamps=true;
}
