<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('Event_model','User_model'));
		$this->check_admin();

	}

	public function index(){
		$data['h1']=lang('new_event');
		$data['events']=$this->Event_model->event(false,false,true);
		$this->admin_view('admin/event/all',$data);
		
	}
	public function create(){
		$data['event_types']=$this->Event_model->get_event_type(array());
		$data['country']=$this->Event_model->default_country(long_ip($_SERVER['REMOTE_ADDR']));
		$data['cities']=$this->Event_model->get_city(array('iso'=>$data['country']->iso));
		$this->admin_view('admin/event/create',$data);
	}
	public function all(){
		$data['h1']= lang('all_event');
		$data['events']=$this->Event_model->event();
		$this->admin_view('admin/event/all',$data);
	}


	public function show($id=false){
		$data['event']=$this->Event_model->event(false,$id);
		if($data['event']){
			$data['dates']=$this->Event_model->get_event_date(array('event_id'=>$id));
			$this->admin_view('admin/event/show',$data); 

		}
		else{
			show_404();
		}

	}
	public function type(){
		$data['types']=$this->Event_model->get_event_type(array());
		$this->admin_view('admin/event/type',$data);
	}
	public function add_type($id){
		echo $id;
	}
	public function change($id=false){
		$data['event']=$this->Event_model->event(false,$id);
		if($data['event']){
			$data['dates']=$this->Event_model->get_event_date(array('event_id'=>$id));
				$data['event_types']=$this->Event_model->get_event_type(array());
				$data['country']=$this->Event_model->default_country(long_ip($_SERVER['REMOTE_ADDR']));
				$data['cities']=$this->Event_model->get_city(array('iso'=>$data['country']->iso));
			$this->admin_view('admin/event/change',$data); 

		}
		else{
			show_404();
		}

	}


	public function action($action){
		$data=$this->input->post();
		switch ($action) {
			case 'create':;
	            $img=uniqid();
            	$config['upload_path'] = './uploads';
            	$config['allowed_types'] = 'gif|jpg|png';
            	$config['max_size'] = '810';
            	$config['max_width']  = '2500';
            	$config['max_height']  = '1500';
            	$config['file_name']  = $img;
	            $this->load->library('upload', $config);

	            if (!$this->upload->do_upload()){
	                $error = array('error' => $this->upload->display_errors());
	                $this->session->set_flashdata('danger', $error['error']);
	                redirect(base_url('event/create'));
	            }
	            else{
	                
	                $data_arr = array('upload_data' => $this->upload->data());
	                $file_name=$data_arr[upload_data][file_name];
	                $img="uploads/$file_name";

					$event_id=$this->Event_model->create_event(array(
																	'user_id'=>$data['user_id'],
																	'title'=>$data['title'],
																	'location_id'=>$data['location_id'],
																	'type_id'=>$data['type_id'],
																	'postcode'=>$data['postcode'],
																	'adress'=>$data['adress'],
																	'status_id'=>2,
																	'date_start'=>strtotime($data['date_start'][0]),
																	'date_end'=>strtotime($data['date_end'][count($data['date_end'])-1]),
																	'description'=>substr($data['description'], 0,400),
																	'date_registrated'=>date('U'),
																	'img'=>$img
																	));

					for($i=0;$i<count($data['date_start']);$i++){
						$this->Event_model->create_event_date(array(
																	'event_id'=>$event_id,
																	'date_start'=>strtotime($data['date_start'][$i]),
																	'date_end'=>strtotime($data['date_end'][$i]),
																	));
						}
					$this->session->set_flashdata('success', lang('success'));
					redirect(base_url('admin/event/show/'.$event_id));
	            }

				break;
				case 'change':
			       if($_FILES['userfile']['error'] == 4){
						$event_id=$this->Event_model->change_event(array(
																	'user_id'=>$data['user_id'],
																	'title'=>$data['title'],
																	'location_id'=>$data['location_id'],
																	'type_id'=>$data['type_id'],
																	'postcode'=>$data['postcode'],
																	'adress'=>$data['adress'],
																	'description'=>substr($data['description'], 0,400),
																	'date_registrated'=>date('U'),
																	'date_start'=>strtotime($data['date_start'][0]),
																	'status_id'=>2,
																	'date_end'=>strtotime($data['date_end'][count($data['date_end'])-1]),
																	),array('id'=>$data['event_id']));
						$this->Event_model->delete_event_dates(array('event_id'=>$data['event_id']));

						for($i=0;$i<count($data['date_start']);$i++){
							$this->Event_model->create_event_date(array(
																	'event_id'=>$data['event_id'],
																	'date_start'=>strtotime($data['date_start'][$i]),
																	'date_end'=>strtotime($data['date_end'][$i]),
																	));
							}
					$this->session->set_flashdata('success', lang('success'));
					redirect(base_url('admin/event/show/'.$data['event_id']));
			       }
			       else{
			       	 $img=uniqid();
            		$config['upload_path'] = './uploads';
            		$config['allowed_types'] = 'gif|jpg|png';
            		$config['max_size'] = '810';
            		$config['max_width']  = '2500';
            		$config['max_height']  = '1500';
            		$config['file_name']  = $img;
	            	$this->load->library('upload', $config);

	            if (!$this->upload->do_upload()){
	                $error = array('error' => $this->upload->display_errors());
	                $this->session->set_flashdata('danger', $error['error']);
	                redirect(base_url('admin/event/change/'.$data['event_id']));
	            }
	            else{
	                $event=$this->Event_model->get_event(array('id'=>$data['event_id']),true);
	                if(file_exists($_SERVER['PWD']."/".$event->img)){
	                	unlink($_SERVER['PWD']."/".$event->img);
	                }
	                $data_arr = array('upload_data' => $this->upload->data());
	                $file_name=$data_arr[upload_data][file_name];
	                $img="uploads/$file_name";

					$event_id=$this->Event_model->change_event(array(
																	'user_id'=>$data['user_id'],
																	'title'=>$data['title'],
																	'location_id'=>$data['location_id'],
																	'type_id'=>$data['type_id'],
																	'postcode'=>$data['postcode'],
																	'adress'=>$data['adress'],
																	'description'=>substr($data['description'], 0,400),
																	'date_registrated'=>date('U'),
																	'date_start'=>strtotime($data['date_start'][0]),
																	'status_id'=>2,
																	'date_end'=>strtotime($data['date_end'][count($data['date_end'])-1]),
																	'img'=>$img
																	),array('id'=>$data['event_id']));
					$this->Event_model->delete_event_dates(array('event_id'=>$data['event_id']));

					for($i=0;$i<count($data['date_start']);$i++){
						$this->Event_model->create_event_date(array(
																	'event_id'=>$data['event_id'],
																	'date_start'=>strtotime($data['date_start'][$i]),
																	'date_end'=>strtotime($data['date_end'][$i]),
																	));
						}
					$this->session->set_flashdata('success', lang('success'));
					redirect(base_url('admin/event/show/'.$data['event_id']));				
	            	}

		       }


					break;
				case 'delete':
					$event=$this->Event_model->get_event(array('id'=>$data['event_id']),true);
					$img=$event->img;
					if(file_exists($_SERVER['PWD']."/".$img)){
						 unlink($_SERVER['PWD']."/".$img);
					}
					$this->Event_model->delete_event(array('id'=>$data['event_id']));
					$this->Event_model->delete_event_dates(array('event_id'=>$data['event_id']));
					break;
				case 'delete_msg':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/all'));
					break;
				case 'active_msg':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/all'));
					break;
				case 'active':
					$this->Event_model->change_event(array("status_id"=>2,'status'=>''),array('id'=>$data['event_id']));
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/all'));
				case 'no_active_msg':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/all'));
					break;
				case 'no_active':
					$this->Event_model->change_event(array("status_id"=>1,'status'=>$data['status']),array('id'=>$data['event_id']));
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/all'));
					break;
				case 'add_type':
					$this->Event_model->create_event_type(array('title'=>$data['title']));
					break;
				case 'add_type_msg':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/type'));
					break;
				case 'delete_type':
					$this->Event_model->delete_event_type(array('id'=>$data['id']));
					break;
				case 'delete_type_msg':
					$this->session->set_flashdata('success', lang('success'));
					redirect(base_url('admin/event/type'));
					break;
				case 'edit_type':
					$this->Event_model->change_event_type(array('title'=>$data['title']),array('id'=>$data['id']));
					break;
				case 'edit_type_msg':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('admin/event/type'));
					break;

			
			default:
				return false;
				break;
		}
	}

}