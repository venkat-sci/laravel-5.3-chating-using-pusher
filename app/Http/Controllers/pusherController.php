<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class pusherController extends Controller
{
    //
    public function index(){

    	return view('welcome');

    }

    public function postpush(Request $request){
    	
    	$input = $request->all();
		$pusher = App::make('pusher');

		$data['message'] = $input['message'];
		$pusher->trigger( 'narayana','local',$data);

		return back();
		//return view('welcome');
    }
    
    public function pusherview(){
	    return view('pusherview');    	
    }

}
