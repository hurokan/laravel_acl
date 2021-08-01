<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;

class UserHasRole extends Model
{
    protected $table='user_has_roles';
    protected $fillable=['user_id','role_id'];
    public $timestamps=false;
    protected $with=['user_role'];

    public function user_role(){
        return $this->belongsTo(User::class,'user_id');
    }
}



