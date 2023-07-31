<?php

namespace App\Models\Core;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTypeItem extends Model
 {
	protected $fillable = ["category_type_id","name","description","user_id"];

    use HasFactory;
}
