<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
	var $array_option=array();
	function __construct() {
		parent::__construct();
	}
	function index(){
		$this->login();
	}
	function login(){
		if($this->input->post("username")=="son"&&$this->input->post("password")=="deptrai"){
			$this->session->user="son";
			header("Location:".base_url());
		}
		$this->load->view("base/header");
		$this->load->view("user/login");
		$this->load->view("base/footer");
		$this->session->item=1;		
	}	
	function logout(){
		$this->session->sess_destroy();
		header("Location:".base_url());
	}
}