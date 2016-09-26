<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Option_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function create_action($array){
		$this->db->insert('actions',$array);
        return $this->db->insert_id();
	}
 
	public function get_action($array,$one=false){
        $query = $this->db->get_where('actions', $array);
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

    public function delete_action($array){
        return $this->db->delete('actions', $array);
    }

    public function change_action($array,$id){
        return $this->db->update('actions', $array, $id);
    }
        public function create_rate($array){
        $this->db->insert('rates',$array);
        return $this->db->insert_id();
    }
 
    public function get_rate($array,$one=false){
        $query = $this->db->get_where('rates', $array);
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

    public function delete_rate($array){
        return $this->db->delete('rates', $array);
    }

    public function change_rate($array,$id){
        return $this->db->update('rates', $array, $id);
    }


    public function create_area($array){
        $this->db->insert('areas',$array);
        return $this->db->insert_id();
    }
 
    public function get_area($array,$one=false){
        $query = $this->db->get_where('areas', $array);
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

    public function delete_area($array){
        return $this->db->delete('areas', $array);
    }

    public function change_area($array,$id){
        return $this->db->update('areas', $array, $id);
    }



    public function create_street($array){
        $this->db->insert('streets',$array);
        return $this->db->insert_id();
    }
 
    public function get_street($array,$one=false){
        $query = $this->db->get_where('streets', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->area = $this->db->get_where('areas',array('id'=>$row->area_id))->row()->title;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

    public function delete_street($array){
        return $this->db->delete('streets', $array);
    }

    public function change_street($array,$id){
        return $this->db->update('streets', $array, $id);
    }



    public function create_damage($array){
        $this->db->insert('damages',$array);
        return $this->db->insert_id();
    }
 
    public function get_damage($array,$one=false){
        $query = $this->db->get_where('damages', $array);
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

    public function delete_damage($array){
        return $this->db->delete('damages', $array);
    }

    public function change_damage($array,$id){
        return $this->db->update('damages', $array, $id);
    }


    public function create_group($array){
        $this->db->insert('groups',$array);
        return $this->db->insert_id();
    }
 
    public function get_group($array,$one=false){
        $query = $this->db->get_where('groups', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->type = $this->db->get_where('group_types',array('id'=>$row->type_id))->row()->title;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_group_types($array,$one=false){
        $query = $this->db->get_where('group_types', $array);
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

    public function delete_group($array){
        return $this->db->delete('groups', $array);
    }

    public function change_group($array,$id){
        return $this->db->update('groups', $array, $id);
    }

    public function create_bid_status($array){
        $this->db->insert('bid_status',$array);
        return $this->db->insert_id();
    }
 

    public function get_bid_status($array,$one=false){
        $query = $this->db->get_where('bid_status', $array);
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

    public function delete_bid_status($array){
        return $this->db->delete('bid_status', $array);
    }

    public function change_bid_status($array,$id){
        return $this->db->update('bid_status', $array, $id);
    }


    public function create_group_consist($array){
        $this->db->insert('group_consist',$array);
        return $this->db->insert_id();
    }
 
    public function get_group_consist($array,$one=false){
        $query = $this->db->get_where('group_consist', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $group = $this->db->get_where('groups',array('id'=>$row->group_id));
                    $data[$row->id]->group =$group->row()->title;
                    $data[$row->id]->type_id =$group->row()->type_id;
                    $data[$row->id]->user = $this->db->get_where('users',array('id'=>$row->user_id))->row()->name;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_consist($array,$one=false){
        $this->db->select('g.id as group_id, g.title,gc.user_id');
        $this->db->from('group_consist gc');
        $this->db->join('groups g', 'g.id = gc.group_id','left');
      //  $this->db->join('users u', 'g.id = gc.group_id','left');
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return array();
        }
    }


    public function delete_group_consist($array){
        return $this->db->delete('group_consist', $array);
    }

    public function change_group_consist($array,$id){
        return $this->db->update('group_consist', $array, $id);
    }

    
    public function create_budget_type($array){
        $this->db->insert('budget_types',$array);
        return $this->db->insert_id();
    }
 
    public function get_budget_type($array,$one=false){
        $query = $this->db->order_by('type', 'ASC')->get_where('budget_types', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                    $data[$row->id]->type_title = $this->db->get_where('budget_pos',array('id'=>$row->type))->row()->title;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_budget_pos($array,$one=false){
        $query = $this->db->get_where('budget_pos', $array);
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
    public function delete_budget_type($array){
        return $this->db->delete('budget_types', $array);
    }

    public function change_budget_type($array,$id){
        return $this->db->update('budget_types', $array, $id);
    }




    public function create_menu($array){
        $this->db->insert('menu',$array);
        return $this->db->insert_id();
    }
 
    public function get_menu($array,$one=false){
        $this->db->order_by('id', 'ASC')->select('*');
        $this->db->from('menu');
        $this->db->where_in('id',$array);
        $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->parent_id][$row->id] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
    public function get_menu_ban($array,$one=false){
        $this->db->order_by('id', 'ASC')->select('*');
        $this->db->from('menu');
        $this->db->where_not_in('id',$array);
        $query = $this->db->get();
        $data=array();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    if($row->url){
                        $data[$row->id] = $row->url;
                    }
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

    public function delete_menu($array){
        return $this->db->delete('menu', $array);
    }

    public function change_menu($array,$id){
        return $this->db->update('menu', $array, $id);
    }

    public function create_menu_user($array){
        $this->db->insert('menu_user',$array);
        return $this->db->insert_id();
    }
 
    public function get_menu_user($array,$one=false){
        $query = $this->db->get_where('menu_user', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->id] = $row->menu_id;
                }
                return $data;
            }
        }
        else{
            return array();
        }
    }

    public function delete_menu_user($array){
        return $this->db->delete('menu_user', $array);
    }

    public function change_menu_user($array,$id){
        return $this->db->update('menu_user', $array, $id);
    }
    public function get_menu_all($array,$one=false){
        $query = $this->db->get_where('menu', $array);
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

    public function create_repair_range($array){
        $this->db->insert('repair_range',$array);
        return $this->db->insert_id();
    }
 
    public function get_repair_range($array,$one=false){
        $query = $this->db->get_where('repair_range', $array);
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
            return array();
        }
    }

    public function delete_repair_range($array){
        return $this->db->delete('repair_range', $array);
    }

    public function change_repair_range($array,$id){
        return $this->db->update('repair_range', $array, $id);
    }

    public function create_lock($array){
        $this->db->insert('lock',$array);
        return $this->db->insert_id();
    }
 
    public function get_lock($array,$one=false){
        $query = $this->db->get_where('lock', $array);
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
            return array();
        }
    }

    public function delete_lock($array){
        return $this->db->delete('lock', $array);
    }

    public function change_lock($array,$id){
        return $this->db->update('lock', $array, $id);
    }

    public function create_user_lock($array){
        $this->db->insert('user_lock',$array);
        return $this->db->insert_id();
    }
 
    public function get_user_lock($array,$one=false){
        $this->db->select('u.lock_id,l.title');
        $this->db->from('user_lock u');
        $this->db->join('lock l', 'l.id = u.lock_id','left');
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->lock_id] = $row->title;
                }
                return $data;
            }
        }
        else{
            return array();
        }
    }

    public function delete_user_lock($array){
        return $this->db->delete('user_lock', $array);
    }

    public function change_user_lock($array,$id){
        return $this->db->update('user_lock', $array, $id);
    }
    public function create_lock_history($array){
        $this->db->insert('lock_history',$array);
        return $this->db->insert_id();
    }
 
    public function get_lock_history($array,$one=false){
        $this->db->select('u.name,.l.title,lh.date,l.ip');
        $this->db->from('lock_history lh');
        $this->db->join('lock l', 'l.id = lh.lock_id','left');
        $this->db->join('users u', 'u.id = lh.user_id','left');
        $this->db->where($array);
        $query = $this->db->get();
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
            return array();
        }
    }

     public function create_house($array){
        $this->db->insert('house',$array);
        return $this->db->insert_id();
    }
 
    public function get_house($array,$one=false){
        $query = $this->db->order_by('title', 'ASC')->get_where('house', $array);
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
            return array();
        }
    }
    public function get_house_full($array,$one=false){
        $this->db->select('h.id,h.street_id, h.title,h.house_count,s.title as street_title,a.title as area_title');
        $this->db->from('house h');
        $this->db->join('streets s', 's.id = h.street_id','left');
        $this->db->join('areas a', 'a.id = s.area_id','left');
        $this->db->where($array);
        $query = $this->db->get();
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
            return array();
        }
    }

    public function get_house_title($house_id){
        $query = $this->db->get_where('house', array('id'=>$house_id));
        if($query->num_rows()==1){
            return $query->row()->title;
        }
        else{
            return false;
        }
    }
    public function get_house_cable_number($id){
        $query = $this->db->get_where('house_cable', array('id'=>$id));
        if($query->num_rows()==1){
            return $query->row()->number;
        }
        else{
            return false;
        }
    }

    public function delete_house($array){
        return $this->db->delete('house', $array);
    }

    public function change_house($array,$id){
        return $this->db->update('house', $array, $id);
    }

     public function create_house_cable($array){
        $this->db->insert('house_cable',$array);
        return $this->db->insert_id();
    }
 
    public function get_house_cable($array,$one=false){
        $query = $this->db->order_by('number', 'ASC')->get_where('house_cable', $array);
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
            return array();
        }
    }

    public function delete_house_cable($array){
        return $this->db->delete('house_cable', $array);
    }

    public function change_house_cable($array,$id){
        return $this->db->update('house_cable', $array, $id);
    }

    public function create_house_note($array){
        $this->db->insert('house_note',$array);
        return $this->db->insert_id();
    }
    public function get_house_street($array,$one=false){
        $this->db->select('h.id,h.note,s.title as street,h.title as house');
        $this->db->from('house h');
        $this->db->join('streets s', 'h.street_id = s.id','left');
        $this->db->where($array);
        $query = $this->db->get();
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
            return array();
        }
    }
    public function get_house_note($array,$one=false){
        $this->db->select('u.name,hn.date,hn.note');
        $this->db->from('house_note hn');
        $this->db->join('users u', 'u.id = hn.user_id','left');
        $this->db->where($array);
         $query = $this->db->get();
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
            return array();
        }
    }
    public function create_admin_status($array){
        $this->db->insert('admin_status',$array);
        return $this->db->insert_id();
    }
 
    public function get_admin_status($array,$one=false){
        $query = $this->db->order_by('id', 'ASC')->get_where('admin_status', $array);
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
    public function change_admin_status($array,$id){
        return $this->db->update('admin_status', $array, $id);
    }

    public function create_admin_type($array){
        $this->db->insert('admin_type',$array);
        return $this->db->insert_id();
    }

    public function get_admin_type($array,$one=false,$in_array=false){
        $this->db->select('*')->from('admin_type');
        $this->db->where($array);
        if($in_array){
            $this->db->where_in('id',$in_array);
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
    public function change_admin_type($array,$id){
        return $this->db->update('admin_type', $array, $id);
    }


    public function get_admin_consist($array,$one=false){
        $this->db->select('c.user_id,c.type_id,u.name as user,t.title as type');
        $this->db->from('admin_consist c');
        $this->db->join('users u', 'u.id = c.user_id','left');
        $this->db->join('admin_type t', 't.id = c.type_id','left');
        $this->db->where($array);
         $query = $this->db->get();
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
            return array();
        }
    }
    public function create_admin_consist($array){
        $this->db->insert('admin_consist',$array);
        return $this->db->insert_id();
    }
    public function delete_admin_consist($array){
        return $this->db->delete('admin_consist', $array);
    }
    public function get_admin_consist_u($array,$one=false){
        $this->db->select('c.user_id,c.type_id');
        $this->db->from('admin_consist c');
        $this->db->where($array);
         $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->type_id] = $row->type_id;
                }
                return $data;
            }
        }
        else{
            return array(0);
        }
    }
      
}