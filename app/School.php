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
				tbl_school order by 
(select count(tbl_student.id) as total from tbl_student  where tbl_student.school_id = tbl_school.id GROUP BY tbl_school.id) desc
				";

		$rs = DB::select($sql);

		return $rs;

	}

	/**
	
	@param school_name

	Find and if does not find 
	Record will insert new data to database. 

	then will return school id 

	*/
	public static function findSchool($school_name) {

		$rs = School::whereSchoolName($school_name)->first();

		if (count($rs)<=0) {

			$rs = new School();
			$rs->school_name = $school_name;
			$status = $rs->save();

			if ($status) {
				return $rs->id;
			}

		}
		else {
			return $rs->id;
		}

	}

}
