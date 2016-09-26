<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Equipment_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function create_equipment_type($array){
		$this->db->insert('equipment_type',$array);
        return $this->db->insert_id();
	}
 
	public function get_equipment_type($array,$one=false){
        $this->db->order_by('title', 'ASC')->select('et.id, et.title, et.use_id, type_1,type_2,type_3,has_number,unit,eu.title as use');
        $this->db->from('equipment_type et');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
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


    public function change_equipment_type($array,$id){
        return $this->db->update('equipment_type', $array, $id);
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

    public function create_equipment_model($array){
		$this->db->insert('equipment_model',$array);
        return $this->db->insert_id();
	}
 
	public function get_equipment_model($array,$one=false){
        $this->db->order_by('em.type_id ASC, em.id ASC')->select('em.id,em.title,em.description,em.type_id,em.vendor_id,em.price_in,em.price_out,em.min,em.photo,em.photo_thumb,
        	et.title as type, et.unit as type_unit,et.has_number as type_has_number, eu.title as use_name,eu.t as use_n,
        	ev.title as vendor' );
        $this->db->from('equipment_model em');
        $this->db->join('equipment_type et', 'et.id = em.type_id','left');
        $this->db->join('equipment_vendor ev', 'ev.id = em.vendor_id','left');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
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


    public function change_equipment_model($array,$id){
        return $this->db->update('equipment_model', $array, $id);
    }

   public function create_equipment_provisioner($array){
        $this->db->insert('equipment_provisioner',$array);
        return $this->db->insert_id();
    }
 
    public function get_equipment_provisioner($array,$one=false){
        $query = $this->db->order_by('title', 'ASC')->get_where('equipment_provisioner', $array);
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


    public function change_equipment_provisioner($array,$id){
        return $this->db->update('equipment_provisioner', $array, $id);
    }

   public function create_equipment_location($array){
        $this->db->insert('equipment_location',$array);
        return $this->db->insert_id();
    }
 
    public function get_equipment_location($array,$one=false){
        $query = $this->db->order_by('id', 'ASC')->get_where('equipment_location', $array);
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


    public function change_equipment_location($array,$id){
        return $this->db->update('equipment_location', $array, $id);
    }

    public function create_equipment($array){
        $this->db->insert('equipment',$array);
        return $this->db->insert_id();
    }
 
    public function get_equipment($array,$one=false){
        $this->db->select('e.id,e.model_id,e.count,e.serial,e.location_id,e.provisioner_id,e.user_id,e.cr_user,e.cr_date,e.up_user,e.up_date,
            em.title as model,em.description as model_description
            ,em.type_id,em.vendor_id,em.price_in,em.price_out,em.min,em.photo,em.photo_thumb,
            et.title as type, et.unit as type_unit,et.has_number as type_has_number,
            ev.title as vendor, eu.title as use_name,eu.t as use_n,
            el.title as location,el.move as location_move, ep.title as provisioner,u.name as user_name,cr_u.name as cr_name,up_u.name as up_name,e.fine_id');
        $this->db->from('equipment e');
        $this->db->join('equipment_model em', 'em.id = e.model_id','left');
        $this->db->join('equipment_type et', 'et.id = em.type_id','left');
        $this->db->join('equipment_vendor ev', 'ev.id = em.vendor_id','left');
        $this->db->join('equipment_location el', 'el.id = e.location_id','left');
        $this->db->join('equipment_provisioner ep', 'ep.id = e.provisioner_id','left');
        $this->db->join('users u', 'u.id = e.user_id','left');
        $this->db->join('users cr_u', 'cr_u.id = e.cr_user','left');
        $this->db->join('users up_u', 'up_u.id = e.up_user','left');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
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
    public function get_equipment_group($array,$one=false){
        $this->db->select('e.id,e.model_id,e.count,e.serial,e.location_id,e.provisioner_id,e.user_id,e.cr_user,e.cr_date,e.up_user,e.up_date,
            em.title as model,em.description as model_description
            ,em.type_id,em.vendor_id,em.price_in,em.price_out,em.min,em.photo,em.photo_thumb,
            et.title as type, et.unit as type_unit,et.has_number as type_has_number,
            ev.title as vendor, eu.title as use_name,eu.t as use_n,
            count(*) as total_count,
            el.title as location,el.move as location_move, ep.title as provisioner,u.name as user_name,cr_u.name as cr_name,up_u.name as up_name,e.fine_id');
        $this->db->from('equipment e');
        $this->db->join('equipment_model em', 'em.id = e.model_id','left');
        $this->db->join('equipment_type et', 'et.id = em.type_id','left');
        $this->db->join('equipment_vendor ev', 'ev.id = em.vendor_id','left');
        $this->db->join('equipment_location el', 'el.id = e.location_id','left');
        $this->db->join('equipment_provisioner ep', 'ep.id = e.provisioner_id','left');
        $this->db->join('users u', 'u.id = e.user_id','left');
        $this->db->join('users cr_u', 'cr_u.id = e.cr_user','left');
        $this->db->join('users up_u', 'up_u.id = e.up_user','left');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
        $this->db->group_by('e.up_date,e.up_user');
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
    public function get_group_equipment($array,$one=false){
        $this->db->group_by('e.model_id')->select('e.id,e.model_id,e.count,e.serial,e.location_id,e.provisioner_id,e.user_id,e.cr_user,e.cr_date,e.up_user,e.up_date,
            em.title as model,em.description as model_description
            ,em.type_id,em.vendor_id,em.price_in,em.price_out,em.min,em.photo,em.photo_thumb,
            et.title as type, et.unit as type_unit,et.has_number as type_has_number,
            ev.title as vendor, eu.title as use_name,eu.t as use_n,
            el.title as location,el.move as location_move, ep.title as provisioner,u.name as user_name,cr_u.name as cr_name,up_u.name as up_name,e.fine_id,count(*) as total');
        $this->db->from('equipment e');
        $this->db->join('equipment_model em', 'em.id = e.model_id','left');
        $this->db->join('equipment_type et', 'et.id = em.type_id','left');
        $this->db->join('equipment_vendor ev', 'ev.id = em.vendor_id','left');
        $this->db->join('equipment_location el', 'el.id = e.location_id','left');
        $this->db->join('equipment_provisioner ep', 'ep.id = e.provisioner_id','left');
        $this->db->join('users u', 'u.id = e.user_id','left');
        $this->db->join('users cr_u', 'cr_u.id = e.cr_user','left');
        $this->db->join('users up_u', 'up_u.id = e.up_user','left');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
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


    public function change_equipment($array,$id){
        return $this->db->update('equipment', $array, $id);
    }

    public function create_unit($array){
        $this->db->insert('equipment_unit',$array);
        return $this->db->insert_id();
    }
 
    public function get_unit($array,$one=false){
        $query = $this->db->get_where('equipment_unit', $array);
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


    public function change_unit($array,$id){
        return $this->db->update('equipment_unit', $array, $id);
    }
    public function create_equipment_history($array){
        $this->db->insert('equipment_history',$array);
        return $this->db->insert_id();
    }
    public function get_equipment_history($array,$one=false){
        $this->db->select('e.id,e.model_id,e.serial,
            h.location_id,h.user_id,h.admin_id,h.date,h.count,h.login,h.house_id, h.porch, ho.title as house, st.title as street,
            em.title as model,em.description as model_description,h.equipment_id,

            em.type_id,em.vendor_id,em.price_in,em.price_out,em.min,em.photo,em.photo_thumb,
            et.title as type, et.unit as type_unit,et.has_number as type_has_number,
            ev.title as vendor, eu.title as use_name,eu.t as use_n,
            el.title as location,el.move as location_move,u.name as user_name,cr_u.name as user_name,up_u.name as admin_name,e.fine_id');
        $this->db->from('equipment_history h');
        $this->db->join('equipment e', 'e.id = h.equipment_id','left');
        $this->db->join('equipment_model em', 'em.id = e.model_id','left');
        $this->db->join('equipment_type et', 'et.id = em.type_id','left');
        $this->db->join('equipment_vendor ev', 'ev.id = em.vendor_id','left');
        $this->db->join('equipment_location el', 'el.id = h.location_id','left');
        $this->db->join('users u', 'u.id = e.user_id','left');
        $this->db->join('users cr_u', 'cr_u.id = h.user_id','left');
        $this->db->join('users up_u', 'up_u.id = h.admin_id','left');
        $this->db->join('equipment_use eu', 'eu.id = et.use_id','left');
        $this->db->join('house ho', 'ho.id = h.house_id','left');
        $this->db->join('streets st', 'ho.street_id = st.id','left');

        $this->db->where($array);
         $query = $this->db->get();
        if($query->num_rows()>0){

            if($one==true){
                return $query->row();
            }else{
                foreach ($query->result() as $row){
                    $data[$row->equipment_id] = $row;
                }
                return $data;
            }
        }
        else{
            return false;
        }
    }
}