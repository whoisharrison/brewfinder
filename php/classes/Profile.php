<?php
namespace [update later];
require_once("autoload.php");
/**
 * Brew Finder Sensor Profile
 *
 * @author Shihlin Lu
 * @version 1.0.0
 */

class Profile implements \JsonSerializable {




	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}