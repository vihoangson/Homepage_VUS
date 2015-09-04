<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function mod_rewrite($str){		   
	    $str_convert=array(
		'á'=>'a',
		'à'=>'a',
		'ả'=>'a',
		'ã'=>'a',
		'ạ'=>'a',
		
		'Á'=>'A',
		'À'=>'A',
		'Ả'=>'A',
		'Ã'=>'A',
		'Ạ'=>'A',
		
		
		'â'=>'a',
		'ấ'=>'a',
		'ầ'=>'a',
		'ẩ'=>'a',
		'ẫ'=>'a',
		'ậ'=>'a',
		
		'Â'=>'A',
		'Ấ'=>'A',
		'Ầ'=>'A',
		'Ẩ'=>'A',
		'Ẫ'=>'A',
		'Ậ'=>'A',
		
		'ă'=>'a',
		'ắ'=>'a',
		'ằ'=>'a',
		'ẳ'=>'a',
		'ẵ'=>'a',
		'ặ'=>'a',
		
		'Ă'=>'A',
		'Ắ'=>'A',
		'Ẳ'=>'A',
		'Ẵ'=>'A',
		'Ặ'=>'A',
		
		'é'=>'e',
		'è'=>'e',
		'ẻ'=>'e',
		'ẽ'=>'e',
		'ẹ'=>'e',
		
		'É'=>'E',
		'È'=>'E',
		'Ẻ'=>'E',
		'Ẽ'=>'E',
		'Ẹ'=>'E',
		
		'ê'=>'e',
		'ế'=>'e',
		'ề'=>'e',
		'ể'=>'e',
		'ễ'=>'e',
		'ệ'=>'e',
		
		'Ê'=>'E',
		'Ế'=>'E',
		'Ề'=>'E',
		'Ể'=>'E',
		'Ễ'=>'E',
		'Ệ'=>'E',
		
		'ó'=>'o',
		'ò'=>'o',
		'ỏ'=>'o',
		'õ'=>'o',
		'ọ'=>'o',
		
		'Ó'=>'O',
		'Ò'=>'O',
		'Ỏ'=>'O',
		'Õ'=>'O',
		'Ọ'=>'O',
		
		'ô'=>'o',
		'ố'=>'o',
		'ồ'=>'o',
		'ổ'=>'o',
		'ỗ'=>'o',
		'ộ'=>'o',
		
		'Ô'=>'O',
		'Ố'=>'O',
		'Ồ'=>'O',
		'Ổ'=>'O',
		'Ỗ'=>'O',
		'Ộ'=>'O',
		
		'ơ'=>'o',
		'ớ'=>'o',
		'ờ'=>'o',
		'ở'=>'o',
		'ỡ'=>'o',
		'ợ'=>'o',
		
		'Ơ'=>'O',
		'Ớ'=>'O',
		'Ờ'=>'O',
		'Ở'=>'O',
		'Ỡ'=>'O',
		'Ợ'=>'O',
		
		'ú'=>'u',
		'ù'=>'u',
		'ủ'=>'u',
		'ũ'=>'u',
		'ụ'=>'u',
		
		'Ú'=>'U',
		'Ù'=>'U',
		'Ủ'=>'U',
		'Ũ'=>'U',
		'Ụ'=>'U',
		
		'ư'=>'u',
		'ứ'=>'u',
		'ừ'=>'u',
		'ử'=>'u',
		'ữ'=>'u',
		'ự'=>'u',
		
		'Ư'=>'U',
		'Ứ'=>'U',
		'Ừ'=>'U',
		'Ử'=>'U',
		'Ữ'=>'U',
		'Ự'=>'U',
		
		'í'=>'i',
		'ì'=>'i',
		'ỉ'=>'i',
		'ĩ'=>'i',
		'ị'=>'i',
		'đ'=>'d',
		
		'Í'=>'I',
		'Ì'=>'I',
		'Ỉ'=>'I',
		'Ĩ'=>'I',
		'Ị'=>'I',
		
		'ý'=>'y',
		'ỳ'=>'y',
		'ỷ'=>'y',
		'ỹ'=>'y',
		'ỵ'=>'y',
		
		'Ý'=>'Y',
		'Ỳ'=>'Y',
		'Ỷ'=>'Y',
		'Ỹ'=>'Y',
		'Ỵ'=>'Y',
		
		'đ'=>'d',
		'Đ'=>'D',
		   '"'=>'',
		   '"'=>'',
		   '"'=>'',
		   ','=>'',
		   '\''=>'',
		   
		
	    );
	  
		$str = trim(strtr($str, $str_convert));
		//$str= ereg_replace("[^[:alnum:]+ \-]"," ",$str);
		$str= preg_replace ("/[^[:alnum:]+ \-]/"," ",$str);

		
		$array_key=array("UNION","OUTFILE","SELECT","ALTER","INSERT","DROP","FROM","WHERE","UPDATE");
		foreach ($array_key as $key => $value) {
			$str=str_replace($value, "", $str);
		}

		return ''.preg_replace("/ +/", "-",$str);

	}	


 ?>