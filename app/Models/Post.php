<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Post extends Model {
	protected $guarded = ['id', 'updated_at', 'created_at'];
	//protected $fillable = ['id', 'name', 'content', 'slug'];
}
