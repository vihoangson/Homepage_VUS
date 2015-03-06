<?php
class Youtube{
	function search_youtube_keyword($keyword){
			$feedURL = "http://gdata.youtube.com/feeds/base/videos?q=".$keyword."&client=ytapi-youtube-search&v=2&max-results=50";    
			$sxml = simplexml_load_file($feedURL);
			if(isset($sxml))
				return $sxml->entry;
			else 
				return;
//			foreach ($sxml->entry as $entry) {  
//				$media = $entry->children('http://search.yahoo.com/mrss/');
//				$attrs = $media->group->content->attributes();
//				$videoURL = $attrs['url'];
//				$videoURL = preg_replace('/\?.*/', '', $videoURL);
//				$videoURL = str_replace("/v/","/embed/",$videoURL);    
//				$videoTitle = $media->group->title; 
//				$idv = str_replace("http://www.youtube.com/embed/","",$videoURL);
//				$idv = str_replace("&feature=youtube_gdata","",$idv);				
//				$id=$idv;
//				$title = $videoTitle;
//				$data=array("id"=>$id,"title"=>$title);
//			}			
	}
	function search_youtube_username($name_user_youtube){
			$feedURL = "http://gdata.youtube.com/feeds/api/users/".$name_user_youtube."/uploads?star-index=5&max-results=50&start-index=1";
			$sxml = simplexml_load_file($feedURL);
			if(isset($sxml))
				return $sxml->entry;
			else 
				return;
//		$m=$this->search_youtube_username($username);
//		foreach($m as $value){
//			$href = $value->link->attributes()->href;
//			$id=str_replace("http://www.youtube.com/watch?v=","",$href);
//			$id = str_replace("&feature=youtube_gdata","",$id);
//			return $id;
//		}
	}
	function youtube_exists($videoID) {
			$theURL = "http://www.youtube.com/oembed?url=http://www.youtube.com/watch?v=$videoID&format=json";
			$headers = get_headers($theURL);
			if (substr($headers[0], 9, 3) !== "404") {
					return true;
			} else {
					return false;
			}
	}
}
