<?php 
/**
* 
*/
class OptionGetLink
{
	
	function __construct()
	{
				
	}
	function  view_status(){
		echo "<p><b>Tổng số bài viết:</b> ". $this->count_all()."</p>";
		echo "<p><b>Tổng số bài viết không có hình:</b> ". $this->check_null_img()."</p>";
	}
	private function check_null_img(){		
		$rs=mysql_fetch_assoc(mysql_query("select count(*) as total from baiviet where image='' ")) ;
		return $rs["total"];
	}
	private function count_all(){		
		$rs=mysql_fetch_assoc(mysql_query("select count(*) as total from baiviet  ")) ;
		return $rs["total"];
	}		
}
 ?>