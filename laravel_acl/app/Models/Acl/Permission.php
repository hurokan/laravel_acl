<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';
    protected $fillable=['permission_name','permission_key','is_enabled'];
    public $timestamps=false;
}
