<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Equipment extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->check_user();
		$this->load->model(array('Equipment_model','User_model','Budget_model','Admin_task_model'));
	}

	public function index(){
		echo 'test';
	}
	public function equipment_type(){
		$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));

		$this->_view('equipment/equipment_type',$data);
	}

	public function equipment_type_create(){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->create_equipment_type($data);
			$this->session->set_flashdata('success','Тип обородувания добавлен');
			redirect(base_url('equipment/equipment_type'));
		}
		else{
			$data['equipment_use']=$this->Equipment_model->get_equipment_use();
			$data['equipment_unit']=$this->Equipment_model->get_equipment_unit();
			$this->_view('equipment/equipment_type_create',$data);
		}
	}
	public function equipment_type_edit($id=false){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->change_equipment_type($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Тип оборудования редактирован');
			redirect(base_url('equipment/equipment_type'));
		}
		else{
			$data['equipment_use']=$this->Equipment_model->get_equipment_use();
			$data['equipment_unit']=$this->Equipment_model->get_equipment_unit();
			$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('et.id'=>$id),true);
			$this->_view('equipment/equipment_type_edit',$data);

		}
	}
	public function equipment_type_delete($id){
		$this->Equipment_model->change_equipment_type(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Тип удален');
		redirect(base_url('equipment/equipment_type'));

	}

	public function equipment_vendor(){
		$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));
		$this->_view('equipment/equipment_vendor',$data);
	}

	public function equipment_vendor_create(){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->create_equipment_vendor($data);
			$this->session->set_flashdata('success','Вендор обородувания добавлен');
			redirect(base_url('equipment/equipment_vendor'));
		}
		else{
			$this->_view('equipment/equipment_vendor_create');
		}
	}
	public function equipment_vendor_edit($id=false){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->change_equipment_vendor($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Вендор оборудования редактирован');
			redirect(base_url('equipment/equipment_vendor'));
		}
		else{
			$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('id'=>$id),true);
			$this->_view('equipment/equipment_vendor_edit',$data);

		}
	}
	public function equipment_vendor_delete($id){
		$this->Equipment_model->change_equipment_vendor(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Вендор удален');
		redirect(base_url('equipment/equipment_vendor'));

	}
	public function equipment_model(){

		$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
		$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));
		$this->_view('equipment/equipment_model',$data);
	}

	public function equipment_model_table(){
		$data=$this->input->post();
		$upload_data=array('em.active'=>1);
		$upload_data=$data['type_id']?array_merge($upload_data,array('type_id'=>$data['type_id'])):$upload_data;
		$upload_data=$data['vendor_id']?array_merge($upload_data,array('vendor_id'=>$data['vendor_id'])):$upload_data;
		$data['equipment_model']=$this->Equipment_model->get_equipment_model($upload_data);
		$this->load->view('equipment/equipment_model_table',$data);
	}

	public function equipment_model_create(){
		$data=$this->input->post();
		if($data){
			  $config = array(
                'upload_path' => './uploads/equipment',
                'allowed_types' => 'gif|jpg|jpeg|png|bmp',
                'max_size' => '2048'
            );
        $this->load->library('upload', $config);
        if($_FILES['file']['error'] != 4){   
            $this->upload->do_upload('file');
            $file = $this->upload->data();
            $error=$this->upload->display_errors();
        }
        if($error){
            $this->session->set_flashdata('danger',$error);
            redirect(base_url('equipment/equipment_model_create'));
        }
        else{
        	if(isset($file)){
        		$thumb=$this->do_resize('/uploads/equipment/',$file['file_name']);
    			$data['photo']='/uploads/equipment/'.$file['file_name'];
    			$data['photo_thumb']=$thumb;
   		 	}
        }
			$this->Equipment_model->create_equipment_model($data);
			$this->session->set_flashdata('success','Модель добавлена');
			redirect(base_url('equipment/equipment_model'));
		}
		else{
			$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
			$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));
			$this->_view('equipment/equipment_model_create',$data);
		}
	}



	public function equipment_model_edit($id=false){
		$data=$this->input->post();
			if($data){
		  			$config = array(
	                'upload_path' => './uploads/equipment',
	                'allowed_types' => 'gif|jpg|jpeg|png|bmp',
	                'max_size' => '2048'
	            );
	        $this->load->library('upload', $config);
	        if($_FILES['file']['error'] != 4){   
	            $this->upload->do_upload('file');
	            $file = $this->upload->data();
	            $error=$this->upload->display_errors();
	        }
	        if($error){
	            $this->session->set_flashdata('danger',$error);
	            redirect(base_url('equipment/equipment_model_create'));
	        }
	        else{
	        	if(isset($file)){
	        		$thumb=$this->do_resize('/uploads/equipment/',$file['file_name']);
	    			$data['photo']='/uploads/equipment/'.$file['file_name'];
	    			$data['photo_thumb']=$thumb;
	   		 	}
	        }
			$this->Equipment_model->change_equipment_model($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Модель редактирована');
			redirect(base_url('equipment/equipment_model'));
		}
		else{
			$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
			$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));

			$data['equipment_model']=$this->Equipment_model->get_equipment_model(array('em.id'=>$id),true);
			$this->_view('equipment/equipment_model_edit',$data);

		}
	}
	public function equipment_model_delete($id){
		$this->Equipment_model->change_equipment_model(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Модель удалена');
		redirect(base_url('equipment/equipment_model'));

	}

	public function equipment_provisioner(){
		$data['equipment_provisioner']=$this->Equipment_model->get_equipment_provisioner(array('active'=>1));
		$this->_view('equipment/equipment_provisioner',$data);
	}

	public function equipment_provisioner_create(){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->create_equipment_provisioner($data);
			$this->session->set_flashdata('success','Поставщик добавлен');
			redirect(base_url('equipment/equipment_provisioner'));
		}
		else{
			$this->_view('equipment/equipment_provisioner_create');
		}
	}
	public function equipment_provisioner_edit($id=false){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->change_equipment_provisioner($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Поставщик редактирован');
			redirect(base_url('equipment/equipment_provisioner'));
		}
		else{
			$data['equipment_provisioner']=$this->Equipment_model->get_equipment_provisioner(array('id'=>$id),true);
			$this->_view('equipment/equipment_provisioner_edit',$data);

		}
	}
	public function equipment_provisioner_delete($id){
		$this->Equipment_model->change_equipment_provisioner(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Поставщик удален');
		redirect(base_url('equipment/equipment_provisioner'));

	}

	public function equipment_location(){
		$data['equipment_location']=$this->Equipment_model->get_equipment_location(array('active'=>1));
		$this->_view('equipment/equipment_location',$data);
	}

	public function equipment_location_create(){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->create_equipment_location($data);
			$this->session->set_flashdata('success','Место добавленл');
			redirect(base_url('equipment/equipment_location'));
		}
		else{
			$this->_view('equipment/equipment_location_create');
		}
	}
	public function equipment_location_edit($id=false){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->change_equipment_location($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Место редактировано');
			redirect(base_url('equipment/equipment_location'));
		}
		else{
			$data['equipment_location']=$this->Equipment_model->get_equipment_location(array('id'=>$id),true);
			$this->_view('equipment/equipment_location_edit',$data);

		}
	}
	public function equipment_location_delete($id){
		if($id==1 || $id==2){
			$this->session->set_flashdata('danger','Нельзя удалить');
		}
		else{
			$this->Equipment_model->change_equipment_location(array('active'=>0),array('id'=>$id));
			$this->session->set_flashdata('success','Место удалено');
		}

		redirect(base_url('equipment/equipment_location'));

	}	
	public function equipment_pres($location_id=false){
		$location_id=$location_id==false?1:$location_id;
		$data['equipment_location']=$this->Equipment_model->get_equipment_location(array('active'=>1));
		$data['location_id']=$location_id;
		$data['head']=$data['equipment_location'][$location_id];
		$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
		$data['equipment_vendor']=$this->Equipment_model->get_equipment_vendor(array('active'=>1));
		$this->_view('equipment/equipment_pres',$data);
	}
	public function equipment_pres_table(){
		$data=$this->input->post();
		$data['head']=$this->Equipment_model->get_equipment_location(array('id'=>$data['location_id']),true);
		$upload_data=array('e.active'=>1,'e.location_id'=>$data['location_id']);
		$upload_data=$data['type_id']?array_merge($upload_data,array('em.type_id'=>$data['type_id'])):$upload_data;
		$upload_data=$data['vendor_id']?array_merge($upload_data,array('em.vendor_id'=>$data['vendor_id'])):$upload_data;
		$equipment=$this->Equipment_model->get_equipment($upload_data);
		$data['equipment']=array();
		if($equipment){
			foreach ($equipment as $key => $value) {
				if(isset($data['equipment'][$value->model_id])){
					$data['equipment'][$value->model_id]['count']+=$value->count;
					if($data['location_id']==2){
						$data['equipment'][$value->model_id]['serial'].=$value->serial?', '.$value->user_name.':'.$value->serial:'';
					}
					else{
						$data['equipment'][$value->model_id]['serial'].=$value->serial?', '.$value->serial:'';
					}
				}
				else{
					$data['equipment'][$value->model_id]['type']=$value->type;
					$data['equipment'][$value->model_id]['vendor']=$value->vendor;
					$data['equipment'][$value->model_id]['model']=$value->model;
					$data['equipment'][$value->model_id]['min']=$value->min;			
					$data['equipment'][$value->model_id]['count']=$value->count;			
					$data['equipment'][$value->model_id]['photo']=$value->photo;			
					$data['equipment'][$value->model_id]['photo_thumb']=$value->photo_thumb;			
					$data['equipment'][$value->model_id]['description']=$value->model_description;			
					$data['equipment'][$value->model_id]['use_n']=$value->use_n;
					if($data['location_id']==2){
						$data['equipment'][$value->model_id]['serial']=$value->user_name.':'.$value->serial;
					}
					else{			
						$data['equipment'][$value->model_id]['serial']=$value->serial;
					}			
				}
			}
		}

		$this->load->view('equipment/equipment_pres_table',$data);
	}

	public function equipment_user(){
		$equipment=$this->Equipment_model->get_equipment(array(
			'e.active'=>1,
			'e.user_id>'=>0
			));
		if($equipment){
			foreach ($equipment as $key => $value) {
				$data['users'][$value->user_id]=$value->user_name;
			}

		}
		$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
		$this->_view('equipment/equipment_user',$data);
	}

	public function equipment_user_table(){
		$data=$this->input->post();
		$upload_data=array('e.active'=>1);
		$upload_data=$data['user_id']?array_merge($upload_data,array('e.user_id'=>$data['user_id'])):array_merge($upload_data,array('e.user_id>'=>0));
		$upload_data=$data['type_id']?array_merge($upload_data,array('em.type_id'=>$data['type_id'])):$upload_data;
		$data['equipment']=$this->Equipment_model->get_equipment_group($upload_data);
		$this->load->view('equipment/equipment_user_table',$data);

	}

	public function equipment_one($model_id=false){
		$data=$this->input->post();
		if($data){
			if($data['has_number']==1){
				$this->Equipment_model->change_equipment(array(
					'location_id'=>$data['location_to'],
					'user_id'=>$data['user_to'],
					'up_date'=>date('U'),
					'up_user'=>$this->session->userdata('user_id')
					),
				array('id'=>$data['serial'])
				);
					$this->Equipment_model->create_equipment_history(array(
					'equipment_id'=>$data['serial'],
					'count'=>1,
					'location_id'=>$data['location_to'],
					'date'=>date('U'),
					'user_id'=>$data['user_to'],
					'admin_id'=>$this->session->userdata('user_id'),
					'house_id'=>$data['location_to']==9?$data['house_id']:NULL,
					'porch'=>$data['location_to']==9?$data['porch']:NULL,
					));
			}
			else{
				$equipment=$this->Equipment_model->get_equipment(array(
					'e.active'=>1,
					'e.location_id'=>$data['location_from'],
					'e.model_id'=>$data['model_id']
					));
				$i=0;
				foreach ($equipment as $key => $value) {
					if($i==$data['count']){
						break;
					}
					else{
						$this->Equipment_model->change_equipment(array(
						'location_id'=>$data['location_to'],
						'user_id'=>$data['user_to'],
						'up_date'=>date('U'),
						'up_user'=>$this->session->userdata('user_id')
						),array('id'=>$value->id));
						$this->Equipment_model->create_equipment_history(array(
							'equipment_id'=>$value->id,
							'count'=>1,
							'location_id'=>$data['location_to'],
							'date'=>date('U'),
							'user_id'=>$data['user_to'],
							'admin_id'=>$this->session->userdata('user_id'),
							'house_id'=>$data['location_to']==9?$data['house_id']:NULL,
							'porch'=>$data['location_to']==9?$data['porch']:NULL,
							));
					}
					$i++;
				}
			}
			$eq=$this->Equipment_model->get_group_equipment(array('e.model_id'=>$model_id,'e.location_id'=>1),true);
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
			redirect(base_url('equipment/equipment_pres'));

		}
		else{
			$equipment=$this->Equipment_model->get_equipment(array('e.model_id'=>$model_id));
			$data['equipment_model']=$this->Equipment_model->get_equipment_model(array('em.id'=>$model_id),true);
			$data['all_location']=$this->Equipment_model->get_equipment_location(array('active'=>1));
			$data['users']=$this->User_model->get_user(array('active'=>1));
			if($equipment){
				foreach ($equipment as $key => $value) {
					if($value->location_move==1){
						$data['location'][$value->location_id]=$value->location;
					}
					
				}
			}
			$data['streets']=$this->Option_model->get_street(array('active'=>1));
			$this->_view('equipment/equipment_one',$data);
		}
	}
	public function equipment_remove($id=false){
		$data=$this->input->post();
		if($data){
			$equipment=$this->Equipment_model->get_equipment(array('e.id'=>$data['id']),true);
			if($equipment->type_has_number==0){
				$when=array(
					'up_date'=>$equipment->up_date,
					'up_user'=>$equipment->up_user,
					'model_id'=>$equipment->model_id,
					);
			}
			else{
				$when=array('id'=>$data['id']);
			}
			$this->Equipment_model->change_equipment(array(
				'location_id'=>$data['location_to'],
				'up_date'=>date('U'),
				'up_user'=>$this->session->userdata('user_id'),
				'user_id'=>'',
				'fine_id'=>'0',
				),$when);
				$this->Equipment_model->create_equipment_history(array(
					'equipment_id'=>$data['id'],
					'count'=>1,
					'location_id'=>$data['location_to'],
					'date'=>date('U'),
					'admin_id'=>$this->session->userdata('user_id'),
					));

			if($data['fine_id']!=0){
				$this->Budget_model->change_user_fine(array('active'=>0),array('id'=>$data['fine_id']));
			}
			redirect(base_url('equipment/equipment_user'));
		}
		else{
			$data['equipment']=$this->Equipment_model->get_equipment(array('e.id'=>$id),true);
			$data['all_location']=$this->Equipment_model->get_equipment_location(array('active'=>1,'remove'=>1));
			$this->_view('equipment/equipment_remove',$data);
		}
	}

	public function equipment_create(){
		$data=$this->input->post();
		if($data){
			for($i=0;$i<count($data['model_id']);$i++){
				if($data['has_number'][$i]==0){
					for($j=0;$j<$data['count'][$i];$j++){
						$equipment_id=$this->Equipment_model->create_equipment(array(
						'model_id'=>$data['model_id'][$i],
						'count'=>1,
						'serial'=>'',
						'provisioner_id'=>$data['provisioner_id'],
						'location_id'=>1,
						'cr_date'=>date('U'),
						'cr_user'=>$this->session->userdata('user_id'),
						));
						$this->Equipment_model->create_equipment_history(array(
							'equipment_id'=>$equipment_id,
							'count'=>1,
							'location_id'=>1,
							'date'=>date('U'),
							'admin_id'=>$this->session->userdata('user_id'),
							));

					}
				}
				else{
					for($j=0;$j<$data['count'][$i];$j++){
						$equipment_id=$this->Equipment_model->create_equipment(array(
						'model_id'=>$data['model_id'][$i],
						'count'=>1,
						'serial'=>$data['serail'][$i][$j],
						'provisioner_id'=>$data['provisioner_id'],
						'location_id'=>1,
						'cr_date'=>date('U'),
						'cr_user'=>$this->session->userdata('user_id'),
						));
						$this->Equipment_model->create_equipment_history(array(
						'equipment_id'=>$equipment_id,
						'count'=>1,
						'location_id'=>1,
						'date'=>date('U'),
						'admin_id'=>$this->session->userdata('user_id'),
						));

					}

				}
				
			}
			$this->session->set_flashdata('success','Оборудование добавлено на склад');
			redirect(base_url('equipment/equipment_pres'));

		}
		else{
			$data['equipment_type']=$this->Equipment_model->get_equipment_type(array('active'=>1));
			$data['equipment_provisioner']=$this->Equipment_model->get_equipment_provisioner(array('active'=>1));
			$this->_view('equipment/equipment_create',$data);
		}
	}

	function get_serial(){
		$data=$this->input->post();

		$equipment=$this->Equipment_model->get_equipment(array(
			'e.model_id'=>$data['model_id'],
			'e.location_id'=>$data['location_id']
			));

		echo json_encode($equipment);
	}
	public function get_model($type_id){
		$models=$this->Equipment_model->get_equipment_model(array('em.active'=>1,'em.type_id'=>$type_id));
		echo json_encode($models);
	}

	public function unit(){
		$data['unit']=$this->Equipment_model->get_unit(array('active'=>1));
		$this->_view('equipment/unit',$data);
	}

	public function unit_create(){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->create_unit($data);
			$this->session->set_flashdata('success','Единица измерения добавленя');
			redirect(base_url('equipment/unit'));
		}
		else{
			$this->_view('equipment/unit_create');
		}
	}
	public function unit_edit($id=false){
		$data=$this->input->post();
		if($data){
			$this->Equipment_model->change_unit($data,array('id'=>$data['id']));
			$this->session->set_flashdata('success','Единица измерения редактирована');
			redirect(base_url('equipment/unit'));
		}
		else{
			$data['unit']=$this->Equipment_model->get_unit(array('id'=>$id),true);
			$this->_view('equipment/unit_edit',$data);

		}
	}
	public function unit_delete($id){
		$this->Equipment_model->change_unit(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Единица измерения удалена');
		redirect(base_url('equipment/unit'));

	}
	public function test(){
		$eq=$this->Equipment_model->get_equipment_history(array());
		echo "<pre>";
		print_r($eq);
		echo "</pre>";

	}

}