<?php

namespace App;

use DB;

class Job {

    protected $label = 'Job';

    public static function search($options) {
        $keywords_query     = static::buildSearchKeyword($options);
        $source_query 	    = static::buildSearchSource($options);
        $limit              = static::buildSearchLimit($options);
        $offset             = static::buildSearchOffset($options);

        $result = DB::table('job')
            	->where($keywords_query['key'], $keywords_query['operator'], $keywords_query['value'])
                ->where($source_query['key'], $source_query['operator'], $source_query['value'])
                ->take($limit)
                ->skip($offset)
                ->orderBy('created_at', 'desc')
                ->get();
        return $result;
    }

    public static function count($options) {
        $keywords_query     = static::buildSearchKeyword($options);
        $source_query       = static::buildSearchSource($options);

        $result = DB::table('job')
                ->where($keywords_query['key'], $keywords_query['operator'], $keywords_query['value'])
                ->where($source_query['key'], $source_query['operator'], $source_query['value'])
                ->count();
        return $result;
    }

    private static function buildSearchKeyword($options) {
    	$where = '';
        $where['key']       = "id_source";
        $where["operator"]  = ">";
        $where["value"]     = '0';

        if (isset($options['keywords']) && $options['keywords']) {
            $where['key'] 		= "message";
	    	$where["operator"] 	= "LIKE";
	    	$where["value"] 	= '%'.$options['keywords'].'%';
        }
        return $where;
    }

    private static function buildSearchSource($options) {
        $where = '';
        $where['key']       = "id_source";
        $where["operator"]  = ">";
        $where["value"]     = '0';

        if (isset($options['id_source']) && $options['id_source']) {
            $where['key']       = "id_source";
            $where["operator"]  = "=";
            $where["value"]     = $options['id_source'];
        }
        return $where;
    }

    private static function buildSearchLimit($options) {
        $limit = (isset($options['limit']) && $options['limit']) ? $options['limit'] : 10;
        return $limit;
    }
    private static function buildSearchOffset($options) {
        $offset = (isset($options['offset']) && $options['offset']) ? $options['offset'] : 0;
        return $offset;
    }
}