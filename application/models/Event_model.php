<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    //Event
	public function create_event($array){
		$this->db->insert('events',$array);
        return $this->db->insert_id();

	}
    public function event($user_id=false,$event_id=false,$status_id=false){
        $user=$user_id?" and e.user_id=$user_id ":"";
        $event=$event_id?" and e.id=$event_id ":"";
        $status=$status_id?" and e.status_id=0 ":"";
        $query=$this->db->query(
                                "SELECT e.id,e.title, e.description,e.img, e.user_id,e.type_id,e.location_id, u.name as user_name,
                                e.status_id, e.status, e.date_registrated, e.postcode, e.adress,t.title as type ,
                                c.country,c.sub,c.city,c.iso,s.title as status_text,e.date_start,e.date_end
                                FROM events e left join event_types t on e.type_id=t.id
                                left join event_status  s on  e.status_id=s.id
                                left join users u on e.user_id=u.id
                                left join cities c on e.location_id=c.id where 1 $user $event $status");
       if($query->num_rows()>0){
            if($event_id){
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
	public function get_event($array,$one=false){
        $query = $this->db->get_where('events', $array);
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

    public function delete_event($array){
        return $this->db->delete('events', $array);
    }

    public function change_event($array,$id){
        return $this->db->update('events', $array, $id);
    }

    //Date of event

    public function create_event_date($array){
        $this->db->insert('event_dates',$array);

    }
    public function get_event_date($array,$one=false){
        $query = $this->db->get_where('event_dates', $array);
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

    public function delete_event_dates($array){
        return $this->db->delete('event_dates', $array);
    }

    public function change_event_dates($array,$id){
        return $this->db->update('event_dates', $array, $id);
    }

    // Type of Event
    public function create_event_type($array){
        $this->db->insert('event_types',$array);

    }
    public function get_event_type($array,$one=false){
        $query = $this->db->get_where('event_types', $array);
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

    public function delete_event_type($array){
        return $this->db->delete('event_types', $array);
    }

    public function change_event_type($array,$id){
        return $this->db->update('event_types', $array, $id);
    }
    public function get_country($array){
        $query = $this->db->get_where('countries', $array);
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }

    public function default_country($ip){
        $query = $this->db->query("SELECT * FROM  countries WHERE  ip_from <=$ip AND  ip_to >=$ip");
        if($query->num_rows()>0){
            return $query->row();
        }
    }

    public function get_city($array,$one=false){
        $query = $this->db->get_where('cities', $array);
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





}