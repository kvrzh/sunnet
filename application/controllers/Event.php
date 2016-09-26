<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event extends MY_Controller{
	function __construct(){
		parent::__construct();
				$this->check_user();

	}

	public function index(){
		$this->check_user();
		$events=$this->Event_model->get_event(array('user_id'=>$this->session->userdata('user_id')));
		if($events){
			redirect(base_url('event/all'));
		}
		else{
			redirect(base_url('event/create'));
		}

		$this->event_view('event/userpage');
	}
	public function main(){
		$this->check_user();
		$this->event_view('event/userpage');
	}
	public function create(){
		$this->check_user();
		$data['event_types']=$this->Event_model->get_event_type(array());
		$data['country']=$this->Event_model->default_country(long_ip($_SERVER['REMOTE_ADDR']));
		$data['cities']=$this->Event_model->get_city(array('iso'=>$data['country']->iso));
		$this->event_view('event/create',$data);
	}
	public function all(){
		$this->check_user();
		$data['events']=$this->Event_model->event($this->session->userdata('user_id'));
		$this->event_view('event/all',$data);
	}


	public function show($id=false){
		$this->check_user();
		$data['event']=$this->Event_model->event($this->session->userdata('user_id'),$id);
		if($data['event']){
			$data['dates']=$this->Event_model->get_event_date(array('event_id'=>$id));
			$this->event_view('event/show',$data); 

		}
		else{
			show_404();
		}

	}


	public function change($id=false){
		$this->check_user();
		$data['event']=$this->Event_model->event($this->session->userdata('user_id'),$id);
		if($data['event']->status_id==0 || $data['event']->status_id==1  || $data['event']->status_id==4){
			$data['dates']=$this->Event_model->get_event_date(array('event_id'=>$id));
				$data['event_types']=$this->Event_model->get_event_type(array());
				$data['country']=$this->Event_model->default_country(long_ip($_SERVER['REMOTE_ADDR']));
				$data['cities']=$this->Event_model->get_city(array('iso'=>$data['country']->iso));
			$this->event_view('event/change',$data); 

		}
		else{
			show_404();
		}

	}

	public function action($action){
		$this->check_user();
		$data=$this->input->post();
		switch ($action) {
			case 'create':
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
																	'description'=>substr($data['description'], 0,400),
																	'date_registrated'=>date('U'),
																	'date_start'=>strtotime($data['date_start'][0]),
																	'date_end'=>strtotime($data['date_end'][count($data['date_end'])-1]),
																	'img'=>$img
																	));

					for($i=0;$i<count($data['date_start']);$i++){
						$this->Event_model->create_event_date(array(
																	'event_id'=>$event_id,
																	'date_start'=>strtotime($data['date_start'][$i]),
																	'date_end'=>strtotime($data['date_end'][$i]),
																	));
						}
					$this->session->set_flashdata('success', lang('reg_msg'));
					redirect(base_url('event/show/'.$event_id));				
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
				case 'all':
					$this->session->set_flashdata('success',lang('success'));
					redirect(base_url('event/all'));
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
																	'status_id'=>0,
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
					$this->session->set_flashdata('success', lang('reg_msg'));
					redirect(base_url('event/show/'.$data['event_id']));
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
	               	redirect(base_url('/event/change/'.$data['event_id']));
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
																	'status_id'=>0,
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
					$this->session->set_flashdata('success', lang('reg_msg'));
					redirect(base_url('event/show/'.$data['event_id']));				
	            	}

		       }


					break;
			
			default:
				return false;
				break;
		}
	}
	function post(){

		$events=$this->Event_model->get_event(array('status_id'=>2));
		$str=$this->postArray($events);
		$time=array(0,1,7,2);
		foreach ($str as $key => $value) {
			if(in_array($value['time'], $time)){
				 $this->facebook($value);

				 $res=$this->twitter($value);

			}
		}
	}
	function postArray($events){
			$events=$this->Event_model->get_event(array('status_id'=>2));
		foreach ($events as $key => $value) {
			if($value->date_end<date('U')){
				$user=$this->User_model->get_user(array('id'=>$value->user_id),true);
				$this->Event_model->change_event(array('status_id'=>4),array('id'=>$value->id));
				$subject    =   "$value->title Finished";
				$data['name']=$user->name;
				$data['title']=$value->title;
				$data['link']=base_url('/event/change/'.$value->id);
 				$message = $this->load->view('mail/event', $data,true);
			   	$email=$user->email;
		        $this->email->from(EMAIL_A,EMAIL_N);
		        $this->email->to($email); 

		        $this->email->subject($subject);
		        $this->email->message($message);  

		        $this->email->send();

	    	}
	    	else{
				$str[$value->id]['title']=$value->title;
				//$str[$key]['link']=base_url('main/show/'.$value->id);
				$str[$value->id]['link']='http://groningem.leton.biz/event.php?id='.$value->id;
				$str[$value->id]['description']=$value->description;
				$str[$value->id]['img']=base_url($value->img);
				$str[$value->id]['date_start']=dt_day($value->date_start);
				$str[$value->id]['date_end']=$value->date_end;
				$str[$value->id]['time']=round(($value->date_start-date('U'))/SEC,0 );
	    	}

		}
		return $str;
	}
	function twitter($arr){
	require_once APPPATH . '/libraries/MY_Upload.php';

    \Codebird\Codebird::setConsumerKey($this->config->item('tw_consumer'),$this->config->item('tw_consumer_secret')); // static, see 'Using multiple Codebird instances'
    $cb = \Codebird\Codebird::getInstance();
    $cb->setToken($this->config->item('tw_token'),$this->config->item('tw_token_secret'));

  

    $params = array(
        'status' =>  $arr['date_start']." ".$arr['title']." ".$arr['link'],
        'media[]' => $arr['img']
    );
    return $reply = $cb->statuses_updateWithMedia($params);
	
	}


    function facebook($arr){
    $page_access_token = $this->config->item('fb_page_access_token');
    $page_id = $this->config->item('fb_page_id');


    $data['link']=$arr['link'];
    $data['message'] = $arr['title'];
    $data['description'] = $arr['description'];
    $data['caption'] = $arr['date_start'];
    $data['access_token'] = $page_access_token;
    $data['picture'] = $arr['img'];

    $post_url = 'https://graph.facebook.com/'.$page_id.'/feed';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $post_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $return = curl_exec($ch);
    curl_close($ch);
    
    echo $return;
    }
    function test(){
    	echo "<pre>";
    	print_r(prep_url());
    	echo "</pre>";

    }



}