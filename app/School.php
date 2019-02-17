<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class School extends Model
{
    //
	protected $table = 'tbl_school';
	public $timestamps = false;

	public static function getTopSchool() {

		$sql = "select 
				tbl_school.*, 
				(select count(tbl_student.id) as total from tbl_student  where tbl_student.school_id = tbl_school.id GROUP BY tbl_school.id) total
				from 
				tbl_school";

		$rs = DB::select($sql);

		return $rs;

	}
}
