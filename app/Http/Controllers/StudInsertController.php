<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudInsertController extends Controller
{
    //
    public function insertform(){
        return view('new-candidate');
        
        }
        public function insert(Request $request){
            $message = $request->echo('Successful');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $othernames = $request->input('othernames');
        $email = $request->input('email');
        $data=array('firstname'=>$firstname,"lastname"=>$lastname,"othernames"=>$othernames,"email"=>$email);
        DB::table('candidates')->insert($data);
        return back('new-candidate', [
            'message'       => $message
        ]);
        //return view('new-candidate');
        }
        }