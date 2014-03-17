<?php if(! defined('BASEPATH'))
	exit('No direct script access allowed');

	class Login extends CI_Controller {

		public function index() {
			$this->lang->load('radioc');
			$this->form_validation->set_error_delimiters('<p class="text-error">', '</p>');
			$this->form_validation->set_rules('identity', $this->lang->line('login_email'), 'required');
			$this->form_validation->set_rules('password', $this->lang->line('login_password'), 'required');

			//Checks if Identity/Email and password are given
			if($this->form_validation->run() == TRUE) {

				//Executes login
				if($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), FALSE)) {
					//Verify if user is confirmed
					if($this->ion_auth->in_group(3) == TRUE) {
						$logout = $this->ion_auth->logout();
						$this->session->set_flashdata('message', '<p class="text-error">' . $this->lang->line('error_unactive_account') . '</p>');
						redirect('/login/', 'refresh');

						return FALSE;
					}

					//If the login is successful redirect them back to the home page
					$the_user = $this->ion_auth->user()->row();
					redirect('/dashboard/', 'refresh');
				} else {
					//If the login was un-successful redirect them back to the login page
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					redirect('/login/', 'refresh');
				}

			} else {
				//Missing Identity/Email, password or not logging in
				$this->load->view('login_view');
			}
		}
	}

?>