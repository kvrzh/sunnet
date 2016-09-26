
<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social extends MY_Controller{
	function __construct(){
		parent::__construct();
		      $this->check_user();
		$this->load->model(array('Option_model','User_model','Social_model'));
	}


	function in_message(){
        $data['head']="Входящие сообщения";
        $data['message']=$this->Social_model->get_message(array(
            'recipient_id'=>$this->session->userdata('user_id')));
        $this->_view('social/message',$data);
    }
    function out_message(){
        $data['head']="Исходящие сообщения";
        $data['message']=$this->Social_model->get_message(array(
            'sender_id'=>$this->session->userdata('user_id')
            ));
        $this->_view('social/message',$data);
    }

    function message_create($id=false){
        $data['users']=$this->User_model->get_user(array('active'=>1,'id!='=>$this->session->userdata('user_id'),'role!='=>5));
        $data['roles']=$this->User_model->get_user_role(array('id!='=>5));

        if($id){
            $message=$this->Social_model->get_message(array(
                'id'=>$id),true);;
          $data['recipient_id']=$message->sender_id; 
          $data['recipient']=$this->User_model->get_user(array('id'=>$message->sender_id),true)->name;     
          $data['subject']=$message->subject;      
          $data['text']=$message->text;      
          $data['message_id']=$message->id;      
          $data['dialog']=$message->dialog==0?$this->Social_model->count_dialog():$message->dialog;      
        }
        else{
            $data['message_id']=0;
            $data['dialog']=0;
              $data['recipient_id']='';      
              $data['recipient']='';      
              $data['subject']='';      
              $data['text']='';   
      }

        $this->_view('social/message_create',$data);
    }

    function message_create_action(){
        $data=$this->input->post();

        if($data['message_id']!=0){
            $this->Social_model->change_message(array('dialog'=>$data['dialog']),array('id'=>$data['message_id']));
        }
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
        if($error){
            $this->session->set_flashdata('danger',$error);
            redirect(base_url('social/message_create'));
        }
        else{
            if(isset($data['recipient_id'])){
            foreach ($data['recipient_id'] as $key => $recipient) {
                $this->Social_model->create_message(array(
                'sender_id'=>$data['sender_id'],
                'recipient_id'=>$recipient,
                'subject'=>$data['subject'],
                'text'=>$data['text'],
                'date'=>date('U'),
                'dialog'=>$data['dialog']?$data['dialog']:0,
                 'file'=>isset($file)?$file['file_name']:'',
                ));
                }
            }
             if(isset($data['roles'])){
                    foreach ($data['roles'] as $key => $role) {
                        $users=$this->User_model->get_user(array('active'=>1,'role'=>$role));
                        foreach ($users as $key => $recipient) {
                            $this->Social_model->create_message(array(
                            'sender_id'=>$data['sender_id'],
                            'recipient_id'=>$key,
                            'subject'=>$data['subject'],
                            'text'=>$data['text'],
                            'date'=>date('U'),
                            'dialog'=>$data['dialog']?$data['dialog']:0,
                            'file'=>isset($file)?$file['file_name']:'',
                            ));
                            
                        }
                    }
                }
            if(isset($file) && $data['general']){
                $this->Social_model->create_message_file(array(
                    'file'=>$file['file_name'],
                    'subject'=>$data['subject'],
                    'sender_id'=>$data['sender_id'],
                    'date'=>date("U"),
                    ));
            }
            $this->session->set_flashdata('success','Сообщение отправлено');
            redirect(base_url('social/out_message'));
        }

    }

    function message_read($id){
        $data['message']=$this->Social_model->get_message(array(
            'id'=>$id),true);
        $this->Social_model->change_message(array('read'=>1),array('id'=>$id,'recipient_id'=>$this->session->userdata('user_id')));
        if($data['message']->dialog!=0){
            $data['dialog']=$this->Social_model->get_message(array('dialog'=>$data['message']->dialog));
        }
        $this->_view('social/message_read',$data);
    }
    function files(){
        $data['files']=$this->Social_model->get_message_file(array());
        $this->_view('social/files',$data);
    }

    public function phonebook(){
        $data['phonebook']=$this->Social_model->get_phonebook(array('active'=>1));
        $this->_view('social/phonebook',$data);

    }

    public function phonebook_edit($id){
        $data['phonebook']=$this->Social_model->get_phonebook(array('id'=>$id),true);
        $this->_view('social/phonebook_edit',$data);
    }
    public function phonebook_create(){
        $this->_view('social/phonebook_create');
    }
    public function phonebook_edit_action(){
        $data=$this->input->post();
        $this->Social_model->change_phonebook($data,array('id'=>$data['id']));
        $this->session->set_flashdata('success','Тариф редактирован');
        redirect(base_url('social/phonebook'));
    }
    public function phonebook_create_action(){
        $data=$this->input->post();
        $this->Social_model->create_phonebook($data);
        $this->session->set_flashdata('success','Тариф добавлен');
        redirect(base_url('social/phonebook'));
    }
    public function phonebook_delete_action($id){
        $data=$this->input->post();
        $this->Social_model->change_phonebook(array('active'=>0),array('id'=>$id));
        $this->session->set_flashdata('success','Тариф удален');
        redirect(base_url('social/phonebook'));
    }
    public function delete_file($id){
        if($this->session->userdata('user_id')){
            $this->Social_model->delete_file(array('id'=>$id));
            $this->session->set_flashdata('success','Файл удален');
            redirect(base_url('social/files'));
        }
   
    }

		
}
