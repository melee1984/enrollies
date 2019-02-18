<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use utilities;
use App\School;

class Passer extends Model 
{
    //
	protected $table = 'tbl_student';
	public $timestamps = true;

	public function school()  {
        return $this->hasOne('App\School', 'id','school_id');
    }	

    // Insert statement 
    public static function InsertExaminee($request) {

		$rs = new Passer;

		$rs->fullname = $request->name;
		$arrayFullname = utilities::splitFullname($request->name);

		if (is_array($arrayFullname)) {
			$rs->fname = $arrayFullname['first_name'];
			$rs->lname = $arrayFullname['last_name'];	
			$rs->fullname =  $arrayFullname['last_name'] . ", " .  $arrayFullname['first_name'];
		}
		else {
			$rs->fullname = $arrayFullname;
		}
		

		$rs->school_id = School::findSchool($request->school); // school; 
		$rs->status = 1;

		return $rs->save();
    }

    public static function getPasser() {
    	
    	$dataExaminee = array();
    	$dataCollection = array();

    	$rsExaminee = Passer::whereStatus(1)->orderBy('lname','asc')->get();

		foreach($rsExaminee as $list) { 
			
			$dataCollection['school'] = $list->school->school_name;
			$dataCollection['fullname'] = $list->fullname;

			array_push($dataExaminee, $dataCollection);
		}

		// utilities::debug($dataExaminee);

		return $dataExaminee;


    }


}
