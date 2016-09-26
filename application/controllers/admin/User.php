<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('Event_model','User_model'));
	}

	public function index(){
		$data['test']="test";
		$this->load->view('admin/login',$data);
	}
    function login(){
        $username    =  $this->security->xss_clean($this->input->post('email'));
        $password    =  encode_pass($this->security->xss_clean($this->input->post('password')));

        $res=$this->User_model->login_admin($username,$password);

        if($this->session->userdata('is_admin')){
            redirect(base_url('admin/event'));
        }else{
            $this->session->set_flashdata('danger', lang('login_inc'));
            redirect(base_url('admin/user'));
        }
    }
     function logout(){
        $this->User_model->logout_admin();
        redirect(base_url('admin/user'));
    }

	function profile($id){
		$this->check_admin();
		$data['user']=$this->User_model->get_user(array('id'=>$id),true);
		$this->admin_view('admin/event/profile',$data);
	}
	function change(){
		$this->check_admin();
		$data=$this->input->post();
		if($data){
		$this->User_model->change_user(array(
			'name'=>$data['name'],
			'email'=>$data['email'],
			'password'=>encode_pass($data['password']),
			'act_code'=>$act_code,
			'phone'=>$data['phone'],
			'website'=>$data['website']
			),array('id'=>$data['id']));
		$this->session->set_flashdata('success',lang('success'));
		redirect(base_url('admin/user/profile/'.$data[id]));
		}
	}
	public function activation(){
		$this->check_admin();
		$data=$this->input->post();
		$this->User_model->change_user(array('active'=>$data['status']),array('id'=>$data['user_id']));
		echo $data['user_id'];
		exit();

	}

	public function act_msg($id){
		$this->session->set_flashdata('success',lang('success'));
		redirect(base_url('admin/user/profile/'.$id));
	}
	public function no_act_msg($id){
		$this->session->set_flashdata('success',lang('success'));
		redirect(base_url('admin/user/profile/'.$id));
	}
	public function all(){
		$this->check_admin();
		$data['users']=$this->User_model->get_user(array());
		$this->admin_view('admin/event/users',$data);
	}


	

}