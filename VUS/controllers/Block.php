<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Block extends CI_Controller {

	function __construct() {
		parent::__construct();	
		$this->breadcrumbs->push("Trang chủ", "/");
	}

	function index() {
		$page=(int)$this->uri->segment(3);
		$this->db->order_by("id","desc");
		$this->db->limit($this->config->item("per_page"),$page);
		$this->db->where("image<>","");
		$this->db->where("active",0);
		$data["data_page"]=$this->db->get("baiviet")->result();		
		
		$config['base_url']   = base_url()."block/index/";
		$config['total_rows'] = $this->get_all_row_block();
		$config['per_page']   = $this->config->item("per_page");
		$this->pagination->initialize($config);
		$data["pagination"]= $this->pagination->create_links();
		$this->load->view('base/header');
		$this->load->view('block/block',$data);
		$this->load->view('base/footer');
	}
	function sendmail(){
		$data=array();
		$this->load->view('base/header');
		$this->load->view('contactus',$data);
		$this->load->view('base/footer');		
	}
	function do_sendmail(){
		$tomail=$this->input->post('email');
		$subject=$this->input->post('name');
		$body=nl2br($this->input->post('message')) ;		
		if($this->base_sendmail($tomail,$subject,$body)){
			header("Location: ".base_url()."Block/sendmail/done");
			
		}
		else {
			header("Location: ".base_url()."Block/sendmail/error");
		}
	}
	function base_sendmail($mail,$subject,$message){
		$this->load->library("email");
		$config['protocol'] = 'smtp';  
		$config['smtp_host'] = 'server-8-55.viethosting.vn';
		$config['smtp_user'] = 'mail@vus.vn';
		$config['smtp_pass'] = '!@#123';
		$config['smtp_port'] = '26';
		$config['mailtype'] = 'html';
		$this->email->initialize($config);		
		$this->email->from('mail@vus.vn', 'Vus.vn');
		$this->email->to($mail);
		$this->email->subject($subject);
		$this->email->message($message);
		if($this->email->send()){
			return true;
		}
		else {
			return false;
		}		

	}
	function detail(){
		$align_title=$this->uri->segment(3);
		$rs=$this->db->limit(1)->get_where("baiviet",array("align_title"=>$align_title))->result();		
		$data_new["data_new"]=$this->db->query("select * from baiviet order by id desc limit 5")->result();		
		$data_new["data_hot"]=$this->db->query("select * from baiviet order by view desc limit 5")->result();		
		$data_comment["data_comment"]=$this->db->query("select * from baiviet order by id limit 5")->result();
		$row=$rs[0];		
		$cat_dt=$this->db->query("select * from baiviet_nhom where cid=".$row->cid." ")->result();		
		$this->breadcrumbs->push($cat_dt[0]->title, "/block/viewcat/".$cat_dt[0]->align_title);
		$this->breadcrumbs->push($row->title, "/block/detail/".$row->align_title);
		$this->config->breadcrumbs=$this->breadcrumbs->show();
		
			if($this->db->query("update baiviet set view=view+1 where id = ".$row->id."")){
			}						
			$data["block_detail"]=$row;
			$data["data_list"]=$this->db->query("select * from baiviet order by id desc limit 5")->result();		
			$this->config->header='<meta property="og:image" content="'.base_url().'uploads/baiviet/'.$row->local_img.'" />';
			$this->config->title_page=$row->title;
			$this->load->view('base/header');
			$this->load->view('block/block_detail',$data);
			$this->load->view('block/comment_baiviet',$data_comment);
			$this->load->view('block/block_footer',$data_new);
			$this->load->view('base/footer');
				
	}
	function viewcat(){
		$pre_page=10;
		$align_title=$this->uri->segment(3);	
		
		$rs=$this->db->get_where("baiviet_nhom",array("align_title"=>$align_title),1)->result();
		foreach ($rs as $row) {
			$cid = $row->cid;			
			$page=(int)$this->uri->segment(4);		
			$this->db->order_by("id","desc");
			$this->db->limit($pre_page,$page)	;		
			$rs2=$this->db->get_where("baiviet",array("cid"=>$cid))->result();
		}    				
		$data["align_title"]=$align_title;
		if($rs2)
			$data["content_block"]=$rs2;
		
		//$this->breadcrumbs->push($row->title, "/block/detail/".$row->align_title);
		$this->breadcrumbs->push($rs[0]->title, "/block/viewcat/".$align_title);		
		$this->config->breadcrumbs=$this->breadcrumbs->show();
		
		
		$config['base_url'] = base_url()."block/viewcat/".$align_title;
		$config['total_rows'] = $this->get_all_row_block($cid);
		$config['per_page'] = $pre_page;
		$this->pagination->initialize($config);
		
		$data["pagination"]= $this->pagination->create_links();
		
		
		$this->load->view('base/header');
		//var_dump($data["content_block"]);
		if(isset($data["content_block"]))
			$this->load->view('block/block_cat',$data);
		else
			echo "<h3>No data !</h3>";
		$this->load->view('base/footer');
	}
	function get_all_row_block($cid=null){		
		if($cid)
			return $this->db->where("cid",$cid)->get("baiviet")->num_rows();
		else
			return $this->db->get("baiviet")->num_rows();
	}
	function get_id_baiviet($align_title){
		$this->db->where("align_title",$align_title);
		$return=$this->db->get("baiviet")->result();
		return $return[0]->id;				
	}
	function do_comment(){
		$content= nl2br($this->input->post("comment"));
		$align_t=$this->input->post("align_t");
		$id= $this->get_id_baiviet($align_t);		
		if($this->db->query("insert into baiviet_comment(cm_id,content,id,timec) values(null,'".$content."','".$id."',".time().")"))
			header("Location:".base_url()."block/detail/".$align_t."#comment");
		else
			echo "error";
	}
	function aboutme(){
		$this->load->view('base/header');		
			$this->load->view('block/aboutme');
		$this->load->view('base/footer');
	}
}

 ?>