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
	 * Brewery address 1
	 * @var float $breweryAddress1
	 **/
	private $breweryAddress1;
	/**
	 * Brewery address 2
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
	 * location x of this Brewery.
	 * @var float $breweryLocationX
	 **/
	private $breweryLocationX;
	/**
	 * location y of this Brewery.
	 * @var float $breweryLocationY
	 **/
	private $breweryLocationY;
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
		if($newBreweryProfileId <= 0) {
			throw(new \RangeException("brewery profile id is not positive"));
		}

		// Convert and store the brewery id.
		$this->breweryProfileId = $newBreweryProfileId;

		/**
		 * Accessor method for address 1
		 *
		 * @return string value for address 1
		 **/
		public
		function getBreweryAddress1(): string {
			return ($this->breweryAddress1);
		}
	}

		/**
		 * Mutator method for address 1
		 *
		 * @param string $newBreweryAddress1
		 * @throws \InvalidArgumentException if $newBreweryAddress1 is not a string or insecure
		 * @throws \RangeException if $newBreweryAddress1 is > 128 characters
		 * @throws \TypeError if the $newBreweryAddress1 is not a string
		 **/
		public
		function setBreweryAddress1(string $newBreweryAddress1): void {

			// Verify address 1 is secure
			$newBreweryAddress1 = trim($newBreweryAddress1);
			$newBreweryAddress1 = filter_var($newBreweryAddress1, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newBreweryAddress1) === true) {
				throw(new \InvalidArgumentException("brewery address 1 is empty or insecure"));
			}

			// Verify address 1 will fit in the database/
			if(strlen($newBreweryAddress1) > 128) {
				throw(new \RangeException("brewery address is too large"));
			}

			// Store address 1.
			$this->breweryAddress1 = $newBreweryAddress1;
		}

		/**
		 * Accessor method for address 2
		 *
		 * @return string|null value for address 2
		 **/
		public
		function getBreweryAddress2(): ?string {
			return ($this->breweryAddress2);
		}

		/**
		 * Mutator method for address 2
		 *
		 * @param string|null $newBreweryAddress2
		 * @throws \InvalidArgumentException if $newBreweryAddress2 is not a string or insecure
		 * @throws \RangeException if $newBreweryAddress2 is > 128 characters
		 * @throws \TypeError if the $newBreweryAddress2 is not a string
		 **/
		public
		function setBreweryAddress2(?string $newBreweryAddress2): void {

			// Verify address 2 is secure
			$newBreweryAddress2 = trim($newBreweryAddress2);
			$newBreweryAddress2 = filter_var($newBreweryAddress2, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
			if(empty($newBreweryAddress2) === true) {
				throw(new \InvalidArgumentException("brewery address 2 is empty or insecure"));
			}

			// Verify address 2 will fit in the database.
			if(strlen($newBreweryAddress2) > 128) {
				throw(new \RangeException("brewery address 2 is too large"));
			}

			// Store address 2.
			$this->breweryAddress2 = $newBreweryAddress2;
		}

		/**
		 * Accessor method for brewery location x.
		 *
		 * @param float $breweryLocationX
		 * @return float $breweryLocationX value of brewery location x
		 **/
		public
		function getBreweryLocationX() {
			return ($this->breweryLocationX);
		}

		/**
		 * Mutator method for brewery location x.
		 *
		 * @param float @newBreweryLocationX new value of brewery location x
		 * @throws \RangeException if $newBreweryLocationX is not between -180 and 180
		 * @throws \TypeError if $newBreweryLocationX is not an integer
		 **/
		public function setBreweryLocationX(float $newBreweryLocationX) {
			$newBreweryLocationX = $newBreweryLocationX == 0.0 ? 0.0 : filter_var($newBreweryLocationX, FILTER_VALIDATE_FLOAT);

			// If the brewery location x is null, immediately return it.
			if($newBreweryLocationX === false) {
				throw(new \InvalidArgumentException("location x is not a valid data type"));
			}

			// Verify that brewery location x is positive.
			if($newBreweryLocationX < -180 || $newBreweryLocationX > 180) {
				throw(new \RangeException("location x is not within range"));
			}

			// Convert and store brewery location x.
			$this->breweryLocationX = $newBreweryLocationX;
		}

		/**
		 * Accessor method for brewery location y.
		 *
		 * @param float $breweryLocationY
		 * @return float $breweryLocationY value of brewery location y
		 **/
		public function getBreweryLocationY() {
			return($this->breweryLocationY);
		}

		/**
		 * Mutator method for brewery location y.
		 *
		 * @param float @newBreweryLocationY new value of profile location y
		 * @throws \RangeException if $newBreweryLocationY is not between -90 and 90
		 * @throws \TypeError if $newBreweryLocationY is not an integer
		 **/
		public function setBreweryLocationY(float $newBreweryLocationY) {
			$newBreweryLocationY = $newBreweryLocationY == 0.0 ? 0.0 : filter_var($newBreweryLocationY, FILTER_VALIDATE_FLOAT);

			// If the brewery location y is null, immediately return it.
			if($newBreweryLocationY === false) {
				throw(new \InvalidArgumentException("location y is not a valid data type"));
			}

			// Verify that brewery location y is positive.
			if($newBreweryLocationY < -90 || $newBreweryLocationY > 90) {
				throw(new \RangeException("location y is not within range"));
			}

			// Convert and store brewery location y.
			$this->breweryLocationY = $newBreweryLocationY;
		}
}