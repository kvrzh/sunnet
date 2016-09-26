<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Storage extends MY_Controller{
	function __construct(){
		parent::__construct();
				$this->check_user();
		$this->load->model(array('Storage_model','User_model'));

	}

	public function index(){
		$data['users']=$this->User_model->get_user(array());

		$this->_view('storage/main',$data);

	}
	public function show_table($id){
		$data['user']=$this->User_model->get_user(array('id'=>$id),true);
		$data['gds_all']=$this->Storage_model->get_gds(array('active'=>1));
		$data['gds']=$this->Storage_model->get_gds_stock($id);
		$data['role']=$this->User_model->get_role($data['user']->role);
		$data['user_all']=$this->User_model->get_user(array('active'=>1,'id!='=>$id));
		$this->load->view('storage/show_table',$data);

	}
	public function update_stock(){
		$data=$this->input->post();
		$this->Storage_model->update_gds_stock($data);
		$this->session->set_flashdata('success','Действие выполнено успешно');
		

	}
	public function get_count(){
		$data=$this->input->post();
		$count=$this->Storage_model->get_gds_stock_full($data,true);

		echo json_encode($count->count);
		exit();
	
	}
	public function test_stock(){
		$data=array(
		    'count' => 3,
		    'gds_id' => 1,
		    'user_from' => 1,
		    'user_to' => 2,
		    'user_id' => 1,
		    'move_type' => 3,
		    'date_move' => 1449829360,
		    'comment'=>"Просто перенес"
			);
		$this->Storage_model->update_gds_stock($data);
	}


	public function delete_stock(){
		$data=$this->input->post();

		echo "<pre>";
		print_r($data);
		echo "</pre>";

	}


	public function goods(){
		$data['goods']=$this->Storage_model->get_gds(array('active'=>1));
		$this->_view('storage/goods',$data);
	}
	public function goods_create(){
		$data['units']=$this->Storage_model->get_gds_unit(array());
		$this->_view('storage/goods_create',$data);
	}
	public function goods_edit($id){
		$data['units']=$this->Storage_model->get_gds_unit(array());
		$data['goods']=$this->Storage_model->get_gds(array('id'=>$id),true);
		$this->_view('storage/goods_edit',$data);
	}
	public function goods_edit_action(){
		$data=$this->input->post();
		$this->Storage_model->change_gds($data,array('id'=>$data['id']));
		$this->session->set_flashdata('success','Инвентарь изминен');
		redirect(base_url('storage/goods'));
	}
	public function goods_delete_action($id){
		$this->Storage_model->change_gds(array('active'=>0),array('id'=>$id));
		$this->session->set_flashdata('success','Инвентарь удален');
		redirect(base_url('storage/goods'));

	}
	public function goods_create_action(){
		$data=$this->input->post();
		$this->Storage_model->create_gds($data);
		$this->session->set_flashdata('success','Инвентарь создан');
		redirect(base_url('storage/goods'));
	}

	public function move(){
		$data['goods']=$this->Storage_model->get_gds(array());
		$this->_view('storage/move',$data);
	}
		




}