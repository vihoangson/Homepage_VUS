<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nhommau extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {       
    	$this->config->title_page="Đăng ký hiến máu nhân đạo 4T";
	$this->config->title_head="Đăng ký hiến máu nhân đạo 4T";
	$this->load->view('base/header');
	$this->load->view('nhommau/nhommau');
	
	$this->load->view('base/footer');
    }
    function delete_uset(){
    	$id=(int)$this->uri->segment(3);
    	if($id!=0){
    		$this->db->query("delete from baiviet_nhommau where id=".$id." ");
    	}

    	$this->config->title_page="Đăng ký hiến máu nhân đạo 4T";
	$this->config->title_head="Đăng ký hiến máu nhân đạo 4T";
	$this->load->view('base/header');
	$this->load->view('nhommau/list_user');
	
	$this->load->view('base/footer');    	
    }
    function list_user() {      
    	$id=(int)$this->uri->segment(3);
    	if($id!=0){
    		$this->db->query("update baiviet_nhommau set  active= if(active=1, 0 , 1) where id=".$id." ");
    	}

    	$this->config->title_page="Đăng ký hiến máu nhân đạo 4T";
	$this->config->title_head="Đăng ký hiến máu nhân đạo 4T";
	$this->load->view('base/header');
	$this->load->view('nhommau/list_user');
	
	$this->load->view('base/footer');
    }    
    
    function do_save(){
    	if($this->input->post("type_blood")==""){ $this->index();return;}
    	if($this->db->query("insert into baiviet_nhommau set 
    		id=null, 
    		name='".$this->input->post("name")."' ,
    		phone='".$this->input->post("sdt")."' ,
    		typeblood='".$this->input->post("type_blood")."' 

    	")){
    		$this->success();
    	}
    }
    function success(){
    	$this->config->title_page="Đăng ký hiến máu nhân đạo 4T";
	$this->config->title_head="Đăng ký hiến máu nhân đạo 4T";
	$this->load->view('base/header');
	$this->load->view('nhommau/success');
	$this->load->view('base/footer');   	
    }
}
        
?>
