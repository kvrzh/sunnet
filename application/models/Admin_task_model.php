<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_task_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }


	public function create_task($array){
		$this->db->insert('admin_task',$array);
        return $this->db->insert_id();
	}
 
	public function get_task($array,$one=false,$in_array=false){
        $this->db->select('t.id,t.subject,t.comment,t.user_id,t.created,t.comment_admin,t.type_id,t.status_id,
        	t.admin_id,t.start,t.start_time,t.finish,t.urgency,t.sms,t.mount_paid,
        	ty.title as type,s.title as status,s.color as status_color, u.name as user,a.name as admin');
        $this->db->from('admin_task t');
        $this->db->join('admin_type ty', 't.type_id = ty.id','left');
        $this->db->join('admin_status s', 't.status_id = s.id','left');
        $this->db->join('users u', 't.user_id = u.id','left');
        $this->db->join('users a', 't.admin_id = a.id','left');
        $this->db->where($array);
        if($in_array){
            $this->db->where_in('t.type_id',$in_array);
        }
         $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function task_count(){
            $query = $this->db->query('SELECT COUNT( * ) AS count
                    FROM  `admin_task` 
                    WHERE active =1
                    AND status_id !=4');
     
        return $query->row()->count;

    }
    public function task_user_count($user_id){
            $query = $this->db->query("SELECT count(*) as count FROM `admin_task`
WHERE active=1 and 
type_id  in(select type_id from admin_consist where user_id=$user_id) and status_id!=4");
     
        return $query->row()->count;

    }


    public function change_task($array,$id){
        return $this->db->update('admin_task', $array, $id);
    }

    public function create_equipment_vendor($array){
        $this->db->insert('equipment_vendor',$array);
        return $this->db->insert_id();
    }
 
    public function get_equipment_vendor($array,$one=false){
        $query = $this->db->order_by('title', 'ASC')->get_where('equipment_vendor', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }


    public function change_equipment_vendor($array,$id){
        return $this->db->update('equipment_vendor', $array, $id);
    }

    public function get_equipment_use(){
        $query = $this->db->get_where('equipment_use',array());
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[$row->id] = $row->title;
            }
            return $data;
        }
        else{
            return false;
        }
    }
    public function get_equipment_unit(){
        $query = $this->db->get_where('equipment_unit',array('active'=>1));
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[$row->short] = $row->title;
            }
            return $data;
        }
        else{
            return false;
        }
    }

   

    public function create_task_history($array){
        $this->db->insert('admin_task_history',$array);
        return $this->db->insert_id();
    }
 
    public function get_task_history($array,$one=false){
        $this->db->select('t.id, t.date,t.comment_admin,s.title as status,s.color as status_color, a.name as admin');
        $this->db->from('admin_task_history t');
        $this->db->join('admin_status s', 't.status_id = s.id','left');
        $this->db->join('users a', 't.admin_id = a.id','left');
        $this->db->where($array);
         $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

}