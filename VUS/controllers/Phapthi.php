<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Phapthi extends CI_Controller {

	function __construct() {
		parent::__construct();	
		$this->breadcrumbs->push("Trang chủ", "/Phapthi");
	}
	function index() {
		$this->load->config("phapthi");
		$page=(int)$this->uri->segment(3);
		$this->db->order_by("id","desc");
		$this->db->limit($this->config->item("per_page_video"),$page);
		$data["data_page"]=$this->db->get("phapthi_video")->result();		
		$config['base_url'] = base_url()."Phapthi/index/";
		$config['total_rows'] = $this->get_all_row_block();
		$config['per_page_video'] = $this->config->item("per_page_video");
		$this->pagination->initialize($config);
		$data["pagination"]= $this->pagination->create_links();			
		$this->config->breadcrumbs=$this->breadcrumbs->show();
		$this->load->view('phapthi/header');
		$this->load->view('phapthi/home',$data);
		$this->load->view('phapthi/footer');
	}

	function detail(){
		$id=(int)$this->uri->segment(3);
		$this->db->where("id",$id);
		$data["video"]=$this->db->get("phapthi_video")->result();
		if(sizeof($data["video"])==0){
			$this->load->view('phapthi/header');			
			$this->load->view('phapthi/unfind');
			$this->load->view('phapthi/footer');			
			return;
		}
		$link=base_url()."Phapthi/detail/".$data["video"][0]->id."-".mod_rewrite($data["video"][0]->name);
		$detail_group=$this->detail_cid($data["video"][0]->id_theloai);
		$link_g="Phapthi/catview/".$detail_group->id."-".mod_rewrite($detail_group->theloai);
		$this->breadcrumbs->push($detail_group->theloai, $link_g);
		$this->breadcrumbs->push($data["video"][0]->name, $link);
		$this->config->breadcrumbs=$this->breadcrumbs->show();
		$this->load->view('phapthi/header');
		$this->load->view('phapthi/detail',$data);
		$this->load->view('phapthi/footer');
	}
	function catview(){
		$id_theloai=(int)$this->uri->segment(3);
		$this->db->where("id_theloai",$id_theloai);
		$data["data_page"]=$this->db->get("phapthi_video")->result();
		if(sizeof($data["data_page"])==0){
			$this->load->view('phapthi/header');			
			$this->load->view('phapthi/unfind');
			$this->load->view('phapthi/footer');			
			return;
		}		
		$link="Phapthi/detail/".$data["data_page"][0]->id."-".mod_rewrite($data["data_page"][0]->name);
		$detail_group=$this->detail_cid($data["data_page"][0]->id_theloai);
		$link_g="Phapthi/catview/".$detail_group->id."-".mod_rewrite($detail_group->theloai);
		$this->breadcrumbs->push($detail_group->theloai, $link_g);
		//$this->breadcrumbs->push($data["data_page"][0]->name, $link);
		$this->config->breadcrumbs=$this->breadcrumbs->show();
		$page=(int)$this->uri->segment(4);
		$config['base_url'] = base_url()."Phapthi/catview/".$this->uri->segment(3)."/";
		$config['total_rows'] = $this->get_all_row_block($id_theloai);
		$config['per_page_video'] = $this->config->item("per_page_video");
		$this->pagination->initialize($config);
		$data["pagination"]= $this->pagination->create_links();			
		$this->load->view('phapthi/header');
		$this->load->view('phapthi/catview',$data);
		$this->load->view('phapthi/footer');
	}
	function detail_cid($id){
		$this->db->where("id",$id);
		$return=$this->db->get("phapthi_video_group")->result();
		return $return[0];
	}
	function get_all_row_block($cid=null){		
		if($cid)
			return $this->db->where("id_theloai",$cid)->get("phapthi_video")->num_rows();
		else
			return $this->db->get("phapthi_video")->num_rows();
	}
	function check_deleted_video(){
		if($this->session->testmode==false) return;
		else echo 1;
		return;
		$this->db->limit(1500);		
		$data["data_page"]=$this->db->get("phapthi_video")->result();						
		$this->load->library("youtube");
		foreach ($data["data_page"] as $key => $value) {			
			if(!$this->youtube->youtube_exists($value->url)){
				$list_un_able[]=$value->url;
				$this->db->query("delete from phapthi_video where id=".$value->id." ");
			}
		}
	}
}

 ?>