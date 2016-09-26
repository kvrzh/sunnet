<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mounter extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->check_user();
		$this->load->model(array('Option_model','User_model','Repair_model','Budget_model','Storage_model','Equipment_model','Admin_task_model'));
	}


	function index(){
		$this->_view('mounter/main');
	}
	function start(){
		$user_id=$this->session->userdata('user_id');
		$work=$this->User_model->is_work($user_id);
		$user_w=$this->User_model->get_worktime(array('end'=>NULL,'user_id'=>$this->session->userdata('user_id')),true);
		if($user_w){
				$start_day=$user_w->start;
				$start=strtotime(dt_day($start_day));
				$end=$start+86398; 
				$now=date('U');
				//$res=round(($end-$start)/3600,1);
				if($now>$end){
					$this->User_model->change_worktime(array(
						'koef_end'=>$user_w->koef_start,
						'end'=>$start_day+3600*10
					),array('id'=>$work));
					$this->session->set_flashdata('danger',"Рабочий день не был закрыт, параметр не был изменен");
					redirect(base_url('mounter/start'));

				}
		
		}
		$data['sheet']=$this->total_sheet($user_id);
		$data['calendar']=$this->day_sheet($user_id);
		$data['user_id']=$user_id;
		$data['head']=$user_w?"Закончить рабочий день":"Начать рабочий день";
		$data['user_w']=$user_w;
		//$data['gds']=$this->Storage_model->get_gds_stock($user_id);
		$data['equipment']=$this->Equipment_model->get_equipment(array(
			'e.active'=>1,
			'e.location_id'=>2,
			'e.user_id'=>$this->session->userdata('user_id')
			));


		if($data['equipment']){
			foreach ($data['equipment'] as $key => $value) {
				if($value->use_n=='В' && ($value->up_date+86400*3)<date('U') && $value->fine_id==0){
					$fine_id=$this->Budget_model->create_user_fine(array(
						'sum'=>$value->price_out,
						'type'=>2,
						'user_id'=>$this->session->userdata('user_id'),
						'comment'=>'Оборудование',
						'user_adm_id'=>1,
						'date'=>date('U')
						));

					$subject="Не списано оборудование";
					$text =$subject.' '.$value->type.' '.$value->vendor.' '.$value->serial.' в течении 3 дней. Временный штраф - '.$value->price_out.' грн.';
       			 	$this->Social_model->create_message(array(
                	'sender_id'=>1,
                	'recipient_id'=>$this->session->userdata('user_id'),
                	'subject'=>$subject,
                	'text'=>$text,
                	'date'=>date('U')));
    				$this->Equipment_model->change_equipment(array('fine_id'=>$fine_id),array('id'=>$value->id));

				}
			}

		}


		$this->_view('mounter/start',$data);
	}

		public function day_sheet($user_id){
		$work=$this->User_model->get_worktime(array('user_id'=>$user_id,'end!='=>NULL));
		if($work){
			foreach ($work as $key => $value) {
				if(isset($data[dt_day($value->start)]['hour'])){
					$data[dt_day($value->start)]['hour_value']+=round(($value->end-$value->start)/3600,2);
					$data[dt_day($value->start)]['koef_value']+=($value->koef_end-$value->koef_start);
				}
				else{
					$data[dt_day($value->start)]['koef_wage']=$value->wage_koef;
					$data[dt_day($value->start)]['hour_wage']=$value->wage_hour;
					$data[dt_day($value->start)]['koef_value']=($value->koef_end-$value->koef_start);
					$data[dt_day($value->start)]['hour_value']=round(($value->end-$value->start)/3600,2);
				}
				$data[dt_day($value->start)]['koef']=$data[dt_day($value->start)]['koef_wage']*$data[dt_day($value->start)]['koef_value'];
				$data[dt_day($value->start)]['hour']=$data[dt_day($value->start)]['hour_wage']*$data[dt_day($value->start)]['hour_value'];

			
		}
		return $data;
		}
		else{
			return false;
		}
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
	function start_action(){
		$data=$this->input->post();
		$user_id=$this->session->userdata('user_id');
		$work=$this->User_model->is_work($user_id);
		if($work){
			$this->User_model->change_worktime(array(
				'koef_end'=>$data['koef'],
				'end'=>date('U'),
				'comment'=>$data['comment'],
				),array('id'=>$work));
			$this->session->set_flashdata('success',"Робочий день закончен");
		}
		else{
			$user=$this->User_model->get_user(array('id'=>$user_id),true);
			$this->User_model->create_worktime(array(
										'user_id'=>$user_id,
										'start'=>date('U'),
										'koef_start'=>$data['koef'],
										'wage_hour'=>$user->wage_hour,
										'wage_koef'=>$user->wage_koef,
										));
			$fine_time=strtotime($user->fine_time);
			if(date('w')==0 || date('w')==6){
				$fine_time=$fine_time+3660;
			}
			$fine=$user->fine;
			if($user->fine!=0 && $user->fine_time!=0){
				$curent_time=date('U');
				if($curent_time>$fine_time){
					$this->Budget_model->create_user_fine(array(
						'user_id'=>$this->session->userdata('user_id'),
						'sum'=>$fine,
						'date'=>date('U'),
						'type'=>2,
						'user_adm_id'=>1,
						'comment'=>'Штраф за опоздание'
					));
					$subject="Штраф";
					$text ='Вам начислен штраф за опоздание в размере '.$fine.' грн';
					$text.="<p>Начало рабочего дня в ".$user->fine_time."</p>";
					$text.="<p>Вы пришли в ".default_time($curent_time)."</p>";
					$this->Social_model->create_message(array(
						'sender_id'=>1,
						'recipient_id'=>$this->session->userdata('user_id'),
						'subject'=>$subject,
						'text'=>$text,
						'date'=>date('U')));
				}
			}

			$this->session->set_flashdata('success',"Робочий день начат");
		}

		redirect(base_url('mounter/start'));

	}


	function day($id=false){

		if(($id<2 && $id>-2) || $id==false){
			$user_w=$this->User_model->get_worktime(array('end'=>NULL,'user_id'=>$this->session->userdata('user_id')),true);
			$data['work3']=array();
			$data['work4']=array();
			if($user_w){
				$data['act_day']=$id;
				$user_id=$this->session->userdata('user_id');
				$start=strtotime(dt_day(date('U')));
				$end=$start+86398; 
				$data['work']=array();
				if($id){
					$start=$start+86400*$id;
					$end=$end+86400*$id;
				}

				$groups=$this->Option_model->get_group_consist(array('user_id'=>$user_id,'active'=>1));
				if($groups){
					foreach ($groups  as $key => $value) {
						$done=1;
						$data['work'][$key]['group']=$value->group;
						$data['work'][$key]['type']=$value->type_id;
						$data['work'][$key]['work']=$this->Repair_model->get_repair_all(
							array('r.active'=>1,'r.type!='=>3,'w.group_id'=>$value->group_id,'w.start>'=>$start,'w.end<'=>$end));
						if($data['work'][$key]['work']){
							foreach ($data['work'][$key]['work'] as $rep) {
								if($rep->status_id!=5){
									$done=0;
								}
								
							}
						}
						$data['work'][$key]['done']=$done;

					}
				}
				else{
					$this->session->set_flashdata('danger',"Вы не привязаны к группе обратитесь к администратору");
				}
					$user_id=$this->session->userdata('user_id');
					$groups=$this->Option_model->get_consist(array('gc.user_id'=>$user_id,'gc.active'=>1,'g.type_id'=>3));
						if($groups){
							foreach ($groups  as $key => $value) {
								$users=$this->Option_model->get_consist(array('gc.group_id'=>$value->group_id));
								$data['work3']=$this->Repair_model->get_repair_all(
									array('r.active'=>1,'r.type='=>3,'w.group_id'=>$value->group_id,'r.status_id!='=>5,'w.fine_time>'=>0));
								$data['work4']=$this->Repair_model->get_repair_all(
									array('r.active'=>1,'r.type='=>3,'w.group_id'=>$value->group_id,'r.status_id!='=>5,'w.fine_time='=>0));

							}
								if($data['work3']){
									foreach ($data['work3'] as $key => $value) {
										if($value->fine_time && $value->fine_sum && $value->fine_stat==0 && $value->start+$value->fine_time<date('U')){
											$users=$this->Option_model->get_consist(array('gc.group_id'=>$value->group_id));
											foreach ($users as $k_user=>$v_user) {
													$fine_id=$this->Budget_model->create_user_fine(array(
													'sum'=>$value->fine_sum,
													'type'=>2,
													'user_id'=>$v_user->user_id,
													'comment'=>'Строительство',
													'user_adm_id'=>1,
													'date'=>date('U')
													));

												$subject="Не закрыто Задание по строительству.";
												$text =$subject.' Номер заявки '.$value->id.' . Штраф - '.$value->fine_sum.' грн.';
							       			 	$this->Social_model->create_message(array(
							                	'sender_id'=>1,
							                	'recipient_id'=>$v_user->user_id,
							                	'subject'=>$subject,
							                	'text'=>$text,
							                	'date'=>date('U')));
							    				$this->Repair_model->change_repair_work(array('fine_stat'=>1),array('id'=>$value->id));
												}
										}
									}
								}

						}

					$this->_view('mounter/day',$data);
			}
			else{
				$this->session->set_flashdata('danger','Сперва начните рабочий день');

				redirect(base_url('mounter/start'));
			}
		}
		else{
			$this->session->set_flashdata('danger','Некоректный день');
			redirect(base_url('mounter/day'));
		}
		
	
	}
	function day_print($id=false){
		$data['act_day']=$id;
		$user_id=$this->session->userdata('user_id');
		$start=strtotime(dt_day(date('U')));
		$end=$start+86398; 
		$data['work']=array();
		if($id){
			$start=$start+86400*$id;
			$end=$end+86400*$id;
		}

		$groups=$this->Option_model->get_group_consist(array('user_id'=>$user_id,'active'=>1));
		if($groups){
			foreach ($groups  as $key => $value) {
				$data['work'][$key]['date']=$start;
				$data['work'][$key]['group']=$value->group;
					$data['work'][$key]['type']=$value->type_id;
				$data['work'][$key]['work']=$this->Repair_model->get_repair_all_cable(
					array('r.active'=>1,'w.group_id'=>$value->group_id,'w.start>'=>$start,'w.end<'=>$end,'r.status_id!='=>5));
			}
		}
		else{
			$this->session->set_flashdata('success',"Вы не привязаны к группе обратитесь к администратору");
		}
			$this->load->view('mounter/day_print',$data);

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";*/
	}
	function in_work(){
		$user_id=$this->session->userdata('user_id');
		$start=strtotime(dt_day(date('U')));
		$end=$start+86398; 
		$data['work']=array();
		$k=0;
		$groups=$this->Option_model->get_group_consist(array('user_id'=>$user_id,'active'=>1));
		if($groups){
			foreach ($groups  as $key => $value) {
				//$data['work'][$key]['group']=$value->group;
				$data['work']=$this->Repair_model->get_repair_all(
					array('r.active'=>1,'w.group_id'=>$value->group_id,'w.start>'=>$start,'w.end<'=>$end));
					if($data['work']){
						foreach ($data['work'] as $key => $value) {
							$res=$this->Repair_model->change_repair(array('status_id'=>8),array('id'=>$value->id,'status_id'=>2));
							$k=$res?($k+1):$k;
					}
				}
			}
		}
		if($k>0){

			$this->session->set_flashdata('success',"Статус всех заявок на сегодня изменен на 'В работе'");
		
		}
		else{
			$this->session->set_flashdata('danger',"ОШИБКА по принятию заявок");
		}
		redirect(base_url('mounter/day/'));

	}

	function task($id){
		
		$data['repair']=$this->Repair_model->get_repair_all(array('r.active'=>1,'r.id'=>$id),true);
		$data['status']=$this->Option_model->get_bid_status(array('active'=>1));
		$data['house_cable']=array();
		if($data['repair']->type_id==1){
			$data['house_cable']=$this->Option_model->get_house_cable(array('active='=>1,'free'=>1,'house_id'=>$data['repair']->house_id));
		}
		$repair_equipment=$this->Repair_model->get_repair_equipment_type(array('re.repair_id'=>$id));
		$data['equipment']=array();
		if($repair_equipment){
			foreach ($repair_equipment as $key => $value) {
				$data['equipment'][$value->id]['type']=$value->type;
				$data['equipment'][$value->id]['list']=$this->Equipment_model->get_equipment(array(
					'e.active'=>1,
					'e.location_id'=>1,
					'em.type_id'=>$value->id
					));
			}
		}
		$data['groups']=$this->Option_model->get_group(array('active'=>1,'type_id'=>$data['repair']->type_id));
		$data['repair_range']=$this->Option_model->get_repair_range(array('type_id'=>$data['repair']->type_id));

		$this->_view('mounter/task',$data);




	}

	function change_status(){
		$data=$this->input->post();
		if($data){
			$comment=$data['comment_master'];
			$input_data=array(
							'comment_master'=>$comment,
							'status_id'=>$data['status'],			
							'operator_id'=>$this->session->userdata('user_id'));
			if($data['status']==11){
				$start=NULL;
				$end=NULL;
				$group_id=NULL;
				$input_data['date_repair']=strtotime($data['date_repair']);
				$input_data['status_id']=1;
				if($data['group_id']){
					$group_id=$data['group_id'];
					$input_data['status_id']=2;

				}
				if($data['repair_range']){
					$range=$this->Option_model->get_repair_range(array('id'=>$data['repair_range']),true);
					$start=strtotime($data['date_repair'].' '.$range->start);
					$end=strtotime($data['date_repair'].' '.$range->end);	


				}
				if($data['type_id']==3 && $data['group_id']){
					$start=strtotime($data['date_repair'].' 09:00');
					$end=strtotime($data['date_repair'].' 11:00');
				}
				$this->Repair_model->change_repair_work(array(
					'group_id'=>$group_id,
					'start'=>$start,
					'end'=>$end,
				),array('repair_id'=>$data['id']));
			}
		$dafault=$this->Repair_model->get_repair(array('id'=>$data['id']),true);
		$dafault->id='';
		$dafault->repair_id=$data['id'];
		$client_change_id=$this->Repair_model->create_repair_change($dafault);

		if($data['type_id']==2 && $data['status']==5){
			if($data['mount_paid']>0){
				$comment='Cумма снятие - '.$data['mount_paid'].'грн. '.$data['comment_master'];
				$input_data['mount_paid']=$data['mount_paid'];	
				$task_data=array(
					'subject'=>'Платный ремонт',
					'comment'=>'Подтвердить снятие абоненту -=логин=- на сумму'.$data['mount_paid'].'грн',
					'user_id'=>1,
					'created'=>date('U'),
					'type_id'=>1,
					'status_id'=>1,
					'start'=>date('U'),
					'mount_paid'=>$data['mount_paid']
					);
				$this->Admin_task_model->create_task($task_data);
			}
		}
	
		$input_data['comment_master']=$comment;
		if($data['status']==7){
			$input_data['status_time']=$data['status_time'];
		}	
		else{
			$input_data['status_time']=0;
		}	
		



		$user_id=$this->session->userdata('user_id');
		$group=$this->Repair_model->get_repair_group(array('repair_id'=>$data['id']));
		$users=$this->Option_model->get_group_consist(array('group_id'=>$group));
		$date_start=strtotime(dt_day(date('U')));
		if($users){
			foreach ($users as $key => $value) {
				$act= $this->User_model->get_worktime_u(array(
					'start>'=>$date_start,'user_id'=>$value->user_id
					));
				if($act){
					$this->Repair_model->create_repair_user(array(
						'user_id'=>$value->user_id,
						'repair_id'=>$data['id'],
						'status_id'=>$data['status'],
						'date'=>date('U'),
						'group_id'=>$group
						));
				}
			}
		}
		if(isset($data['house_cable'])){
			if($data['house_cable']){
				$input_data['cable_use']=1;
				if($data['house_cable']>0){
						$this->Option_model->change_house_cable(array('free'=>0),array('id'=>$data['house_cable']));
						$cable=$this->Option_model->get_house_cable(array('id'=>$data['house_cable']),true);
						$input_data['comment_master']='(Использован кабель кв '.$cable->number.' '.$input_data['comment_master'].'.)';
						$input_data['cable_use']=1;
						$cable_info="<b>$cable->login</b> 
				            	(п:$cable->porch эт:$cable->floor 
				            	к:$cable->com_id
				            	п:<b>$cable->number</b>) ";
						$task_data=array(
							'subject'=>'Свободный кабель, удалить заявку с биллинга',
							'comment'=>'Удалить заявку с биллинга.'.$cable_info,
							'user_id'=>1,
							'created'=>date('U'),
							'type_id'=>2,
							'status_id'=>1,
							'start'=>date('U'),
							);
						$this->Admin_task_model->create_task($task_data);
				}
			}
		}
		if($data['house_note']!=$data['def_house_note']){
			$house=$this->Option_model->get_house(array('id'=>$data['house_id']),true);
			if($house->note){
				$this->Option_model->create_house_note(array(
				'house_id'=>$data['house_id'],
				'note'=>$house->note,
				'date'=>$house->date,
				'user_id'=>$house->user_id
				));
			}
			$this->Option_model->change_house(array(
				'note'=>$data['house_note'],
				'user_id'=>$this->session->userdata('user_id'),
				'date'=>date('U')
				),
				array('id'=>$data['house_id'])
			);


			
		}

		$this->Repair_model->change_repair($input_data,array('id'=>$data['id']));
		if(isset($data['equipment'])){
			if($data['equipment']>0){
				foreach ($data['equipment'] as $key => $value) {
					if($value){
						$this->Equipment_model->change_equipment(array(
							'location_id'=>2,
							'user_id'=>$this->session->userdata('user_id'),
							'up_user'=>$this->session->userdata('user_id'),
							'up_date'=>date('U'),
							),array('id'=>$value));
							$this->Equipment_model->create_equipment_history(array(
								'equipment_id'=>$value,
								'count'=>1,
								'location_id'=>2,
								'date'=>date('U'),
								'admin_id'=>$this->session->userdata('user_id'),
								'user_id'=>$this->session->userdata('user_id'),
								'repair_id'=>$data['id'],
							));
						$model=$this->Equipment_model->get_equipment(array('e.id'=>$value),true);
						$eq=$this->Equipment_model->get_group_equipment(array('e.model_id'=>$model->model_id,'e.location_id'=>1),true);
						if($eq->total<=$eq->min){
									$task_data=array(
									'subject'=>'Склад, заканчивается '.$eq->vendor.' '.$eq->model,
									'comment'=>'На складе осталось '.$eq->vendor.' '.$eq->model.' - '.$eq->total.'шт. Необходимо закупить !!  ',
									'user_id'=>1,
									'created'=>date('U'),
									'type_id'=>3,
									'status_id'=>1,
									'start'=>date('U'),
									);
							$this->Admin_task_model->create_task($task_data);
						}
					}
				}
			}
		}

		$this->session->set_flashdata('success',"Заявка изменина");
		redirect(base_url('mounter/day/'));
	}



	}

	public function lock(){
		$user_id=$this->session->userdata('user_id');
		$data['lock']=$this->Option_model->get_user_lock(array('u.user_id'=>$user_id));
		$this->_view('mounter/lock',$data);
	}
	public function lock_open($id){
		$user_id=$this->session->userdata('user_id');
		$user_lock=$this->Option_model->get_user_lock(array('user_id'=>$user_id,'lock_id'),true);
		if($user_lock){
			$this->Option_model->create_lock_history(array(
				'user_id'=>$user_id,
				'lock_id'=>$id,
				'date'=>date('U')
				));
			$ip=$this->Option_model->get_lock(array('id'=>$id),true)->ip;
			// Connect there


			$this->session->set_flashdata('success',"Замок открыт");
		}
		else{
			$this->session->set_flashdata('danger',"Нет прав доступа");
		}
		redirect(base_url('mounter/lock'));
	}
	public function note(){
		$data['streets']=$this->Option_model->get_street(array('active'=>1));
		$this->_view('mounter/note',$data);
		
	}
	public function note_table(){
		$data=$this->input->post();
		$upload_data=array('h.active'==1);
		$upload_data=$data['street_id']?array_merge($upload_data,array('s.id'=>$data['street_id'])):$upload_data;
		$data['notes']=$this->Option_model->get_house_street($upload_data);
		$this->load->view('mounter/note_table',$data);
	}
	public function house_note_edit($id){
		$data['house']=$this->Option_model->get_house(array('id'=>$id),true);
		$data['street']=$this->Option_model->get_street(array('id'=>$data['house']->street_id),true);
		$data['user']=$this->User_model->get_user(array('id'=>$data['house']->user_id),true);
		$this->_view('mounter/house_note_edit',$data);
	}
	public function house_note_edit_action(){
		$data=$this->input->post();
		if($data['house']['note']!=$data['def_note']){
			$house=$this->Option_model->get_house(array('id'=>$data['house']['id']),true);
			if($house->note){
				$this->Option_model->create_house_note(array(
				'house_id'=>$data['house']['id'],
				'note'=>$house->note,
				'date'=>$house->date,
				'user_id'=>$house->user_id
				));
			}
		}
		$this->Option_model->change_house($data['house'],array('id'=>$data['house']['id']));
		$street=$this->Option_model->get_street(array('id'=>$data['id']),true);
		$this->session->set_flashdata('success','Заметка редактирована');
		redirect(base_url('mounter/note/'));

	}
	public function get_range(){
		$data=$this->input->post();
		if($data['group'] && $data['date'] && $data['type']){
			$start=strtotime($data['date'].' 09:00');
			$end=strtotime($data['date'].' 23:00');
			$repair=$this->Repair_model->get_work_range(array(
				'r.start>='=>$start,
				'r.end<='=>$end,
				'r.group_id'=>$data['group'],
				'g.type_id'=>$data['type'],
				'rep.active'=>1,
				));
			if($repair){
				foreach ($repair as $key => $value) {
					$time[$key]['start']=default_time($value->start);
					$time[$key]['end']=default_time($value->end);
				}
				$block=array();
				$range=$this->Option_model->get_repair_range(array('type_id'=>$data['type']));
				foreach ($range as $ra) {
					foreach ($time as $ti) {
						if($ti['start']<=$ra->start && $ti['end']>=$ra->end){
							$block[$ra->id]=$ra->id;

						}
						if($ti['start']>=$ra->start && $ti['end']<=$ra->end){
							$block[$ra->id]=$ra->id;

						}
					}
					
				}

			}
		}
		echo json_encode($block);


	}
	public function test1(){
		$users=$this->Option_model->get_consist(array('gc.group_id'=>7));
		echo "<pre>";
		print_r($users);
		echo "</pre>";

	}

}
