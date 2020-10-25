<?php

namespace App\Models\Mysql;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
	// const CREATED_AT = 'date_created';
	// const UPDATED_AT = 'date_modified';
	protected $primaryKey = 'id';
	protected $guarded = ['id'];

}
