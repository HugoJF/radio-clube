<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');

	class Register extends CI_Controller {

		public function index() {
			$this->load->view('header', array(
				'the_user' => $this->ion_auth->user()->row()
			));
			$this->load->view('register_view');
			$this->load->view('footer');
		}

		public function token_check($token = -1) {
			$query = $this->db->get_where('tokens', array(
				'value' => $token
			));

			if ($query->num_rows() == 0) {
				$this->form_validation->set_message('token_check', $this->lang->line('register_invalid_token'));
				return FALSE;
			} else {
				return TRUE;
			}
		}

		public function with_token() {
			$this->form_validation->set_error_delimiters('<p class="text-error">', '</p>');
			$this->form_validation->set_rules('identity', 'E-mail', 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'required|matches[password]');
			$this->form_validation->set_rules('name', 'name', 'required|is_unique[users.username]');
			$this->form_validation->set_rules('token', 'Token', 'required|exact_length[3]|callback_token_check');

			if ($this->form_validation->run() == TRUE) {
				$name      = $_POST['name'];
				$password  = $_POST['password'];
				$email     = $_POST['identity'];
				$more_data = array(
					'first_name' => $name
				);
				$this->ion_auth->register($name, $password, $email, $more_data, array('2'));
				$this->db->delete('tokens', array(
					'value' => $_POST['token']
				));
				$this->radioc_model->add_new_notification('MESSAGE', 'The user ' . $name . ' just registered with the TOKEN: ' . $_POST['token'] . '.');
				$this->load->view('header', array(
					'the_user' => $this->ion_auth->user()->row()
				));
				$this->load->view('message', array(
					'message' => 'Registered',
					'link'    => base_url() . 'login/'

				));

			} else {
				$this->load->view('header');
				$this->load->view('with_token_register_view');
				$this->load->view('footer');
			}
		}

		public function without_token() {
			$this->form_validation->set_error_delimiters('<p class="text-error">', '</p>');
			$this->form_validation->set_rules('identity', $this->lang->line('login_email'), 'required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', $this->lang->line('login_password'), 'required|min_length[4]|max_length[32]|alpha_dash');
			$this->form_validation->set_rules('password_conf', $this->lang->line('login_password_conf'), 'required|matches[password]');
			$this->form_validation->set_rules('name', $this->lang->line('login_name'), 'required|is_unique[users.username]');

			if ($this->form_validation->run() == TRUE) {
				$name      = $_POST['name'];
				$password  = $_POST['password'];
				$email     = $_POST['identity'];
				$more_data = array(
					'first_name' => $name
				);
				$this->ion_auth->register($name, $password, $email, $more_data, array('3'));
				$this->session->set_flashdata('message', $this->lang->line('registered'));
				redirect(base_url('login/'));
				$this->load->view('registered');

			} else {
				$this->load->view('header');
				$this->load->view('without_token_register_view');
				$this->load->view('footer');
			}
		}

		public function generate_token() {
			$this->output->enable_profiler(TRUE);
			while (TRUE) {
				$rand  = rand(100, 999);
				$query = $this->db->get_where('tokens', array(
					'value' => $rand
				));
				if ($query->num_rows() == 0)
					break;
			}
			$this->db->insert('tokens', array('value' => $rand));
			$this->load->view('header', array(
				'the_user' => $this->ion_auth->user()->row()
			));
			$this->load->view('token_view', array(
				'token' => $rand
			));
			$this->load->view('footer');
		}
	}

?>