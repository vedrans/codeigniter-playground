<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
	{
		parent:: __construct();
		$this->layout->placeholder("title", "Vedran's CI test app");

	}

	 
	public function index()
	{
		
		//$this->load->view('welcome_message');
		$this->layout->view('welcome_message');
	}
	
	public function loginfb(){
	
		if(isset($_POST['id'])){
			$sess_array = array(
	         'fbid' 		=> $this->input->post('id'),
	         'username' 	=> $this->input->post('username'),
	         'name' 		=> $this->input->post('name'),
	         'firstname' 	=> $this->input->post('first_name'),
	         'email' 		=> $this->input->post('email')
	       );
	       $this->session->set_userdata('logged_in', $sess_array);
	       
	       echo json_encode('ok');
	       
		}else{
			echo 'No you can\'t!';
		}
	
	}
	
	public function logout(){
		$this->session->set_userdata('logged_in', false);
		$this->load->helper('url');
		redirect('/welcome/index', 'refresh');
	}
	
	public function test(){
		$this->layout->view('test');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */