<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lang extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('Lang_model'));
		$this->check_admin();

	}
	function index(){
		$data['lang']=$this->Lang_model->get_lang(array());
		$this->admin_view('admin/lang',$data);
	}
	function create(){
		$data['title']=lang('lang_cr');
		$this->admin_view('admin/lang_create',$data);
	}
	function edit($id){
		$data['lang']=$this->Lang_model->get_lang(array('id'=>$id),true);
		$data['title']=lang('lang_ed');
		$this->admin_view('admin/lang_edit',$data);	
	}
	function save(){
		$data=$this->input->post();
		if($data['id']){
			$this->Lang_model->change_lang($data,array('id'=>$data['id']));
			$this->session->set_flashdata("success",lang('success'));
			redirect(base_url('admin/lang'));
		}
		else{
			$this->Lang_model->create_lang($data);
			$this->session->set_flashdata("success",lang('success'));
			redirect(base_url('admin/lang'));
	
		}
	}
	function change($lang){
		$this->session->set_userdata(array('lang'=>$lang));
		redirect($_SERVER['HTTP_REFERER']);
		
	}


}