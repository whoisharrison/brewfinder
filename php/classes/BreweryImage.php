<?php
//namespace com/michaelharrisonwebdev;
require_once("autoload.php");
/**
 * BreweryImage Class for Brewfinder
 *
 * @author Lea McDuffie <lea@littleloveprint.io>
 * @version 1.0
 **/
class BreweryImage implements \JsonSerializable {
	/**
	 * Id of the image being posted; this is a a component of a composite primary and foreign key
	 * @var int $breweryImageImageId
	 **/
	private $breweryImageImageId;
	/**
	 * Id of the brewery the image belongs to; this is a a component of a composite primary and foreign key
	 * @var int $breweryImageBreweryId
	 **/
	private $breweryImageBreweryId;
	/**
	 * Constructor for breweryImage
	 *
	 * @param int $newBreweryImageBreweryId id of the parent breweryImage belongs to
	 * @param int $newBreweryImageImageId id of the parent Image
	 */
	public function  __construct(int $newBreweryImageImageId, int $newBreweryImageBreweryId) {
		try {
			$this->setBreweryImageImageId($newBreweryImageImageId);
			$this->setBreweryImageBreweryId($newBreweryImageBreweryId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {

			// Determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	/**
	 * Accessor method for image id
	 *
	 * @return int value of image id
	 **/
	public function getBreweryImageImageId(): int {
		return($this->breweryImageImageId);
	}

	/**
	 * Mutator for image id
	 *
	 * @param int $newBreweryImageImageId new value of image id
	 * @throws \RangeException if $newBreweryImageImageId is not positive
	 * @throws \TypeError if $newBreweryImageImageId is not an integer
	 **/
	public function setBreweryImageImageId(int $newBreweryImageImageId): void {

		// Verify the image id is positive
		if($newBreweryImageImageId <= 0) {
			throw(new \RangeException("brewery image image id is not positive"));
		}

		// Convert and store the image id
		$this->breweryImageImageId = $newBreweryImageImageId;
	}

	/**
	 * Accessor method for event id
	 *
	 * @return int value of brewery image brewery id
	 **/
	public function getBreweryImageBreweryId(): int {
		return ($this->breweryImageBreweryId);
	}

	/**
	 * mutator method for brewery image brewery id
	 *
	 * @param int $newBreweryImageBreweryId new value of brewery image brewery id
	 * @throws \RangeException if $newBreweryImageBreweryId is not positive
	 * @throws \TypeError if $newBreweryImageBreweryId is not an integer
	 **/
	public function setBreweryImageBreweryId(int $newBreweryImageBreweryId): void {

		// Verify the brewery image brewery id is positive
		if($newBreweryImageBreweryId <= 0) {
			throw(new \RangeException("brewery image brewery id is not positive"));
		}

		// Convert and store the event id
		$this->breweryImageBreweryId = $newBreweryImageBreweryId;
	}

	/**
	 * Insert into mySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException whe mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function insert(\PDO $pdo): void {

		// Enforce the brewery image image id is null (i.e., don't insert a brewery image that already exists)
		if($this->breweryImageImageId !== null) {
			throw(new \PDOException("not a new image"));
		}

		// Create query template
		$query = "INSERT INTO breweryImage(breweryImageImageId, breweryImageBreweryId) VALUES (:breweryImageImageId, :breweryImageBreweryId)";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryImageImageId" => $this->breweryImageImageId, "breweryImageBreweryId" => $this->breweryImageBreweryId];
		$statement->execute($parameters);

		// Update the null brewery image image id with what mySQL gave us
		$this->breweryImageImageId = intval($pdo->lastInsertId());
	}

	/**
	 * Deletes this breweryImage from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo) : void {

		// Ensure the object exists before deleting
		if($this->breweryImageImageId === null || $this->breweryImageImageId === null) {
			throw(new \PDOException("cannot delete an image that does not exist"));
		}

		// Create query template
		$query = "DELETE FROM breweryImage WHERE breweryImageImageId = :breweryImageImageId AND breweryImageBreweryId = :breweryImageBreweryId";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryImageImageId" => $this->breweryImageImageId, "breweryImageBreweryId" => $this->breweryImageBreweryId];
		$statement->execute($parameters);
	}

	/**
	 * Update in mySQL
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function update(\PDO $pdo) : void {

		// Enforce the image is not null
		if($this->breweryImageImageId === null) {
			throw(new \PDOException("cannot update an image that does not exist"));
		}
	}

	/**
	 * Gets the Brewery Image by brewery image image id
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param int $profileId profile id to search for
	 * @return BreweryImage|null BreweryImage or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBreweryImageByBreweryImageImageId(\PDO $pdo, int $breweryImageImageId):?BreweryImage {

		// Sanitize the brewery image image id before searching
		if($breweryImageImageId <= 0) {
			throw(new \PDOException("brewery image image id is not positive"));
		}

		// Create query template
		$query = "SELECT BreweryImageImageId FROM BreweryImage WHERE breweryImageImageId = :breweryImageImageId AND breweryImageBreweryId = :breweryImageBreweryId";
		$statement = $pdo->prepare($query);

		// Bind the brewery image image id to the place holder in the template
		$parameters = ["breweryImageImageId" => $breweryImageImageId];
		$statement->execute($parameters);

		// Grab the brewery image from mySQL
		try {
			$breweryImage = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$breweryImage = new BreweryImage($row["breweryImageImageId"], $row["breweryImageBreweryId"]);
			}
		} catch(\Exception $exception) {

			// If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($breweryImage);
	}

	/**
	 * Gets the Brewery Image by brewery image brewery id
	 *
	 * @param \PDO $pdo $pdo PDO connection object
	 * @param int $profileId profile id to search for
	 * @return BreweryImage|null BreweryImage or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getBreweryImageByBreweryImageBreweryId(\PDO $pdo, int $breweryImageBreweryId):?BreweryImage {

		// Sanitize the brewery image brewery id before searching
		if($breweryImageBreweryId <= 0) {
			throw(new \PDOException("brewery image brewery id is not positive"));
		}

		// Create query template
		$query = "SELECT BreweryImageBreweryId FROM BreweryImage WHERE breweryImageImageId = :breweryImageImageId AND breweryImageBreweryId = :breweryImageBreweryId";
		$statement = $pdo->prepare($query);

		// Bind the brewery image brewery id to the place holder in the template
		$parameters = ["breweryImageBreweryId" => $breweryImageBreweryId];
		$statement->execute($parameters);

		// Grab the brewery image from mySQL
		try {
			$breweryImage = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$breweryImage = new BreweryImage($row["breweryImageImageId"], $row["breweryImageBreweryId"]);
			}
		} catch(\Exception $exception) {

			// If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($breweryImage);
	}

	public static function getBreweryImageByBreweryImageImageIdAndBreweryImageBreweryId(\PDO $pdo, int $breweryImageImageId, int $breweryImageBreweryId): ?BreweryImage {

		// Sanitize before searching
		if($breweryImageImageId <= 0) {
			throw(new \PDOException("brewery image image id is not positive"));
		}
		if($breweryImageBreweryId <= 0) {
			throw(new \PDOException("brewery image brewery id is not positive"));
		}

		// Create query template
		$query = "SELECT BreweryImageImageId, BreweryImageBreweryId FROM BreweryImage WHERE breweryImageImageId = :breweryImageImageId AND breweryImageBreweryId = :breweryImageBreweryId";
		$statement = $pdo->prepare($query);

		// Bind the member variables to the place holders in the template
		$parameters = ["breweryImageImageId" => $breweryImageImageId, "breweryImageBreweryId" => $breweryImageBreweryId];
		$statement->execute($parameters);

		// Grab the brewery image from mySQL
		try {
			$breweryImage = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$friend = new BreweryImage($row["breweryImageImageId"], $row["breweryImageBreweryId"]);
			}
		} catch(\Exception $exception) {

			// If the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($breweryImage);
	}

		/**
		 * formats the state variables for JSON serialization
		 *
		 * @return array resulting state variables to serialize
		 **/
		public function jsonSerialize() {
			$fields = get_object_vars($this);
			return($fields);
		}
	}