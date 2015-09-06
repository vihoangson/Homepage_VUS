<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
	function __construct() {
		parent::__construct();	
	}

	function index(){
		$data["list_function"]=get_class_methods(get_class($this));
		$this->load->view("admin/header");
		$this->load->view("admin/index",$data);
		$this->load->view("admin/footer");	
	}
	function show_post(){
		$this->db->order_by("id","desc");
		$this->db->limit(60);
		$data["list_post"]=$this->db->get("baiviet")->result();
		
		$this->load->view("admin/header");
		$this->load->view("admin/list_post",$data);
		$this->load->view("admin/footer");	
				
	}
	function show_comment(){
$css='	
<style>		
	.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}
</style>
';
$this->config->header=$css;
$this->config->footer.='<script src="'.base_url().'assets/script/filter_table.js"></script>';		
		$comment["comment"]=	$this->db->get("baiviet_comment")->result();			
		$this->load->view("base/header");
		$this->load->view("admin/show_comment",$comment);
		$this->load->view("base/footer");	
	}
	function do_save(){
		$cid= $this->input->post("cid");
		$title= $this->input->post("title");
		$image= $this->input->post("image");
		$content=$this->input->post("hometext");
		$this->load->model("Admin_model");	
		if($this->config->item("save_img_auto"))
		$content=$this->Admin_model->getimg->do_get_img_from_content(array($title,$content));
		$content= mysql_real_escape_string($content) ;

		
		
if($this->input->post("type_save")=="update"){
	$id=$this->input->post("id");
		$sql='update baiviet set
			title="'.$title.'",
				align_title="'.mod_rewrite($title).'",
				readmore="'.word_limiter(strip_tags($content)).'",
				content="'.$content.'",
				time_create='.time().',
				local_img="'.$image.'",
				cid='.$cid.'
					where id='.$id.'
			';			
}else{
		$sql='insert into baiviet set 
			id=null, 
			title="'.$title.'",
				align_title="'.mod_rewrite($title).'",
				readmore="'.word_limiter(strip_tags($content)).'",
				content="'.$content.'",
				time_create='.time().',
				local_img="'.$image.'",					
				cid='.$cid.'
			';			
}				
		if($this->db->query($sql))
			header("Location:".base_url()."admin/show_post");
	}
	function add_post(){		
		$this->config->header=$this->get_header_tinymce();
		$this->load->view("base/header");
		$this->load->view("admin/add_post");
		$this->load->view("base/footer");		
	}
	
	function edit_post(){		
		$this->config->header=$this->get_header_tinymce();
		$id=$this->uri->segment(3);
		$this->db->where("id",$id);
		$data["detail"]=$this->db->get("baiviet")->result();
		$this->load->view("base/header");
		$this->load->view("admin/edit_post",$data);
		$this->load->view("base/footer");		
	}
	function delete_post(){
		$id=$this->uri->segment(3);
		$this->db->where("id",$id);
		$rs=$this->db->get("baiviet")->result();		
		$this->load->model("Admin_model");		
		$array_img=$this->Admin_model->getimg->get_all_img($rs[0]->content);
		foreach ($array_img as $key => $value) {		
			$value=str_replace(base_url(), "", $value);
			@unlink($value);					
		}
		$this->db->query("delete from baiviet where id = ".$id." ");
		header("Location:".base_url()."Admin/show_post");
	}
	function active_post(){
		$id=(int)$this->uri->segment(3);
		$this->db->query("update  baiviet set active=if(active=1,0,1) where id = ".$id."  ");
		header("Location:".base_url()."Admin/show_post");
	}
	private function get_header_tinymce(){
return '
<script type="text/javascript" src="'.base_url().'assets/tinymce/tinymce.min.js"></script>
			<script type="text/javascript">
				tinymce.PluginManager.load(\'moxiemanager\', \'http://www.tinymce.com/tryit/js/moxiemanager/plugin.min.js\');
				
				tinymce.init({
					height : 500,
					selector: "textarea.input_text_vihan",
					theme: "modern",
					plugins: [
						"advlist autolink lists link image charmap print preview hr anchor pagebreak",
						"searchreplace wordcount visualblocks visualchars code fullscreen",
						"insertdatetime media nonbreaking save table contextmenu directionality",
						"emoticons template paste textcolor filemanager sh4tinymce "
					],
					toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
					toolbar2: " preview media | forecolor backcolor  | sh4tinymce template  link image pagebreak fontsizeselect fontselect",
					image_advtab: true,
					font_size_classes : "fontSize1,fontSize2,fontSize3,fontSize4,fontSize5,fontSize6,fontSize7",		
					theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
					content_css: "'.base_url().'assets/bootstrap-3.3.2-dist/css/bootstrap.css",
					templates: [						
						{title: \'Bs3-Post form\', url: \''.base_url().'assets/tinymce/plugins/template/postform.html\'},
						{title: \'Bs3-Multi_panel form\', url: \''.base_url().'assets/tinymce/plugins/template/multi_panel.html\'},
						{title: \'Bs3-Alert\', url: \''.base_url().'assets/tinymce/plugins/template/alert.html\'},							
							{title: \'Bs3-Temp\', url: \''.base_url().'assets/tinymce/plugins/template/template.html\'},							
						{title: \'Bs3-Panel\', url: \''.base_url().'assets/tinymce/plugins/template/panel.html\'}						
					]
				});
			</script>			
';
	}
	/*
	* test class get img automatic
	*/
	function test_getimg(){
		if(!(isset($_GET["confirm"]) && $_GET["confirm"]=="true")){
			echo "<div class='text-center'><a href='?confirm=true'>Bạn có chắc thực hiện</a></div>";
		}
		$this->db->limit(1);
		$content_p=$this->db->get("baiviet")->result();
		$this->load->model("Admin_model");				
		foreach ($content_p as $key => $value) {
			$content=$value->content;			
			$title=$value->title;			
			$content=$this->Admin_model->getimg->do_get_img_from_content(array($title,$content));
			$this->db->where("id",$value->id);
			$this->db->update("baiviet",array("content"=>$content));
			echo "<hr><hr>";
			echo $content;
		}
	}
}
