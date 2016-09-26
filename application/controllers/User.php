<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('User_model','Option_model'));
	}

	public function index(){
		$this->load->view('login');
	}
	public function show($status=false){
        $this->check_user();
        $data['active']=$status==2?0:1;
		$data['users']=$this->User_model->get_user(array('active'=>$data['active']));
		$this->_view('user/main',$data);
	}
	public function edit($id){
		   $this->check_user();
		$data['user']=$this->User_model->get_user(array('id'=>$id),true);
        $data['lock']=$this->Option_model->get_lock(array('active'=>1));
        $data['user_lock']=$this->Option_model->get_user_lock(array('u.user_id'=>$id));
		$data['role']=$this->User_model->get_role($id);
		$data['roles']=$this->User_model->get_user_role(array());
		$this->_view('user/edit',$data);

	}
	public function active_action($id){
		      $this->check_user();
		$user=$this->User_model->get_user(array('id'=>$id),true);
		if($user){
			$status=$user->active;
			$new_status=$status==1?0:1;
            if($new_status==0){
                $work=$this->User_model->is_work($id);
                $user_w=$this->User_model->get_worktime(array('end'=>NULL,'user_id'=>$id),true);
                if($user_w){
                    $start_day=$user_w->start;
                        $this->User_model->change_worktime(array(
                            'koef_end'=>$user_w->koef_start,
                            'end'=>$start_day
                        ),array('id'=>$work));
                    }
                }
			$this->User_model->change_user(array('active'=>$new_status),array('id'=>$id));
			$this->session->set_flashdata('success',"Статус пользователя успешер изминен");
			redirect(base_url('user/show'));
		}
		else{
			redirect(base_url('user/show'));
		}


	}
    public function edit_action(){
		      $this->check_user();
    	$data=$this->input->post();
        $this->load->helper('form');
        $error=false;
        $photo['file_name']=$data['photo'];
        $passport['file_name']=$data['passport'];
        if ($data) {
            $config = array(
                'upload_path' => './uploads/users',
                'allowed_types' => 'gif|jpg|png',
                'max_size' => '2048'
            );
           $this->load->library('upload', $config);
            if($_FILES['passport']['error'] != 4){   
	            $this->upload->do_upload('passport');
	         	$passport = $this->upload->data();
	         	$error=$this->upload->display_errors();
        	}
            if($_FILES['photo']['error'] != 4){
	            $this->upload->do_upload('photo');
	         	$photo = $this->upload->data();
	         	$error=$this->upload->display_errors();
        	}
        	if($error){
        		$this->session->set_flashdata('danger',$error);
        		redirect(base_url('user/create'));
        	}
        	else{

        		$this->User_model->change_user(array(
        			'name'=>$data['name'],
        			'login'=>$data['login'],
        			'password'=>encode_pass($data['password']),
        			'date_registrated'=>date("U"),
        			'active'=>1,
        			'role'=>$data['role'],
        			'phone'=>$data['phone'],
        			'photo'=>$photo['file_name'],
        			'passport'=>$passport['file_name'],
        			),array('id'=>$data['id']));
                $this->Option_model->delete_user_lock(array('user_id'=>$data['id']));
                if(isset($data['lock'])){
                    foreach ($data['lock'] as $key => $value) {
                        $this->Option_model->create_user_lock(array(
                            'user_id'=>$data['id'],
                            'lock_id'=>$value,
                            ));
                    }
                }
    		$this->session->set_flashdata('success',"Пользователь успешно изминен");
    		redirect(base_url('user/show'));
    		}
    	}
	}		

	public function create(){
        $this->check_user();
                $data['lock']=$this->Option_model->get_lock(array('active'=>1));
		$data['roles']=$this->User_model->get_user_role(array());
		$this->_view('user/create',$data);
	}
    public function create_action(){
	       $this->check_user();
    	$data=$this->input->post();
        $this->load->helper('form');
        $error=false;
        $photo=NULL;
        $passport=NULL;
        if ($data) {
            $config = array(
                'upload_path' => './uploads/users',
                'allowed_types' => 'gif|jpg|png',
                'max_size' => '2048'
            );
           $this->load->library('upload', $config);
            if($_FILES['passport']['error'] != 4){   
	            $this->upload->do_upload('passport');
	         	$passport = $this->upload->data();
	         	$error=$this->upload->display_errors();
        	}
            if($_FILES['photo']['error'] != 4){
	            $this->upload->do_upload('photo');
	         	$photo = $this->upload->data();
	         	$error=$this->upload->display_errors();
	         	$this->load->library('image_lib');
        	}
        	if($error){
        		$this->session->set_flashdata('danger',$error);
        		redirect(base_url('user/create'));
        	}
        	else{
        		$user_id=$this->User_model->create_user(array(
        			'name'=>$data['name'],
        			'login'=>$data['login'],
        			'password'=>encode_pass($data['password']),
        			'date_registrated'=>date("U"),
        			'active'=>1,
        			'role'=>$data['role'],
        			'phone'=>$data['phone'],
        			'photo'=>$photo['file_name'],
        			'passport'=>$passport['file_name'],
        			));
            if(isset($data['lock'])){
                    foreach ($data['lock'] as $key => $value) {
                        $this->Option_model->create_user_lock(array(
                            'user_id'=>$user_id,
                            'lock_id'=>$value,
                            ));
                    }
                }
    		$this->session->set_flashdata('success',"Пользователь успешно добавлен");
    		redirect(base_url('user/show'));
    		}
    	}
	}		




    function login(){
        $username    =  $this->security->xss_clean($this->input->post('login'));
        $password    =  encode_pass($this->security->xss_clean($this->input->post('password')));

        $res=$this->User_model->login($username,$password);

        if($this->session->userdata('is_logged_in')){
            redirect(base_url('main'));
        }else{
            $this->session->set_flashdata("danger","Некорректный логин или пароль");
            redirect(base_url('user'));
        }
    }

    
     function logout(){
        $this->User_model->logout();
        redirect(base_url('user'));
    }
	function profile(){
		$this->check_user();
		$data['user']=$this->User_model->get_user(array('id'=>$this->session->userdata('user_id')),true);
		$this->event_view('main/profile',$data);
	}
	function change(){
                $this->check_user();
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
		redirect(base_url('user/profile'));
		}

	}
    public function copy_user($id){
        $copy_user=$this->User_model->get_user(array('id'=>$id),true);
        $copy_perm=$this->Option_model->get_menu_user(array('user_id'=>$id));
        $user_id=$this->User_model->create_user(array(
            'role'=>$copy_user->role,
            'date_registrated'=>date('U'),
            'active'=>1,
            'name'=>'COPY_'.$id

            ));
        if($copy_perm){
            foreach ($copy_perm as $key => $value) {
                    $this->Option_model->create_menu_user(array(
                        'user_id'=>$user_id,
                        'menu_id'=>$value
                    ));
            }
        }
        $this->session->set_flashdata('success',"Создан новый пользователь, права доступа перенесены");
        redirect(base_url('user/edit/'.$user_id));


    }

	

}