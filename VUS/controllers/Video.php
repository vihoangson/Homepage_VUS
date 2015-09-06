<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {

	public function index()
	{
		echo $this->load->view('base/header',null,true);
		$this->db->order_by('RAND()');
		$array_video = $this->db->get('videos',24)->result_array();
		foreach ($array_video as $key => $value) {
			echo $this->load->view('block/block_ele_video',$value,true);
		}
		echo $this->load->view('base/footer',null,true);
	}

	public function detail(){
		$id = $this->uri->segment(3);
		if(!$id){
			die;
		}
		$this->db->where('video_id', $id);
		$rs = $this->db->get('videos', 1)->row();
		$this->load->view('base/header');
		$this->load->view('video/detail_video', array("rs"=>$rs));
		$this->load->view('base/footer');
	}

}

/* End of file Video.php */
/* Location: .///10.11.8.118/vhosts/santo/vus.vn/VUS/controllers/Video.php */