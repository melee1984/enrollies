<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passer;
use App\School;

class RequestController extends Controller
{
    //
    public function getBoardPasser() {
       	
		$data = array();
		$dataTopSchool = array();
		
		$dataCollection = array();
		
		// Board Passer 

		$rs = Passer::whereStatus(1)->get();

		foreach($rs as $list) {

			$dataCollection['fullname'] = $list->lname . ", " . $list->fname . " " . $list->mname;
			$dataCollection['school'] = $list->school->school_name;
			$dataCollection['ce'] = $list->campus_eligibility;
			$dataCollection['division'] = $list->division;
			array_push($data, $dataCollection);
		}

		// 	Top School 
		$dataCollection = array();
		
		$rsSchool = School::getTopSchool();

		foreach($rsSchool as $list) { 
			
			$dataCollection['school'] = $list->school_name;
			$dataCollection['total'] = $list->total;

			array_push($dataTopSchool, $dataCollection);
		}


	    return response()->json(['boardPasser' => $data, 'topSchool' => $dataTopSchool]); 
	}

}
