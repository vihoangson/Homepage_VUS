<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class KhoanhKhacAnTuong extends CI_Controller {	
	function __construct() {
		parent::__construct();	
	}
	public function index(){
		$data["page_title"]="Khoảnh khắc ấn tượng";
		$this->load->view("kkat/header",$data);
			$this->load->view("kkat/index");
		$this->load->view("kkat/footer");
	}
	public function readmore(){
		$data["page_title"]='Chương trình tình nguyện "Tết yêu thương" năm 2015';
		$this->load->view("kkat/header",$data);
			$this->load->view("kkat/readmore");
		$this->load->view("kkat/footer");		
	}
	public function upload(){
		$data["page_title"]="Upload ảnh";
		$this->load->view("kkat/header",$data);
			$this->load->view("kkat/upload");
		$this->load->view("kkat/footer");
	}	
	public function do_upload(){			
					$config['upload_path']          = './uploads/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 5000;
					$config['max_width']            = 9000;
					$config['max_height']           = 9000;
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload()){
						$data = array('error_data' => $this->upload->display_errors());
					}
					else{
						$data = array('upload_data' => $this->upload->data());												

					$newWidth=200;
					$newHeight=200;				
					$config_res['image_library'] = 'gd2';
					$config_res['source_image'] = './uploads/'.$data["upload_data"]["file_name"];		
					$config_res['maintain_ratio'] = TRUE;
					$config_res['create_thumb'] = TRUE;
					$config_res['thumb_marker'] = "22222222";
					$config_res['width'] = $newWidth;
					$config_res['height'] = $newHeight;

					$this->image_lib->initialize($config_res);    

						if(!$this->image_lib->resize()){
							echo "<div>Không ghi được file thumb</div>";
						}												
						$xp = $this->image_lib->explode_name($data["upload_data"]["file_name"]);
						$filename = $xp['name'];
						$file_ext = $xp['ext'];
						$thumb_marker=$this->image_lib->thumb_marker;
						$img_name=$filename.$thumb_marker.$file_ext;					
						$data_i=array(
							"image"=>$data["upload_data"]["file_name"],
							"image_thumb"=>$img_name,
							"name"=>"test img");
						$this->db->insert("kkat",$data_i);
					}
					
					$this->load->view("kkat/header");
					$this->load->view("kkat/index",$data);
					$this->load->view("kkat/footer");		
	}
	function video(){
					$data["page_title"]="Video chương trình";
					$this->load->view("kkat/header",$data);
					$this->load->view("kkat/video");
					$this->load->view("kkat/footer");		
	}
	function del(){
					
							if($this->db->query("delete from kkat")){								
								$data["alert_page"]="Đã xóa hết dữ liệu";
							}
							
					$this->load->view("kkat/header",$data);
					$this->load->view("kkat/footer");				

	}
	
}