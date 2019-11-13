<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Articles extends CI_Controller {

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
	
	
    //Ajax
    public function get_article(){
        $this->form_validation->set_rules('id', 'id', 'trim');

		if ($this->form_validation->run() != false) {
            $id = $this->input->post("id");
            
            $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE id_depot <>'.$id.' ORDER BY depot ASC');
            $data['article'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot,depots WHERE id_art = id_art_stock AND id_depot = id_depot_stock AND id_depot ='.$id.' ORDER BY id_art ASC');
    	    echo json_encode($data);
		}
		else{
		    echo json_encode("Error de submession ");
		}
    }
    
    public function trans_article(){
        $data = new stdClass();
        $this->form_validation->set_rules('depot_d', 'depot_d', 'trim');
        $this->form_validation->set_rules('depot_f', 'depot_f', 'trim');
        $this->form_validation->set_rules('article', 'article', 'trim');
        $this->form_validation->set_rules('qte', 'qte', 'trim');
    
		if ($this->form_validation->run() != false) {
            $id1 = $this->input->post("depot_d");
            $id2 = $this->input->post("depot_f");
            $article = $this->input->post("article");
            $qte = $this->input->post("qte");
            
            $row = $this->form->get_row_query('SELECT * FROM articles,stocks_depot,depots WHERE id_art = id_art_stock AND id_depot = id_depot_stock AND id_depot='.$id1);
            if ($row->qte_stock > $qte){
                $data = array('qte_trans' => $qte,
                                'id_art_trans' => $article,
                                'id_depot_out' => $id1,
                                'id_depot_in' => $id2
                                );
                    $this->form->add_data('transfaires', $data ); 
                    $this->form->update_query('UPDATE stocks_depot  SET qte_stock='.( $row->qte_stock - $qte) .' WHERE id_art_stock = '.$article.' AND id_depot_stock='.$id1);
            }
            
             $data = array('qte_stock' => $qte,
                                'id_art_stock' => $article,
                                'id_depot_stock' => $id2
                                );
            //$this->form->add_data('stocks_depot', $data );
           
            $row = $this->form->get_row_query('SELECT * FROM articles,stocks_depot,depots WHERE id_art = id_art_stock AND id_depot = id_depot_stock AND id_depot='.$id2);
            
            if ( $this->form->get_row_query('SELECT * FROM stocks_depot  WHERE id_art_stock = '.$article.' AND id_depot_stock='.$id2) ){
                $this->form->update_query('UPDATE stocks_depot SET qte_stock='.( $row->qte_stock + $qte) .' WHERE id_art_stock = '.$article.' AND id_depot_stock='.$id2);
                
                echo json_encode('Transfaire depot à Bien effectué ');
            }else{
                $this->form->add_data('stocks_depot', $data );
               	$data['msg'] = 'Transfaire depot à Bien Effectué';
            }
            
            
		}
		else{
		    echo json_encode("Error de submession ");
		}
    }
    
    //Ajax
    public function get_art($id){
	    $data['info'] = $this->form->get_data_query('SELECT * FROM articles WHERE id_art='.$id);
	    
	    echo json_encode($data);
	}
	
	public function detail_depot($id){
	    $data['trans'] = $this->form->get_data_query('SELECT * FROM transfaires WHERE 1 ORDER BY create_trans DESC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/detail_depot",$data);	
    	$this->load->view("include/footer");
	    
	}
	
	public function update_stock(){
	            $this->form_validation->set_rules('qte', 'qte', 'trim');
	            $this->form_validation->set_rules('id_mag', 'id_mag', 'trim');

				if ($this->form_validation->run() != false) {

    	            $qte = $this->input->post("qte");
    	            $id = $this->input->post("id_mag");
    	            
    	            $checking = $this->form->update_data('magasins', $data ); 
    	            
    	            if ($checking != FALSE) {
    	               echo json_encode(true);
    	            }else{
    	            	echo json_encode('error de l"inserssion ');
    	            }
				}else{
					echo json_encode('error de submession !!');
	            }
	}
    
}
