<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends MY_Controller{
	function __construct(){
		parent::__construct();
				$this->check_user();
		$this->load->model(array('Storage_model','User_model','Option_model',"Budget_model","Repair_model","Equipment_model"));

	}

	public function index(){
		$data=array();

		$this->_view('storage/main',$data);

	}

	function storage(){
		$data['users']=$this->User_model->get_user(array('active'=>1));
		$data['gds']=$this->Storage_model->get_gds(array('active'=>1));
		$data['move_type']=$this->Storage_model->get_move_type(array());
		$this->_view('report/storage',$data);

	}
	function storage_table(){
		$data=$this->input->post();
			
		$upload_data=array();
		$upload_data=$data['start']?array_merge($upload_data,array('m.date_move>'=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('m.date_move<'=>strtotime($data['end']))):$upload_data;
		$upload_data=$data['user_in']?array_merge($upload_data,array('m.user_from'=>$data['user_in'])):$upload_data;
		$upload_data=$data['user_out']?array_merge($upload_data,array('m.user_to'=>$data['user_out'])):$upload_data;
		$upload_data=$data['gds_id']?array_merge($upload_data,array('m.gds_id'=>$data['gds_id'])):$upload_data;
		$upload_data=$data['move_type']?array_merge($upload_data,array('m.move_type'=>$data['move_type'])):$upload_data;
		$data['move']=$this->Storage_model->get_move($upload_data);
		$this->load->view('report/storage_table',$data);

	}

	function budget(){

		$data['users']=$this->User_model->get_user(array('active'=>1));
		$data['types']=$this->Option_model->get_budget_type(array('active'=>1));
		$this->_view('report/budget',$data);

	}
	function budget_table(){

		$data=$this->input->post();

		$upload_data=array('active'=>0);
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
				$data['sum_in']+=$value->sum_in;
				$data['sum_out']+=$value->sum_out;
			}
		}

		$this->load->view('report/budget_table',$data);
	}
	function test(){
		$data['move']=$this->Storage_model->get_move(array());
		echo "<pre>";
		print_r($data);		
		echo "</pre>";		
	}
	function repair(){
		$data['status']=$this->Option_model->get_bid_status(array('active'=>1));
		$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$data['types']=$this->Option_model->get_group_types(array());;
		$this->_view('report/repair',$data);
	}
	function repair_table(){
		$data=$this->input->post();

		$upload_data=array('r.active'=>1);
		$upload_data=$data['start']?array_merge($upload_data,array('r.date_repair>'=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('r.date_repair<'=>strtotime($data['end'])+86398)):$upload_data;
		$upload_data=$data['type']?array_merge($upload_data,array('r.type'=>$data['type'])):$upload_data;
		$upload_data=$data['status_id']?array_merge($upload_data,array('r.status_id'=>$data['status_id'])):$upload_data;
		$data['repairs']=$this->Repair_model->get_repair_all($upload_data);
		$this->load->view('report/repair_table',$data);

	}
		function repair_detail($id){

		$data['repair']=$this->Repair_model->get_repair_all(array('r.id'=>$id),true);
		$data['type']=$data['repair']->type_id;
		$data['history']=$this->Repair_model->get_repair_all_change(array('r.repair_id'=>$id));
		$this->_view('report/repair_detail',$data);
	}

	function worktime(){
		//$data['work']=$this->User_model->get_worktime_u(array('comment!='=>NULL));
		$data['users']=$this->User_model->get_user(array('active'=>1,'role!='=>5));
		$this->_view('report/worktime',$data);
	}
	function worktime_table(){
		$data=$this->input->post();
		$upload_data=array();
		$upload_data=$data['start']?array_merge($upload_data,array('start>='=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('start<='=>strtotime($data['end']))):$upload_data;
		$upload_data=$data['user_id']?array_merge($upload_data,array('user_id'=>$data['user_id'])):$upload_data;
		$data['work']=$this->User_model->get_worktime_u($upload_data);
		$this->load->view('report/worktime_table',$data);


	}
	function worktime_read($id){
		$data['work']=$this->User_model->get_worktime(array('id'=>$id));
		$this->_view('report/worktime_read',$data);
	}
	function time(){
		$users=$this->User_model->get_user_sn(array('active'=>1,'role!='=>5));
		foreach ($users as $key => $value) {
			$data['resources'][$value->id]=$value->name;
		
		}
			$data['events']=$this->day_sheet_show();
		$this->_view('report/time',$data);

	}
	function group_work(){
		$data['users']=$this->User_model->get_user(array('active'=>1,'role'=>4));
		$this->_view('report/group_work',$data);


	}
	function group_work_table(){
		$data=$this->input->post();
		$upload_data=array();

		$upload_data=$data['start']?array_merge($upload_data,array('r.date_repair>='=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('r.date_repair<'=>strtotime($data['end'])+1)):$upload_data;
		$upload_data=$data['user_id']?array_merge($upload_data,array('u.id'=>$data['user_id'])):$upload_data;
		$data['repairs']=$this->Repair_model->get_repair_user($upload_data);
		$data['user']=array();
		if($data['repairs']){
			foreach ($data['repairs'] as $key => $value) {
				$data['user'][$value->user_id]=$value->name;
			}
		}
		$this->load->view('report/group_work_table',$data);
	} 

		
	public function lock_history(){

		$data['users']=$this->User_model->get_user(array('active'=>1,'role!='=>5));
		$data['lock']=$this->Option_model->get_lock(array('active'=>1));
		$this->_view('report/lock_history',$data);
	}

	public function lock_table(){
		$data=$this->input->post();
		$upload_data=array();
		$upload_data=$data['user_id']?array_merge($upload_data,array('lh.user_id'=>$data['user_id'])):$upload_data;
		$upload_data=$data['lock_id']?array_merge($upload_data,array('lh.lock_id'=>$data['lock_id'])):$upload_data;
		$data['lock']=$this->Option_model->get_lock_history($upload_data);
		$this->load->view('report/lock_history_table',$data);
	}
	public function equipment_history(){
		$data['equipment_location']=$this->Equipment_model->get_equipment_location(array('active'=>1));
		$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
		$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));
		$data['users']=$this->User_model->get_user(array('active'=>1,'role'=>4));
		$this->_view('report/equipment_history',$data);
	}
	public function equipment_history_table(){
		$data=$this->input->post();
		$upload_data=array('eu.t'=>'В');
		$upload_data=$data['location_id']?array_merge($upload_data,array('h.location_id'=>$data['location_id'])):$upload_data;
		$upload_data=$data['type_id']?array_merge($upload_data,array('em.type_id'=>$data['type_id'])):$upload_data;
		$upload_data=$data['vendor_id']?array_merge($upload_data,array('em.vendor_id'=>$data['vendor_id'])):$upload_data;
		$upload_data=$data['user_id']?array_merge($upload_data,array('h.user_id'=>$data['vendor_id'])):$upload_data;
		$upload_data=$data['start']?array_merge($upload_data,array('h.date>='=>strtotime($data['start']))):$upload_data;
		$upload_data=$data['end']?array_merge($upload_data,array('h.date<'=>strtotime($data['end'])+1)):$upload_data;
		$data['equipment_history']=$this->Equipment_model->get_equipment_history($upload_data);
		
		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
		$this->load->view('report/equipment_history_table',$data);
	}




}