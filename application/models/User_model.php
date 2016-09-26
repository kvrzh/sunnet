<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model{
	 public function __construct(){
        parent::__construct();
    }

	public function create_user($array){
		$this->db->insert('users',$array);
         return $this->db->insert_id();

	}
	public function get_user($array,$one=false){
        $query = $this->db->order_by('role', 'ASC')->get_where('users', $array);
        if($query->num_rows()>0){
            if($one==true){
                $data= $query->row();
                $data->role_title = $this->db->get_where('user_roles',array('id'=>$query->row()->role))->row_array()['title'];
                return $data;

            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->role_title = $this->db->get_where('user_roles',array('id'=>$row->role))->row_array()['title'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
        public function get_user_sn($array,$one=false){
        $query = $this->db->order_by('name', 'ASC')->get_where('users', $array);
        if($query->num_rows()>0){
            if($one==true){
                $data= $query->row();
                $data->role_title = $this->db->get_where('user_roles',array('id'=>$query->row()->role))->row_array()['title'];
                return $data;

            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->role_title = $this->db->get_where('user_roles',array('id'=>$row->role))->row_array()['title'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_user_details($one=false){
        $query = $this->db->query("select *,u.id as user_id from users u left join user_roles r on u.role=r.id");
        if($query->num_rows()>0){
            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }

    }

    public function get_user_role($array,$one=false){
        $query = $this->db->get_where('user_roles', $array);
        if($query->num_rows()>0){
            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_role($id){
        $query = $this->db->get_where('user_roles',array('id'=>$id) );
        if($query->num_rows()>0){
                return $query->row()->title;
        }
    }

    public function delete_user($array){
        return $this->db->delete('users', $array);
    }

    public function change_user($array,$id){
        return $this->db->update('users', $array, $id);
    }

    public function login($username, $password){
        $this->db->select('*');
        $this->db->where('login', (string)$username);
        $this->db->where('password', (string)$password);
        $this->db->where('active', 1);
        $this->db->limit(1);
        $result = $this->db->get('users');
        $role=$this->db->get_where('user_roles',array('id'=>$result->row()->role));

        if($result->num_rows()){
            $session_data = array(
                'user_id'    =>  $result->row()->id,
                'user_name'    =>  $result->row()->name,
                'is_logged_in'  =>  true,
                'user_role'=>$result->row()->role,
                'user_right'=>$role->row()->slug,
            );
            $this->session->set_userdata($session_data);

            return true;
        }else{
            return false;
        }
    }
    function logout(){
        $session_data = array('user_id','user_role','user_name','is_logged_in' );
        $this->session->unset_userdata($session_data);
    }

    public function create_worktime($array){
        $this->db->insert('worktime',$array);
        return $this->db->insert_id();
    }
 
    public function get_worktime($array,$one=false){
        $query = $this->db->order_by('end','asc')->get_where('worktime', $array);
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
    public function get_worktime_u($array,$one=false){
        $query = $this->db->order_by('end','asc')->get_where('worktime', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                     $data[$row->id]->name = $this->db->get_where('users',array('id'=>$row->user_id))->row_array()['name'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

    public function delete_worktime($array){
        return $this->db->delete('worktime', $array);
    }

    public function change_worktime($array,$id){
        return $this->db->update('worktime', $array, $id);
    }
    public function is_work($id){
        $query=$this->db->query("select * from worktime where user_id=$id order by id desc limit 1");
        if($query->num_rows()>0){
            if($query->row()->end==NULL){
                return $query->row()->id;
            }
            else return false;
        }
        else return false;
    }
    public function get_fine_res($user_id,$start,$end,$type){
        $query=$this->db->query("SELECT sum(sum) as result FROM `user_fines` 
            WHERE active=1 and user_id=$user_id and type=$type 
            and date between $start and $end");
        if($query->row()->result!=NULL){
            return $query->row()->result;
        }
        else{
            return 0;
        }
    }



}