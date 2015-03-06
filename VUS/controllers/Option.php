<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Option extends CI_Controller {
	var $array_option=array();
	var $CI;
	function __construct() {
		parent::__construct();
		$this->CI=& get_instance();
		$this->array_option["_ALL_ROW_1"]= array("type"=> "boolean","title"=> "Bật/tắt page","value"=>null);
		$this->array_option["_KITTEN_123"]= array("type"=> "boolean","title"=> "Bật/tắt page","value"=>null);
	}
public function syntaxhighlighter(){
		$this->load->view('base/header');
				$subject= '
			<pre class="brush: php;">
			<?php echo 123; 
				function helloSyntaxHighlighter()
				{
					return "hi!";
				}
				echo ;
			?>
			</pre>
			';
			$subject=str_replace("<?php", "&lt;?php", $subject);					
		$this->config->footer= $subject.'
		<script type="text/javascript" src="'.  base_url().'assets/syntaxhighlighter/scripts/shCore.js"></script>
		<!--	<script type="text/javascript" src="'.  base_url().'assets/syntaxhighlighter/scripts/shBrushJScript.js"></script>-->
		<script type="text/javascript" src="'.  base_url().'assets/syntaxhighlighter/scripts/shBrushPhp.js"></script>
		<link type="text/css" rel="stylesheet" href="'.  base_url().'assets/syntaxhighlighter/styles/shCoreDefault.css"/>
		<script type="text/javascript">SyntaxHighlighter.all();</script>';
$this->load->view('base/footer');
}
	public function index(){		
		
		$this->load->view('base/header');
			$a_data["array_option"]=$this->array_option;
			$this->CI->db->limit(3);
			$a_data["bai"]=$this->CI->db->get("baiviet")->result();
			$this->load->view("option",$a_data);
		
		$this->load->view('base/footer');	
		
	}

	public function save_option()
	{
		foreach ($this->array_option as $key=>$value ){			
			$array_insert[$key]=$this->input->post($key);
			$this->db->where("option",$key);
			$num=$this->db->get("option")->num_rows();
				$data111["option"]=$key;
				$data111["value"]=$this->input->post($key);
				$this->db->replace("option",$data111);			
		}	
		header("Location:".base_url()."option/");
	}	
}