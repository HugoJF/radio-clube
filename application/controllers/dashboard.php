<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

		public function index() {
			//Verify if User can access this controller
			verify_access(array(1, 2), '/');

			$the_user = $this->ion_auth->user()->row();

			$this->load->view('header');
			$this->load->view('dashboard_view', array(
				'available_games' => $this->radioc_model->get_games_24h()
			));
			$this->load->view('footer');
		}
	}

?>