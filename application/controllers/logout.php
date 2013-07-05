<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index() {
		$logout = $this->ion_auth->logout();

		//Redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('login', 'refresh');
	}
}

?>