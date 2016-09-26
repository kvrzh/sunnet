<?php
class MY_Controller extends CI_Controller{

    function __construct()
    {
        parent::__construct();
        $this->check_perm();
        $this->load->model(array('Option_model','User_model','Budget_model','Social_model','Admin_task_model','Test_model'));

    }


	function _view($page, $variables = array()){
		$data['close']=$this->session->userdata('menu_status');
		$variables['menu']=$this->menu();
		$this->load->view('templates/header',$data);
		$this->load->view('templates/all_user',$variables);
		$this->load->view('templates/footer');
		$this->load->view($page, $variables);
		$this->load->view('templates/foot');
		
	}
	
	function check_message(){
			$this->load->model(array('Social_model'));
			$message=$this->Social_model->get_message(array('recipient_id'=>$this->session->userdata('user_id'),'read'=>0));
			$count_m=$message?count($message):0;
			return $count_m;
		
	}

	function check_user(){
		if($this->session->userdata('is_logged_in')){
			return true;
		}
		else{
			$this->session->set_flashdata('success','Введите логин и пароль');
			redirect(base_url('user'));
		}
	}
	function check_right($person=false){
		if($this->session->userdata('is_logged_in')){
			if($person){
				$person=is_array($person)?$person:array($person);
				if(in_array($this->session->userdata('user_right'),$person)){
					return true;
				}
				else{
					redirect(base_url());
				}
			}

		}
		else{
			$this->session->set_flashdata('success','Введите логин и пароль');
			redirect(base_url('user'));
		}
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
	function total_sheet($user_id){
		$data['day']=$this->day_sheet($user_id);
		if($data['day']){
		$total=0;
		foreach ($data['day'] as $key => $value) {
			$mon=dt_mon($key);
			if(empty($data['mon'][$mon]['salary'])){
				$data['mon'][$mon]['salary']=$value['koef']+$value['hour'];
				$data['mon'][$mon]['koef']=$value['koef'];
				$data['mon'][$mon]['hour']=$value['hour'];
				$begin=strtotime($mon);
				$end=last_day($mon);
				$data['mon'][$mon]['fine']=$this->User_model->get_fine_res($user_id,$begin,$end,1);
				$data['mon'][$mon]['damage']=$this->User_model->get_fine_res($user_id,$begin,$end,2);
				$data['mon'][$mon]['pay']=$this->Budget_model->get_pay_res($user_id,$begin,$end);
				$rest=$total;
			}else{
				$data['mon'][$mon]['salary']+=$value['koef']+$value['hour'];
				$data['mon'][$mon]['koef']+=$value['koef'];
				$data['mon'][$mon]['hour']+=$value['hour'];
			}
			$total=$data['mon'][$mon]['salary']+$data['mon'][$mon]['fine']-$data['mon'][$mon]['damage']-$data['mon'][$mon]['pay'];
			$data['mon'][$mon]['total']=$total;
			$data['mon'][$mon]['rest']=$total+$rest;

			$data['salary']=$data['mon'][$mon]['salary'];
			$data['fine']=$data['mon'][$mon]['fine'];
			$data['damage']=$data['mon'][$mon]['damage'];

			$data['pay']=$data['mon'][$mon]['pay'];
			$data['total']=$data['mon'][$mon]['total'];
			$data['rest']=$data['mon'][$mon]['rest'];
			}
		}
		else{
			$data['salary']=0;
			$data['fine']=0;
			$data['damage']=0;

			$data['pay']=0;
			$data['total']=0;
			$data['rest']=0;

		}
		return $data;
	}
	public function day_sheet_show(){
		//$users=$this->User_model->get_user(array('active'=>1,'role!='=>5));
		$work=$this->User_model->get_worktime(array('end!='=>NULL));
		if($work){
			foreach ($work as $key => $value) {
				$hour=round(($value->end-$value->start)/3600,2);
				$day=dt_day($value->start);
				$new_day=substr($day, 0,7).'-01';
				if(isset($data[$day][$value->user_id]['user_id'])){
					$data[$day][$value->user_id]['hour']+=$hour;
					$data[$day][$value->user_id]['time'].=default_time($value->start).' - '.default_time($value->end).'; ';
				}
				else{
					$data[$day][$value->user_id]['hour']=$hour;
					$data[$day][$value->user_id]['time']=default_time($value->start).' - '.default_time($value->end).'; ';
				}
				if(isset($data[$new_day][$value->user_id]['user_id'])){
					$data[$new_day][$value->user_id]['total_hour']+=$hour;
					
				
				}
				else{
					$data[$new_day][$value->user_id]['user_id']=$value->user_id;
					$data[$new_day][$value->user_id]['total_hour']=$hour;

				}
				$data[$day][$value->user_id]['user_id']=$value->user_id;
				$point[$day][$value->user_id]=1;
				
		}
		return $data;
		}
		else{
			return false;
		}
	}
	public function menu(){

		//$menu_user=$this->Option_model->get_menu_user(array('user_id'=>$this->session->userdata('user_id')));
		$menu_user=$this->Option_model->get_menu_user(array('user_id'=>$this->session->userdata('user_id')));
		if($menu_user){
			$menu=$this->Option_model->get_menu($menu_user);
		}



		$result='<ul class="sidebar-menu">';
		$task=$this->Test_model->task(array('user_id'=>$this->session->userdata('user_id'),'t.status_finish'=>0),true);
		if($task){
			$result.= ' <li ><a href="'.base_url('test/start').'"><i class="fa fa-question text-red">
			</i><span class="text-red">Пройдите тест</span></a></li>';
		}
		$result.='<li><a href="'.base_url("mounter/start/").'"><i class="fa fa-circle-o text-red"></i> <span>Рабочий день</span></a></li>';
		$result.=isset($menu)?$this->build_tree($menu,0):"";
		$count_m=$this->check_message();
		$count_t=$this->Admin_task_model->task_user_count($this->session->userdata('user_id'));
		if($count_m){
			$result.= ' <li><a href="'.base_url('social/in_message').'"><i class="fa fa-envelope">
			</i><span>Новые сообщение</span><small class="label pull-right bg-red">'.$count_m.'</small></a></li>';

		}
		if($count_t){
			$result.= ' <li><a href="'.base_url('admin_task/task').'"><i class="fa fa-tasks ">
			</i><span>Новые задачи</span><small class="label pull-right bg-red">'.$count_t.'</small></a></li>';

		}
		if(!$task){
			$result.= ' <li><a href="'.base_url('test/show').'"><i class="fa fa-question">
			</i><span>Тесты</span></a></li>';
		}
		$result.= '<li><a href="'.base_url("user/logout").'"><i class="fa fa-circle-o text-maroon"></i> <span>Выйти</span></a></li>';
		$result.='</ul>';

		return $result;

	}
	function build_tree($cats,$parent_id){
    if(is_array($cats) and isset($cats[$parent_id])){
        $tree = '';
            foreach($cats[$parent_id] as $cat){
            	if($cat->url=='0'){
            		if($cat->url){
               		$tree .= '<li><a href="'.base_url($cat->url).'"><i class="fa fa-circle-o text-'.$cat->color.'"></i><span>'.$cat->title;
                	$tree .= '</span></a></li>';
            		}
            		else{
	            		$tree.='<li class="treeview">
				          <a href="#">
				            <i class="fa fa-circle-o text-'.$cat->color.'"></i><span>'.$cat->title.'</span>
				            <i class="fa fa-angle-left pull-right"></i>
				          </a>
				            <ul class="treeview-menu" style="">';
			            $tree .=  $this->build_tree($cats,$cat->id);
			            $tree .= '</ul></li>';
		        	}

            	}
            	else{
               		$tree .= '<li><a href="'.base_url($cat->url).'"><i class="fa fa-circle-o text-'.$cat->color.'"></i><span>'.$cat->title;
                	//$tree .=  $this->build_tree($cats,$cat->id);
                	$tree .= '</span></a></li>';
            	}

            }
    }
    else return null;
    return $tree;
}
    function check_perm(){
    	$this->load->model(array('Option_model'));
        $url=$this->uri->segment(1);
        $url=$this->uri->segment(2)?$url.'/'.$this->uri->segment(2):$url;
        $url=$this->uri->segment(3)?$url.'/'.$this->uri->segment(3):$url;
		$menu_user=$this->Option_model->get_menu_user(array('user_id'=>$this->session->userdata('user_id')));
		$menu_user=$menu_user?$menu_user:array('0');
		$banned=$this->Option_model->get_menu_ban($menu_user);
        $ref=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:base_url('mounter/start');
        if($banned){
            if(in_array($url, $banned)){
                $this->session->set_flashdata('danger','Доступ запрещен');
                redirect($ref);

            }
        }
    }
	public function do_resize($path,$filename)
	{
	 
	    $source_path = $_SERVER['DOCUMENT_ROOT'] . $path . $filename;
	    $target_path = $_SERVER['DOCUMENT_ROOT'] . $path.'thumb/';
	    $config_manip = array(
	        'image_library' => 'gd2',
	        'source_image' => $source_path,
	        'new_image' => $target_path,
	        'maintain_ratio' => TRUE,
	        'create_thumb' => TRUE,
	        'thumb_marker' => '',
	        'width' => 150,
	        'height' => 150
	    );
	    $this->load->library('image_lib', $config_manip);
	    if (!$this->image_lib->resize()) {
	        echo $this->image_lib->display_errors();
	    }
	    // clear //
	    $this->image_lib->clear();
	    return $path.'thumb/'.$filename;
	}




	
} 