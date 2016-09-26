<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Budget_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function create_budget($array){
		$this->db->insert('budget',$array);
        return $this->db->insert_id();
	}
 
	public function get_budget($array,$one=false){
        $query = $this->db->get_where('budget', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->type = $this->db->get_where('budget_types',array('id'=>$row->type_id))->row_array()['title'];
                    $in = $this->db->get_where('users',array('id'=>$row->user_in))->row_array();
                    $out = $this->db->get_where('users',array('id'=>$row->user_out))->row_array();
                    $data[$row->id]->out =$out['name'];
                    $data[$row->id]->in=$in['name'];
                    $data[$row->id]->out_role =$out['role'];
                    $data[$row->id]->in_role=$in['role'];
                    $data[$row->id]->user = $this->db->get_where('users',array('id'=>$row->user_id))->row_array()['name'];
                   
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    

    public function delete_budget($array){
        return $this->db->delete('buget', $array);
    }

    public function change_budget($array,$id){
        return $this->db->update('budget', $array, $id);
    }


    public function create_budget_change($array){
        $this->db->insert('budget_change',$array);
        return $this->db->insert_id();
    }
 
    public function get_budget_change($array,$one=false){
        $query = $this->db->get_where('budget_change', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->type = $this->db->get_where('budget_types',array('id'=>$row->type_id))->row_array()['title'];
                    $data[$row->id]->in = $this->db->get_where('users',array('id'=>$row->user_in))->row_array()['name'];
                    $data[$row->id]->out = $this->db->get_where('users',array('id'=>$row->user_out))->row_array()['name'];
                    $data[$row->id]->user = $this->db->get_where('users',array('id'=>$row->user_id))->row_array()['name'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }


    public function create_user_fine($array){
        $this->db->insert('user_fines',$array);
        return $this->db->insert_id();
    }
 
    public function get_user_fine($array,$one=false){
        $query = $this->db->get_where('user_fines', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->user = $this->db->get_where('users',array('id'=>$row->user_id))->row_array()['name'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_fine($array,$one=false){
        $this->db->order_by('date', 'desc')->select('f.id,f.sum,f.user_id,f.comment,f.type,f.user_adm_id,f.date,
            u.name as user,ua.name as admin');
        $this->db->from('user_fines f');
        $this->db->join('users u', 'u.id = f.user_id','left');
        $this->db->join('users ua', 'ua.id = f.user_adm_id','left');
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

    public function delete_user_fine($array){
        return $this->db->delete('user_fines', $array);
    }

    public function change_user_fine($array,$id){
        return $this->db->update('user_fines', $array, $id);
    }
    public function get_pay_res($user_id,$start,$end){
        $query=$this->db->query("SELECT sum(sum_out) as result FROM `budget` 
            WHERE active=1 and user_in=$user_id and type_id=5
            and date between $start and $end" );
        if($query->row()->result!=NULL){
            return $query->row()->result;
        }
        else{
            return 0;
        }
    }
}