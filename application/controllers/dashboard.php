<?php if(! defined('BASEPATH'))
	exit('No direct script access allowed');

	class Dashboard extends CI_Controller {

		public function index() {
			//Verify if User can access this controller
			if(!$this->ion_auth->logged_in()) {
				//redirect('/', 'refresh');
				die('not logged');
			}
			if(!$this->ion_auth->in_group(array(2))) {
				//$this->ion_auth->logout();
				//redirect('/', 'refresh');
				die('not in group');
			}

			$the_user = $this->ion_auth->user()->row();

			$this->load->view('header');
			$this->load->view('dashboard_view', array('available_games' => $this->radioc_model->get_games_24h()));
			$this->load->view('footer');
		}
		
		public function parse_data() {
			$data       = $this->load->view('login_csv_data', '', TRUE);
			$data_line  = preg_split('/\n/', $data);
			$data_final = array();
			foreach($data_line as $l) {
				if(! isset($l))
					continue;
				$exploded = explode(',', $l);
				if(! isset($exploded[0]) || ! isset($exploded[1]) || ! isset($exploded[2]) || ! isset($exploded[3]) || ! isset($exploded[4]))
					continue;
				if($exploded[0] == '' || $exploded[1] == '' || $exploded[2] == '' || $exploded[3] == '' || $exploded[4] == '')
					continue;
				list($id, $name, $type, $bd, $gender) = $exploded;

				//parse id

				$hifen = explode('-', $id);
				$final = str_replace('.', '', $hifen[0]);

				array_push($data_final, array('original_rid' => $id, //rid
											  'login_rid'    => $final, //username
											  'name'         => $name, //firstname
											  'type'         => $type, //type
											  'birthday'     => $bd, //birthday
											  'gender'       => $gender //gender
										));
			}

			
			echo '<pre>';
			print_r($data_final);
			echo '</pre>';
			foreach($data_final AS $user) {
				$username = $user['login_rid'];
				$password = 'password';
				$email    = str_replace(' ', '', $user['name']) . '_' . $user['original_rid'] . '@email.com';
				list($day, $month, $year) = explode('/', $user['birthday']);
				$birthday = strtotime($month . '/' . $day . '/' . $year);
				$add_data = array('first_name' => $user['name'], //full name, no separation from last name
								  'rid'        => $user['original_rid'], //original rid for future references
								  'gender'     => $user['gender'], //gender for future refereces
								  'birthday'   => $birthday, //unix time bd
								  'type'       => $user['type']); //uer type

				$this->ion_auth->register($username, $password, $email, $add_data, array('2'));
			}
		}

	}