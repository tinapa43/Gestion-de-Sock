<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ventes extends CI_Controller {

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
	    
	    $this->form_validation->set_rules('article', 'article', 'trim');
	    $this->form_validation->set_rules('vente', 'vente', 'trim');
        $this->form_validation->set_rules('prix_reg', 'prix_reg', 'trim');
        $this->form_validation->set_rules('type_reg', 'type_reg', 'trim');
        $this->form_validation->set_rules('frs', 'frs', 'trim');

		if ($this->form_validation->run() != false) {

           $art = $this->input->post("article");
            $pu = $this->input->post("pu");
            $qte = $this->input->post("qte");
            $frs = $this->input->post("frs");

            $data = array('id_art_vente' => $art,
                            'qte_vente' => $qte,
                            'pu_vente' => $pu,
                            'id_frs_vente' => $frs
                            );
            $checking = $this->form->add_data('ventes', $data );
            
            if ($checking != FALSE) {
               	$data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}

        $data['clt'] = $this->form->get_data_query('SELECT * FROM clients WHERE 1 ORDER BY nom_clt ASC');
        $data['art'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY article_art ASC');
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Ventes/Add_vente",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function add_reglement(){

        $this->form_validation->set_rules('article', 'article', 'trim');

		if ($this->form_validation->run() != false) {

            $art = $this->input->post("id_achat");
            $id = $this->input->post("article");

            $type_reg = $this->input->post("type_reg");
            $prix_reg = $this->input->post("prix_reg");

            $data = array('id_achat_reg' => $art,
                            'prix_reg' => $prix_reg,
                            'type_reg' => $type_reg
                            );
            	

            $checking = $this->form->add_data('reglements', $data );

            if ($checking != FALSE) {
               	$data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}
        redirect(base_url("Achats/Update_reglement/".$art) );	
	}

	public function list_achats(){
	    $data['data'] = $this->form->get_data_query('SELECT * FROM articles,fournisseur,achats WHERE id_frs=id_frs_achat AND id_art=id_art_achat GROUP BY id_achat ORDER BY id_achat DESC');
	    $this->load->view("include/header");	
		$this->load->view("Achats/view_achat",$data);	
		$this->load->view("include/footer");
	}

	public function list_reglement(){
	      $data['data'] = $this->form->get_data_query('SELECT *,SUM(prix_reg) as prix FROM articles,fournisseur,achats,reglements WHERE id_frs=id_frs_achat AND id_achat=id_achat_reg AND id_art=id_art_achat GROUP BY id_achat ORDER BY id_achat DESC');
	    $this->load->view("include/header");	
		$this->load->view("Achats/view_reg",$data);	
		$this->load->view("include/footer");
	}
	
	public function detail_reglement($id){
	      $data['data'] = $this->form->get_data_query('SELECT * FROM articles,fournisseur,achats,reglements WHERE id_achat='.$id.' AND id_frs=id_frs_achat AND id_achat=id_achat_reg AND id_art=id_art_achat ORDER BY id_achat DESC');
	    $this->load->view("include/header");	
		$this->load->view("Achats/detail_reg",$data);	
		$this->load->view("include/footer");
	}
	
	//Ajax
	public function cmd(){
	        
	    $this->form_validation->set_rules('id_art', 'id_art', 'trim');

		if ($this->form_validation->run() != false) {

           $id_art = $this->input->post("id_art");
            
            if ( $this->form->get_row_query('SELECT * FROM articles WHERE id_art='.$id_art) ) {
               	$data['art'] = $this->form->get_row_query('SELECT * FROM articles WHERE id_art='.$id_art);
            }else{
              $data = "Error de DB";
            }
		}
        echo json_encode($data);
       
	}
	
	//Ajax
	public function list_fact(){
	        
	    $this->form_validation->set_rules('id_achat', 'achat', 'trim');

		if ($this->form_validation->run() != false) {

           $id_achat = $this->input->post("id_achat");
            
            if ($this->form->get_data_query('SELECT * FROM articles,fournisseur,achats,reglements WHERE id_achat='.$id_achat.' AND id_frs=id_frs_achat AND id_achat=id_achat_reg AND id_art=id_art_achat ORDER BY id_achat DESC') ) {
               	$data['frs'] = $this->form->get_row_query('SELECT * FROM fournisseur,achats WHERE id_achat='.$id_achat.' AND id_frs=id_frs_achat ORDER BY nom_frs ASC');
                $data['achats'] = $this->form->get_data_query('SELECT * FROM articles,fournisseur,achats,reglements WHERE id_achat='.$id_achat.' AND id_frs=id_frs_achat AND id_achat=id_achat_reg AND id_art=id_art_achat GROUP BY id_achat  ORDER BY id_achat DESC');
            }else{
              $data = "Error de DB";
            }
		}
        echo json_encode($data);
       
	}
	
	public function fact_reglement(){
	     $data['data'] = $this->form->get_data_query('SELECT *,SUM(prix_reg) as prix FROM articles,fournisseur,achats,reglements WHERE id_frs=id_frs_achat AND id_achat=id_achat_reg AND id_art=id_art_achat GROUP BY id_achat ORDER BY id_achat DESC');
	     $this->load->view("include/header");	
		$this->load->view("Achats/fact",$data);	
		$this->load->view("include/footer");
	}
	public function delete(){
	    
	    $this->load->view("include/header");	
		$this->load->view("Achats/maj_achat");	
		$this->load->view("include/footer");
	    
	}
	
	public function Update_reglement($id){
	    $data['article'] = $this->form->get_row_query('SELECT *,( pu_achat-SUM(prix_reg)) as prix_art  FROM articles,fournisseur,achats,reglements WHERE id_frs_achat=id_frs AND id_achat=id_achat_reg AND id_art=id_art_achat AND id_achat='.$id );
	    $this->load->view("include/header");	
		$this->load->view("Achats/update_reg",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function stock($qte,$art){

		if($stock=$this->form->get_row_query('SELECT * FROM magasins WHERE id_art_mag='.$art)):

			$data = array('qte_mag' => $qte+$stock->qte_mag,
	                            'id_art_mag' => $art
	                            );
	        $this->form->update_data('magasins',$data,'id_art_mag',$art ); 
	    else:
	    	$data = array('qte_mag' => $qte,
	                            'id_art_mag' => $art
	                            );
	        $this->form->add_data('magasins',$data); 
	    endif;

	}

}
