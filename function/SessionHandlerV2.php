<?php
/**
 * Description of SessionHandlerV2
 *
 * @author rjs
 */
class SessionHandlerV2 {
	public static function start() {
		return session_start();
	}
	public static function stop() {
		return session_destroy();
	}
	public static function isEmpty($name) {
		return empty($_SESSION[$name]);
	}
	public static function set($name, $value) {
		if(is_object($value) && get_class($value) == "Core") {
			$_SESSION[$name] = $value->toArray();
			$_SESSION[$name]['ob_h'] = 1;
		} else if(is_object($value)) {
			$_SESSION[$name] = get_object_vars($value);
			$_SESSION[$name]['ob_h'] = 1;
		} else {
			$_SESSION[$name] = $value;
		}
	}
	public static function get($name) {
		if (!isset($_SESSION[$name])) {
			return null;
		}
		$ses_data = $_SESSION[$name];
		if(is_array($ses_data) && $ses_data['ob_h'] == 1) {
			$ses_data = (object)$ses_data;
		}
		return $ses_data;
	}
	public static function delete($name) {
		unset($_SESSION[$name]);
	}
	public static function isLoggedIn() {
		return $_SESSION['Logged'];
	}
	public static function loggedIn() {
		$_SESSION['Logged'] = true;
	}
	public static function loggedOut() {
		$_SESSION['Logged'] = false;
	}
}