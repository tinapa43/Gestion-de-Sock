<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stocks extends CI_Controller {

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
	
	public function add_article(){
	    
	    $this->form_validation->set_rules('titre_art', 'titre_art', 'trim');
        $this->form_validation->set_rules('reference', 'reference', 'trim');
        $this->form_validation->set_rules('designiation', 'designiation', 'trim');
        $this->form_validation->set_rules('pu', 'pu', 'trim');
        $this->form_validation->set_rules('qte', 'qte', 'trim');

		if ($this->form_validation->run() != false) {

            $art = $this->input->post("titre_art");
            $ref = $this->input->post("reference");
            $desi = $this->input->post("designiation");
            $pu = $this->input->post("pu");
            $qte = $this->input->post("qte");
            $frs = $this->input->post("frs");
            $famill = $this->input->post("famill"); 
            $unite = $this->input->post('unite');
            $depot = $this->input->post('depot');
            
            $data = array('article_art' => $art,
                            'ref_art' => $ref,
                            'desi_art' => $desi,
                            'qte_min_art' => $qte,
                            'pv_art' => $pu,
                            'id_famill_art' => $famill,
                            'unite_art' => $unite
                            );
            $checking = $this->form->add_data('articles', $data ); 
            $row = $this->form->get_row_query('SELECT * FROM `articles` WHERE `ref_art` =\''.$ref.'\'');
            
            if ($checking != FALSE) {
                //  SELECT `id_stock`, `qte_stock`, `id_depot_stock`, `id_art_stock`, `visible_stock`, `create_stock` FROM `stocks_depot` WHERE 1
                
                $data = array('id_art_stock' => $row->id_art,
                                'id_depot_stock' => $depot );
                $this->form->add_data('stocks_depot', $data );             
                            
               	$data['msg'] = 'Bien Ajouter';
            }else{
               $data['msg'] = 'Probleme a insertion !!';
            }
		}

        $data['frs'] = $this->form->get_data_query('SELECT * FROM fournisseur WHERE 1 ORDER BY nom_frs ASC');
        $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY id_depot ASC');
        $data['unite'] = $this->form->get_data_query('SELECT * FROM unites WHERE 1 ORDER BY unite ASC');
        $data['famill'] = $this->form->get_data_query('SELECT * FROM famills WHERE 1 ORDER BY famill ASC');
		$this->load->view("include/header");	
		$this->load->view("Stocks/Add_stock",$data);	
		$this->load->view("include/footer");
	    
	}
	
	public function list_article($id=null){
	    if(!isset($id)) 
	        $data['data'] = $this->form->get_data_query('SELECT * FROM articles,famills WHERE id_famill = id_famill_art ORDER BY id_art ASC');
	    else 
	        $data['data'] = $this->form->get_data_query('SELECT * FROM articles,famills WHERE id_famill = id_famill_art ORDER BY id_art ASC LIMIT '.($id*100-100).', 100');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/list_article",$data);	
    	$this->load->view("include/footer");
	}
	
	//ajax 
	public function get_stock_article(){
        $this->form_validation->set_rules('id', 'id', 'trim');

		if ($this->form_validation->run() != false) {
            $id = $this->input->post("id");

            $data['article'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot,depots WHERE id_art=id_art_stock AND id_art=id_art_stock AND id_depot=id_depot_stock AND id_depot='.$id.'  ORDER BY id_art ASC');
    	    echo json_encode($data);
		}
		else{
		    echo json_encode("Error de submession ");
		}
    }
	//ajax 
	public function get_article(){
     
        $data['article'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot WHERE id_art=id_art_stock  ORDER BY article_art ASC');
	    echo json_encode($data);

    }
    
    
	public function load_stock(){
	    $data['depot'] = $this->form->get_data_query('SELECT * FROM depots WHERE 1 ORDER BY depot ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/load_stock",$data);	
    	$this->load->view("include/footer");
	    
	}
    
	public function historique_stock(){
	    $data['depot'] = $this->form->get_data_query('SELECT * FROM transfaires,articles WHERE id_art=id_art_trans ORDER BY create_trans DESC');
	    $data['mouve'] = $this->form->get_data_query('SELECT * FROM mouvement,type_mouvement,articles WHERE id_art=id_art_mouve AND type_mouve=id_t_mouve ORDER BY created_mouve DESC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/historique_stock",$data);	
    	$this->load->view("include/footer");
	    
	}
	
	public function list_stock(){
	    //$data['data'] = $this->form->get_data_query('SELECT *,SUM(qte_stock) as qte_stock_t FROM articles,stocks_depot,famills WHERE id_famill = id_famill_art AND id_art=id_art_stock  GROUP BY id_art ORDER BY id_art ASC');
	    //$data['data'] = $this->form->get_data_query('SELECT *,(qte_stock) as qte_stock_t FROM articles,stocks_depot,famills WHERE id_famill = id_famill_art AND id_art=id_art_stock  ORDER BY id_art ASC');
	    $data['data'] = $this->form->get_data_query('SELECT *,SUM(qte_stock) as qte_stock_t FROM articles,stocks_depot,famills WHERE id_famill = id_famill_art AND id_art=id_art_stock GROUP BY id_art ORDER BY id_art ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/list_stock",$data);	
    	$this->load->view("include/footer");
	    
	}
    
    public function Detail_stock($id){
	    $data['data'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot,famills,depots WHERE id_art_stock=id_art AND id_depot=id_depot_stock AND id_famill = id_famill_art AND id_art=id_art_stock AND id_art='.$id.' GROUP BY depot ORDER BY depot ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/detail_stock",$data);	
    	$this->load->view("include/footer");
	    
	}
	
    public function rep_stock(){
        $data['data'] = $this->form->get_data_query('SELECT * FROM articles,stocks_depot WHERE qte_min_art>qte_stock AND id_art=id_art_stock ORDER BY id_art ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/list_rep",$data);	
    	$this->load->view("include/footer");
    }
    
    public function MAJ_Article($id){
        
	    $data['unite'] = $this->form->get_data_query('SELECT * FROM unites WHERE 1 ORDER BY unite ASC');
	    $data['famill'] = $this->form->get_data_query('SELECT * FROM famills WHERE 1 ORDER BY famill ASC');
	    $data['article'] = $this->form->get_row_query('SELECT * FROM articles,stocks_depot,famills WHERE id_famill = id_famill_art AND id_art=id_art_stock AND id_art='.$id.' ORDER BY article_art ASC');
	    $this->load->view("include/header"); 
		$this->load->view("Stocks/maj_article",$data);	
		$this->load->view("include/footer");
    }
    
    public function MAJ_Stock($id){
        $data['depot'] = $this->form->get_row_query('SELECT * FROM depots,stocks_depot WHERE id_depot=id_depot_stock AND id_stock='.$id);
	    $data['famill'] = $this->form->get_data_query('SELECT * FROM famills WHERE 1 ORDER BY famill ASC');
	    $data['article'] = $this->form->get_row_query('SELECT * FROM articles,stocks_depot,famills,depots WHERE id_famill = id_famill_art AND id_depot=id_depot_stock AND id_art=id_art_stock AND id_stock='.$id);
	    $this->load->view("include/header"); 
		$this->load->view("Stocks/maj_stock",$data);	
		$this->load->view("include/footer");
    }
    
	public function stocks(){
	    $data['data'] = $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY article_art ASC');
	    $this->load->view("include/header");	
    	$this->load->view("Stocks/stocks",$data);	
    	$this->load->view("include/footer");
	    
	}
	
	public function update_stock(){
        $this->form_validation->set_rules('article', 'article', 'trim');
	    $this->form_validation->set_rules('qte', 'qte', 'trim');
        $this->form_validation->set_rules('pu', 'pu', 'trim');

		if ($this->form_validation->run() != false) {

            $id_depot = $this->input->post("id_depot");
            $id_art = $this->input->post("id_art");
            $id_stock = $this->input->post("id_stock");
            $prix = $this->input->post("pu");
            $qte = $this->input->post("qte_stock");
            
            $data = array('id_depot_stock' => $id_depot,
                            'id_art_stock' => $id_art,
                            'qte_stock' => $qte,
                            'create_stock' => date("Y-m-d H:i:s")
                            );
            $checking = $this->form->update_data('stocks_depot', $data,'id_stock',$id_stock );
            
            if ($checking != FALSE) {
               	$data['msg'] = 'Bien Modifier';
            }else{
               $data['msg'] = 'Probleme a Modification !!';
            }
		}
			
		redirect(base_url("Stocks/maj_Stock/".$id_stock) );	
	}
	
	public function update_article(){
        $this->form_validation->set_rules('article', 'article', 'trim');
	    $this->form_validation->set_rules('qte', 'qte', 'trim');
        $this->form_validation->set_rules('pu', 'pu', 'trim');

		if ($this->form_validation->run() != false) {

            $id = $this->input->post("id_art");
            $id_mag = $this->input->post("id_stock");
            $art = $this->input->post("article");
            $pu = $this->input->post("pu");
            $qte = $this->input->post("qte");
            //$qte_stock = $this->input->post("qte_stock");
            $ref = $this->input->post("ref");
            $desi = $this->input->post("desi");
            $famille = $this->input->post("famill");
            $unite = $this->input->post('unite');

            $data = array('article_art' => $art,
                            'ref_art' => $ref,
                            'desi_art' => $desi,
                            'qte_min_art' => $qte,
                            'pv_art' => $pu,
                            'id_famill_art' => $famille,
                            'unite_art' => $unite
                            );
            $checking = $this->form->update_data('articles', $data,'id_art',$id );
            //$checking = $this->form->update_query('UPDATE `stocks_depot` SET `qte_stock` = '.$qte_stock.' WHERE `stocks_depot`.`id_mag` ='.$id_mag);
            
            if ($checking != FALSE) {
               	$data['msg'] = 'Bien Modifier';
            }else{
               $data['msg'] = 'Probleme a Modification !!';
            }
		}
			
		redirect(base_url("Stocks/MAJ_Article/".$id) );	
	}

}
