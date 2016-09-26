<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Option extends MY_Controller{
	function __construct(){
		parent::__construct();
				$this->check_user();
		$this->load->model(array('Option_model','User_model'));

	}

	public function actions(){
		$data['actions']=$this->Option_model->get_action(array('active'=>1));
		$this->_view('option/actions',$data);

	}
	public function action_edit($id){
		$data['action']=$this->Option_model->get_action(array('id'=>$id),true);
		$this->_view('option/action_edit',$data);
	}
	public function action_create(){
		$this->_view('option/action_create');
	}
	public function action_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_action($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Акция редактирована');
		redirect(base_url('option/actions'));
	}
	public function action_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_action($data);
		$this->session->set_flashdata('success','Акция добавлена');
		redirect(base_url('option/actions'));
	}
	public function action_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_action(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Акция удалена');
		redirect(base_url('option/actions'));
	}
	public function rates(){
		$data['rates']=$this->Option_model->get_rate(array('active'=>1));
		$this->_view('option/rates',$data);

	}

	public function rate_edit($id){
		$data['rate']=$this->Option_model->get_rate(array('id'=>$id),true);
		$this->_view('option/rate_edit',$data);
	}
	public function rate_create(){
		$this->_view('option/rate_create');
	}
	public function rate_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_rate($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Тариф редактирован');
		redirect(base_url('option/rates'));
	}
	public function rate_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_rate($data);
		$this->session->set_flashdata('success','Тариф добавлен');
		redirect(base_url('option/rates'));
	}
	public function rate_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_rate(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Тариф удален');
		redirect(base_url('option/rates'));
	}

	public function areas(){
		$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$this->_view('option/areas',$data);

	}

	public function area_edit($id){
		$data['area']=$this->Option_model->get_area(array('id'=>$id),true);
		$this->_view('option/area_edit',$data);
	}
	public function area_create(){
		$this->_view('option/area_create');
	}
	public function area_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_area($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Район редактирован');
		redirect(base_url('option/areas'));
	}
	public function area_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_area($data);
		$this->session->set_flashdata('success','Район добавлен');
		redirect(base_url('option/areas'));
	}
	public function area_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_area(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Район удален');
		redirect(base_url('option/areas'));
	}
	public function streets(){
		$data['streets']=$this->Option_model->get_street(array('active'=>1));
		$this->_view('option/streets',$data);

	}

	public function street_edit($id){
		$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$data['street']=$this->Option_model->get_street(array('id'=>$id),true);
		$this->_view('option/street_edit',$data);
	}
	public function street_create(){
		$data['areas']=$this->Option_model->get_area(array('active'=>1));
		$this->_view('option/street_create',$data);
	}
	public function street_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_street($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Улица редактирована');
		redirect(base_url('option/streets'));
	}
	public function street_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_street($data);
		$this->session->set_flashdata('success','Улица добавлена');
		redirect(base_url('option/streets'));
	}
	public function street_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_street(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Улица удалена');
		redirect(base_url('option/streets'));
	}
		

	public function damages(){
		$data['damages']=$this->Option_model->get_damage(array('active'=>1));
		$this->_view('option/damages',$data);

	}

	public function damage_edit($id){
		$data['damage']=$this->Option_model->get_damage(array('id'=>$id),true);
		$this->_view('option/damage_edit',$data);
	}
	public function damage_create(){
		$this->_view('option/damage_create');
	}
	public function damage_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_damage($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Поломка редактирована');
		redirect(base_url('option/damages'));
	}
	public function damage_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_damage($data);
		$this->session->set_flashdata('success','Поломка добавлена');
		redirect(base_url('option/damages'));
	}
	public function damage_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_damage(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Поломка удалена');
		redirect(base_url('option/damages'));
	}

	public function groups(){
		$data['groups']=$this->Option_model->get_group(array('active'=>1));
		$this->_view('option/groups',$data);

	}

	public function group_edit($id){
		$data['types']=$this->Option_model->get_group_types(array());
		$data['group']=$this->Option_model->get_group(array('id'=>$id),true);
		if($data['group']){
			$this->_view('option/group_edit',$data);
		}
		else{
			$this->session->set_flashdata('danger','Группа не существует');
			redirect(base_url('option/groups'));
		}
	}
	public function group_create(){
		$data['types']=$this->Option_model->get_group_types(array());
		$this->_view('option/group_create',$data);
	}
	public function group_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_group($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Группа редактирована');
		redirect(base_url('option/groups'));
	}
	public function group_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_group($data);
		$this->session->set_flashdata('success','Группа добавлена');
		redirect(base_url('option/groups'));
	}
	public function group_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_group(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Группа удалена');
		redirect(base_url('option/groups'));
	}


	public function bid_status(){
		$data['bid_status']=$this->Option_model->get_bid_status(array('active'=>1));
		$data['admin_status']=$this->Option_model->get_admin_status(array('active'=>1));
		$data['admin_type']=$this->Option_model->get_admin_type(array('active'=>1));
		$this->_view('option/bid_status',$data);

	}
	public function admin_status_create(){
		$data=$this->input->post();
		if($data){
			$this->Option_model->create_admin_status($data);
			$this->session->set_flashdata('success','Админ статус создан');
			redirect(base_url('option/bid_status'));
		}
		else{
			$this->_view('option/admin_status_create');
		}
	}
	public function admin_status_change($id=false){
		$data=$this->input->post();
		if($data){
			$this->Option_model->change_admin_status($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Админ статус изминен');
			redirect(base_url('option/bid_status'));
		}
		else{
			$data['status']=$this->Option_model->get_admin_status(array('id'=>$id),true);
			$this->_view('option/admin_status_edit',$data);
		}
	}
	public function admin_status_remove($id){
		$this->Option_model->change_admin_status(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Админ статус удален');
		redirect(base_url('option/bid_status'));
	}

	public function admin_type_create(){
		$data=$this->input->post();
		if($data){
			$this->Option_model->create_admin_type($data);
			$this->session->set_flashdata('success','Админ тип создан');
			redirect(base_url('option/bid_status'));
		}
		else{
			$this->_view('option/admin_type_create');
		}
	}
	public function admin_type_change($id=false){
		$data=$this->input->post();
		if($data){
			$this->Option_model->change_admin_type($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Админ тип изминен');
			redirect(base_url('option/bid_status'));
		}
		else{
			$data['type']=$this->Option_model->get_admin_type(array('id'=>$id),true);
			$this->_view('option/admin_type_edit',$data);
		}
	}
	public function admin_type_remove($id){
		$this->Option_model->change_admin_type(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Админ тип удален');
		redirect(base_url('option/bid_status'));
	}

	public function bid_status_edit($id){
		$data['bid_status']=$this->Option_model->get_bid_status(array('id'=>$id),true);
		$this->_view('option/bid_status_edit',$data);
	}
	public function bid_status_create(){
		$this->_view('option/bid_status_create');
	}
	public function bid_status_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_bid_status($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Статус изминен');
		redirect(base_url('option/bid_status'));
	}
	public function bid_status_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_bid_status($data);
		$this->session->set_flashdata('success','Статус добавлен');
		redirect(base_url('option/bid_status'));
	}
	public function bid_status_delete_action($id){
		$data=$this->input->post();
		if($id==1 || $id==2){
			$this->session->set_flashdata('success','Администраторские статусы, удалять не льзя');
			redirect(base_url('option/bid_status'));
		}
		else{
		$this->Option_model->change_bid_status(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Статус удален');
		redirect(base_url('option/bid_status'));
		}
	}

	public function group_consist(){
		
		$users=$this->User_model->get_user(array('role'=>4,'active'=>1));
		$groups=$this->Option_model->get_group(array('active'=>1));
		
		foreach ($users as $user_id => $user) {
			$data['users'][$user->id]['user']=$user->name;
			foreach($groups as $group_id=>$group){
				$data['headers'][$group->id]=$group->type.' '.$group->title;
				$consist=$this->Option_model->get_group_consist(array('user_id'=>$user->id,'group_id'=>$group->id),true);
				if($consist){	
					if($consist->active){
					$data['users'][$user->id][$group->id]=1;
					}
					else{
						$data['users'][$user->id][$group->id]=0;
					}
				}else{
					$data['users'][$user->id][$group->id]=0;
				}
			}
		}
		$this->_view('option/group_consist',$data);
	}
	public function consist_save(){
		$data=$this->input->post();
		$this->Option_model->delete_group_consist(array('id>'=>0));
		echo "<pre>";
		print_r($data['consist']);
		echo "</pre>";
		foreach ($data['consist'] as $user_key => $user) {
			foreach ($user as $group_key => $group) {
				$this->Option_model->create_group_consist(array(
					'user_id'=>$user_key,
					'group_id'=>$group_key,
					'date'=>date('U'),
					'active'=>1));
			}
		}
		$this->session->set_flashdata('success','ТЗ обновлено');
		redirect(base_url('option/group_consist'));
	
	}

	public function budget_types(){
		$data['budget_types']=$this->Option_model->get_budget_type(array('active'=>1));
		$this->_view('option/budget_types',$data);

	}

	public function budget_type_edit($id){
		$data['types']=$this->Option_model->get_budget_pos(array());
		$data['budget_type']=$this->Option_model->get_budget_type(array('id'=>$id),true);
		$this->_view('option/budget_type_edit',$data);
	}
	public function budget_type_create(){
		$data['types']=$this->Option_model->get_budget_pos(array());

		$this->_view('option/budget_type_create',$data);
	}
	public function budget_type_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_budget_type($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Позиция редактирована');
		redirect(base_url('option/budget_types'));
	}
	public function budget_type_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_budget_type($data);
		$this->session->set_flashdata('success','Позиция добавлена');
		redirect(base_url('option/budget_types'));
	}
	public function budget_type_delete_action($id){
		$data=$this->input->post();
		if($id==5){
			$this->session->set_flashdata('success','Администраторская статья, удалять нельзя');
			redirect(base_url('option/budget_types'));
		}

		else{
		$this->Option_model->change_budget_type(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Позиция удалена');
		redirect(base_url('option/budget_types'));
		}
	}

	function permission($id){
		$data['user']=$this->User_model->get_user(array('id'=>$id),true);
		$data['all_menu']=$this->Option_model->get_menu_all(array());
		$data['menu_user']=$this->Option_model->get_menu_user(array('user_id'=>$id));
		$data['user_id']=$id;

		$this->_view('option/permission',$data);
	}
	function permission_action(){
		$data=$this->input->post();
		$this->Option_model->delete_menu_user(array('user_id'=>$data['user_id']));
		if($data['permission']){
			foreach ($data['permission'] as $key => $value) {
				if($value==1){
					$this->Option_model->create_menu_user(array(
						'user_id'=>$data['user_id'],
						'menu_id'=>$key
					));
				}

			}
		}
		$this->session->set_flashdata('success','Права доступа изменены');
		redirect(base_url('option/permission/'.$data['user_id']));
	}


	public function repair_range(){
		$data['repair_range1']=$this->Option_model->get_repair_range(array('active'=>1,'type_id'=>1));
		$data['repair_range2']=$this->Option_model->get_repair_range(array('active'=>1,'type_id'=>2));
		$this->_view('option/repair_range',$data);
	}
	public function repair_range_action(){
		$data=$this->input->post();
		if($data){
			$this->Option_model->delete_repair_range(array('type_id'=>$data['type_id']));
			if(count($data['date']['start']>0)){
				for($i=0;$i<count($data['date']['start']);$i++){
					$this->Option_model->create_repair_range(array(
						'type_id'=>$data['type_id'],
						'start'=>$data['date']['start'][$i],
						'end'=>$data['date']['end'][$i],
						));
				}
			}
		}
		$this->session->set_flashdata('success',"Диапазоны времени изменены");
		redirect(base_url('option/repair_range'));		
	}

	public function lock(){
		$data['lock']=$this->Option_model->get_lock(array('active'=>1));
		$this->_view('option/lock',$data);

	}

	public function lock_edit($id){
		$data['lock']=$this->Option_model->get_lock(array('id'=>$id),true);
		$this->_view('option/lock_edit',$data);
	}
	public function lock_create(){

		$this->_view('option/lock_create');
	}
	public function lock_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_lock($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Замок редактирован');
		redirect(base_url('option/lock'));
	}
	public function lock_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_lock($data);
		$this->session->set_flashdata('success','Замок добавлен');
		redirect(base_url('option/lock'));
	}
	public function lock_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_lock(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Замок удален');
		redirect(base_url('option/lock'));
	}

	public function house($id){
		$data['street']=$this->Option_model->get_street(array('id'=>$id),true);
		$data['house']=$this->Option_model->get_house(array('street_id'=>$id,'active'=>1));
		$this->_view('option/house',$data);

	}

	public function house_edit($id){
		$data['house']=$this->Option_model->get_house(array('id'=>$id),true);
		$data['street']=$this->Option_model->get_street(array('id'=>$data['house']->street_id),true);
		$data['house_cable']=$this->Option_model->get_house_cable(array('active'=>1,'house_id'=>$id));
		$data['house_note']=$this->Option_model->get_house_note(array('house_id'=>$id));
		$data['user']=$this->User_model->get_user(array('id'=>$data['house']->user_id),true);
		$this->_view('option/house_edit',$data);
	}


	public function house_create($id){
		$data['street']=$this->Option_model->get_street(array('id'=>$id),true);
		$this->_view('option/house_create',$data);
	}
	public function house_edit_action(){
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
		$this->session->set_flashdata('success','Дом редактирован');
		redirect(base_url('option/house/'.$data['street_id']));

	}
	public function house_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_house($data);
		$this->session->set_flashdata('success','Дом добавлен');
		redirect(base_url('option/house/'.$data['street_id']));
	}
	public function house_delete_action($id){;
		$this->Option_model->change_house(array('active'=>0),array('id'=>$id));
		$house=$this->Option_model->get_house(array('id'=>$id),true);
		$this->session->set_flashdata('success','Дом удален');
		redirect(base_url('option/house/'.$house->street_id));


		
	}
	public function house_cable_create($id){
		$data['house']=$this->Option_model->get_house(array('id'=>$id),true);
		$data['street']=$this->Option_model->get_street(array('id'=>$data['house']->street_id),true);
		$this->_view('option/house_cable_create',$data);
	}

	public function house_cable_edit($id){

		$data['house_cable']=$this->Option_model->get_house_cable(array('id'=>$id),true);
		$data['house']=$this->Option_model->get_house(array('id'=>$data['house_cable']->house_id),true);
		$data['street']=$this->Option_model->get_street(array('id'=>$data['house']->street_id),true);
		$this->_view('option/house_cable_edit',$data);

	}


	public function house_cable_create_action(){
		$data=$this->input->post();
		$this->Option_model->create_house_cable($data);
		$this->session->set_flashdata('success','Кабель добавлен');
		redirect(base_url('option/house_edit/'.$data['house_id']));
	}
	public function house_cable_edit_action(){
		$data=$this->input->post();
		$this->Option_model->change_house_cable($data['house_cable'],array('id'=>$data['house_cable']['id']));
		$this->session->set_flashdata('success','Кабель редактирован');
		redirect(base_url('option/house_edit/'.$data['house_id']));
	}
	public function house_cable_delete_action($id){
		$data=$this->input->post();
		$this->Option_model->change_house_cable(array('active'=>0),array('id'=>$id));
		$house=$this->Option_model->get_house_cable(array('id'=>$id),true);
		$this->session->set_flashdata('success','Кабель удален');
		redirect(base_url('option/house_edit/'.$house->house_id));
	}


	public function admin_consist(){
		
		$users=$this->User_model->get_user(array('role!='=>5,'active'=>1));
		$types=$this->Option_model->get_admin_type(array('active'=>1));
		
		foreach ($users as $user_id => $user) {
			$data['users'][$user->id]['user']=$user->name;
			foreach($types as $type_id=>$type){
				$data['headers'][$type->id]=$type->title;
				$consist=$this->Option_model->get_admin_consist(array('c.user_id'=>$user->id,'c.type_id'=>$type->id),true);
				if($consist){	
					$data['users'][$user->id][$type->id]=1;
				}else{
					$data['users'][$user->id][$type->id]=0;
				}
			}
		}
		$this->_view('option/admin_consist',$data);
	}
	public function admin_save(){
		$data=$this->input->post();
		$this->Option_model->delete_admin_consist(array('user_id>'=>0));
		echo "<pre>";
		print_r($data['consist']);
		echo "</pre>";
		foreach ($data['consist'] as $user_key => $user) {
			foreach ($user as $group_key => $group) {
				$this->Option_model->create_admin_consist(array(
					'user_id'=>$user_key,
					'type_id'=>$group_key
					));
			}
		}
		$this->session->set_flashdata('success','Права для админ задач обновлены');
		redirect(base_url('option/admin_consist'));
	
	}

	public function vision(){
		$data['street']=$this->Option_model->get_street(array('active'=>1));
		$this->_view('option/vision',$data);
	}

	public function vision_table(){
		$data=$this->input->post();
		$upload_data=array('h.active'=>1);
		$upload_data=$data['street_id']?array_merge($upload_data,array('h.street_id'=>$data['street_id'])):$upload_data;
		$data['house']=$this->Option_model->get_house_full($upload_data);
		$this->load->view('option/vision_table',$data);
	}
}