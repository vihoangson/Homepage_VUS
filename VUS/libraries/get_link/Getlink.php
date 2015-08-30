<?php 
class GetLink
{
	var $type_news="ifact";
	var $list_url=array();
	var $selector_getlink=array(
		"link_page"=>".entry-header figure a",
		"title"=>"",
		"content"=>"",
		"selector_remove_in_content"=>array(
				".related-post-top",
				".random_relate",
				".related_post",
				".wp_rp_content",
				".ssba",
				".wp_rp_wrap"
		)
	);
	var $get_img_option=array(
		"attr_img"=>"src",
		"selector"=>""
	);
	var $show_img=true;
	var $per_page=10;
	var $list_menu=array();
	var $list_link=array();
	var $test_mode=true;
	var $viewstatus=false;

	function __construct()
	{
		$CI =& get_instance();
		# code...
	}
		public function lay_baiviet($var=""){
			$this->type_news=$var;
			if($this->type_news=="tuoitrenangdong"){
				$list_url[0]="http://tuoitrenangdong.net/nghe-thuat/nhiep-anh/page/";
				// $list_url[1]="http://tuoitrenangdong.net/nghe-thuat/thiet-ke-my-thuat/page/";
				//  $list_url[2]="http://tuoitrenangdong.net/nghe-thuat/kien-truc/page/";
				//  $list_url[3]="http://tuoitrenangdong.net/nghe-thuat/kheo-tay/page/";
				//  $list_url[4]="http://tuoitrenangdong.net/game-ttnd/tin-tuc-game/page/";
				//  $list_url[5]="http://tuoitrenangdong.net/game-ttnd/download-game/page/";
				//  $list_url[6]="http://tuoitrenangdong.net/game-ttnd/tro-giup-gamer/page/";
				//  $list_url[7]="http://tuoitrenangdong.net/may-tinh/phan-mem/page/";
				// $list_url[8]="http://tuoitrenangdong.net/may-tinh/thu-thuat/page/";
				// $list_url[9]="http://tuoitrenangdong.net/tin-tuc/cong-nghe/page/";	
				// $list_url[10]="http://tuoitrenangdong.net/tin-tuc/khoa-hoc-doi-song/page/";	
				// $list_url[11]="http://tuoitrenangdong.net/tin-tuc/xa-hoi/page/";	
				// $list_url[12]="http://tuoitrenangdong.net/tin-tuc/ky-la-bi-an/page/";	
				// $list_url[13]="http://tuoitrenangdong.net/tin-tuc/cong-nghe/page/";
				$this->list_link=$list_url;
				$this->set_type_news("tuoitrenangdong");				
				$this->get_content_link();
			}
			
			if($this->type_news=="ifact"){
				$list_url[19]="http://ifact.com.vn/chuyen-muc/chuyen-muc/i-mystery/page/";				
				$list_url[16]="http://ifact.com.vn/chuyen-muc/chuyen-muc/useful-facts/page/";
				$list_url[17]="http://ifact.com.vn/chuyen-muc/chuyen-muc/i-science/page/";
				$list_url[18]="http://ifact.com.vn/chuyen-muc/chuyen-muc/i-people/page/";
				$this->list_link=$list_url;
				$this->set_type_news("ifact");
				$this->get_content_link();
			}


			if($this->type_news=="dantri"){
				$list_url[20]="http://dantri.com.vn/chuyen-la/trang-";				
				$this->list_link=$list_url;
				$this->set_type_news("dantri");
				$this->get_content_link();
			}

		}	
	function set_type_news($type_news){
		switch ($type_news){
			case "tuoitrenangdong":
				$this->type_news="tuoitrenangdong";
				$this->selector_getlink=array(
					"link_page"=>"#content_box .post-title a",					
					"title"=>"h1.entry-title",
					"content"=>".post-single-content",
					"selector_remove_in_content"=>array()
				);	
			break;
			case "ifact":
				$this->type_news="ifact";
				$this->selector_getlink=array(
					"link_page"=>".entry-header figure a",
					"title"=>".entry-title",
					"content"=>".entry-content",
					"selector_remove_in_content"=>array(
							".related-post-top",
							".random_relate",
							".related_post",
							".wp_rp_content",
							".ssba",
							".wp_rp_wrap"
					)
				);
			break;
			case "dantri":
				$this->type_news="dantri";
				$this->selector_getlink=array(
					"link_page"=>".mr1 h2 a",
					"title"=>"h1.fon31.mgb15",
					"content"=>".fl.wid470",
				);		
			break;
		}
	}

/*
 * @namefunction: ifact
 * @todo: lấy bài viết con của nhóm trang ifact
 * @input: array $list_url
 * @output: string array link
 */
		private function get_content_link(){
				$list_url=$this->list_link;				
				if($this->test_mode)
					echo "<h1 style='color:red'>Test mode</h1>";
				
					foreach ($list_url as $key => $value) {						
					echo "<h1>Link new11: <br>Cid:".$key ." <br>Link: ".$value."</h1>";
					$k=1;
					$km=2;
					$plus_link="";
					if($this->type_news=="dantri"){
						$plus_link=".htm";
					}				
					for($i=$k;$i<=$km;$i++){
						if($this->test_mode==true){
							echo "<div class='well'>
							<h3>View link</h3>";
							echo $value.$i.$plus_link;
							echo "<br>";
							print_r($this->selector_getlink);	
							echo "</div>";						
						}
						$html=$this->curl_get($value.$i.$plus_link);
						foreach ($html->find($this->selector_getlink["link_page"]) as $link){	
							echo "<div class='well'>";
							$this->save_content($link->href,$key);
							echo "</div>";
							if($this->test_mode==true) return;													
						}				
						$html->clear();				
					}
				}	
		}


/*
 * @namefunction: save_content
 * @todo: 
 * @input: 
 * @output: 
 */				
		private function save_content($link,$cid=-1){	
			echo "<p><b>Save_content: ".$link."</b></p>";
			if($this->type_news=="dantri")
				$link="http://dantri.com.vn".$link;

			$html=$this->curl_get($link);
			if(isset($this->selector_getlink["selector_remove_in_content"]))
			if(is_array($this->selector_getlink["selector_remove_in_content"])){
				$selector_remove_in_content=$this->selector_getlink["selector_remove_in_content"];
				foreach($selector_remove_in_content as $mll){
					foreach($html->find($mll)  as $linka) {
						$linka->outertext="";
					}
				}				
			}			

			foreach ($html->find($this->selector_getlink["title"]) as $link){   
				$title= trim($link->innertext);	
			}			

			$content="";
			foreach ($html->find($this->selector_getlink["content"]) as $link2){   
				$content= trim(($link2->innertext)) ;
				break;
			}
			if(!isset($title) || !isset($content)) {echo "<h3>no data</h3>"; return;}
			$readmore=trim(strip_tags($content));
			$html->clear();
			//$img=$this->get_first_img_once($content,"src");
			$img="";
			$content= trim(mysql_real_escape_string($content)) ;

			if($this->test_mode) {
				echo "<h3>Class: <b>save_content</b>:".mod_rewrite($title)."</h3>";
			}
			$align_title=mod_rewrite($title);
			if($this->check_exists_baiviet($align_title,"align_title")>0) {
				echo "<h4>Trùng align</h4>";
				return;
			}
			$sql = "insert into baiviet(id,title,align_title,image,readmore,content,cid,type_content,time_create,local_img) values(null,'".$title."','".$align_title."','".$img."','".$readmore."','".$content."',".$cid.",'ifact',".time().",'')";
			if($CI->db->query($sql))
				echo "<b>Saved</b>";
			else
				echo "<b>Error</b>";

			if($this->test_mode) die;
		}
		function check_exists_baiviet($value,$type){			
			$numrow=mysql_fetch_assoc(mysql_query("select count(*) as total from baiviet where ".$type."='".$value."' "));
			return (int)$numrow["total"];						
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
                 $dom=str_get_html($kl);
                 return $dom;                        
     }          		
}
 ?>