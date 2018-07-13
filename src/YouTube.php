<?php

namespace Madcodez\YouTube;

class YouTube {

private $endPoint = array(
        'videos' => 'https://www.googleapis.com/youtube/v3/videos',
        'search' => 'https://www.googleapis.com/youtube/v3/search'
        );
        
private $apiKey;

public function __construct($key) {

	$this->apiKey = $key;
	
}

public function chart($maxResults, $token = null) {



	$params = array(

	'chart' => 'mostPopular',

	'type' => 'video',

	'part' => 'id',

	'order' => 'relevance',

	'maxResults' => $maxResults

	);

	

	if (!is_null($token)) {

	$params['pageToken'] = $token;

	}

	

	$out = self::api_get($this->endPoint['videos'], $params);

	

	foreach($out->items as $o) {

		$ids[] = $o->id->videoId;

	}

	

	if (isset($out->prevPageToken)) {

	$info['page_info']['prevPage'] = $out->prevPageToken;

	}

	if (isset($out->nextPageToken)) {

	$info['page_info']['nextPage'] = $out->nextPageToken;

	}

	

	$info['content'] = self::formatVideos($ids);

	

	return $info;

	

}


public function videoByCat($catID, $maxResults, $token = null) {



	$params = array(

	'videoCategoryId' => $catID,

	'type' => 'video',

	'part' => 'id',

	'order' => 'relevance',

	'maxResults' => $maxResults

	);

	

	if (!is_null($token)) {

	$params['pageToken'] = $token;

	}

	

	$out = self::api_get($this->endPoint['videos'], $params);

	

	foreach($out->items as $o) {

		$ids[] = $o->id->videoId;

	}

	

	if (isset($out->prevPageToken)) {

	$info['page_info']['prevPage'] = $out->prevPageToken;

	}

	if (isset($out->nextPageToken)) {

	$info['page_info']['nextPage'] = $out->nextPageToken;

	}

	

	$info['content'] = self::formatVideos($ids);

	

	return $info;

	

}


public function search($q, $maxResults, $token = null) {

	$params = array(
	'q' => $q,
	'type' => 'video',
	'part' => 'id',
	'order' => 'relevance',
	'maxResults' => $maxResults
	);
	
	if (!is_null($token)) {
	$params['pageToken'] = $token;
	}
	
	$out = self::api_get($this->endPoint['search'], $params);
	
	foreach($out->items as $o) {
		$ids[] = $o->id->videoId;
	}
	
	if (isset($out->prevPageToken)) {
	$info['page_info']['prevPage'] = $out->prevPageToken;
	}
	if (isset($out->nextPageToken)) {
	$info['page_info']['nextPage'] = $out->nextPageToken;
	}
	
	$info['content'] = self::formatVideos($ids);
	
	return $info;
	
}

public function channel($chId, $maxResults, $token = null) {

	$params = array(
	'channelId' => $chId,
	'type' => 'video',
	'part' => 'id',
	'order' => 'relevance',
	'maxResults' => $maxResults
	);
	
	if (!is_null($token)) {
	$params['pageToken'] = $token;
	}
	
	$out = self::api_get($this->endPoint['search'], $params);
	
	foreach($out->items as $o) {
		$ids[] = $o->id->videoId;
	}
	
	if (isset($out->prevPageToken)) {
	$info['page_info']['prevPage'] = $out->prevPageToken;
	}
	if (isset($out->nextPageToken)) {
	$info['page_info']['nextPage'] = $out->nextPageToken;
	}
	
	$info['content'] = self::formatVideos($ids);
	
	return $info;
	
}

public function related($id, $maxResults, $token = null) {



	$params = array(

	'relatedToVideoId' => $id,

	'type' => 'video',

	'part' => 'id',

	'order' => 'relevance',

	'maxResults' => $maxResults

	);

	

	if (!is_null($token)) {

	$params['pageToken'] = $token;

	}

	

	$out = self::api_get($this->endPoint['search'], $params);

	

	foreach($out->items as $o) {

		$ids[] = $o->id->videoId;

	}

	

	if (isset($out->prevPageToken)) {

	$info['page_info']['prevPage'] = $out->prevPageToken;

	}

	if (isset($out->nextPageToken)) {

	$info['page_info']['nextPage'] = $out->nextPageToken;

	}

	

	$info['content'] = self::formatVideos($ids);

	

	return $info;

	

}


public function video($id) {
	return self::formatVideos($id);
}

private function getVideoInfo($vId) {

	$ids = is_array($vId) ? implode(',', $vId) : $vId;
	$params = array(
	'id' => $ids,
	'part' => 'id, snippet, contentDetails, statistics'
	);
	
	return self::api_get($this->endPoint['videos'],$params);
}

private function formatVideos($vIds) {

	$info = self::getVideoInfo($vIds);
	foreach($info->items as $item) {
	$infos[] = self::object2Array($item);
	}
	
	return $infos;
}

private function object2Array($data) {
        // Checking data type
        if(is_array($data) || is_object($data)) {
            $output = array();
            // Convert object to array in recursive method
            foreach($data as $key => $value) {
                $output[$key] = self::object2Array($value);
            }
            // Update data
            $data = $output;
        }
        return $data;
}
    
private function api_get($url, $params) {
	
	$params['key'] = $this->apiKey;
	$final_url = $url.'?'.http_build_query($params);
	try {
	return json_decode(Http::getHttp($final_url)['content']);
	} catch (Exception $e) {
	return false;
	}
}

}