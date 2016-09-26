<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Budget extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->check_user();
		

	}

	function index(){
		$data['users']=$this->User_model->get_user(array('active'=>1));
		$data['types']=$this->Option_model->get_budget_type(array('active'=>1));
		$budget=$this->Budget_model->get_budget(array('active'=>1));

		if($budget){
			foreach($budget as $key => $value) {
				if($value->out_role==5 && $value->in_role!=5){
		 	 		if($value->sum_in && !$value->sum_out){
						if(empty($data['points'][$value->out])){
							$data['points'][$value->out]=$value->sum_in;
						}
						else{
							$data['points'][$value->out]+=$value->sum_in;
						}
					}
					if(!$value->sum_in && $value->sum_out){
						if(empty($data['points'][$value->out])){
							$data['points'][$value->out]=-$value->sum_out;
						}
						else{
						$data['points'][$value->out]-=$value->sum_out;
						}
					}
				}
				else{
					if(empty($data['points'][$value->in])){
						$data['points'][$value->in]=$value->sum_in;
					}
					else{
						$data['points'][$value->in]+=$value->sum_in;
					}
			
					if(empty($data['points'][$value->out])){
						$data['points'][$value->out]=-$value->sum_out;
					}
					else{
					$data['points'][$value->out]-=$value->sum_out;
					}
					


				}
			}
		}
		$this->_view('budget/main',$data);

	}
	function get_table(){

		$data=$this->input->post();
		$upload_data=array('active'=>1);
		$upload_data=$data['start']?array_merge($upload_data,array('date>'=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('date<'=>strtotime($data['end']))):$upload_data;
		$upload_data=$data['user_in']?array_merge($upload_data,array('user_in'=>$data['user_in'])):$upload_data;
		$upload_data=$data['user_out']?array_merge($upload_data,array('user_out'=>$data['user_out'])):$upload_data;
		$upload_data=$data['type_id']?array_merge($upload_data,array('type_id'=>$data['type_id'])):$upload_data;
		$data['budget']=$this->Budget_model->get_budget($upload_data);
		$data['sum_in']=0;
		$data['sum_out']=0;
		if($data['budget']){
			foreach($data['budget'] as $key => $value) {
				if($value->type_id!=8){
				$data['sum_in']+=$value->sum_in;
				$data['sum_out']+=$value->sum_out;
				}
			}
		}

		$this->load->view('budget/table',$data);
	}

	function wage(){
		$data['users']=$this->User_model->get_user(array('active'=>1,'role!='=>5));
		$this->_view('budget/wage',$data);
	}
	function wage_save(){
		$data=$this->input->post();
		foreach ($data['wage'] as $key => $value) {
			$this->User_model->change_user(
				array(
					'wage_hour'=>$value['0'],
					'wage_koef'=>$value['1'],
					'fine_time'=>$value['2'],
					'fine'=>$value['3'],
					),array('id'=>$key));
			
		}
		$this->session->set_flashdata('success','Зарплатные ставки изменины');
		redirect(base_url('budget/wage'));
		echo "<pre>";
		print_r($data);
		echo "</pre>";

	}
	function create(){
		$get=$this->input->get();
		$data['get']=$get;
		$data['types']=$this->Option_model->get_budget_type(array('active'=>1));
		$data['users']=$this->User_model->get_user(array('active'=>1));
		$this->_view('budget/create',$data);
	}

	
	function create_action(){
		$data=$this->input->post();
		$budget=$this->Option_model->get_budget_type(array('id'=>$data['type_id']),true)->type;
		$upload_data=array(
			'user_id'=>$data['user_id'],
			'user_in'=>$data['user_in'],
			'user_out'=>$data['user_out'],
			'type_id'=>$data['type_id'],
			'comment'=>$data['comment'],
			'date'=>date("U")
			);
		switch ($budget) {
			case 1:
				$upload_data=array_merge($upload_data, array('sum_in'=>$data['sum']));
				break;
			case 2:
				$upload_data=array_merge($upload_data, array('sum_out'=>$data['sum']));
				break;
			case 3:
				$upload_data=array_merge($upload_data, array('sum_out'=>$data['sum'],'sum_in'=>$data['sum']));
				break;
			default:
				break;
		}
		$this->Budget_model->create_budget($upload_data);
		$this->session->set_flashdata('success','Статья успешно добавлена в Бюджет');
		redirect(base_url('budget'));
	}
	function change($id){
		$data['budget']=$this->Budget_model->get_budget(array('id'=>$id),true);
		$data['budget_change']=$this->Budget_model->get_budget_change(array('budget_id'=>$id));

		$data['types']=$this->Option_model->get_budget_type(array('active'=>1));
		$data['users']=$this->User_model->get_user(array('active'=>1));

		$this->_view('budget/change',$data);
	}
	function change_action(){
		$data=$this->input->post();
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		$default=$this->Budget_model->get_budget(array('id'=>$data['budget_id']),true);
		$this->Budget_model->create_budget_change(array(
			'user_id'=>$default->user_id,
			'user_in'=>$default->user_in,
			'user_out'=>$default->user_out,
			'type_id'=>$default->type_id,
			'comment'=>$default->comment,
			'date'=>$default->date,
			'sum_in'=>$default->sum_in,
			'sum_out'=>$default->sum_out,
			'budget_id'=>$default->id,
			));
		$budget=$this->Option_model->get_budget_type(array('id'=>$data['type_id']),true)->type;
		$upload_data=array(
			'user_id'=>$data['user_id'],
			'user_in'=>$data['user_in'],
			'user_out'=>$data['user_out'],
			'type_id'=>$data['type_id'],
			'comment'=>$data['comment'],
			'date'=>date("U"),
			'chng'=>1
			);
		switch ($budget) {
			case 1:
				$upload_data=array_merge($upload_data, array('sum_in'=>$data['sum']));
				break;
			case 2:
				$upload_data=array_merge($upload_data, array('sum_out'=>$data['sum']));
				break;
			case 3:
				$upload_data=array_merge($upload_data, array('sum_out'=>$data['sum'],'sum_in'=>$data['sum']));
				break;
			default:
				break;
		}
		$this->Budget_model->change_budget($upload_data,array('id'=>$data['budget_id']));
		$this->session->set_flashdata('success','Статья успешно редактирована');
		redirect(base_url('budget'));
	}
	function budget_delete_action($id){
		$this->Budget_model->change_budget(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Статья успешно удалена');
		redirect(base_url('budget'));
	}

	public function user_fines(){
		$data['user_fines']=$this->Budget_model->get_fine(array('f.active'=>1));
		$this->_view('budget/user_fines',$data);

	}

	public function user_fine_create(){
		$data['users']=$this->User_model->get_user(array('active'=>1,'role!='=>5));

		$this->_view('budget/user_fine_create',$data);
	}

	public function user_fine_create_action(){
		$data=$this->input->post();

		$this->Budget_model->create_user_fine($data);
		$config = array(
                'upload_path' => './uploads/files',
                'allowed_types' => '*',
                'max_size' => '2048'
            );
        $this->load->library('upload', $config);
        if($_FILES['file']['error'] != 4){   
            $this->upload->do_upload('file');
            $file = $this->upload->data();
            $error=$this->upload->display_errors();
        }
        if(isset($error)){
            $this->session->set_flashdata('danger',$error);
            redirect(base_url('budget/user_fine_create'));
        }
		$subject=$data['type']==1?"Премия":"Штраф";
		$text =$subject.' начислен в размере '.$data['sum'].'грн<p>Комментарий: '.$data['comment'].'</p>';
                $this->Social_model->create_message(array(
                'sender_id'=>$this->session->userdata('user_id'),
                'recipient_id'=>$data['user_id'],
                'subject'=>$subject,
                'text'=>$text,
             	'file'=>isset($file)?$file['file_name']:'',
                'date'=>date('U')));
		$this->session->set_flashdata('success','Позиция успешно создана');
		redirect(base_url('budget/user_fines'));
	}
	public function user_fine_delete_action($id){
		$data=$this->input->post();
		$this->Budget_model->change_user_fine(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Позиция успешно удалена');
		redirect(base_url('budget/user_fines'));
	}
	


	function sheet(){
		$users=$this->User_model->get_user(array('active'=>1));
		foreach ($users as $key => $value) {
			if($value->role!=5){
			$data['users'][$value->id]=$this->total_sheet($value->id);
			$data['users'][$value->id]['name']=$value->name;
			$data['users'][$value->id]['role']=$value->role_title;
		}
		}
		$this->_view('budget/sheet',$data);
	}
	function sheet_user($id){
		$data['user']=$this->total_sheet($id);
		$data['user_id']=$id;
		$this->_view('budget/sheet_user',$data);

	}
	function sheet_mon(){
		$get=$this->input->get();
		$user=$get['user'];
		$data['date']=$get['date'];
		$data['user']=$this->User_model->get_user(array('id'=>$user),true);
		$data['calendar']=$this->day_sheet($user);
		$this->_view('budget/sheet_calendar',$data);

	}
	function sheet_salary(){
		$data=$this->input->post();
		$begin=strtotime($data['date']);
		$end=last_day($data['date']);
		$data['fine']=$this->Budget_model->get_user_fine(array(
			'active'=>1,'user_id'=>$data['user_id'],'date>'=>$begin,'date<'=>$end));

		$data['salary']=$this->Budget_model->get_budget(array(
			'active'=>1,'user_in'=>$data['user_id'],'date>'=>$begin,'date<'=>$end,'type_id'=>5));
		$this->load->view('budget/sheet_salary',$data);
	}
	function on_work(){
		$data['work']=$this->User_model->get_worktime_u(array('end'=>NULL));
		$this->_view('budget/on_work',$data);

	}


		
}
