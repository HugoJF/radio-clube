<?php if(! defined('BASEPATH'))
	exit('No direct script access allowed');

	class Control_Panel extends CI_Controller {

		public function index() {
			//Verify if User can access this controller
			verify_access(1);

			//Load page to add more options
			$this->load->view('header');
			$this->load->view('control_panel_view');
			$this->load->view('footer');
		}

		public function add() {
			//Verify if User can access this controller
			verify_access(1);

			//Check required variables
			if(! isset($_POST['day']) || ! isset($_POST['hours']) || ! isset($_POST['minutes'])) {
				$this->session->set_flashdata('error', $this->lang->line('error_missing_parameter'));
				redirect('control_panel/', 'refresh');
			}

			//Create string with option
			$value = $_POST['day'] . ' ' . intval($_POST['hours']) . ':' . intval($_POST['minutes']);

			//Checks if this options is already added
			if($this->db->get_where('options', array('name' => 'game_date', 'value' => $value))->num_rows() == 0) {
				//No option in database, adding it.
				$data = array('name' => 'game_date', 'value' => $value);
				$this->db->insert('options', $data);

				$this->session->set_flashdata('message', $this->lang->line('control_panel_game_added'));
				redirect(base_url('control_panel/list_games'));
			} else {
				//Option is already in database
				$this->session->set_flashdata('message', $this->lang->line('control_panel_game_exists'));
				redirect(base_url('control_panel/list_games'));
			}
		}

		public function remove($id = -1) {
			//Verify if User can access this controller
			verify_access(1);

			//Check if required parameter is given
			if($id == - 1)
				throw new Exception($this->lang->line('error_missing_parameter'));

			$this->db->delete('options', array('id' => $id));
			$this->session->set_flashdata('message', $this->lang->line('control_panel_game_removed'));
			redirect(base_url('control_panel/list_games'));
		}

		public function list_games() {
			//Verify if User can access this controller
			verify_access(1);

			$options = $this->db->get_where('options', array('name' => 'game_date'));
			$this->load->view('header');
			$this->load->view('control_panel_list_view', array('options' => $options));
			$this->load->view('footer');
		}
	}

?>