<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_task extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->check_user();
		$this->load->model(array('Admin_task_model','Option_model','Equipment_model','User_model','Budget_model'));
	}

	public function index(){
		$data=$this->Admin_task_model->get_task(array());
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

	public function task_create(){
		$data=$this->input->post();
		if($data){
			$input_data=array(
				'subject'=>$data['subject'],
				'comment'=>$data['comment'],
				'user_id'=>$this->session->userdata('user_id'),
				'created'=>date('U'),
				'type_id'=>$data['type_id'],
				'status_id'=>$data['status_id'],
				'start'=>strtotime($data['date']),
				'start_time'=>$data['start_time'],
				'urgency'=>$data['urgency'],
				'sms'=>$data['sms'],
				);

			$task_id=$this->Admin_task_model->create_task($input_data);

			$this->session->set_flashdata('success','Админ задача создана');
			
			redirect(base_url('admin_task/task'));
		}
		else{
			$data['admin_status']=$this->Option_model->get_admin_status(array('active'=>1));
			$data['admin_type']=$this->Option_model->get_admin_type(array('active'=>1));
			$this->_view('admin_task/task_create',$data);
		}
	}

	public function task_change($id=false){
		$data=$this->input->post();
		if($data){
			$this->Admin_task_model->change_task(array(
				'admin_id'=>$this->session->userdata('user_id'),
				'finish'=>date('U'),
				'status_id'=>$data['status_id'],
				'comment_admin'=>$data['comment_admin']
				),array('id'=>$data['id']));
			if($data['type_id']==1){
				$paid=$data['mount_paid'];
			}
			$this->Admin_task_model->create_task_history(array(
				'admin_id'=>$this->session->userdata('user_id'),
				'date'=>date('U'),
				'status_id'=>$data['status_id'],
				'comment_admin'=>$data['comment_admin'],
				'task_id'=>$data['id']
				));
			$this->session->set_flashdata('success','Заявка изменена');
			redirect(base_url('admin_task/task'));
		}
		else{
			$data['admin_status']=$this->Option_model->get_admin_status(array('active'=>1));
			$data['task']=$this->Admin_task_model->get_task(array('t.id'=>$id),true);
			/*echo "<pre>";
			print_r($data);
			echo "</pre>";*/
			$this->_view('admin_task/task_change',$data);
		}

	}

	public function task(){
		$data['admin_status']=$this->Option_model->get_admin_status(array('active'=>1));

		$task=$this->Option_model->get_admin_consist_u(array('c.user_id'=>$this->session->userdata('user_id')));
		$data['admin_type']=$this->Option_model->get_admin_type(array('active'=>1),false,$task);
		$data['user']=$this->User_model->get_user(array('active'=>1,'role!='=>5));

		$this->_view('admin_task/task',$data);
	}


	public function task_table(){
		$data=$this->input->post();
		$upload_data=array('t.active'=>1);
		$upload_data=$data['status_id']?array_merge($upload_data,array('t.status_id'=>$data['status_id'])):$upload_data;
		
		if(!$data['start'] && !$data['end']){
			$upload_data=array_merge($upload_data,array());
		}
		else{
			$upload_data=$data['start']?array_merge($upload_data,array('t.start>='=>strtotime($data['start']))):$upload_data;
			$upload_data=$data['end']?array_merge($upload_data,array('t.start<'=>strtotime($data['end'])+1)):$upload_data;
		}
		if($data['type_id']){
			$upload_data=$data['type_id']?array_merge($upload_data,array('t.type_id'=>$data['type_id'])):$upload_data;
			$data['task']=$this->Admin_task_model->get_task($upload_data);
		}
		else{
			$task=$this->Option_model->get_admin_consist_u(array('c.user_id'=>$this->session->userdata('user_id')));
			$data['task']=$this->Admin_task_model->get_task($upload_data,false,$task);
		}

		$this->load->view('admin_task/task_table',$data);
	}

	public function task_history($id){
		$data['task_id']=$id;
		$data['task']=$this->Admin_task_model->get_task(array('t.id'=>$id),true);
		$data['history']=$this->Admin_task_model->get_task_history(array('t.task_id'=>$id,'t.active'=>1));
		$this->_view('admin_task/task_history',$data);
	}

	public function test(){

		//$count=$this->Admin_task_model->task_count();
		//print_r($count);
		$data['admin_task']=$this->Option_model->get_admin_consist_u(array('c.user_id'=>$this->session->userdata('user_id')));
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}

}