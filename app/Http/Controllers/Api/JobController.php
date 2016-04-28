<?php 
	namespace App\Http\Controllers\Api;
	use Illuminate\Routing\Controller as BaseController;
	use DB;
	use App\Job;
    use Illuminate\Http\Request;
    use View;

	Class JobController extends BaseController {
		public function getAllJob()
		{
			$results = DB::select('select * from job');
			return json_encode(array(
	            array('job' => $results),
	        ));
		}

		// Job search
		public function jobSearch(Request $request) {
	        $keywords 	= $request->input('keywords', '');
	        $id_source 	= $request->input('id_source', '');
	        $limit 		= $request->input('limit', 10);
	        $offset 	= $request->input('offset', 0);

	        return Job::search([
	            'keywords' => $keywords, 'id_source' => $id_source,
	            'limit' => $limit, 'offset' => $offset
	        ]);
	    }
	    // Count job
	    public function jobCount(Request $request) {
	    	$keywords 	= $request->input('keywords', '');
	        $id_source 	= $request->input('id_source', '');

	        return Job::count([
	            'keywords' => $keywords, 'id_source' => $id_source
	        ]);
	    }

		public function getListNewJob() {
	        $result = DB::select('select * from job order by created_at desc limit 10 offset 0');
	        return json_encode(array(
	            array('job' => $result),
	        ));
	    }
	    // Job detail
	    public function jobDetail($id_social) {
	    	$result = DB::select('SELECT * FROM job JOIN source ON source.id_source = job.id_source WHERE id_social = ? limit 1 offset 0', array($id_social));
	        return View::make('job', array('data' => $result));
	    }
	}
 ?>