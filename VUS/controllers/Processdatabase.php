<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Processdatabase extends CI_Controller {
	function __construct() {
		parent::__construct();
	}

	function index(){
		$list=array("repair_data","rebuild_align_title","show_controller","get_link","view_status","update_content");
		foreach ($list as $key => $value) {
			?>
			<p><a href="<?php echo base_url("index.php/ProcessDataBase/".$value."") ?>"><?php echo $value; ?></a></p>
			<?php
		}
		?>    	
				
		<?php
	}
	function rebuild_time_create(){
		$this->db->order_by("id","desc");
		$this->db->where("time_create","");
		$rs=$this->db->get("baiviet");
		$time_now=time();
		foreach ($rs->result() as $row) {    		
			$time_now=$time_now-9600-rand(200,4600);
			echo "<h4>".date("d/m/Y h:n:s",$time_now)."</h4>";
			$sql="update baiviet set time_create='".$time_now."' where id=".$row->id." limit 1 ";
			echo "<p>".$sql."</p>";
			if(false)
					$this->db->query($sql);	    	
		} 
	}
	function update_content(){
		$this->load->library('get_link/updategetlink');				
		$this->updategetlink->update_content();		
	}
	function get_link(){
		$this->load->library('get_link/getlink');
		$this->load->view("base/header");		
		if($this->input->post("testmode")=="false"){
			$this->getlink->test_mode=false;
		}
		$succ=0;
		switch ($this->input->post('type')) {
			case 'tuoitrenangdong':
				$this->getlink->lay_baiviet("tuoitrenangdong");
				$succ=1;
				break;
			case 'ifact':
				$this->getlink->lay_baiviet("ifact");
				$succ=1;
				break;
			case 'dantri':
				$this->getlink->lay_baiviet("dantri");
				$succ=1;
				$this->get_first_img(true);
				break;							
		}
		if($succ==1){
			?><div class='alert alert-success'>Đã lưu</div><?php
		}
		?><div class="container">
			<form action="" method="post">
					<center>
					<div>
						<h4>Test mode</h4>
						<input type="radio" name="testmode" value="true" checked="checked"> True ||
						<input type="radio" name="testmode" value="false"> False 						
					</div>							
					<div>
						<h4>Type</h4>
						<input type="radio" name="type" value="tuoitrenangdong"> http://tuoitrenangdong.com ||
						<input type="radio" name="type" value="ifact"> http://ifact.com ||
						<input type="radio" name="type" value="dantri"> http://dantri.com.vn
					</div>
					
					<div><button type="submit" class="btn btn-primary">Get news</button></div>
					</center>
			</form>
			</div>
			<?php
			
		
		$this->load->view("base/footer");
	}
	function view_status(){
		$this->load->library('get_link/optiongetlink');
		$this->optiongetlink->view_status();		
	}


	function repair_data(){
		// Xóa bài viết nếu tiêu đề là rỗng
		$this->db->query("delete from baiviet where title='' ");


	}
	/**
	 * get first
	 * @todo Lấy hình đầu tiên
	 * @param  bool
	 * @return void
	 */
	public function get_first_img($flag=true){
		$this->load->library('get_link/updategetlink');
		$this->updategetlink->get_first_img(); // lấy dữ liệu vào trường image trong database
		$this->download_resize_img();//Save hình vào thư mục và save vào trường local_img trong database
	}

	/*
	 * Lấy tất cả tên hình trong csld và download về đặt tại thư mục baiviet
	 */
	function download_resize_img(){
		$rs=$this->db->query("select * from baiviet where local_img = '' or local_img = null ")->result();
		foreach($rs as $value){
			echo $value->image;
			echo $value->local_img;
			echo "<hr>";
			if($value->image=="" || $value->image==null)
				continue;
			$path=explode("?",$value->image);
			$base_name=basename($path[0]);
			@file_put_contents("uploads/baiviet/".$base_name, file_get_contents($value->image));
			@file_put_contents("uploads/baiviet/thumb/small_120x120_".$base_name, file_get_contents($value->image));			
			$array_config["source_image"]="uploads/baiviet/thumb/small_120x120_".$base_name;
			$array_config["width"]=120;
			$array_config["height"]=120;
			$this->image_lib->initialize($array_config);
			$this->image_lib->resize();			
			$this->image_lib->clear();
			$this->db->query("update baiviet set local_img='".$base_name."' where id=".$value->id." ");

		}
	}	
	public function rebuild_align_title() {    	
		if(false) if($_GET["testmode"]!="true"){
			echo "funtion không hoạt động";
			return;
		}
		$rs=$this->db->get("baiviet");
		$this->load->helper('rewrite');
		foreach ($rs->result() as $row) {    		
			$align_title_new=mod_rewrite(trim($row->title));
			echo "<h4>".$align_title_new."</h4>";
			echo "<p>"."update baiviet set align_title='".$align_title_new."' where id=".$row->id." limit 1 "."</p>";
			if(false)
					$this->db->query("update baiviet set align_title='".$align_title_new."' where id=".$row->id." limit 1 ");	    	
		}   
	}
	function rebuild_readmore() {    
		if(false) if($_GET["testmode"]!="true"){
			echo "funtion không hoạt động";
			return;
		}		
		
		$rs=$this->db->get("baiviet");		
		foreach ($rs->result() as $row) {    		
			$readmore_new=word_limiter(trim($row->readmore));
			echo "<h4>".$readmore_new."</h4>";
			echo "<p>"."update baiviet set readmore='".$readmore_new."' where id=".$row->id." limit 1 "."</p>";
			if(true)
					$this->db->query("update baiviet set readmore='".$readmore_new."' where id=".$row->id." limit 1 ");	    	
		}  
	}	
	function show_controller(){
		if(false) if($_GET["testmode"]!="true"){
			echo "funtion không hoạt động";
			return;
		}		
		$controllers = array();
		$this->load->helper('file');

		// Scan files in the /application/controllers directory
		// Set the second param to TRUE or remove it if you 
		// don't have controllers in sub directories
		$files = get_dir_file_info(APPPATH.'controllers', FALSE);

		// Loop through file names removing .php extension
		foreach (array_keys($files) as $file)
		{
			$controllers[] = str_replace(".php", '', $file);
			$controllers=array_diff($controllers, array("index.html") );		
		}
		foreach ($controllers as $key => $value) {
			echo "<p><a href='".base_url("index.php/".$value."")."'>".$value."</a></p>";
		}
	}
	


/*
 * Lấy hình trong thư mục hình ảnh baiviet và lưu vào thư mục mới tên thumb với kích thước thay đổi được
 */
	function resize_img_custom($size=200){
		if(false) if($_GET["testmode"]!="true"){
			echo "funtion không hoạt động";
			return;
		}
		$size=120;
		$array_d=scandir("./uploads/baiviet");
		foreach ($array_d as $value){
			if($value=="."||$value=="..") continue;
			echo $value."<hr>";
			$array_config["source_image"]="uploads/baiviet/".$value;
			$array_config["new_image"]="uploads/baiviet/thumb/small_".$size."x".$size."_".$value;
			$array_config["width"]=$size;
			$array_config["height"]=$size;
			$this->image_lib->clear();
			$this->image_lib->initialize($array_config);
			$this->image_lib->resize();			
			//$this->db->query("update baiviet set local_img='".$basename."' where id=".$value->id." ");		
		}
	}
	
}
 ?>