<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Frs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       
       if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true)
		{
			redirect('login');	
		}
    }

	public function index()
	{	}
	
	public function Add(){
	    
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

        $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
		$this->load->view("include/header");	
		$this->load->view("frs/add",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function view(){
	    $data =  array( 'data' => $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY article_art ASC') );
	    $this->load->view("include/header");	
		$this->load->view("Achats/view",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function delete(){
	    
	    $this->load->view("include/header");	
		$this->load->view("Achats/maj");	
		$this->load->view("include/footer");
	    
	}
	
	public function maj(){
	    
	    $this->load->view("include/header");	
		$this->load->view("Achats/maj");	
		$this->load->view("include/footer");
	    
	}


}
