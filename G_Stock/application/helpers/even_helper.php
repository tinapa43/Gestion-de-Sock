<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

        function pagination($url, $rowscount, $per_page) {
        	$ci = & get_instance();
        	$ci->load->library('pagination');
        	
        	$config = array();
        	$config["base_url"] = base_url($url);
        	$config["total_rows"] = $rowscount;
        	$config["per_page"] = $per_page;
        	$config["uri_segment"] = 3;
        	$config['full_tag_open'] = '<nav><ul class="pagination">';
        	$config['full_tag_close'] = '</ul></nav>';
        	$config['num_tag_open'] = '<li>';
        	$config['num_tag_close'] = '</li>';
        	$config['cur_tag_open'] = '<li class="active"><a>';
        	$config['cur_tag_close'] = '</a></li>';
        	$config['next_tag_open'] = '<li>';
        	$config['next_tag_close'] = '</li>';
        	$config['prev_tag_open'] = '<li>';
        	$config['prev_tag_close'] = '</li>';
        	$config['first_link'] = 'First';
        	$config['first_tag_open'] = '<li>';
        	$config['first_tag_close'] = '</li>';
        	$config['last_link'] = 'Last';
        	$config['last_tag_open'] = '<li>';
        	$config['last_tag_close'] = '</li>';
        	$ci->pagination->initialize($config);
        	return $ci->pagination->create_links();
        }
        
        function get_depot($id){
	        $CI = get_instance();
            $CI->load->model('Form');
        
    	    $data['info'] = $CI->form->get_row_query('SELECT * FROM `depots` WHERE `id_depot` = '.$id);
            
            return $data['info']->depot;
        }
        
        
        
?>