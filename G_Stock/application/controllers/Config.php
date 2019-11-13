<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('form');
		$this->load->helper(array('url'));
		$this->load->helper('form');
		
       if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true)
		{
			redirect('login');	
		}
    }

	public function index()
	{ }
	
	public function config(){
	    $data['famill'] = $this->form->get_data_query('SELECT * FROM famills WHERE1 ORDER BY famill ASC');
	    $data['unite'] = $this->form->get_data_query('SELECT * FROM unites WHERE1 ORDER BY unite ASC');
        $this->load->view("include/header");	
    	$this->load->view("Config/add_config",$data);	
    	$this->load->view("include/footer");
	}
	
	public function frs_clt(){
	    $data['clt'] = $this->form->get_data_query('SELECT * FROM clients WHERE 1 ORDER BY nom_clt ASC');
	    $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
		$this->load->view("include/header");	
		$this->load->view("Config/add_frs-clt",$data);	
		$this->load->view("include/footer");
	}
	
	public function add_info(){
	    
	    $this->form_validation->set_rules('nom', 'nom', 'trim');
			if ($this->form_validation->run() != false) {
	            
	            $data = array('ste_info' => $this->input->post('ste'),
	                           'adress_info' => $this->input->post('adress'),
	                           'tel_info' => $this->input->post('tel'),
	                           'fax_info' => $this->input->post('fax'),
	                           'logo_info' => $this->input->post('logo'),
	                           'i_1_info' => $this->input->post('1_info'),
	                           'i_2_info' => $this->input->post('2_info'),
	                           'i_3_info' => $this->input->post('3_info'),
	                           'i_4_info' => $this->input->post('4_info') );
	            $checking = $this->form->update_data('info', $data, 'id_info', 1 ); 
	            
	            if ($checking != FALSE) {
	               $data['msg'] = 'Bien Modifier';
	            }else{
	               $data['msg'] = 'Probleme d\'ajouter';
                }    
			}else{
			    $data['msg'] = ' ';
            }
            
	    $data['row'] = $this->form->get_row_query('SELECT * FROM info WHERE id_info=1 ');
		$this->load->view("include/header");	
		$this->load->view("Config/add_info",$data);	
		$this->load->view("include/footer");
		
		
	}
	
	public function add_famill(){
		
            $this->form_validation->set_rules('nom', 'nom', 'trim');
			if ($this->form_validation->run() != false) {
	            $nom = $this->input->post("nom");
	            
	            $data = array('famill' => $nom );
	            $checking = $this->form->add_data('famills', $data ); 
	            
	            if ($checking != FALSE) {
	               redirect(base_url('config/config'));
	            }else{
	               redirect(base_url('config/config'));
                }    
			}else{
			    redirect(base_url('config/config'));
            }
	}
	
	public function add_unite(){
		
	            $this->form_validation->set_rules('nom', 'nom', 'trim');
				if ($this->form_validation->run() != false) {
    	            $nom = $this->input->post("nom");
    	            
    	            $data = array('unite' => $nom );
    	            $checking = $this->form->add_data('unites', $data ); 
    	            
    	            if ($checking != FALSE) {
    	               redirect(base_url('config/config'));
    	            }else{
    	               redirect(base_url('config/config'));
	            }
				    
			}else{
			    redirect(base_url('config/config'));
            }
	}
	
	public function update_famill(){
	    
            $this->form_validation->set_rules('id_famill', 'id_famill', 'trim');
            $id = $this->input->post("id_famill");
            $nom = $this->input->post("famill");
            $visible = $this->input->post("visible");
            
            $data = array('famill' => $nom,
                            'visible_famill' => $visible);
            $checking = $this->form->update_data('famills', $data, 'id_famill', $id ); 
            if ($checking != FALSE) {
                redirect(base_url('config/config'));
            }else{
    	         redirect(base_url('config/config'));
            }
	}
	
	public function update_unite(){
	    
            $this->form_validation->set_rules('id_unite', 'id_unite', 'trim');
            $id = $this->input->post("id_unite");
            $nom = $this->input->post("unite");
            $visible = $this->input->post("visible");
            
            $data = array('unite' => $nom,
                            'visible_unite' => $visible);
            $checking = $this->form->update_data('unites', $data, 'id_unite', $id ); 
            if ($checking != FALSE) {
               redirect(base_url('config/config'));
            }else{
                redirect(base_url('config/config'));
            }
	}
	
    public function add_frs(){
        
	    $this->form_validation->set_rules('nom', 'nom', 'trim');
        $this->form_validation->set_rules('adress', 'adress', 'trim');
        $this->form_validation->set_rules('tel', 'tel', 'trim');

		if ($this->form_validation->run() != false) {

            $nom = $this->input->post("nom");
            $adress = $this->input->post("adress");
            $tel = $this->input->post("tel");
            
            $data = array('nom_frs' => $nom,
                            'adress_frs' => $adress,
                            'tel_frs' => $tel
                            );
            $checking = $this->form->add_data('fournisseur', $data ); 
            
            if ($checking != FALSE) {
               $data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}else{
               $data['msg'] = 'Probleme de submession !!';
        }
        
        redirect(base_url('config/frs_clt'));
    }
    
	public function update_frs($id){
            $this->form_validation->set_rules('id_frs', 'id_frs', 'trim');
            $id = $this->input->post("id_frs");

            $data = array('nom_frs' => $this->input->post("nom"),
                            'adress_frs' => $this->input->post("adress"),
                            'tel_frs' => $this->input->post("tel"),
                            'visible_frs' => $this->input->post("visible")
                            );
            $checking = $this->form->update_data('fournisseur', $data, 'id_frs', $id );
            if ($checking != FALSE) {
               redirect(base_url('config/frs_clt'));
            }else{
                redirect(base_url('config/frs_clt'));
            }
	}
	
	public function add_clt(){
        
	    $this->form_validation->set_rules('nom', 'nom', 'trim');
        $this->form_validation->set_rules('adress', 'adress', 'trim');
        $this->form_validation->set_rules('tel', 'tel', 'trim');

		if ($this->form_validation->run() != false) {

            $nom = $this->input->post("nom");
            $adress = $this->input->post("adress");
            $tel = $this->input->post("tel");
            
            $data = array('nom_clt' => $nom,
                            'adress_clt' => $adress,
                            'tel_clt' => $tel
                            );
            $checking = $this->form->add_data('clients', $data ); 
            
            if ($checking != FALSE) {
               $data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}else{
               $data['msg'] = 'Probleme de submession !!';
        }

        redirect(base_url('config/frs_clt'));
    }
    
	public function update_clt($id){
            $this->form_validation->set_rules('id_clt', 'id_clt', 'trim');
            $id = $this->input->post("id_clt");

            $data = array('nom_clt' => $this->input->post("nom"),
                            'adress_clt' => $this->input->post("adress"),
                            'tel_clt' => $this->input->post("tel"),
                            'visible_clt' => $this->input->post("visible")
                            );
            $checking = $this->form->update_data('clients', $data, 'id_clt', $id );
            if ($checking != FALSE) {
               redirect(base_url('config/frs_clt'));
            }else{
                redirect(base_url('config/frs_clt'));
            }
	}
    
    
}
