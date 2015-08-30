<?php
	include(APPPATH."third_party/dbug/dBug.php");
	function dd($variable){
		$dd=new dBug($variable);
		die;
	}
	function d($variable){
		$dd=new dBug($variable);
	}
?>