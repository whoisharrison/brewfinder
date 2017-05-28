<?php

require_once dirname(__DIR__, 3) . "/php/classes/autoload.php";
require_once dirname(__DIR__, 3) . "/php/lib/xsrf.php";
require_once ("../encrypted-config.php");
use com/michaelharrisonwebdev;

/** api for brewery tag
 *
 * @author michael harrison <mikeharrison34@gmail.com>
 * @version 1.0
 */

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
//start session
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

//grab mySQL statement

	/**
	 * need to figure out where to put this security.ini file
	 */

	$pdo = connectToEncryptedMySQL("/../security.ini");

//determine which HTTP method is being used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];