<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Cv extends Eloquent
{
    protected $tableName = 'cvs';
    // public static function all(){
    //     return DB::table($tableName)->get();
    // }
    public static function getCvById($id) {
    	return $users = DB::select('select * from users where active = ?', [1]);
    	return view('user.index', ['users' => $users]);
    }
    public function newCv($info) {
    	$cv = new Cv();
    	$cv->id_user 	= $info->id_user;
    	$cv->full_name 	= $info->full_name;
    	$cv->email 		= $info->email;
    	$cv->website 	= $info->website;
    	$cv->mobile 	= $info->mobile;
    	$cv->description= $info->description;
    	$cv->job_title 	= $info->job_title;
    	$cv->save();
    }
}
