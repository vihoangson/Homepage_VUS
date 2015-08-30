<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Get_content
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	function curl_get($url){
			 $cookie = tmpfile();
			 $userAgent = 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31' ;
			 //$userAgent = 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0';
			 $ch = curl_init($url);
			 $options = array(
				 CURLOPT_CONNECTTIMEOUT => 20 , 
				 CURLOPT_USERAGENT => $userAgent,
				 CURLOPT_AUTOREFERER => true,
				 CURLOPT_FOLLOWLOCATION => true,
				 CURLOPT_RETURNTRANSFER => true,
				 CURLOPT_COOKIEFILE => $cookie,
				 CURLOPT_COOKIEJAR => $cookie ,
				 CURLOPT_SSL_VERIFYPEER => 0 ,
				 CURLOPT_SSL_VERIFYHOST => 0
			 );

			 curl_setopt_array($ch, $options);
			 $kl = curl_exec($ch);
			 $kl=preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $kl);
			 $kl = preg_replace('#<script[^>]*>.*?</script>#is', '', $kl);
			 $kl=preg_replace('/<ins\b[^>]*>(.*?)<\/ins>/i', "", $kl);
			 curl_close($ch);   
			 return $kl;                        
 	}

 	public function string_to_dom($string){
 		$dom=str_get_html($string);
 		return $dom;
 	}
 				 
	

}

/* End of file libraryName.php */
/* Location: ./application/libraries/libraryName.php */
