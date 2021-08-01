<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    protected $table='role_has_permissions';
    protected $primaryKey = 'id';
    protected $fillable=['role_id','permission_id','assigned_by'];
    public $timestamps=true;
}
