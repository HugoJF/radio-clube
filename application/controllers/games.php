<?php if(! defined('BASEPATH'))
	exit('No direct script access allowed');

	class Games extends CI_Controller {

		public function index() {

			redirect('dashboard', 'refresh');

		}

		public function detail($id = -1) {
			//Load language file
			$this->lang->load('radioc');
			//Verify access
			verify_access(1);

			//No id set
			if($id == - 1)
				redirect('dashboard', 'refresh');

			$this->load->view('header');
			$this->load->view('games_detail_view', array('game'           => $this->radioc_model->get_game($id),
														 'game_presences' => $this->radioc_model->get_presences_from_game($id)));
		}
	}