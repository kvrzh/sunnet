<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Test extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(array('User_model','Test_model','Social_model','Budget_model'));


	}
	
	function work(){
		echo "Test";
	}
	function index(){
		redirect('base/branch');
	}
	function branch(){
		$data['branch']=$this->Test_model->branch(array('active'=>1));
		$this->_view('test/branch',$data);
	}
	function branch_create(){
		$data=$this->input->post();
		if($data){
			$this->Test_model->branch_create($data);
			$this->session->set_flashdata('success','Отдел создан');
			redirect(base_url('test/branch'));
		}
		else{
			$this->_view('test/branch_create');
		}
	}
	function branch_update($id=false){
		$data=$this->input->post();
		if($data){
			$this->Test_model->branch_update($data,array('id'=>$data['id']));
			$this->session->set_flashdata('succes','Отдел обновлен');
			redirect(base_url('test/branch'));
		}
		else{
			$data['branch']=$this->Test_model->branch(array('id'=>$id),true);
			$this->_view('test/branch_update',$data);
		}
	}
	function branch_remove($id){
		$this->Test_model->branch_update(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Отдел удален');
		redirect(base_url('test/branch'));
	}
	function theme($id){
		$data['branch']=$this->Test_model->branch(array('id'=>$id),true);
		$data['theme']=$this->Test_model->theme(array('t.active'=>1,'t.branch_id'=>$id));
		$this->_view('test/theme',$data);
	}
	function theme_create($id){
		$data=$this->input->post();
		if($data){
			$this->Test_model->theme_create($data);
			$this->session->set_flashdata('success','Тема создана');
			redirect(base_url('test/theme/'.$data['branch_id']));
		}
		else{
			$data['branch']=$this->Test_model->branch(array('id'=>$id),true);
			$this->_view('test/theme_create',$data);
		}
	}
	function theme_update($id=false){
		$data=$this->input->post();
		if($data){
			$this->Test_model->theme_update($data,array('id'=>$data['id']));
			$this->session->set_flashdata('succes','Тема обновлена');
			redirect(base_url('test/theme/'.$data['branch_id']));
		}
		else{
			$data['theme']=$this->Test_model->theme(array('t.id'=>$id),true);
			$data['branch']=$this->Test_model->branch(array('id'=>$data['theme']->branch_id),true);
			$this->_view('test/theme_update',$data);
		}
	}
	function theme_remove($id){
		$data['theme']=$this->Test_model->theme(array('t.id'=>$id),true);
		$this->Test_model->theme_update(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Тема удалена');
		redirect(base_url('test/theme/'.$data['theme']->branch_id));
	}


	function question($id){
		$data['theme']=$this->Test_model->theme(array('t.id'=>$id),true);
		$data['question']=$this->Test_model->question(array('theme_id'=>$id,'active'=>1));
		$this->_view('test/question',$data);
	}
	function question_create($id){
		$data=$this->input->post();
		$error=array();
		if($data){
			$quesetion_data=array(
				'date'=>date('U'),
				'theme_id'=>$data['theme_id'],
				'text'=>$data['text'],
				'comment'=>$data['comment'],
				'right'=>$data['right'],
				'priority'=>$data['priority'],
				'ans1'=>$data['ans1'],
				'ans2'=>$data['ans2'],
				'ans3'=>$data['ans3'],
				'ans4'=>$data['ans4'],

				);
  			$config = array(
	                'upload_path' => './uploads/question',
	                'allowed_types' => 'gif|jpg|jpeg|png|bmp',
	                'max_size' => '2048'
	            );
	        $this->load->library('upload', $config);
	        if($_FILES['file']['error'] != 4){   
	            $this->upload->do_upload('file');
	            $file = $this->upload->data();
    			$quesetion_data['photo']='/uploads/question/'.$file['file_name'];
	            $error=$this->upload->display_errors();
	        }
	        if($error){
	            $this->session->set_flashdata('danger',$error);
	            redirect(base_url('test/question_create/'.$data['theme_id']));
	        }
	       	else{
	       		$question_id=$this->Test_model->question_create($quesetion_data);
				$this->session->set_flashdata('succes','Вопрос создан');
				redirect(base_url('test/question/'.$data['theme_id']));
	        }
	        

		}
		else{
			$data['theme']=$this->Test_model->theme(array('t.id'=>$id),true);
			$this->_view('test/question_create',$data);
		}
	}
	function question_update($id){
		$data=$this->input->post();
		$error=array();
		if($data){
			$quesetion_data=array(
				'date'=>date('U'),
				'theme_id'=>$data['theme_id'],
				'text'=>$data['text'],
				'comment'=>$data['comment'],
				'right'=>$data['right'],
				'priority'=>$data['priority'],
				'ans1'=>$data['ans1'],
				'ans2'=>$data['ans2'],
				'ans3'=>$data['ans3'],
				'ans4'=>$data['ans4'],

				);
  			$config = array(
	                'upload_path' => './uploads/question',
	                'allowed_types' => 'gif|jpg|jpeg|png|bmp',
	                'max_size' => '2048'
	            );
	        $this->load->library('upload', $config);
	        if($_FILES['file']['error'] != 4){   
	            $this->upload->do_upload('file');
	            $file = $this->upload->data();
    			$quesetion_data['photo']='/uploads/question/'.$file['file_name'];
	            $error=$this->upload->display_errors();
	        }
	        if($error){
	            $this->session->set_flashdata('danger',$error);
	            redirect(base_url('test/question_create/'.$data['theme_id']));
	        }
	       	else{
	       		$question_id=$this->Test_model->question_update($quesetion_data,array('id'=>$data['id']));
				$this->session->set_flashdata('succes','Вопрос создан');
				redirect(base_url('test/question/'.$data['theme_id']));
	        }
	        

		}
		else{
			$data['question']=$this->Test_model->question(array('id'=>$id),true);
			$data['theme']=$this->Test_model->theme(array('t.id'=>$data['question']->theme_id),true);
			$this->_view('test/question_update',$data);
		}
	}
	function question_remove($id){
		$data['question']=$this->Test_model->question(array('id'=>$id),true);
		$this->Test_model->question_update(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Вопрос удален');
		redirect(base_url('test/question/'.$data['question']->theme_id));
	}
	function block(){
		$data=$this->input->post();
		if($data){
			foreach ($data['user'] as $user) {

				$mont=5184000;
				$question_array=array();
				$question_number=0;
				foreach ($data['theme'] as $theme_key => $theme_value) {
					$test=$this->Test_model->question_in(array('q.active'=>1,'t.branch_id'=>$theme_key),$theme_value);
					$new_key=0;
					$new_test=array();
					foreach ($test  as $t) {
						$priority=date('U')<($t->date+$mont) ?($t->priority+5):$t->priority;
						for($i=0;$i<$priority;$i++){
							$new_test[$new_key]=$t;
							$new_key++;
						}
					}
					$task=$this->Test_model->question_task_in(array('tt.user_id'=>$user),$theme_value);
					$question_count=$data['question_count'][$theme_key];
					$co=0;
					if($task){
						foreach ($task as $key => $value) {
							if($question_count==0){
								break;
							}
							array_push($question_array,$value);
							$question_count--;

						}
					}
					$j=0;
					while($j<$question_count){
						$rand=rand(0, count($new_test) - 1);
						if(!in_array($new_test[$rand]->id, $question_array)){
							array_push($question_array,$new_test[$rand]->id);
							$j++;
							$question_number++;
						}
						else{
							continue;
						}

					}
					
				}
				$task=$this->Test_model->task_create(array(
					'user_id'=>$user,
					'date'=>date('U'),
					'status_finish'=>0
					));
				if($question_array){
					$pos=1;
					foreach ($question_array as $question) {
						$this->Test_model->task_question_create(array(
							'task_id'=>$task,
							'question_id'=>$question,
							'pos'=>$pos
							));
						$pos++;
					}
				}

			}
		$this->session->set_flashdata('success','Тест создан');
		redirect(base_url('test/result'));


		}
		else{
			$data['user']=$this->User_model->get_user(array('role!='=>5,'active'=>1));
			$data['branch']=$this->Test_model->branch(array('active'=>1));
			foreach ($data['branch'] as $key => $value) {
				$data['branch'][$value->id]->theme=$this->Test_model->theme(array('t.active'=>1,'q.active'=>1,'t.branch_id'=>$value->id));
			}
			$this->_view('test/block',$data);

		}
	}
	function start(){
		$data=$this->input->post();
		if($data){

		}
		else{
			$data['task']=$this->Test_model->task(array('user_id'=>$this->session->userdata('user_id'),'t.status_finish'=>0),true);
			if($data['task']){

				//$data['start']=$data['task']->start;
				$this->_view('test/start',$data);
			}
			else{
				redirect(base_url('test/show'));
			}


		}
	}


	function start_question(){
		$data=$this->input->post();
		if($data){
			$task=$this->Test_model->task(array('t.id'=>$data['task_id']),true);
			$start=$task->start+1200;
			$data['question']=$this->Test_model->task_question(array('tq.task_id'=>$data['task_id'],'tq.status_finish'=>0),true);
			if($start<date('U') || !$data['question']){
				
				$this->Test_model->task_question_update(
					array('status_finish'=>1),
					array('task_id'=>$data['task_id'])
					);
				$finish=$start<date('U')?$start:date('U');
				$wrong_res=count($this->Test_model->task_question(array('tq.task_id'=>$data['task_id'],'tq.right'=>0)));
				$this->Test_model->task_update(
					array('finish'=>$finish,'status_finish'=>1,'wrong'=>$wrong_res),
					array('id'=>$data['task_id']));
				if($wrong_res==0){
						$this->Budget_model->create_user_fine(array(
						'user_id'=>$this->session->userdata('user_id'),
						'sum'=>100,
						'date'=>date('U'),
						'type'=>1,
						'user_adm_id'=>1,
						'comment'=>'Премия за тестирования'
					));
					$subject="Премия";
					$text ='Вам начислен премия за тестирование в размере 100 грн';
					$this->Social_model->create_message(array(
						'sender_id'=>1,
						'recipient_id'=>$this->session->userdata('user_id'),
						'subject'=>$subject,
						'text'=>$text,
						'date'=>date('U')));
				}
				if($wrong_res>3){
					$fine=($wrong_res-2)*50;
						$this->Budget_model->create_user_fine(array(
						'user_id'=>$this->session->userdata('user_id'),
						'sum'=>$fine,
						'date'=>date('U'),
						'type'=>2,
						'user_adm_id'=>1,
						'comment'=>'Штраф за тестирования'
					));
					$subject="Штраф";
					$text ='Вам начислен премия за тестирование в размере '.$fine.' грн';
					$text.="<p>Вы сделали ".$wrong_res." ошибок.</p>";
					$this->Social_model->create_message(array(
						'sender_id'=>1,
						'recipient_id'=>$this->session->userdata('user_id'),
						'subject'=>$subject,
						'text'=>$text,
						'date'=>date('U')));
				}

			}


			if($data['question']){
				$this->load->view('test/start_question',$data);
			}
			else{
				$data['question_result']=$this->Test_model->task_question(array('tq.task_id'=>$data['task_id']));
				$data['right']=0;
				$data['wrong']=0;
				foreach ($data['question_result'] as $key => $value) {
					if($value->right==1){
						$data['right']++;
					}
					else{
						$data['wrong']++;
					}
				}

				$this->load->view('test/start_question_result',$data);
			}
		}


	}
	function start_test(){
		$data=$this->input->post();
		if($data){
			$this->Test_model->task_update(
				array('start'=>date('U')),
				array('id'=>$data['task_id'])
				);
		}
	}
	function start_answer(){
		$data=$this->input->post();
		if($data){
			$this->Test_model->task_question_update(
				array('right'=>$data['right'],'status_finish'=>1,'answer'=>$data['answer']),
				array('id'=>$data['id'])
				);
		}
	}

	function result(){
		$data['task']=$this->Test_model->task(array());
		$this->_view('test/result',$data);
	}
	function detail($id){
		$data['task']=$this->Test_model->task(array('t.id'=>$id),true);
		$data['question_result']=$this->Test_model->task_question(array('tq.task_id'=>$id));
		$this->_view('test/detail',$data);


	}

	function show(){
		$task=$this->Test_model->task(array('user_id'=>$this->session->userdata('user_id'),'t.status_finish'=>0),true);
		if($task){
			$this->session->set_flashdata('danger','Вам назначен тест');
			redirect(base_url('test/strart'));
		}
		else{
			$data['branch']=$this->Test_model->branch(array('active'=>1));
			$this->_view('test/show',$data);
		}

	}
	function show_table(){
		$data=$this->input->post();
		$upload_data=array('t.active'=>1);
		$upload_data=$data['branch_id']?array_merge($upload_data,array('t.branch_id'=>$data['branch_id'])):$upload_data;
		$data['theme']=$this->Test_model->theme($upload_data);
		$this->load->view('test/show_table',$data);
	}
	function show_theme($id){
		$task=$this->Test_model->task(array('user_id'=>$this->session->userdata('user_id'),'t.status_finish'=>0),true);
		if($task){
			$this->session->set_flashdata('danger','Вам назначен тест');
			redirect(base_url('test/strart'));
		}
		else{
			$data['theme']=$this->Test_model->theme(array('t.id'=>$id),true);
			$data['question']=$this->Test_model->question(array('theme_id'=>$id,'active'=>1));
			$this->_view('test/show_theme',$data);
		}  
	}
	function show_question($id){
		$data['qeustion']=$this->Test_model->question(array('id'=>$id),true);
		$data['theme']=$this->Test_model->theme(array('t.id'=>$data['question']->theme_id),true);
		$this->_view('test/show/question_data',$data);
	}


	function test(){

		$res=rand(1,4);
		echo $res;
	}


}
