<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
 {
	protected $fillable = ["name","slug","user_id","status"];

    use HasFactory;
}
