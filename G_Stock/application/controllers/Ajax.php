
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        if(!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != true)
		{
			redirect('login');	
		}

    }

	public function index()
	{ }

	public function get_all_article()
	{
		$data =  array( 'data' => $this->form->get_data_query('SELECT * FROM articles WHERE 1 ORDER BY article_art ASC') ); 
        echo json_encode($data);		
	}
	

	public function add_article(){
		
	            $this->form_validation->set_rules('titre_art', 'titre_art', 'trim');
	            $this->form_validation->set_rules('reference', 'reference', 'trim');
	            $this->form_validation->set_rules('designiation', 'designiation', 'trim');
	            $this->form_validation->set_rules('pu', 'pu', 'trim');
	            $this->form_validation->set_rules('qte', 'qte', 'trim');
	            $this->form_validation->set_rules('frs', 'frs', 'trim');

				if ($this->form_validation->run() != false) {

    	            $art = $this->input->post("titre_art");
    	            $ref = $this->input->post("reference");
    	            $desi = $this->input->post("designiation");
    	            $pu = $this->input->post("pu");
    	            $qte = $this->input->post("qte");
    	            $frs = $this->input->post("frs");
    	            
    	            $data = array('article_art' => $art,
	                                'ref_art' => $ref,
	                                'desi_art' => $desi,
	                                'qte_art' => $qte,
	                                'pv_art' => $pu,
	                                'id_frs_art' => $frs
	                                );
    	            $checking = $this->form->add_data('articles', $data ); 
    	            
    	            if ($checking != FALSE) {
    	               echo json_encode(true);
    	            }else{
    	            	echo json_encode('error de l"inserssion ');
    	            }
				}else{
					echo json_encode('error de submession !!');
	            }
		          
	}
	
	public function views(){
	     $data = new stdClass();  
	    
	    if($this->form->get_data_query('SELECT * FROM abs,stg,module,groups WHERE id_module = id_module_abs AND id_groups_module = id_groups AND id_stg_abs = id_stg ORDER BY id_stg ASC')){
	        $data = array('data' => $this->form->get_data_query('SELECT * FROM abs,stg,module,groups WHERE id_module = id_module_abs AND id_groups_module = id_groups AND id_stg_abs = id_stg ORDER BY id_stg ASC') );
	        
			$this->load->view("include/header");	
    		$this->load->view("abs/view",$data);	
    		$this->load->view("include/footer");
	    }else{ 
			$this->load->view("include/header");	
    		$this->load->view("abs/add");	
    		$this->load->view("include/footer");
	    }
	    
	}
	
	public function update(){
	    
	    $this->load->view("include/header");	
		$this->load->view("abs/maj");	
		$this->load->view("include/footer");
	    
	}
	
	public function delete(){
	    
	    $this->load->view("include/header");	
		$this->load->view("abs/maj");	
		$this->load->view("include/footer");
	    
	}
	
	public function maj(){
	    
	    $this->load->view("include/header");	
		$this->load->view("abs/maj");	
		$this->load->view("include/footer");
	    
	}


}
