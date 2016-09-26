<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Operator extends MY_Controller{
	function __construct(){
		parent::__construct();
				$this->check_user();
		$this->load->model(array('Option_model','User_model','Repair_model','Equipment_model'));
	}


	function index(){
		$this->_view('operator/main');
	}

	function repair_create($id){
		$data['damages']=$this->Option_model->get_damage(array('active'=>1));
		$data['rates']=$this->Option_model->get_rate(array('active'=>1));
		$data['equipment']=$this->Equipment_model->get_equipment_type(array(
			'active'=>1,
			'use_id'=>2,
			'type_'.$id=>1,
			));
		//$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$data['streets']=$this->Option_model->get_street(array('active'=>1));
		$data['actions1']=$this->Option_model->get_action(array('active'=>1,'type'=>1));
		$data['actions2']=$this->Option_model->get_action(array('active'=>1,'type'=>2));
		$data['groups']=$this->Option_model->get_group(array('active'=>1,'type_id'=>$id));
		$data['repair_range']=$this->Option_model->get_repair_range(array('type_id'=>$id));
		$data['type']=$id;
		$data['head']=$this->Option_model->get_group_types(array('id'=>$id),true)->another;

		$this->_view('operator/repair_create',$data);
	}
	function repair_create_action(){
		$data=$this->input->post();

		$status=1;		


		$comment=$data['comment'];
		$data['address_house']=NULL;
		if($data['house_id']){
			$data['address_house']=$this->Option_model->get_house_title($data['house_id']);
		}
		if($data["type"]==1 || $data["type"]==2){
				if($data['repair_range'] && $data['group_id'] && $data['date_repair']){
					$range=$this->Option_model->get_repair_range(array('id'=>$data['repair_range']),true);
					$start=strtotime($data['date_repair'].' '.$range->start);
					$end=strtotime($data['date_repair'].' '.$range->end);
					$status=2;
				}
			$client_data=array(
							'name'=>$data['name'],
							'phone1'=>$data['phone1'],
							'phone2'=>$data['phone2'],
							'date_created'=>date('U'),
							//'area_id'=>$data['area_id'],
							'street_id'=>$data['street_id'],
							'address_house'=>$data['address_house'],
							'house_id'=>$data['house_id'],
							'address_porch'=>$data['address_porch'],
							'address_floor'=>$data['address_floor'],
							'address_room'=>$data['address_room'],
			);
		$client_id=$this->Repair_model->create_client($client_data);

		$input_data=array(
							'type'=>$data['type'],
							'client_id'=>$client_id,
							'date_repair'=>strtotime($data['date_repair']),
							'date_phone'=>$data['date_phone'],
							'date_created'=>date('U'),
							'comment'=>$comment,		
							'operator_id'=>$this->session->userdata('user_id'),		
							'urgency'=>isset($data['urgency'])?1:0,		
							'sms'=>isset($data['sms'])?1:0,
							'status_id'=>$status	
			);
		}

		else{
			 if($data['date_repair'] && $data['group_id']){
			 		$status=2;
				}
					$client_data=array(
							'date_created'=>date('U'),
							//'area_id'=>$data['area_id'],
							'street_id'=>$data['street_id'],
							'address_house'=>$data['address_house'],
							'house_id'=>$data['house_id'],
							'address_porch'=>$data['address_porch'],
			);
		$client_id=$this->Repair_model->create_client($client_data);
				$input_data=array(
					'type'=>$data['type'],
								'client_id'=>$client_id,
					'date_repair'=>strtotime($data['date_repair']),
					'date_created'=>date('U'),
					'comment'=>$comment,		
					'operator_id'=>$this->session->userdata('user_id'),		
					'urgency'=>isset($data['urgency'])?1:0,	
					'status_id'=>$status			
				);
		}
		if($data["type"]==1){
			$input_data['rate_id']=$data['rate_id'];
			$input_data['action1_id']=$data['action1_id'];
			$input_data['action2_id']=$data['action2_id'];
		}
		if($data["type"]==2){
			$input_data['damage_id']=$data['damage_id'];
			if($data['damage_id']==2){
				$comment='Поврежден провод! '.$comment;
			}
			if($data['damage_id']==4){
				$comment='СКНП! '.$comment;
			}
			$input_data['paid']=$data['paid'];
			if($data['paid']>0){
				$comment='Cтоимость ремонта '.$data['paid'].' грн. '.$comment;
			}
		}
		if($data['equipment']){
			foreach ($data['equipment'] as $key => $eq) {
				$equipment=$this->Equipment_model->get_equipment_type(array('et.id'=>$eq),true)->title;
				$comment=' (Взять '.$equipment.')'.$comment;
			}
		}
		$input_data['comment']=$comment;
		$repair_id=$this->Repair_model->create_repair($input_data);
		if($data['equipment']){
			foreach ($data['equipment'] as $key => $eq) {

				$this->Repair_model->create_repair_equipment(array(
					'repair_id'=>$repair_id,
					'equipment_id'=>$eq,
					));
				$equipment=$this->Equipment_model->get_equipment_type(array('et.id'=>$eq),true)->title;

				$comment=' (Взять '.$equipment.')'.$comment;
			}
		}
		if($status==1){
			$work=array(
				'repair_id'=>$repair_id,
				'operator_id'=>$this->session->userdata('user_id'),
				'created'=>date('U'));
		}
		if($status==2){
			$work=array(
				'repair_id'=>$repair_id,
				'start'=>$start,
				'end'=>$end,
				'group_id'=>$data['group_id'],
				'operator_id'=>$this->session->userdata('user_id'),
				'created'=>date('U'));
		}
		if($data["type"]==3  && $data['date_repair'] && $data['group_id']){
			$work=array(
				'repair_id'=>$repair_id,
				'start'=>strtotime($data['date_repair'].' 09:00'),
				'end'=>strtotime($data['date_repair'].' 11:00'),
				'fine_sum'=>$data['fine_sum'],
				'fine_d'=>$data['fine_d'],
				'fine_h'=>$data['fine_h'],
				'fine_m'=>$data['fine_m'],
				'fine_time'=>$data['fine_d']*86400+$data['fine_h']*3600+$data['fine_m']*60,
				'group_id'=>$data['group_id'],
				'operator_id'=>$this->session->userdata('user_id'),
				'created'=>date('U'));
		}
		$this->Repair_model->create_repair_work($work);

		$this->session->set_flashdata('success',"Заявка добавлена");
		redirect(base_url('operator/base/'.$data['type']));
	}

	function get_street($id){
		$street=$this->Option_model->get_street(array('active'=>1,'area_id'=>$id));
		echo json_encode($street);
	}
	function get_house($id){
		$street=$this->Option_model->get_house(array('active'=>1,'street_id'=>$id));
		echo json_encode($street);
	}
	function select_house($id){
		$house=$this->Option_model->get_house(array('id'=>$id),true);
		echo json_encode($house);
	}
		
	function base($id){
		$data['head']=$this->Option_model->get_group_types(array('id'=>$id),true)->base;
		$data['status']=$this->Option_model->get_bid_status(array('active'=>1));
		$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$data['type']=$id;
		$this->_view('operator/base',$data);
	}
	function base_table(){
		$data=$this->input->post();
		$upload_data=array('r.active'=>1);
		if(!$data['start'] && !$data['end']){
			$upload_data=array_merge($upload_data,array('r.date_repair'=>0));
		}
		else{
			$upload_data=$data['start']?array_merge($upload_data,array('r.date_repair>='=>strtotime($data['start']))):$upload_data;
			$upload_data=$data['end']?array_merge($upload_data,array('r.date_repair<'=>strtotime($data['end'])+1)):$upload_data;
		}
		
		$upload_data=$data['type']?array_merge($upload_data,array('r.type'=>$data['type'])):$upload_data;
		$upload_data=$data['status_id']?array_merge($upload_data,array('r.status_id'=>$data['status_id'])):$upload_data;
		$data['repairs']=$this->Repair_model->get_repair_all($upload_data);
		$this->load->view('operator/base_table',$data);
	/*	echo "<pre>";
		print_r($upload_data);
		echo "</pre>";*/
	}

	function repair_change($id){

		$data['repair']=$this->Repair_model->get_repair(array('id'=>$id),true);
		$data['work']=$this->Repair_model->get_repair_work(array('r.id'=>$id),true);
		$data['client']=$this->Repair_model->get_client(array('id'=>$data['repair']->client_id),true);
		$data['damages']=$this->Option_model->get_damage(array('active'=>1));
		$data['rates']=$this->Option_model->get_rate(array('active'=>1));
		//$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$data['streets']=$this->Option_model->get_street(array('active'=>1));
		if($data['client']->street_id){
			$data['house']=$this->Option_model->get_house(array('street_id'=>$data['client']->street_id,'active'=>1));
		}
		$data['actions1']=$this->Option_model->get_action(array('active'=>1,'type'=>1));
		$data['actions2']=$this->Option_model->get_action(array('active'=>1,'type'=>2));
		$data['type']=$data['repair']->type;
		$data['head']=$this->Option_model->get_group_types(array('id'=>$data['repair']->type),true)->another;
		$data['status']=$this->Option_model->get_bid_status(array('active'=>1));
		$data['equipment']=$this->Equipment_model->get_equipment_type(array(
			'active'=>1,
			'use_id'=>2,
			'type_'.$data['repair']->type=>1,
			));
		$data['groups']=$this->Option_model->get_group(array('active'=>1,'type_id'=>$data['repair']->type));
		$data['repair_range']=$this->Option_model->get_repair_range(array('type_id'=>$data['repair']->type));
	 	$data['repair_equipment']=$this->Repair_model->get_repair_equipment(array('repair_id'=>$id));
		$this->_view('operator/repair_edit',$data);
	}
	function repair_detail($id){

		$data['repair']=$this->Repair_model->get_repair_all(array('r.id'=>$id),true);
		$data['type']=$data['repair']->type_id;
		$data['history']=$this->Repair_model->get_repair_all_change(array('r.repair_id'=>$id));
		$data['equipment']=$this->Equipment_model->get_equipment_history(array('h.repair_id'=>$id));
		$this->_view('operator/detail',$data);
	}
	function repair_change_action(){
		$data=$this->input->post();
		$status=1;
		if($data["type"]==1 || $data["type"]==2){
			if($data['repair_range'] && $data['group_id'] && $data['date_repair']){
				$range=$this->Option_model->get_repair_range(array('id'=>$data['repair_range']),true);
				$start=strtotime($data['date_repair'].' '.$range->start);
				$end=strtotime($data['date_repair'].' '.$range->end);
				$status=2;
			}
		}
		$dafault=$this->Repair_model->get_repair(array('id'=>$data['id']),true);
		$dafault_client=$this->Repair_model->get_client(array('id'=>$data['client_id']),true);
		$dafault->id='';
		$dafault->repair_id=$data['id'];
		$client_change_id=$this->Repair_model->create_repair_change($dafault);
		$dafault_client->id='';
		$dafault_client->client_id=$client_change_id;

		
	
		$this->Repair_model->create_client_change($dafault_client);
		$data['address_house']=NULL;
		if($data['house_id']){
			$data['address_house']=$this->Option_model->get_house_title($data['house_id']);
		}
		if($data["type"]==1 || $data["type"]==2){

		$client_data=array(
							'name'=>$data['name'],
							'phone1'=>$data['phone1'],
							'phone2'=>$data['phone2'],
							//'area_id'=>$data['area_id'],
							'date_created'=>date('U'),
							'street_id'=>$data['street_id'],
							'house_id'=>$data['house_id'],
							'address_house'=>$data['address_house'],
							'address_porch'=>$data['address_porch'],
							'address_floor'=>$data['address_floor'],
							'address_room'=>$data['address_room'],
			);
		$client_id=$this->Repair_model->change_client($client_data,array('id'=>$data['client_id']));

		$input_data=array(
							'type'=>$data['type'],
							'client_id'=>$data['client_id'],
							'date_repair'=>strtotime($data['date_repair']),
							'date_phone'=>$data['date_phone'],
							'comment'=>$data['comment'],		
							'operator_id'=>$this->session->userdata('user_id'),		
							'status_id'=>$data['status_id'],	
							'date_created'=>date('U'),	
							'urgency'=>isset($data['urgency'])?1:0,		
							'sms'=>isset($data['sms'])?1:0,		
			);
		}
		else{
			$client_data=array(
							'date_created'=>date('U'),
							//'area_id'=>$data['area_id'],
							'street_id'=>$data['street_id'],
							'address_house'=>$data['address_house'],
							'address_porch'=>$data['address_porch'],
			);
			$client_id=$this->Repair_model->change_client($client_data,array('id'=>$data['client_id']));
			$input_data=array(
				'type'=>$data['type'],
				'client_id'=>$data['client_id'],
				'date_repair'=>strtotime($data['date_repair']),
				'date_created'=>date('U'),
				'comment'=>$data['comment'],	
				'status_id'=>$data['status_id'],		
				'operator_id'=>$this->session->userdata('user_id'),		
				'urgency'=>isset($data['urgency'])?1:0,			
			);

		}
		if($data["type"]==1){
			$input_data['rate_id']=$data['rate_id'];
			$input_data['action1_id']=$data['action1_id'];
			$input_data['action2_id']=$data['action2_id'];
		}
		if($data["type"]==2){
			$input_data['damage_id']=$data['damage_id'];
			$input_data['paid']=$data['paid'];
		}

		if($data['status_id']==11){
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
				$this->Repair_model->change_repair_work(array(
					'group_id'=>$group_id,
					'start'=>$start,
					'end'=>$end,
				),array('repair_id'=>$data['id']));
				if($data["type"]==3){
					$group_id=NULL;
					$start=NULL;
					$end=NULL;
					if($data['group_id']){
						$group_id=$data['group_id'];
						$start=strtotime($data['date_repair'].' 09:00');
						$end=strtotime($data['date_repair'].' 11:00');
							$status=2;
					}
					$status=1;
					$work=array(
						'start'=>$start,
						'end'=>$end,
						'fine_sum'=>$data['fine_sum'],
						'fine_d'=>$data['fine_d'],
						'fine_h'=>$data['fine_h'],
						'fine_m'=>$data['fine_m'],
						'fine_time'=>$data['fine_d']*86400+$data['fine_h']*3600+$data['fine_m']*60,
						'group_id'=>$group_id);
					$this->Repair_model->change_repair_work($work,array('repair_id'=>$data['id']));
				}
		}

		$this->Repair_model->delete_repair_equipment(array('repair_id'=>$data['id']));
		/*if($data['equipment']){
			foreach ($data['equipment'] as $key => $value) {
				$this->Repair_model->create_repair_equipment(array(
					'repair_id'=>$data['id'],
					'equipment_id'=>$value,
					));
			}
		}*/
		$this->Repair_model->change_repair($input_data,array('id'=>$data['id']));
		$this->session->set_flashdata('success',"Заявка изменина");
		redirect(base_url('operator/base/'.$data['type']));
		echo "<pre>";
		print_r($data);
		echo "</pre>";

	}
	function delete_repair($id){
		if($this->session->userdata('user_role')==1){
			$type=$this->Repair_model->get_repair(array('id'=>$id),true)->type;
			$this->Repair_model->change_repair(array('active'=>0),array('id'=>$id));
		}
		$this->session->set_flashdata('danger',"Заявка удалена");
		redirect(base_url('operator/base/'.$type));

	}
	function calendar($id){
		$data['head']=$data['head']=$this->Option_model->get_group_types(array('id'=>$id),true)->base;
		$data['groups']=$this->Option_model->get_group(array('active'=>1,'type_id'=>$id));
		$data['events']=$this->get_calendar($id);
		$this->_view('operator/calendar',$data);

		
	}
	function get_calendar($id){
		$group_id=$this->Option_model->get_group(array('active'=>1,'type_id'=>$id),true)->id;
		$events=$this->Repair_model->get_repair_work(array('r.active'=>1,'r.type'=>$id));
		$result=array();
		if($events){
		foreach ($events as $key => $value) {
			$result[$value->id]['id']=$value->id;
			$result[$value->id]['urgency']=$value->urgency;
			$result[$value->id]['status']=$value->status;
			$result[$value->id]['color']=$value->color;
			//Add login there
			$result[$value->id]['title']="$value->street $value->address_house кв. $value->address_room | login";
			$result[$value->id]['readeble']=$value->date_repair>=(date('U')+86400)?true:false;
			$result[$value->id]['start']=(!$value->start && !$value->end)?dt_day($value->date_repair):default_dt($value->start);
			$result[$value->id]['end']=(!$value->start && !$value->end)?dt_day($value->date_repair):default_dt($value->end);
			$result[$value->id]['resource']=(!$value->group_id)?$group_id:$value->group_id;

		}
	}
		return $result;

	}
	function change_calendar(){
		$data=$this->input->post();
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		foreach($data as $key=>$value){

			if($value['end']==0 && $value['active']==0){

				$this->Repair_model->change_repair_work(array(
					'group_id'=>NULL,
					'start'=>NULL,
					'end'=>NULL,
					'operator_id'=>$this->session->userdata('user_id'),
					'created'=>date('U'),
					),array('repair_id'=>$value['id']));
				//$this->Repair_model->change_repair(array('status_id'=>1),array('id'=>$value['id']));
			}
				else if($value['end']==0 && $value['active']==1){
				$this->Repair_model->change_repair_work(array(
					'group_id'=>$value['group_id'],
					'start'=>strtotime($value['start']),
					'end'=>(strtotime($value['start'])+3600),
					'operator_id'=>$this->session->userdata('user_id'),
					'created'=>date('U'),
					),array('repair_id'=>$value['id']));
				$this->Repair_model->change_repair(array('status_id'=>2),array('id'=>$value['id']));
		

			}
			else if($value['end']!=0 && $value['active']==1){
				$this->Repair_model->change_repair_work(array(
					'group_id'=>$value['group_id'],
					'start'=>strtotime($value['start']),
					'end'=>strtotime($value['end']),
					'operator_id'=>$this->session->userdata('user_id'),
					'created'=>date('U'),
					),array('repair_id'=>$value['id']));
				$this->Repair_model->change_repair(array('status_id'=>2),array('id'=>$value['id'],'status_id'=>1));
			}

		}
	}
	public function get_group(){
		$data=$this->input->post();
		if($data['range'] && $data['date'] && $data['type']){
			$range=explode(' - ', $data['range']);
			$start=strtotime($data['date'].' '.$range[0]);
			$end=strtotime($data['date'].' '.$range[1]);
			$repair=$this->Repair_model->get_work_group(array(
				'r.start<='=>$start,
				'r.end>='=>$end,
				'g.type_id'=>$data['type'],
				));
	
			echo json_encode($repair);
		}
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

	public function test(){
		$data['group']=3;
		$data['type']=1;
		$data['date']='27.05.2016';
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

}
