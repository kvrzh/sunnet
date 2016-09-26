<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends MY_Controller{
	function __construct(){
		parent::__construct();
		 		$this->check_user();

	}
	function menu_change(){
		$data=$this->input->post();
		if($data){
			$menu_status=$this->session->userdata('menu_status');
			$new_status=$menu_status?'':'sidebar-collapse';
			$this->session->set_userdata(array('menu_status'=>$new_status));
		}

	}

	public function index(){
		$role=$this->session->userdata('user_role');
		switch ($role) {
			case 3 : 
				redirect(base_url('mounter/start'));
				break;
			case 4 : 
				redirect(base_url('mounter/start'));
				break;
			
			default:
				$this->load->model(array('Option_model','User_model','Repair_model','Budget_model'));
				$repairs=$this->Repair_model->get_repair(array('active'=>1));
					$status=$this->Option_model->get_group_types(array());

				foreach ($repairs as $key => $value) {
					if(empty($data['repairs'][$status[$value->type]->title][dt_utc(strtotime(dt_day($value->date_repair)))])){
						$data['repairs'][$status[$value->type]->title][dt_utc(strtotime(dt_day($value->date_repair)))]=1;
					}
					else{
						$data['repairs'][$status[$value->type]->title][dt_utc(strtotime(dt_day($value->date_repair)))]+=1;				
					}
					if(empty($data['repairs_s'][$status[$value->type]->title])){
						$data['repairs_s'][$status[$value->type]->title]=1;
					}
					else{
						$data['repairs_s'][$status[$value->type]->title]+=1;				
					}
							

				}
				$budget=$this->Budget_model->get_budget(array('active'=>1));
				$data['sum']=0;
				if($budget){
				foreach ($budget as $key => $value) {
					$data['sum']+=$value->sum_in?$value->sum_in:0;
					$data['sum']-=$value->sum_out?$value->sum_out:0;
					
				}
				$on_work=$this->User_model->get_worktime_u(array('end'=>NULL));
				$data['on_work']=$on_work?count($on_work):0;
				$data['sum_rep']=$repairs ?count($repairs ):0;
			}
				$data['count_m']=$this->check_message();
				$this->_view('main',$data);
				break;
		}
		

	}
	public function test(){
		$user=$this->User_model->get_user(array('id'=>$this->session->userdata('user_id')),true);
		$fine_time=strtotime($user->fine_time);
		$fine=$user->fine;
		$curent_time=date('U');
		if($curent_time>$fine_time){
			$this->Budget_model->create_user_fine(array(
				'user_id'=>$this->session->userdata('user_id'),
				'sum'=>$fine,
				'date'=>date('U'),
				'type'=>2
				));
				$subject="Штраф";
				$text ='Вам начислен штраф за опоздание в размере '.$fine.'грн';
                $this->Social_model->create_message(array(
                'sender_id'=>1,
                'recipient_id'=>$this->session->userdata('user_id'),
                'subject'=>$subject,
                'text'=>$text,
                'date'=>date('U')));
		}
		echo "<pre>";
		print_r(default_dt($fine_time));
		//print_r(date('U'));
		//print_r($user);
		echo "</pre>";
	}




}