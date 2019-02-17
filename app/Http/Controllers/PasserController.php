<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasserController extends Controller
{
    //
	public function __construct() {
         // $this->middleware('administrator');
    }
 	
 	public function default() {
        return view('passer');
    }
}
