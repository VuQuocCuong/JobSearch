<?php 
	namespace App\Http\Controllers\Api;
	use Illuminate\Routing\Controller as BaseController;
    use Illuminate\Http\Request;
	use DB;

	Class SourceController extends BaseController {
		public function source(Request $request)
		{
			$id_source = $request->input('id_source');
			if ($id_source)
			{
				$results = DB::select('select * from source where id_source = ?', array($id_source));
			}
			else
			{
				$results = DB::select('select * from source');
			}
			return json_encode(array(
	            array('source' => $results),
	        ));
		}
		public function sourceNew(Request $request)
		{
			$results = DB::select('select * from source where type = ?', array('PAGE'));
			return json_encode(array(
	            array('source' => $results),
	        ));
		}
		public function getAllSource()
		{
			$results = DB::table('source')->orderBy("name")->get();
			return json_encode($results);
		}
	}
 ?>