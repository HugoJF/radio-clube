<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Main extends CI_Controller {

		public function index() {
			//Forwards flashdata messages to next page
			$this->session->keep_flashdata('message');
			$this->session->keep_flashdata('error');

			//Redirects user to correct controller
			if (!$this->ion_auth->logged_in()) {
				//Not logged in
				redirect('login', 'refresh');
			} elseif ($this->ion_auth->is_admin()) {
				//Administrator
				redirect('dashboard', 'refresh');
			} else {
				//Normal user
				redirect('dashboard', 'refresh');
			}
		}
	}