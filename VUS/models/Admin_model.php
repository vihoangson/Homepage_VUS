<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model {
	var $getimg;
	function __construct(){
		parent::__construct();
		$this->load->library('Get_img_in_content');
		$this->getimg= new Get_img_in_content;
	}
}


 ?>