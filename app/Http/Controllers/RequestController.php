<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Passer;
use App\School;

use Goutte;
use utilities;


class RequestController extends Controller
{
    //
    public function getBoardPasser() {
       	
		$data = array();
		$dataTopSchool = array();
		$dataExaminee = array();
		$dataCollection = array();
		
		$search = @$_REQUEST['search'];

		if ($search!="") {

			$rs = Passer::join('tbl_school', 'tbl_school.id', '=', 'tbl_student.school_id')
						->Where('fullname', 'like', '%'.$search.'%')
						->orWhere('campus_eligibility', 'like', '%'.$search.'%')
						->orWhere('division', 'like', '%'.$search.'%')
						->orWhere('school_name', 'like', '%'.$search.'%')
						 
						->paginate(50);
 
		}
		else {
			$rs = Passer::whereStatus(2)->paginate(50);
		}


		// Board Passer 
		foreach($rs as $list) {

			$dataCollection['fullname'] = $list->lname . ", " . $list->fname . " " . $list->mname;
			$dataCollection['school'] = $list->school->school_name;
			$dataCollection['ce'] = $list->campus_eligibility;
			$dataCollection['division'] = $list->division;
			array_push($data, $dataCollection);
		}

		// Top School 
		$dataTopSchool = School::topSchool();
		// Examinee Record 
		$dataExaminee = Passer::getPasser(2);


	    return response()->json(['boardPasser' => $rs, 'topSchool' => $dataTopSchool,  'examinee' => $dataExaminee
	    					]); 
	}

	public function processBoardPasser() {

		$crawler = Goutte::request('GET', 'http://www.pshs.edu.ph/nce2018/');

		$data = array();
		$dataCollection = array(); 
		$dataMerge = array();

		$data = $crawler->filter('.container_list div div')->each(function ($node)  {
			return $node->text();
		});	

		$ctr = 0;

		// This will delete all the record from the database and will update the recent updated board passer
		// THis will only delete the (board passer) "2"
		// Delete 
		Passer::whereStatus(2)->delete();
		/// End of the delete;

		foreach($data as $list) {
			
			array_push($dataCollection, $list);

			if ($ctr == 4) {
				$ctr = 0;
				// array_push($dataMerge, $dataCollection);

				$rs = new Passer;
				$rs->student_no = $dataCollection[0];
				$rs->fullname = $dataCollection[1];

				$arrayFullname = utilities::splitFullname($dataCollection[1]);

				$rs->fname = $arrayFullname['first_name'];
				$rs->lname = $arrayFullname['last_name'];

				$rs->campus_eligibility = $dataCollection[2];
				$rs->school_id = School::findSchool($dataCollection[3]); // school; 
				$rs->division = $dataCollection[4];
				$rs->status = 2;

				$rs->save();

				$dataCollection = array();
			}
			else {
				$ctr++;	
			}
		}

		$this->getBoardPasser();

		// return response()->json(['status' => 1]); 

	}

}

