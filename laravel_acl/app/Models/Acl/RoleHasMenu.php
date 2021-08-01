<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class RoleHasMenu extends Model
{
    protected $table='role_has_menus';
    protected $fillable=['menu_id','role_id','assigned_by'];
    public $timestamps=false;
}
