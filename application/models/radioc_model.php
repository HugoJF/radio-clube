<?php

class RadioC_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
		
		/***************************|
		|*Check for uncreated games*|
		|***************************/
		//Get all game dates options
		$options = $this->db->get_where('options', array('name' => 'game_date'));
		
		//Get all games created in database
		$games = $this->get_current_games();
		
		//Push to array formated date of created games
		$games_dates = array();
		foreach($games->result() as $game) {
			array_push($games_dates, date('Y-m-d H:i:s', strtotime($game->date)));
		}
		
		//Push to array formated dates of game dates options
		foreach($options->result() as $option) {
		
			//Check if option is already present in database to create it
			if(!in_array(date('Y-m-d H:i:s', strtotime($option->value)), $games_dates)) {
				if(strtotime($option->value) < time() + 24 * 60 * 60 ) {
					$data = array(
						'date' => date('Y-m-d H:i:s', strtotime($option->value))
					);
					$this->db->insert('games', $data);
				}
			}
		}
    }
	
    /*******************|
	|** GET FUNCTIONS **|
	|*******************/
	
	//Returns the number of presences in reference to a single game
	function get_presence_number($id = -1) {
		if($id == -1) return FALSE;
		$query = $this->db->query('SELECT COUNT(*) FROM `' . $this->db->dbprefix('presence') . '` WHERE `id_game` = ' . $id);
		$query = $query->row_array(0);
		return $query['COUNT(*)'];
	}
	
	//Return the max number os users presences per game
	function get_max_users_game() {
		return 12;
	}
	
	//Returns all games in database
	function get_all_games() {
		$query = $this->db->get('games');
		return $query;
	}
	
	//Returns all games within a period
	function get_games($starting = -1, $ending = -1) {
		if($starting == -1 || $ending == -1) throw new Exception('No STARTING or ENDING period specified!');
		$starting = date('Y-m-d H:i:s', $starting);
		$ending = date('Y-m-d H:i:s', $ending);
		$this->db->from('games');
		$this->db->where("date >= $starting AND date <= $ending");
		$query = $this->db->get();
		return $query;
	}
	
	//Returns all games from array
	function get_games_from_array($games_ids = -1) {
		if($games_ids == -1) throw new Exception('No games ids array defined');
		$this->db->from('games');
		$this->db->where_in('id', $games_ids);
		$query = $this->db->get();
		return $query;
	}
	//Returns all games that will happen
	function get_current_games() {
		$this->db->from('games');
		$this->db->where('date > now()');
		$query = $this->db->get();
		return $query;
	}

	
	//Returns games from 24h period
	function get_games_24h() {
		$starting = date('Y-m-d H:i:s', time());
		$ending = date('Y-m-d H:i:s', time() + (24 * 60 * 60));
		$this->db->from('games');
		$this->db->where("date >= '$starting' AND `date` <= '$ending'");
		$query = $this->db->get();
		return $query;
	
	}
	
	//Return all games from the current day
	function get_games_today() {
		$starting = date('Y-m-d H:i:s', strtotime(date('d F Y')));
		$ending = date('Y-m-d H:i:s', strtotime(date('d F Y')) + (24*60*60-1));
		$this->db->from('games');
		$this->db->where("date >= '$starting' AND `date` <= '$ending'");
		$query = $this->db->get();
		return $query;
	}
	
	//Return game from ID
	function get_game($game_id = -1) {
		if($game_id == -1) throw new Exception('No GAMEID specified!');
		$query = $this->db->get_where('games', array('id' => $game_id));
		return $query;
	}
	
	//Return user from ID
	function get_user($user_id = -1) {
		if($user_id == -1) throw new Exception('No USERID defined');
		$query = $this->db->get_where('users', array('id' => $user_id));
		return $query;
	}
	
	//Return game from specific day
	function get_games_from_date($date = -1) {
		if($date == -1) throw new Exception('No DATE specified!');
		$starting = date('Y-m-d H:i:s', strtotime($date));
		$ending = date('Y-m-d H:i:s', strtotime($date) + (24*60*60-1));
		$this->db->from('games');
		$this->db->where("date >= '$starting' AND `date` <= '$ending'");
		$query = $this->db->get();
		return $query;
	}
	
	//Return game from exact date and time
	function get_game_from_datetime($date = -1) {
		if($date == -1) throw new Exception('No DATE specified!');
		$thedate = date('Y-m-d H:i:s', strtotime($date));
		$this->db->from('games');
		$this->db->where("date = '$thedate'");
		$query = $this->db->get();
		return $query;
	}
	
	//Return presence from ID
	function get_presence($presence_id) {
		if($presence_id == -1) throw new Exception('No PRESENCEID specified!');
		$query = $this->db->get_where('presence', array('id' => $presence_id));
		return $query;
	}
	
	//Return all presences from user
	function get_presences_from_user($user_id = -1) {
		if($user_id == -1) return FALSE;
		$query = $this->db->get_where('presence', array('id_user' => $user_id));
		return $query;
	}
	
	//Return all presences from user older than now
	function get_actual_presences_from_user($user_id = -1) {
		if($user_id == -1) return FALSE;
		$query = $this->db->query('SELECT * FROM `' . $this->db->dbprefix('presence') . '` WHERE `id_game` IN(SELECT `id` FROM `' . $this->db->dbprefix('games') . '` WHERE date > now()) AND `id_user` = ' . $user_id);
		return $query;
	}
	
	//Return all presences from game
	function get_presences_from_game($game_id = -1) {
		if($game_id == -1) throw new Exception('No GAMEID specified!');
		$query = $this->db->get_where('presence', array('id_game' => $game_id));
		return $query;
	}
	
	//Return presence from user and game
	function get_presences_from_user_game($user_id = -1, $game_id = -1) {
		if($user_id == -1 || $game_id == -1) throw new Exception('No USERID or GAMEID specified!');
		$query = $this->db->get_where('presence', array('id_game' => $game_id, 'id_user' => $user_id));
		return $query;
	}
	
	//Return is user is present in game
	function is_user_present($user_id = -1, $game_id = -1) {
		if($user_id == -1 || $game_id == -1) throw new Exception('No USERID or GAMEID defined');
		$query = $this->db->get_where('presence', array('id_game' => $game_id, 'id_user' => $user_id));
		if($query->num_rows == 0) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	/******************|
	|*INSERT FUNCTIONS*|
	|******************/
	
	//Insert game into database
	function add_game($date = -1) {
		if($date == -1) throw new Exception('No DATE specified');
		if($this->get_game_from_datetime($date)->num_rows != 0) return 'A game already exists at this Date';
		$data = array(
			'date' => date('Y-m-d H:i:s', strtotime($date))
		);
		$this->db->insert('games', $data);
		return TRUE;
	}
	
	//Check and insert user presence
	function add_presence($user_id = -1, $game_id = -1) {
		if($user_id == -1 || $game_id == -1) throw new Exception('No USERID or GAMEID specified');
		if($this->get_presences_from_user_game($user_id, $game_id)->num_rows() != 0) return 'Presence already exists';
		if($this->radioc_model->get_presence_number($game_id) >= $this->get_max_users_game()) return 'Game max users reached';
		//Get the date from the game trying to add the presence
		$the_game = $this->get_game($game_id)->result();
		$the_game_date = $the_game[0]->date;
		
		//Get all games IDs from the day of the game
		$games_from_day = $this->get_games_from_date(date('d F Y', strtotime($the_game_date)));
		$game_ids = array();
		foreach($games_from_day->result() as $game) {
			array_push($game_ids, $game->id);
		}
		//Get presence from as games listed in the same day
		$this->db->from('presence');
		$this->db->where('id_user', $user_id);
		$this->db->where_in('id_game', $game_ids);
		$presence = $this->db->get();
		//Check user presence in a game from the same day
		if($presence->num_rows() != 0) return 'User already is present for a game in this day';
		$data = array(
			'id_user' => $user_id,
			'id_game' => $game_id,
			'date' => date('Y-m-d H:i:s', time())
		);
		$this->db->insert('presence', $data);
		return TRUE;
	}
}

?>