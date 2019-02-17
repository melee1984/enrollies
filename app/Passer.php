<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Passer extends Model 
{
    //
	protected $table = 'tbl_student';
	public $timestamps = true;

	public function school()  {
        return $this->hasOne('App\School', 'id','school_id');
    }	



}
