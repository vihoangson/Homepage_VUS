<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Action
{
	protected $ci;
	public $menu_main=array();
	public $title_page = "";
	public function __construct()
	{
        $this->ci =& get_instance();
	}

	

}

/* End of file Action.php */
/* Location: .//D/xampp/htdocs/vus.vn/VUS/libraries/Action.php */
