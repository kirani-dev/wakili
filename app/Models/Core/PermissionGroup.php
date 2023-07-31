<?php

namespace App\Models\Core;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PermissionGroup extends Model
{

	protected $fillable = ["name","description"];

    public function users(){
        return $this->hasMany(User::class);
    }


}
