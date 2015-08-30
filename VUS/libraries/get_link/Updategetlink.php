<?php 
/**
* 
*/
class Updategetlink
{
	var $get_img_option=array(
		"attr_img"=>"src",
		"selector"=>""
	);	
	function __construct()
	{
		$CI =& get_instance();
	}
	/*
	 * @namefunction: update_align_title
	 * @todo: 
	 * @input: 
	 * @output: 
	 */		
	public function update_content(){
		$rs=  mysql_query("select id,content from baiviet  ");
		while($row = mysql_fetch_assoc($rs)){				
			$html=  str_get_html($row["content"]);
			foreach($html->find("img.lazy") as $link){
				$src= $link->getAttribute("data-lazy-src");					
				$link->setAttribute ("src",$src);
			}
			@mysql_query("update baiviet set content = '".  mysql_real_escape_string($html->outertext)."' where id=".$row["id"]." limit 1  ");
		}
	}
/*
 * @namefunction: update_readmore
 * @todo: 
 * @input: 
 * @output: 
 */		
		public function update_readmore(){			
			$rs=  mysql_query("select id,content,readmore from baiviet  where readmore=''  ");			
			while($row = mysql_fetch_assoc($rs)){
				$html=  @str_get_html($row["content"]);
				$readmore=@trim($html->plaintext);				
				@mysql_query("update baiviet set readmore = '".  mysql_real_escape_string($readmore)."' where id=".$row["id"]." limit 1  ");
			}
		}	
/*
 * @namefunction: get_first_img
 * @todo: 
 * @input: 
 * @output: 
 */		
		public function get_first_img($where=""){
			$where = " image = '' ";
			if($where<>"")
				$where=" where ".$where;
			$rs=  mysql_query("select id,content from baiviet  ".$where ." order by id desc");
			while($row = mysql_fetch_assoc($rs)){
				if(isset($row["image"])){ 
					continue;
				}	else{
					$img=$this->get_first_img_once($row["content"]);
					@mysql_query("update baiviet set image = '".$img."' where id=".$row["id"]." limit 1  ");
					
				}

				
			}
		}	
	
	/*				
		* @namefunction: get_first_img_once
		* @todo: 
		* @input: 
		* @output: 
	*/			
		private function get_first_img_once($content,$attr="src"){
			if($this->get_img_option["selector"]){
			}else{
				$html=str_get_html($content);
				foreach ($html->find("img") as  $link) {
					$img=$link->getAttribute($attr);				
					$tam=getimagesize($img);
					if($tam[0]>100)
						break;
				}
				
				$html->clear();
				if(isset($img)){
					return $img;				
				}
					
			}
			return "";
		}
/*
 * @namefunction: xoatrung
 * @todo: Xóa các tin trung
 * @input: 
 * @output: 
 */	
 		public function xoatrung(){
			$rs=mysql_query("select * from baiviet");
			$i=0;
			while($row=mysql_fetch_assoc($rs)){				
				$rs2=mysql_query("select * from baiviet where title='".$row["title"]."' and id<>".$row["id"]."  ");
				$num=mysql_num_rows($rs2);				
				if($num>1){
					$tam[]=$row["id"];
					while($row2=mysql_fetch_assoc($rs2)){
						if(!in_array($row2["id"], $tam)){							
							@mysql_query("delete from baiviet where id=".$row2["id"]." ");
						}
					}
				}
			}
			print_r($tam);

		}
/*
 * @namefunction: update_align_title
 * @todo: 
 * @input: 
 * @output: 
 */		
		public function update_align_title(){
			$rs=  mysql_query("select id,title from baiviet ");
			while($row = mysql_fetch_assoc($rs)){
				@mysql_query("update baiviet set align_title = '".mod_rewrite($row["title"])."' where id=".$row["id"]." limit 1  ");
			}
		}										
}
 ?>