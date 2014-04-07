<?php

class session {
	public static function exists($session) {
		return (isset($_SESSION[$session])) ? true : false;
	}

	public static function make($name, $value) {
		return $_SESSION[$name] = $value;
	}

	public static function get($session) {
		return $_SESSION[$session];
	}

	public static function delete($session) {
		if (self::exists($session))
			unset($_SESSION[$session]);
	}

	public static function flash($session, $msg = null) {
		if(self::exists($session)) {
			$sesija = self::get($session);
			self::delete($session);

			return $sesija;
		} else
			self::make($session, $msg);
	}
}

?>