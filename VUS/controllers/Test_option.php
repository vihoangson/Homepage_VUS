<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Test_option
 *
 * @package vihoangson
 * @version 1.1
 * @todo Kiểm tra các chức năng tồn tại trong source
 * @author Vi Hoàng Sơn	
 **/
class Test_option extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->testmail();
		echo "<div><a href='".base_url()."' >Back to home</a></div>";
	}
	function test_option(){	
	}
	function testmail(){
		if($this->base_sendmail("vihoangson@gmail.com","test mail ".date("d/m/y h:n:s",time()), "test mail ".date("d/m/y h:n:s",time()) )){
						  ?> 
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Mail</strong> Send !
			</div>
						   <?php 
					}else{
						  ?> 
			<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Email</strong> Error
			</div>
						   <?php 

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
}
/* End of file test_option.php */
/* Location: ./application/controllers/test_option.php */