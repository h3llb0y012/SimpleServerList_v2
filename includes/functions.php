<?php

class functions {
	private $_db,
			$_tpl;

	public function __construct() {
		$this->_db = db::getInstance();
		$this->_tpl = new template();
	}

	public function display($file) {
		$this->_tpl->render($file);
	}

	public function assignVars($array = array())
	{
		$this->_tpl->assignVars($array);
		return $this;
	}

	public function admin_login($username, $password) {
		if ($username == get_cfg('account/username') && $password == get_cfg('account/password'))
			return true;
		return false;
	}

	public function server_list() {
		$servers = $this->_db->query("SELECT * FROM `serveri` LIMIT " . get_cfg('limit/value'))->results();

		return $servers;
	}

	public function delete_server($id) {
		if($this->_db->delete('serveri', array('id','=',$id)))
			return true;
		return false;
	}

	public function escape($v) {
		return htmlentities($v, ENT_QUOTES, 'UTF-8');
	}

	public function exists($ip) {
		$check = $this->_db->rowCount("SELECT COUNT(*) FROM `serveri` WHERE `ip` = '$ip'");

		if($check > 0)
			return true;
		return false;
	}

	public function add_server($naziv, $ip) {
		if(!empty($naziv) && !empty($ip)) {

			if(preg_match('/[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\:[0-9]{1,5}/', $ip) && !$this->exists($ip)) {
				$insert = $this->_db->insert('serveri', array(
					'naziv' => $naziv,
					'ip' => $ip
				));

				if ($insert) {
					session::flash('msg',"{$naziv} dodat na listu");

					return true;
				}
			} else
			session::flash('msg','IP nije validan ili server vec postoji!');
		} else
			session::flash('msg','Popunite sva polja!');

		return false;
	}

	public function get_settings($sta = null) {
		if($sta) {
			$upit = $this->_db->get('podesavanja', array('name', '=', $sta));

			return $upit->first();
		}
	}

	public function updateSettings($id, $value) {
		$update = $this->_db->update('podesavanja', $id, array(
			'value' => $value
		));

		if($update) return true;
		return false;
	}

	public function json_decode_bre($ip) {
		$link = "http://api.gametracker.rs/demo/json/server_info/" . $ip;
		$link = @file_get_contents($link);

		$json = json_decode($link, true);

		return $json;
	}
}

?>