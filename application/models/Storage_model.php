<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Storage_model extends CI_Model{
    public function __construct(){
        parent::__construct();
    }

	public function create_gds($array){
		$this->db->insert('gds',$array);
        return $this->db->insert_id();
	}
 
	public function get_gds($array,$one=false){
        $query = $this->db->get_where('gds', $array);
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

    public function delete_gds($array){
        return $this->db->delete('gds', $array);
    }

    public function change_gds($array,$id){
        return $this->db->update('gds', $array, $id);
    }
    public function get_gds_unit($array,$one=false){
        $query = $this->db->get_where('gds_unit', $array);
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
    public function get_move_type($array,$one=false){
        $query = $this->db->get_where('gds_move_type', $array);
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
    public function get_gds_stock($id){
        $query = $this->db->query("SELECT *  FROM gds_stock s left join gds g on s.gds_id=g.id where s.user_id=$id ");
        if($query->num_rows()>0){

            foreach ($query->result() as $row){
                $data[$row->id] = $row;
            }
            return $data;
        }
        else{
            return false;
        }
    }
    public function get_gds_stock_full($array,$one){
        $query = $this->db->get_where('gds_stock', $array);
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

    public function update_gds_stock($array){
        switch ($array['move_type']) {
            case 1:
                $stock=$this->db->query("SELECT id,count FROM gds_stock WHERE gds_id=$array[gds_id] and user_id=$array[user_to]");
                if($stock->num_rows()>0){
                    $count=$stock->row()->count+$array['count'];
                    $this->db->update('gds_stock',array('count'=>$count),array('id'=>$stock->row()->id));
                }
                else{
                    $this->db->insert('gds_stock',array('user_id'=>$array['user_to'],'count'=>$array['count'],'gds_id'=>$array['gds_id']));
                }
                break;
            case 2:
                $stock=$this->db->query("SELECT id,count FROM gds_stock WHERE gds_id=$array[gds_id] and user_id=$array[user_from]");
                $count=$stock->row()->count-$array['count'];
                $this->db->update('gds_stock',array('count'=>$count),array('id'=>$stock->row()->id));
                break;
            case 3:
                $stock_from=$this->db->query("SELECT id,count FROM gds_stock WHERE gds_id=$array[gds_id] and user_id=$array[user_from]");
                $count_from=$stock_from->row()->count-$array['count'];
                $this->db->update('gds_stock',array('count'=>$count_from),array('id'=>$stock_from->row()->id));
                $stock_to=$this->db->query("SELECT id,count FROM gds_stock WHERE gds_id=$array[gds_id] and user_id=$array[user_to]");
                if($stock_to->num_rows()>0){
                    $count_to=$stock_to->row()->count+$array['count'];
                    $this->db->update('gds_stock',array('count'=>$count_to),array('id'=>$stock_to->row()->id));
                }
                else{
                      $this->db->insert('gds_stock',array('user_id'=>$array['user_to'],'count'=>$array['count'],'gds_id'=>$array['gds_id']));
                }
                break;
            default:
                break;

        }
        $this->db->insert('gds_move',$array);

    }
    public function get_move($array,$one=false){
        $this->db->select('m.id,g.title,g.unit, m.date_move,m.comment,ui.name as user_name,uf.name as user_from,
            ut.name as user_to,m.count,mt.title as type');
        $this->db->from('gds_move m');
        $this->db->join('gds g', 'm.gds_id = g.id','left');
        $this->db->join('gds_move_type mt', 'mt.id = m.move_type','left');
        $this->db->join('users ui', 'm.user_id = ui.id','left');
        $this->db->join('users ut', 'm.user_to = ut.id','left');
        $this->db->join('users uf', 'm.user_from = uf.id','left');
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




}