<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Model {
 
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		
	}
	 
	public function add_data($table,$data) { 
		 return $this->db->insert($table, $data);
	}
	
	public function get_all_data($table) { 
	    
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();
		if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        $query->free_result();
	}                          
	
	public function update_query($query) { 
	    return $this->db->query($query);
	} 
	
	public function get_data_query($query) { 
	    
	    $query = $this->db->query($query);
		if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        $query->free_result();  
	}                  
	
	public function get_row_query($query) { 
	    
	    $row = $this->db->query($query);
	    return $row->row();
	}
	
	public function maj_query($query) {  
	    return $this->db->query($query); 
	}
	
	public function get_data($table) { 
	    
		$this->db->select('*');
		$this->db->from($table);
		return $this->db->get()->row();
		
	}
	
	public function get_data_where($table,$where){
        $key = array_keys($where);
        $value = array_values($where);
	    $key_string = implode(',', $key);
        $value_string = implode(",", $value);
        
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($key_string, $value_string);
        return $this->db->get()->row();
        
		/*$query = $this->db->get();
		if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        $query->free_result();*/
    }
    
	public function update_data($table,$data,$id,$where){
	    /*$this->db->select('*');
        $this->db->from($table);
        $this->db->where($id, $where);
        
	    if(!$this->db->get()->row()){
	        return false;
	    }else{
	    */
    		$this->db->where($id, $where);
            return $this->db->update($table, $data);
	}
	
	public function delete_data($table,$id,$where){
	    $this->db->select('*');
        $this->db->from($table);
        $this->db->where($id, $where);
        
	    if(!$this->db->get()->row()){
	        return false;
	    }else{
    		$this->db->where($id,$where);
            return $this->db->delete($table);
	    }
	}
	 
	 
	function get_search($match)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('miles', 'miles.user = users.id','left');
        $this->db->like('username', $match);
        $this->db->or_like('name', $match);
    
        $query = $this->db->get();
    
    
        if($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        $query->free_result();
    }
    
    
    
    
    /*  user login */
    
    public function is_connecte($id){ 
		$this->db->where('id', $id);
        return $this->db->update('users', array('is_confirmed'=>1));
	}
    public function is_deconnecte($id){
		$this->db->where('id', $id);
        return $this->db->update('users', array('is_confirmed'=>0));
	}
    
    public function create_user($username, $email, $password) { 
		
		$data = array(
			'username'   => $username,
			'email'      => $email,
			'password'   => $this->hash_password($password),
			'created_at' => date('Y-m-j H:i:s'),
		);
		
		return $this->db->insert('users', $data);
		
	}
	 
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('users');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');
		
		return $this->verify_password_hash($password, $hash);
		
	}
	 
	public function get_user_id_from_username($username) {
		
		$this->db->select('id');
		$this->db->from('users');
		$this->db->where('username', $username);

		return $this->db->get()->row('id');
		
	}
	 
	public function get_user($user_id) {
		
		$this->db->from('users');
		$this->db->where('id', $user_id);
		return $this->db->get()->row();
		
	}
	 
	private function hash_password($password) {
		
		return password_hash($password, PASSWORD_BCRYPT);
		
	}
	 
	private function verify_password_hash($password, $hash) {
		
		return password_verify($password, $hash);
		
	}
	
}
