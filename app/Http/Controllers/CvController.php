<?php 
	namespace App\Http\Controllers;
	use Illuminate\Routing\Controller as BaseController;
	use DB;
    use Illuminate\Http\Request;
    use View;
    use App\Cv;

	Class CvController extends BaseController {
		public function getCvById() {
			$cv = DB::select('select * from cv where id_user = ?', [1]);
    		return view('cv', ['cvs' => $cv]);
		}
		public function updateCV(Request $request)
		{
			$id_user = 1; 
			$full_name 	= $request->input('full_name', '');
	        $email 		= $request->input('email', '');
	        $website 	= $request->input('website', '');
	        $mobile 	= $request->input('mobile', '');
	        $your_info 	= $request->input('your_info', '');
	        $job_title 	= $request->input('job_title', '');
	        $skill 		= $request->input('skill', '');
	        $job_history= $request->input('job_history', '');


			$cvUpdate = DB::table('cv')
    			->where('id_user', $id_user)
    			->update(['full_name' 	=> $full_name])
    			->update(['email' 		=> $email])
    			->update(['website' 	=> $website])
    			->update(['mobile' 		=> $mobile])
    			->update(['your_info' 	=> $your_info])
    			->update(['job_title' 	=> $job_title])
    			->update(['job_history' => $job_history])
    			->update(['skill' 		=> $skill]);
			$cvUpdate->save();
			return redirect()->route('cv');
		}
	}
 ?>