<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Eloquent\Model;

class Mongo extends Model
{
	// use SoftDeletes;

	protected $connection = 'mongodb-mongo';
	protected $dateFormat = 'Y-m-d G:i:s';
	protected $table = 'mongo';
	protected $dates = ['updated_at', 'created_at'];
}
