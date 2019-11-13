<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Depots extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin');
        $this->load->model('form');
		$this->load->helper(array('url'));

       if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true)
		{
			redirect('login');	
		}
    }

	public function index()
	{  }
	
	public function add_depot(){
	    
	    $this->form_validation->set_rules('nom', 'nom', 'trim');

		if ($this->form_validation->run() != false) {

            $nom = $this->input->post("nom");
            
            $data = array('depot' => $nom );
            $checking = $this->form->add_data('depots', $data ); 
            
            if ($checking != FALSE) {

               	$data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}

        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Depots/Add_depot",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function add_article_depot(){
	    
	    $this->form_validation->set_rules('id', 'id', 'trim');

		if ($this->form_validation->run() != false) {

            $id = $this->input->post("id");
            $id_depot = $this->input->post("id_depot");
            $qte = $this->input->post("dte");
            
            $data = array('id_art_stock' => $id,'qte_stock' => $qte,'id_depot_stock' => $id_depot );
            $checking = $this->form->add_data('stocks_depot', $data ); 
            
            if ($checking != FALSE) {

               	echo json_encode('Bien Ajouter');
            }else{
               echo json_encode('Probleme a insertion !!');
            }
		}

        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Depots/Add_depot",$data);	
		$this->load->view("include/footer");
	    
	}
	
    public function list_depot(){
        $data['data'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY id_depot ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/list_dipot",$data);	
    	$this->load->view("include/footer");
    }
    
    public function transfaire_depot(){
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY depot ASC');
        $data['article'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY article_art ASC');
        $data['trans'] = $this->form->get_data_query('SELECT * FROM transfaires,articles WHERE id_art=id_art_trans ORDER BY create_trans DESC');
        
	    $this->load->view("include/header");	
    	$this->load->view("Depots/trans_depot",$data);	
    	$this->load->view("include/footer");
    }

	public function detail_depot($id){
	    $data['info'] = $this->form->get_row_query('SELECT * FROM depots WHERE id_depot='.$id);
	    $data['data'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot,depots WHERE id_art=id_art_stock AND id_depot=id_depot_stock AND id_depot='.$id.'  ORDER BY id_art ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/detail_depot",$data);	
    	$this->load->view("include/footer");
	    
	}
    
}
