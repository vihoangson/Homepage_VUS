<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');

// function __construct()
// function index()
// function rebuild_time_create()
// function update_content()
// function get_link()
// function view_status()
// function repair_data()
// function get_first_img($flag=true)
// function download_resize_img()
// function rebuild_align_title()
// function rebuild_readmore()
// function show_controller()
// function resize_img_custom($size=200)

class Processdatabase extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('get_content/get_content');
	}

	function index(){
		$list=array("repair_data","rebuild_align_title","show_controller","get_link","view_status","update_content");
		foreach ($list as $key => $value) {
			?>
			<p><a href="<?php echo base_url("index.php/ProcessDataBase/".$value."") ?>"><?php echo $value; ?></a></p>
			<?php
		}
	}

	function check_youtube(){
		if(!(isset($_GET["confirm"]) && $_GET["confirm"]=="true")){
			echo "<div class='text-center'><a href='?confirm=true'>Bạn có chắc thực hiện</a></div>";
		}
		$data = $this->db->get('videos')->result_array();
		$delete_video = array();
		foreach ($data as $key => $value) {
			if(!@getimagesize("http://img.youtube.com/vi/".$value["video_youtube"]."/0.jpg")	){
				$delete_video[] = $value["video_youtube"];
			}
		}
		if(is_array($delete_video)){
			$this->db->where('video_youtube in ' ."('".implode("','",$delete_video)."')" );
			$this->db->delete('videos');
			echo "<h1>Deleted !</h1>";
			dd($delete_video);
		}else{
			echo "Nothing to do";
		}
	}

	function getvui1(){
		if(!(isset($_GET["confirm"]) && $_GET["confirm"]=="true")){
			echo "<div class='text-center'><a href='?confirm=true'>Bạn có chắc thực hiện</a></div>";
		}
		$link = "https://vui1.net/trending?page={d}";
		$dom_image = ".img-wrap img";
		$dom_title = ".info h1 a";
		$title = array();
		$image = array();
		for($i=1;$i<30;$i++){
			$l = str_replace("{d}",$i,$link);
			$html = $this->get_content->curl_get($l);
			$dom_string = str_get_html($html);
			foreach ($dom_string->find($dom_image) as $key => $value) {
				$image[] = $value->src;
			}
			foreach ($dom_string->find($dom_title) as $key => $value) {
				$title[] = $value->innertext;
			}
		}
		echo (json_encode($title));
		echo (json_encode($image));
		d($image);
		dd($title);
	}

	function get_content_few_website(){
		$data = $this->prepare_data();
		foreach ($data as $key => $value) {
			$object = array(
				"title" => $value["title"],
				"readmore" => $value["compact"],
				"content" => $value["content"],
				);
			$this->db->insert('baiviet_1', $object);
		}
	}

	function get_content_detail($link){
		$html = $this->get_content->curl_get($link);
		$dom_string = str_get_html($html);
		try {
			$return["title"] = $dom_string->find("h1.title",0);
			$return["compact"] = $dom_string->find("h2.sapo",0);
			$return["content"] = $dom_string->find(".content ",0);
		} catch (Exception $e) {
		}
		$dom_string->clear();
		return $return;
	}



	function prepare_data(){
		//Nếu trong table baivie_tam khong có thì lấy về
		if($this->db->get('baiviet_tam')->num_rows()==0){
			$this->get_contet_website_save_to_db("http://kenh14.vn/la-cool/trang-{d}.chn");
			$this->get_contet_website_save_to_db("http://dantri.com.vn/chuyen-la/trang-{d}.htm");
			echo $this->db->get('baiviet_tam')->num_rows();
			die;
		}
		echo "<h1>Tổng số dòng của bảng baiviet_tam: ". $this->db->get('baiviet_tam')->num_rows()."</h1>";
		$debug_mod=false;
		if($debug_mod){//Lấy dữ liệu sẵn
			$links_ele = json_decode($this->config->config["db_link"],true);
		}else{
			//Lấy tất cả link trong cột content
			$links_ele = $this->get_main_article();
		}
		$data=array();
		$links_ele = array_values($links_ele);
		$s= microtime();
		foreach ($links_ele as $key => $value) {
			$data[] = $this->get_content_detail($value);
			if($key > 1){
				break;
			}
		}
		file_put_contents(FCPATH."/assets/data_".time().".data", json_encode($data));
		$e= microtime();
		echo "<h1>Time_process: ".$e-$s."</h1>";
		return $data;
	}

	/**
	 * Lấy dữ liệu các trang chính đổ vào csdl
	 * http://dantri.com.vn/chuyen-la/trang-".$i.".htm
	 * 
	 * @return void
	 * @author 
	 **/
	function get_contet_website_save_to_db($link_cat=""){
		if(!$link_cat) return;
		for($i=1;$i<2;$i++){
			$l = str_replace("{d}",$i,$link_cat);
			$string = $this->get_content->curl_get($l);
			$object= array(
				"content" => $string,
				);
			$this->db->insert('baiviet_tam', $object);
		}
	}

	function get_main_article(){
		$array_row = $this->db->get('baiviet_tam', 1)->result_array();
		foreach ($array_row as $key => $value) {
			$links = str_get_html($value["content"])->find("a[href^='/chuyen-la']");
			foreach ($links as $key2 => $value2) {
				if(!preg_match("/\/trang-\d|\/chuyen-la\.htm|\/chuyen-la\.rss/", $value2)){
					$link_array[] = preg_replace("/#(.+)$/","","http://dantri.com.vn".$value2->href);
				}
			}

			$links = str_get_html($value["content"])->find(".content_news h2>a");
			foreach ($links as $key2 => $value2) {
				if(preg_match("/^\/la-cool\//", $value2->href)){
					$link_array[] = preg_replace("/#(.+)$/","","http://kenh14.vn".$value2->href);
				}
			}
		}
		$link_array = array_values(array_unique($link_array));
		return (($link_array));
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