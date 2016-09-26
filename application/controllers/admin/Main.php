<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MY_Controller{
	function __construct(){
		parent::__construct();
		//$this->load->model(array('Event_model','User_model'));
		 $this->check_user();

	}

	public function index(){
		echo "<pre>";
		print_r($this->session->userdata);
		echo "</pre>";
	}



}