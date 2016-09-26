<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Social_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function create_message($array){
		$this->db->insert('message',$array);
        return $this->db->insert_id();
	}
 
	public function get_message($array,$one=false){
        $query = $this->db->get_where('message', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->sender =$this->db->get_where('users',array('id'=>$row->sender_id))->row_array()['name'];
                    $data[$row->id]->recipient =$this->db->get_where('users',array('id'=>$row->recipient_id))->row_array()['name'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

    public function delete_message($array){
        return $this->db->delete('message', $array);
    }

    public function delete_file($array){
        return $this->db->delete('message_files', $array);
    }

    public function change_message($array,$id){
        return $this->db->update('message', $array, $id);
    }


    public function create_message_file($array){
        $this->db->insert('message_files',$array);
        return $this->db->insert_id();
    }
 
    public function get_message_file($array,$one=false){
        $query = $this->db->get_where('message_files', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->sender =$this->db->get_where('users',array('id'=>$row->sender_id))->row_array()['name'];
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }



    public function create_phonebook($array){
        $this->db->insert('phonebook',$array);
        return $this->db->insert_id();
    }
 
    public function get_phonebook($array,$one=false){
        $query = $this->db->get_where('phonebook', $array);
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

    public function delete_phonebook($array){
        return $this->db->delete('phonebook', $array);
    }

    public function change_phonebook($array,$id){
        return $this->db->update('phonebook', $array, $id);
    }
    function count_dialog(){
        $query=$this->db->query("SELECT max(dialog) as max FROM `message` WHERE 1");
        $count= $query->row()->max;
        return $count+1;
    }
    
}