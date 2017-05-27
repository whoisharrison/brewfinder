<?php
namespace com/michaelharrisonwebdev;
require_once("autoload.php");
/**
 * Brewery Class for Brewfinder
 *
 * @author Lea McDuffie <lea@littleloveprint.io>
 * @version 1.0
 **/
class Brewery implements \JsonSerializable {
	/**
	 * id for this Brewery; this is the primary key.
	 * @var int $breweryId
	 **/
	private $breweryId;
	/**
	 * Token to verify the brewery is valid.
	 * @var string $brewery
	 */
}