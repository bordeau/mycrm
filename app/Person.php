<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = "persons";
	public $timestamps = false; // this indicates the created_at and updated_at will not be done by Eloquent, will need to do in database or manually
}
