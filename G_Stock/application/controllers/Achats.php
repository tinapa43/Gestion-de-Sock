<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Achats extends CI_Controller {

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
	
	public function add_achat(){
	    
        $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
        $data['art'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY id_art ASC'); 
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY id_depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Achats/commande_achat",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function add_bon_achat(){
	    
        $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
        $data['art'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY id_art ASC'); 
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY id_depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Achats/bon_achat",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function add_avoire_achat(){
	    
        $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
        $data['art'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY id_art ASC'); 
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY id_depot ASC');
		$this->load->view("include/header");	
		$this->load->view("Achats/avoire_achat",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function add_commande(){
	    $maj = 0;
	    
	    $this->form_validation->set_rules('article', 'article', 'trim');
	    $this->form_validation->set_rules('achat', 'achat', 'trim');
        $this->form_validation->set_rules('prix_reg', 'prix_reg', 'trim');
        $this->form_validation->set_rules('frs', 'frs', 'trim');

		if ($this->form_validation->run() != false) {

           $art = $this->input->post("article");
            $pu = $this->input->post("pu");
            $qte = $this->input->post("qte");
            $frs = $this->input->post("frs");
            
            //SELECT `id_achat`, `id_frs_achat`, `id_art_achat`, `qte_achat`, `pu_achat`, `visible_achat`, `create_achat` FROM `achats` WHERE 1
            
            $data = array('id_frs_achat' => $frs,
                            'id_art_achat' => $art,
                            'qte_achat' => $qte,
                            'pu_achat' => $pu
                            );
            
            $maj = $this->form->add_data('achats',$data);
            
            //  SELECT `id_mouve`, `qte_mouve`, `prix_mouve`, `date_mouve`, `id_art_mouve`, `type_mouve`, `id_user_mouve`, `visible_mouve`, `created_mouve` FROM `mouvement` WHERE 1
            $data = array('id_art_mouve' => $art,
                            'id_user_mouve' => 1,
                            'prix_mouve' => $pu,
                            'date_mouve' => date("Y-m-d"),
                            'type_mouve' => 1,
                            'qte_mouve' => $qte
                            );
            $maj = $this->form->add_data('mouvement', $data);
            
            if ($maj != FALSE) {
               	$data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}
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
	    $data['data'] = $this->form->get_data_query('SELECT * FROM depots,fournisseur,ligne_commande WHERE id_frs=id_frs_ligne AND id_depot=id_depot_ligne ORDER BY created_ligne DESC');
	    $this->load->view("include/header");	
		$this->load->view("Achats/view_achat",$data);	
		$this->load->view("include/footer");
	}
	
	public function detail_achat($id){
	    $data['row'] = $this->form->get_row_query('SELECT * FROM info WHERE id_info=1 ');
	    $data['info'] = $this->form->get_row_query('SELECT * FROM depots,fournisseur,ligne_commande,type_commande WHERE id_type=id_type_ligne AND id_frs=id_frs_ligne AND id_depot=id_depot_ligne AND id_ligne='.$id );
	    $data['list'] = $this->form->get_data_query('SELECT * FROM articles,ligne_commande,list_commande WHERE id_art=id_art_list AND id_ligne=id_ligne_list AND id_ligne='.$id );
	    $this->load->view("include/header");	
		$this->load->view("facture/detail_facture",$data);	
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
	
	
	// Ajax
	public function add_facture(){
    	$this->form_validation->set_rules('frs', 'frs', 'trim');
		
		if ($this->form_validation->run() != false) { 
		    //  SELECT `id_ligne`, `id_frs_ligne`, `id_depot_ligne`, `pay_ligne`, `numeros_ligne`, `visible_ligne`, `created_ligne` FROM `ligne_commande` WHERE 1
		    $data = array(
                    'id_frs_ligne'      => $this->input->post('frs'),
                    'id_depot_ligne'     => $this->input->post('depot'),
                    'pay_ligne'      => $this->input->post('pay'),
                    'numeros_ligne'     => $this->input->post('num'),
                    'id_type_ligne'     => 1,
                    'date_ligne'     => $this->input->post('date')
            ); 
            if($this->form->add_data('ligne_commande',$data)){
                $data['fact'] = $this->form->get_row_query('SELECT MAX(id_ligne) as id FROM `ligne_commande` LIMIT 1');
                echo json_encode($data);
		    }else{
				echo json_encode('error d`ajouter');
		    }
		}else{
		    echo json_encode('error de submission');
		}
	}
	
	// Ajax
	public function add_bon(){
    	$this->form_validation->set_rules('frs', 'frs', 'trim');
		
		if ($this->form_validation->run() != false) { 
		    //  SELECT `id_ligne`, `id_frs_ligne`, `id_depot_ligne`, `pay_ligne`, `numeros_ligne`, `visible_ligne`, `created_ligne` FROM `ligne_commande` WHERE 1
		    $data = array(
                    'id_frs_ligne'      => $this->input->post('frs'),
                    'id_depot_ligne'     => $this->input->post('depot'),
                    'pay_ligne'      => $this->input->post('pay'),
                    'numeros_ligne'     => $this->input->post('num'),
                    'id_type_ligne'     => 2,
                    'date_ligne'     => $this->input->post('date')
            ); 
            if($this->form->add_data('ligne_commande',$data)){
                $data['fact'] = $this->form->get_row_query('SELECT MAX(id_ligne) as id FROM `ligne_commande` LIMIT 1');
                echo json_encode($data);
		    }else{
				echo json_encode('error d`ajouter');
		    }
		}else{
		    echo json_encode('error de submission');
		}
	}
	
	// Ajax
	public function add_avoire(){
    	$this->form_validation->set_rules('frs', 'frs', 'trim');
		
		if ($this->form_validation->run() != false) { 
		    //  SELECT `id_ligne`, `id_frs_ligne`, `id_depot_ligne`, `pay_ligne`, `numeros_ligne`, `visible_ligne`, `created_ligne` FROM `ligne_commande` WHERE 1
		    $data = array(
                    'id_frs_ligne'      => $this->input->post('frs'),
                    'id_depot_ligne'     => $this->input->post('depot'),
                    'pay_ligne'      => $this->input->post('pay'),
                    'numeros_ligne'     => $this->input->post('num'),
                    'id_type_ligne'     => 3,
                    'date_ligne'     => $this->input->post('date')
            ); 
            if($this->form->add_data('ligne_commande',$data)){
                $data['fact'] = $this->form->get_row_query('SELECT MAX(id_ligne) as id FROM `ligne_commande` LIMIT 1');
                echo json_encode($data);
		    }else{
				echo json_encode('error d`ajouter');
		    }
		}else{
		    echo json_encode('error de submission');
		}
	}
	
	//Ajax
    public function add_art_facture(){
        
		$this->form_validation->set_rules('id_art', 'id_art', 'trim'); 
		
		if ($this->form_validation->run() === false) { 
            echo json_encode('error de submission');
		} else {  
    		//      SELECT `id_list`, `id_art_list`, `qte_list`, `remise_list`, `tva_list`, `ht_list`, `ttc_list`, `id_ligne_list`, `visible_list`, `create_list` FROM `list_commande` WHERE 1
    		$id = $this->input->post('id_ligne');
		    $data = array('id_art_list'=> $this->input->post('id_art') ,
                            'qte_list'=> $this->input->post('qte_cmd') ,
                            'id_ligne_list'=> $id,
                            'remise_list'=> $this->input->post('remise') ,
                            'tva_list'=> $this->input->post('tva') ,
                            'ht_list'=> $this->input->post('ht') ,
                            'ttc_list'=> $this->input->post('ttc') ,
                            );
                             
		    if($this->form->add_data('list_commande',$data)){
    			echo json_encode('Bien Ajouter');
		    }else{
				echo json_encode('error d`ajouter');
		    }
		}
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
