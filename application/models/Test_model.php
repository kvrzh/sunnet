<?
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Test_model extends CI_Model{
    public function __construct(){
        parent::__construct();
        
    }

	public function branch_create($array){
		$this->db->insert('test_branch',$array);
        return $this->db->insert_id();
	}
    public function branch_update($array,$id){
        return $this->db->update('test_branch', $array, $id);
    }


	public function branch($array,$one=false){
        $this->db->select('*');
        $this->db->from('test_branch');
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
            return array();
        }
    }

	public function theme_create($array){
		$this->db->insert('test_theme',$array);
        return $this->db->insert_id();
	}
    public function theme_update($array,$id){
        return $this->db->update('test_theme', $array, $id);
    }
	public function theme($array,$one=false){
        $this->db->select('t.id,t.title,t.branch_id,b.title as branch_title,(count(*)) as question_count');
        $this->db->from('test_theme t');
        $this->db->join('test_branch b', 't.branch_id = b.id','left');
        $this->db->join('test_question q', 'q.theme_id = t.id','left');
     	$this->db->group_by('q.theme_id'); 
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
            return array();
        }
    }
	public function question_create($array){
		$this->db->insert('test_question',$array);
        return $this->db->insert_id();
	}
    public function question_update($array,$id){
        return $this->db->update('test_question', $array, $id);
    }

	public function question_in($array,$in_array){
        $this->db->select('q.id,q.theme_id,q.date,q.priority,t.branch_id');
        $this->db->from('test_question q');
        $this->db->join('test_theme t', 'q.theme_id = t.id','left');
       	$this->db->where($array);
        $this->db->where_in('theme_id',$in_array);
     	$query = $this->db->get();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
                $data[$row->id] = $row;
            }
            return $data;
        }
        else{
            return array();
        }
    }
	public function question($array,$one=false){
        $this->db->select('*');
        $this->db->from('test_question');

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
            return array();
        }
    }

	public function answer_create($array){
		$this->db->insert('test_answer',$array);
        return $this->db->insert_id();
	}
    public function answer_update($array,$id){
        return $this->db->update('test_answer', $array, $id);
    }

	public function answer($array,$one=false){
        $this->db->select('*');
        $this->db->from('test_answer');
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
            return array();
        }
    }

	public function task_create($array){
		$this->db->insert('test_task',$array);
        return $this->db->insert_id();
	}
    public function task_update($array,$id){
        return $this->db->update('test_task', $array, $id);
    }
	public function task($array,$one=false){
        $this->db->select('t.id,t.user_id,t.date,t.start,t.finish,t.status_finish, t.wrong, u.name as user_name');
        $this->db->from('test_task t');
        $this->db->join('users u', 't.user_id = u.id','left');
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
	public function task_question_create($array){
		$this->db->insert('test_task_question',$array);
        return $this->db->insert_id();
	}
    public function task_question_update($array,$id){
        return $this->db->update('test_task_question', $array, $id);
    }
	public function task_question($array,$one=false){
        $this->db->select('
        	tq.id,tq.task_id,tq.question_id,tq.right,tq.status_finish as status_question,tq.answer,tq.pos,
        	t.user_id,t.date,t.start,t.finish,t.status_finish,
        	q.theme_id,q.text,q.photo,q.comment,q.right as right_question,q.ans1,q.ans2,q.ans3,q.ans4,
        	');
        $this->db->from('test_task_question tq');
        $this->db->join('test_task t', 'tq.task_id = t.id','left');
        $this->db->join('test_question q', 'tq.question_id = q.id','left');
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
	public function question_task_in($array,$in_array){
        $this->db->select('q.id,q.theme_id,q.date,q.priority,t.branch_id,ttq.right,tt.user_id,ttq.id as question_task_id');
     	$this->db->from('test_task_question ttq');
        $this->db->join('test_question q', 'ttq.question_id = q.id','left');
        $this->db->join('test_theme t', 'q.theme_id = t.id','left');
        $this->db->join('test_task tt', 'ttq.task_id = tt.id','left');
       	$this->db->where($array);
        $this->db->where_in('theme_id',$in_array);
       	//$this->db->group_by('ttq.question_id'); 
   		$this->db->order_by('ttq.id','asc'); 

     	$query = $this->db->get();
     	$data1=array();
        if($query->num_rows()>0){
            foreach ($query->result() as $row){
               	 	$data[$row->id] = $row;
            	
            }
            if($data){
            	foreach ($data as $key => $value) {
            		if($value->right==0){
            			$data1[]=$key;
            		}
            	}
            }
            return $data1;
        }
        else{
            return array();
        }
    }



}