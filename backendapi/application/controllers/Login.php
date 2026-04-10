<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(1);
ini_set('display_errors',1);

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
       //  $this->load->library('session');
         $this->load->model('login_model');
         	    $this->load->library('form_validation');

    }

	public function index(){

	    $data['controller']			= $this->router->class;	
		$data['reset_link']			= base_url().$data['controller'].'/';
		$main		            	= $data['controller'].'/index';
        $this->load->view($main,$data);
       
	}

 public function do_login(){

        header('Content-Type: application/json');

        $admin_user = $this->input->post('admin_user');
        $admin_pwd  = $this->input->post('admin_pwd');

        $this->load->model('login_model');

        $user = $this->login_model->login($admin_user, $admin_pwd);

        if ($user) {

            $session_data = array(
                'id' => $user[0]['admin_id']
            );

            $this->session->set_userdata('sen_id', $session_data);

            echo json_encode([
                'status' => true,
                'message' => 'Login successful'
            ]);

        } else {

            echo json_encode([
                'status' => false,
                'message' => 'Invalid Credentials'
            ]);
        }
    }
  public function logout(){

  
    $this->session->sess_destroy();

    // optional: cookie clear (extra safe)
    delete_cookie('ci_session');

    // redirect to login
    redirect('login');
}

}

