<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use utilities;
use App\Passer;

class PasserController extends Controller
{
    //
	public function __construct() {
         // $this->middleware('administrator');
    }
 	
 	public function default() {
        return view('passer');
    }

    protected function addExaminuee(Request $request) {

    	$input = $request->all();
    	$data = array();
    	$dataExaminee = array();

    	$request->validate([
			            'name' => 'required',
			            'school' => 'required']);

    	$status = Passer::InsertExaminee($request);

    	if ($status)  {
    		$dataExaminee = Passer::getPasser();
		}

		return response()->json(['examinee' => $dataExaminee]); 

    }

}
