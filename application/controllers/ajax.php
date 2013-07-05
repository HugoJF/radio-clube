<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Ajax extends CI_Controller {

		public function index() {
		}

		public function notificator() {
			verify_access(1);

			$this->load->view('header');
			$this->load->view('notificator_view');
		}

		public function get_new_notifications($notif_id) {
			verify_access(1);

			$query  = $this->radioc_model->get_new_notifications($notif_id);
			$result = $query->result_array();


			echo json_encode($result);
		}
	}

	/* End of file welcome.php */
	/* Location: ./application/controllers/welcome.php */