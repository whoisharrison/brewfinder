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
	 * @var int $breweryProfileId
	 **/
	private $breweryProfileId;
	/**
	 * Token to verify the brewery profile is valid.
	 * @var string $breweryActivationToken
	 **/
	private $breweryActivationToken;
	/**
	 * Brewery location x
	 * @var float $breweryAddress1
	 **/
	private $breweryAddress1;
	/**
	 * Brewery location y
	 * @var float $breweryAddress2
	 **/
	private $breweryAddress2;
	/**
	 * @var string $breweryCity
	 */
	private $breweryCity;
	/**
	 * @var string $breweryContent
	 */
	private $breweryContent;
	/**
	 * @var string $breweryEmail
	 */
	private $breweryEmail;
	/**
	 * @var string $breweryHash
	 */
	private $breweryHash;
	/**
	 * @var int|null $breweryImageId
	 */
	private $breweryImageId;
	/**
	 * @var string $breweryName
	 */
	private $breweryName;
	/**
	 * @var string $breweryPhone
	 */
	private $breweryPhone;
	/**
	 * @var $brewerySalt
	 */
	private $brewerySalt;
	/**
	 * @var
	 */
	private $breweryState;
	/**
	 * @var int $breweryZip
	 */
	private $breweryZip;

	/**
	 * Constructor for this Brewery
	 *
	 * @param int $newBreweryId
	 * @param int|null $newBreweryProfileId
	 * @param string $newBreweryAddress1
	 * @param string|null $newBreweryAddress2
	 * @param float $newBreweryLocationX
	 * @param float $newBreweryLocationY
	 * @param string $newBreweryCity
	 * @param string $newBreweryContent
	 * @param string $newBreweryEmail
	 * @param string $newBreweryHash
	 * @param int $newBreweryImageId
	 * @param string $newBreweryName
	 * @param string $newBreweryPhone
	 * @param string $newBrewerySalt
	 * @param string $newBreweryState
	 * @param int $newBreweryZip
	 **/
	public function __construct(int $newBreweryId, ?int $newBreweryProfileId, string $newBreweryAddress1, ?string $newBreweryAddress2, float $newBreweryLocationX, float $newBreweryLocationY, string $newBreweryCity, string $newBreweryContent, string $newBreweryEmail, string $newBreweryHash, int $newBreweryImageId, string $newBreweryName, string $newBreweryPhone, string $newBrewerySalt, string $newBreweryState, int $newBreweryZip) {
		try {
			$this->setBreweryId($newBreweryId);
			$this->setBreweryProfileId($newBreweryProfileId);
			$this->setBreweryAddress1($newBreweryAddress1);
			$this->setBreweryAddress2($newBreweryAddress2);
			$this->setBreweryLocationX($newBreweryLocationX);
			$this->setBreweryLocationY($newBreweryLocationY);
			$this->setBreweryCity($newBreweryCity);
			$this->setBreweryContent($newBreweryContent);
			$this->setBrewerySalt($newBrewerySalt);
			$this->setBreweryState($newBreweryState);
			$this->setBreweryZip($newBreweryZip);
		}

		// Determine what exception type was thrown
		catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * Accessor method for brewery id.
	 *
	 * @return int value of brewery id.
	 **/
	public function getBreweryId(): int {
	}

	/**
	 * Mutator method for brewery id.
	 *
	 * @param int $newBreweryId
	 * @throws \RangeException is $newBreweryId is not positive
	 * @throws \TypeError if $newBreweryId is not an integer
	 **/
	public function setBreweryId(int $newBreweryId): void {

		// If brewery id is null, immediately return it.
		if($newBreweryId === null) {
			$this->breweryId = null;
			return;
		}

		// Verify the brewery id is positive.
		if($newBreweryId <=0) {
			throw(new \RangeException("brewery id is not positive"));
		}

		// Convert and store the brewery id.
		$this->breweryId = $newBreweryId;
	}

	/**
	 * Accessor method for brewery profile id.
	 *
	 * @return int value of brewery profile id
	 **/
	public function getBreweryProfileId(): int {
	}

	/**
	 * Mutator method for brewery profile id.
	 *
	 * @param int $newBreweryProfileId
	 * @throws \RangeException is $newBreweryProfiled is not positive
	 * @throws \TypeError if $newBreweryProfileId is not an integer
	 **/
	public function setBreweryProfileId(int $newBreweryProfileId): void {

		// If brewery profile id is null, immediately return it.
		if($newBreweryProfileId === null) {
			$this->breweryProfileId = null;
			return;
		}

		// Verify the brewery profile id is positive.
		if($newBreweryProfileId <=0) {
			throw(new \RangeException("brewery profile id is not positive"));
		}

		// Convert and store the brewery id.
		$this->breweryProfileId = $newBreweryProfileId;
}