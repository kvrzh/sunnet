<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Repair_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

    public function create_repair($array){
        $this->db->insert('repairs',$array);
        return $this->db->insert_id();
    }
  public function create_client($array){
        $this->db->insert('clients',$array);
        return $this->db->insert_id();
    }

    public function create_repair_change($array){
        $this->db->insert('repairs_change',$array);
        return $this->db->insert_id();
    }
    public function create_repair_work($array){
        $this->db->insert('repair_work',$array);
        return $this->db->insert_id();
    }
  public function create_client_change($array){
        $this->db->insert('clients_change',$array);
        return $this->db->insert_id();
    }

    public function get_repair($array,$one=false){
        $query = $this->db->order_by('date_repair','asc')->get_where('repairs', $array);
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
    public function get_cable($array,$one=false){
        $query = $this->db->get_where('cable_type', $array);
        if($query->num_rows()>0){
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
    }
    public function get_repair_change($array,$one=false){
        $query = $this->db->get_where('repairs_change', $array);
        if($query->num_rows()>0){
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
    }
        public function get_client_change($array,$one=false){
        $query = $this->db->get_where('clients_change', $array);
        if($query->num_rows()>0){
                foreach ($query->result() as $row){
                    $data[$row->id] = $row;
                }
                return $data;
            }
    }
    public function get_client($array,$one=false){
        $query = $this->db->get_where('clients', $array);
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

    public function delete_repair($array){
        return $this->db->delete('repairs', $array);
    }
    public function delete_repair_work($array){
        return $this->db->delete('repair_work', $array);
    }

    public function change_client($array,$id){
        return $this->db->update('clients', $array, $id);
    }
    public function change_repair_work($array,$id){
        return $this->db->update('repair_work', $array, $id);
    }
    public function change_repair($array,$id){
        $this->db->update('repairs', $array, $id);
        //$this->db->trans_complete();
        return $this->db->affected_rows();
    }


    public function get_repair_all($array,$one=false){
        $this->db->order_by('start', 'ASC')->select('r.id,c.name,c.phone1,c.phone2,c.email,c.address_house,c.address_porch,a.short, s.short as str_short, r.comment_master,
            c.address_floor,c.address_room, rates.title as rate, act1.title as action1, act2.title as action2,r.paid,
            ct.title as cable,r.date_created,r.date_repair,r.date_phone,r.comment,r.urgency,r.sms,gp.title as type,r.status_time,
            dmg.title as damage, bs.title as status,bs.color,bs.id as status_id,r.type as type_id,
            w.start as repair_start,w.end as repair_end,c.house_id,ho.note as house_note,w.fine_time,w.fine_sum,w.fine_stat,w.fine_d,w.fine_h,w.fine_m,
            s.title as street,a.title as area,u.name as operator, r.active,w.start,w.end,w.group_id,gt.title as group,
            r.cable_use');
        $this->db->from('repairs r');
        $this->db->join('clients c', 'r.client_id = c.id','left');
        $this->db->join('users u', 'r.operator_id= u.id','left');
        $this->db->join('streets s', 'c.street_id= s.id','left');
        $this->db->join('areas a', 'a.id= s.area_id','left');
        $this->db->join('rates ', 'r.rate_id= rates.id','left');
        $this->db->join('actions act1 ', 'r.action1_id= act1.id','left');
        $this->db->join('actions act2 ', 'r.action2_id= act2.id','left');
        $this->db->join('cable_type ct ', 'r.cable= ct.id','left');
        $this->db->join('group_types gp ', 'r.type= gp.id','left');
        $this->db->join('damages dmg ', 'r.damage_id= dmg.id','left');
        $this->db->join('bid_status bs ', 'r.status_id= bs.id','left');
        $this->db->join('repair_work  w', 'r.id= w.repair_id','left');
        $this->db->join('groups  gt', 'w.group_id= gt.id','left');
        $this->db->join('house  ho', 'ho.id= c.house_id','left');
 
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
            return false;
        }
    }
    public function get_repair_all_cable($array,$one=false){
        $this->db->order_by('start', 'ASC')->select('r.id,c.name,c.phone1,c.phone2,c.email,c.address_house,c.address_porch,a.short, s.short as str_short, r.comment_master,
            c.address_floor,c.address_room, rates.title as rate, act1.title as action1, act2.title as action2,
            ct.title as cable,r.date_created,r.date_repair,r.date_phone,r.comment,r.urgency,r.sms,gp.title as type,r.status_time,
            dmg.title as damage, bs.title as status,bs.color,bs.id as status_id,r.type as type_id,
            w.start as repair_start,w.end as repair_end,c.house_id,ho.note as house_note,
            s.title as street,a.title as area,u.name as operator, r.active,w.start,w.end,w.group_id,gt.title as group');
        $this->db->from('repairs r');
        $this->db->join('clients c', 'r.client_id = c.id','left');
        $this->db->join('users u', 'r.operator_id= u.id','left');
        $this->db->join('streets s', 'c.street_id= s.id','left');
        $this->db->join('areas a', 'a.id= s.area_id','left');
        $this->db->join('rates ', 'r.rate_id= rates.id','left');
        $this->db->join('actions act1 ', 'r.action1_id= act1.id','left');
        $this->db->join('actions act2 ', 'r.action2_id= act2.id','left');
        $this->db->join('cable_type ct ', 'r.cable= ct.id','left');
        $this->db->join('group_types gp ', 'r.type= gp.id','left');
        $this->db->join('damages dmg ', 'r.damage_id= dmg.id','left');
        $this->db->join('bid_status bs ', 'r.status_id= bs.id','left');
        $this->db->join('repair_work  w', 'r.id= w.repair_id','left');
        $this->db->join('groups  gt', 'w.group_id= gt.id','left');
        $this->db->join('house  ho', 'ho.id= c.house_id','left');
 
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[$row->id] = $row;
                if($row->type_id==1)
                {
                $query_cable = $this->db->order_by('number', 'ASC')->get_where('house_cable',array('house_id'=>$row->house_id,'free'=>1));
                if($query_cable->num_rows()>0){
                        foreach ($query_cable->result() as $row_cable){
                            $data[$row->id]->house_cable[] = $row_cable;
                        }
                    }
                    else{
                        $data[$row->id]->house_cable=array();
                    }
                }
            }
        return $data;
        }
       
        else{
            return false;
        }
    }
        public function get_repair_all_change($array,$one=false){
        $this->db->select('r.id,c.name,c.phone1,c.phone2,c.email,c.address_house,c.address_porch,
            c.address_floor,c.address_room, rates.title as rate, act1.title as action1, act2.title as action2,
            ct.title as cable,r.date_created,r.date_repair,r.date_phone,r.comment,r.urgency,r.sms,gp.title as type,r.type as type_id,
            dmg.title as damage, bs.title as status,bs.color,
            s.title as street,a.title as area,u.name as operator, r.active');
        $this->db->from('repairs_change r');
        $this->db->join('clients_change c', 'r.id = c.client_id','left');
        $this->db->join('users u', 'r.operator_id= u.id','left');
        $this->db->join('streets s', 'c.street_id= s.id','left');
        $this->db->join('areas a', 'a.id= s.area_id','left');
        $this->db->join('rates ', 'r.rate_id= rates.id','left');
        $this->db->join('actions act1 ', 'r.action1_id= act1.id','left');
        $this->db->join('actions act2 ', 'r.action2_id= act2.id','left');
        $this->db->join('cable_type ct ', 'r.cable= ct.id','left');
        $this->db->join('group_types gp ', 'r.type= gp.id','left');
        $this->db->join('damages dmg ', 'r.damage_id= dmg.id','left');
        $this->db->join('bid_status bs ', 'r.status_id= bs.id','left');
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
            return false;
        }
    }
        public function get_repair_work($array,$one=false){
        $this->db->select('r.id,c.name,c.address_house,c.address_room, 
          r.date_repair,r.date_phone,r.urgency,r.sms,r.status_id,bs.color as color,,w.fine_time,w.fine_sum,w.fine_stat,w.fine_d,w.fine_h,w.fine_m,
            s.title as street,a.title as area, r.active, w.start,w.end,w.group_id, bs.title as status');
        $this->db->from('repairs r');
        $this->db->join('clients c', 'r.client_id = c.id','left');
        $this->db->join('streets s', 'c.street_id= s.id','left');
        $this->db->join('areas a', 'a.id= s.area_id','left');
        $this->db->join('repair_work  w', 'r.id= w.repair_id','left');
        $this->db->join('bid_status bs ', 'r.status_id= bs.id','left');
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
            return false;
        }
    }
    public function create_repair_user($array){
        $this->db->insert('repair_user',$array);
        return $this->db->insert_id();
    }
    public function get_repair_user($array,$one=false){
        $this->db->select('r.id,c.name as repair_name,c.address_house,c.address_room,  c.address_floor,a.short, s.short as str_short, s.short as str_short,
          r.date_repair,r.urgency,r.status_id,bs.color as color,r.status_time,r.comment,r.comment_master,c.address_porch,
            s.title as street,a.title as area, bs.title as status,rw.date as date_change,
            rw.group_id,gr.title as group,gt.title as group_type,
            u.name,u.id as user_id');
        $this->db->from('repair_user rw');
        $this->db->join('repairs r', 'rw.repair_id = r.id','left');
        $this->db->join('clients c', 'r.client_id = c.id','left');
        $this->db->join('streets s', 'c.street_id= s.id','left');
               $this->db->join('areas a', 'a.id= s.area_id','left');
        $this->db->join('bid_status bs ', 'rw.status_id= bs.id','left');
        $this->db->join('users u ', 'rw.user_id= u.id','left');
        $this->db->join('groups gr', 'rw.group_id= gr.id','left');
        $this->db->join('group_types gt', 'gr.type_id= gt.id','left');
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
            return false;
        }
    }
    public function get_repair_group($array){
        $query = $this->db->get_where('repair_work', $array);
        if($query->num_rows()>0){
            return $query->row()->group_id;
        }

        else{
            return false;
        }
    }


    public function create_repair_equipment($array){
        $this->db->insert('repair_equipment',$array);
        return $this->db->insert_id();
    }
 
    public function get_repair_equipment($array,$one=false){
        $query = $this->db->get_where('repair_equipment', $array);
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[] = $row->equipment_id;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }

    public function delete_repair_equipment($array){
        return $this->db->delete('repair_equipment', $array);
    }
    public function get_repair_equipment_type($array,$one=false){
        $this->db->select('re.equipment_id as id,et.title as type');
        $this->db->from('repair_equipment re');
        $this->db->join('equipment_type et', 'et.id = re.equipment_id','left');
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
            return false;
        }
    }


        public function get_work_group($array,$one=false){
        $this->db->select('r.id,r.start,r.end,r.group_id,g.type_id');
        $this->db->from('repair_work r');
        $this->db->join('groups g','r.group_id=g.id','left');
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[] = $row->group_id;
            }
            return $data;
        }
        else{
            return false;
        }
    }
    public function get_work_range($array,$one=false){
        $this->db->select('r.repair_id,r.start,r.end,r.group_id,g.type_id');
        $this->db->from('repair_work r');
        $this->db->join('groups g','r.group_id=g.id','left');
        $this->db->join('repairs rep','r.repair_id=rep.id','left');
        $this->db->where($array);
        $query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
        else{
            return false;
        }
    }
}