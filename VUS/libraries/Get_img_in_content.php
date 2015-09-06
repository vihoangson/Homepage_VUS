<?php 
/**
* class Get_img_in_content
* @todo: Automatic save image in content
* @author: Vi Hoang Son
* @version: 1 - 2015
*/
class Get_img_in_content
{
	var $dir="assets/vus_folder_img_content";// direct default
	var $max_width=500;//Giá trị tối đa của hình ảnh được xử lý, nếu lớn hơn sẽ dùng hình ảnh của trang nguồn
	var $max_size=1000;
	function __construct(){
		//if don't have direc then make new dir
		if(!is_dir($this->dir)){
			mkdir($this->dir);
		}		
	}
	/*
	* Automatic save image in content
	* @param: string
	* @return: string
	*/
	function do_get_img_from_content($data=array()){
		list($title,$content)	= $data;
		$remote_images=$this->get_all_img($content);
		if(!$remote_images) return $content;			
		$file="";
		$i=1;
		foreach ($remote_images as $key => $value) {
			list($width, $height, $type, $attr) = @getimagesize($value);	
			if($width > $this->max_width || $width > $this->max_width  ) continue;
			$file=$this->download_image($value);
			$type= $this->getFileType($file);
			$filename=$this->get_filename_from_url($value);
			if(!$filename){
				$filename=md5(time()).".".$type;
			}
			$filename=mod_rewrite($title)."_".$i.".".$type;
			if(!file_put_contents($this->dir."/".$filename, $file)) {
				continue;
			}else{
				$i++;
			}
				
			 $content = str_replace($value, base_url().$this->dir."/".$filename, $content);
		}
		return  $content;
	}
	function get_all_img($content){
		$remote_images = array();
		$preg = preg_match_all('/<img.*?src=\"((?!\").*?)\"/i', stripslashes($content), $matches);
		if ($preg) $remote_images = $matches[1];
		$preg = preg_match_all('/<img.*?src=\'((?!\').*?)\'/i', stripslashes($content), $matches);
		if ($preg) $remote_images = array_merge($remote_images, $matches[1]);	
		if(is_array($remote_images))
			return 	$remote_images;
		return false;
	}
	public function getFileType($file){
		$bin = substr($file,0,2);
		$strInfo = @unpack("C2chars", $bin);
		$typeCode = intval($strInfo['chars1'].$strInfo['chars2']);
		switch ($typeCode) {
			case 7790: $fileType = 'exe'; return false;
			case 7784: $fileType = 'midi'; return false;
			case 8297: $fileType = 'rar'; return false;
			case 255216: $fileType = 'jpg'; $mime = 'image/jpeg'; return $fileType;
			case 7173: $fileType = 'gif'; $mime = 'image/gif'; return $fileType;
			case 6677: $fileType = 'bmp'; $mime = 'image/bmp'; return $fileType;
			case 13780: $fileType = 'png'; $mime = 'image/png'; return $fileType;
			default: return false;
		}
	}	
	public function download_image($image_url) {
		$file = '';
		// file_get_contents
		if (function_exists('file_get_contents')) {
			$file = @file_get_contents($image_url);
		}
		
		// curl
		if (!$file && function_exists('curl_init')) {
			$ch = curl_init();
			$timeout = 5;
			curl_setopt($ch, CURLOPT_URL, $image_url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$file = curl_exec($ch);
			curl_close($ch);
		}
		$img = @imagecreatefromstring($file);
		// GD
		if (!$img && function_exists('fsockopen')) {
			$type = $this->fsockopen_image_header($image_url);
			if ($type && in_array($type, array('image/jpeg', 'image/gif', 'image/png'))) {
				$type = substr($type, 6);
				$img = call_user_func("imagecreatefrom{$type}", $image_url);
				ob_start();
				call_user_func("image{$type}", $img);
				$file = ob_get_contents();
				ob_end_clean();
				imagedestroy($img);
			} else $file = '';
		}
		return $file;
	} 
	public function get_filename_from_url($url) {
		$url = parse_url($url);
		$path = $url['path'];
		$filename = explode('/', $path);
		return $filename[count($filename)-1];
	}		
}
 ?>