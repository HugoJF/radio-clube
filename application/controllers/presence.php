	<?php if (!defined('BASEPATH'))
		exit('No direct script access allowed');

		class Presence extends CI_Controller {

			public function index() {
				//Verify if User can access this controller
				verify_access(array(1, 2));

				//Get current user info
				$the_user = $this->ion_auth->user()->row();

				//Get all presences from user
				$presences = $this->radioc_model->get_actual_presences_from_user($the_user->id);

				//Prepare array to insert game data
				$games_info = array();

				//Populate array with games information
				foreach ($presences->result() as $presence) {
					$game                           = $this->radioc_model->get_game($presence->id_game);
					$game                           = $game->first_row();
					$games_info[$presence->id_game] = $game;
				}

				$this->load->view('header');
				$this->load->view('presence_view', array(
					'presences'  => $presences,
					'games_info' => $games_info
				));
				$this->load->view('footer');
			}

			public function add($game_id) {
				//Verify if User can access this controller
				verify_access(array(1, 2));

				//Get user info
				$the_user = $this->ion_auth->user()->row();

				//Add user presence and stores result
				$result = $this->radioc_model->add_presence($the_user->id, $game_id);

				//Display final page according to result
				switch ($result) {
					case '1':
						$this->session->set_flashdata('message', $this->lang->line('presence_added'));
						redirect(base_url('dashboard/'));
						break;

					case 'Presence already exists':
						$this->session->set_flashdata('message', $this->lang->line('presence_exists'));
						redirect(base_url('dashboard/'));
						break;

					case 'User already is present for a game in this day':
						$this->session->set_flashdata('message', $this->lang->line('presence_already_today'));
						redirect(base_url('dashboard/'));
						break;

					case 'Game max users reached':
						$this->session->set_flashdata('message', $this->lang->line('presence_max_users'));
						redirect(base_url('dashboard/'));
						break;

					default:
						$this->session->set_flashdata('message', $this->lang->line('error_unknown'));
						redirect(base_url('dashboard/'));
						break;
				}
			}

			public function remove($id = -1) {
				//Verify if User can access this controller
				verify_access(array(1, 2));

				//Verify if required parameter is given
				if ($id == -1)
					throw new Exception($this->lang->line('error_missing_parameter'));

				//Delete presence from database
				$this->db->delete('presence', array(
					'id' => $id
				));
				$this->session->set_flashdata('message', $this->lang->line('presence_removed'));
				redirect(base_url('presence'));
			}

			public function remove_dash($user_id = -1, $game_id = -1) {
				//Verify if User can access this controller
				verify_access(array(1, 2));

				//Verify if required parameter is given
				if ($user_id == -1 || $game_id == -1)
					throw new Exception($this->lang->line('error_missing_parameter'));
				$this->db->delete('presence', array(
					'id_game' => $game_id,
					'id_user' => $user_id
				));
				$this->session->set_flashdata('message', $this->lang->line('presence_removed'));
				redirect(base_url('dashboard/'));
			}
		}







		/* End of file welcome.php */
		/* Location: ./application/controllers/welcome.php */