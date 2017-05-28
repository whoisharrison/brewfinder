<?php
require_once("autoload.php");

/*
 * brewfinder BeerFavorite class
 *
 * @author Luc FLynn <lucnmsu@gmail.com>
 * @coauthors & @editors: Billy Trabaudo, Lea McDuffie, Michael Harrison, Shihlin Lu
 * version 0.0.0
 * */

class BreweryFavorite implements \JsonSerializable {
	
	
	/*
	 * primary key for the beer favorite
	 *
	 * */
	
	private $breweryFavoriteId;
	
	/*
	 * id for the beer that is favorited
	 *
	 */
	
	private $breweryFavoriteBreweryId;
	
	/*
	 * favorites profileId
	 *
	 */
	private $breweryFavoriteProfileId;
	
	/*
	 * favorites date
	 *
	 */
	private $breweryFavoriteDateTime;

	
	/*
	 * constructor for this BeerFavorite
	 * @param int|null $newBeerFavoriteId id of this beerFavorite or null if a new favorite
	 * @param int $newBeerFavoriteProfileId id of the Profile that did this favorite
	 * @param int $newBeerFavoriteBreweryId id of the Brewery
	 * @param int $newBeerFavoriteDateTime
	 * @param string $newBeerFavoriteStyle style of beer.
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * */
	
	
	public function __construct(int $newBreweryFavoriteId, int $newBreweryFavoriteBreweryId, int $newBreweryFavoriteProfileId, $newBreweryFavoriteDateTime) {
		try {
		
		$this->setBreweryFavoriteId($newBreweryFavoriteId);
		$this->setBreweryFavoriteBreweryId($newBreweryFavoriteBreweryId);
		
		$this->setBreweryFavoriteProfileId($newBreweryFavoriteId);
		$this->setBreweryFavoriteDateTime($newBreweryFavoriteDateTime);
		
		}
		// determine exception type thrown
		catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	
	/**
	 * accesor method for beerFavoriteId
	 * @return mixed
	 */
	public function getBreweryFavoriteId(): ?int
	{
		return $this->breweryFavoriteId;
	}
	
	/**
	 * mutator method for beerFavoriteId
	 *
	 * @param int|null $newBeerFavoriteId
	 * @throws \RangeException if $newBeerFavoriteId is not positive
	 * @throws \TypeError if $newBeerFavoriteId is not an integer
	 *
	 * */
	
	/**
	 * @param mixed $newBreweryFavoriteId
	 */
	public function setBreweryFavoriteId(int $newBreweryFavoriteId) : void {
		
		if($newBreweryFavoriteId === null ) {
			$this->breweryFavoriteId = null;
			return;
		}
		
		if($newBreweryFavoriteId <= 0 ) {
			throw(new\RangeException("Id not positive"));
		}
		//convert and store the ID
		$this->breweryFavoriteId = $newBreweryFavoriteId;
	}
	

	
	/**
	 * Accessor method for BeerFavoriteBeerId
	 * @return mixed
	 */
	public function getBreweryFavoriteBreweryId(): int
	{
		return ($this->breweryFavoriteBreweryId);
	}
	
	/*
	 * mutator method for beerFavoriteBeerId
	 *
	 * @param int $newBeerFavoriteBeerId new value of id
	 * @throws \RangeException if the id is not positive
	 * @throw \TypeError if the id is not an int
	 *
	 * */
	/**
	 * @param mixed $newBreweryFavoriteBreweryId
	 */
	public function setBreweryFavoriteBreweryId(int $newBreweryFavoriteBreweryId) : void
	{
		// verifies id is positive
		if($newBreweryFavoriteBreweryId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->breweryFavoriteBreweryId = $newBreweryFavoriteBreweryId;
	}
	
	/**
	 * Accessor method for BeerFavoriteProfileId
	 * @return mixed
	 */
	public function getBreweryFavoriteProfileId(): int
	{
		return ($this->breweryFavoriteProfileId);
	}
	
	/**
	 * mutator method for beerFavoriteProfileId
	 *
	 * @param int $newBeerFavoriteProfileId new value of id
	 * @throws \RangeException if the id is not positive
	 * @throw \TypeError if the id is not an int
	 *
	 * */
	/**
	 * @param mixed $newBreweryFavoriteProfileId
	 */
	public function setBreweryFavoriteProfileId(int $newBreweryFavoriteProfileId) : void
	{
		// verifies id is positive
		if($newBreweryFavoriteProfileId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->breweryFavoriteProfileId = $newBreweryFavoriteProfileId;
	}
	
	/**
	 * accessor method for BeerDateTime
	 *
	 * @return \DateTime value of BeerDateTime
	 */
	
	/**
	 * @return mixed
	 */
	public function getBreweryFavoriteDateTime(): \DateTime {
		return $this->breweryFavoriteDateTime;
	}
	
	/**
	 * mutator method for beerFavoriteDateTime
	 *
	 * @param null \ $newBeerFavoriteDateTime
	 * @throws \RangeException if the id is not positive
	 * @throw \TypeError if the id is not an int
	 *
	 * */
	
	/**
	 * @param mixed $beerFavoriteDateTime
	 */
	public function setBreweryFavoriteDateTime($newBreweryFavoriteDateTime = null ) : void {
		// if the data is null, use the current date and time
		if($newBreweryFavoriteDateTime === null) {
			$this->newBreweryFavoriteDateTime = new \DateTime();
			return;
		}
		// store the validateDate trait
		try {
			$newBreweryFavoriteDateTime = self::validateDateTime($newBreweryFavoriteDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new$exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->breweryFavoriteDateTime=$newBreweryFavoriteDateTime;
	}
	
	
	
	/**
	 *insert for beerFavoriteId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when MySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 *
	 */
	
	public function insert(\PDO $pdo) : void {
		// ensure the object exist before inserting
		if($this->breweryFavoriteId === null || $this->breweryFavoriteBreweryId === null || $this->breweryFavoriteProfileId === null) {
			throw(new \PDOException("not a valid favorite"));
		}
		// creates query table
		$query = "INSERT INTO BreweryFavorite(breweryFavoriteId, breweryFavoriteBreweryId, breweryFavoriteProfileId, breweryFavoriteDateTime) VALUES (:breweryFavoriteId, :breweryFavoriteBeerId, :breweryFavoriteProfileId, :breweryFavoriteDateTime)";
		$statement = $pdo->prepare($query);
		//bind the member vars to the place holders
		$parameters = ["breweryFavoriteId" => $this->breweryFavoriteId, "breweryFavoriteBreweryId" => $this->breweryFavoriteBreweryId, "breweryFavoriteProfileId" => $this->breweryFavoriteProfileId, "breweryFavoriteDateTime" => $this->breweryFavoriteDateTime];
		$statement->execute($parameters);
	}
	
	/**
	* delete fav from mySQL
	*
	* @param \PDO $pdo PDO connection object
	* @throws \PDOException when MySQL related errors occur
	* @throws \TypeError if $pdo is not a PDO connection object
	**/
	public function delete(\PDO $pdo) : void {
		// ensure the object exist before deleting
		if($this->breweryFavoriteId === null || $this->breweryFavoriteBreweryId === null || $this->breweryFavoriteProfileId === null || $this->breweryFavoriteDateTime) {
			throw(new \PDOException("not a valid favorite"));
		}
		// create query template
		$query = "DELETE FROM BreweryFavorite WHERE breweryFavoriteId = :breweryFavoriteId AND breweryFavoriteBreweryId = :breweryFavoriteBreweryId AND breweryFavoriteProfileId = :breweryFavoriteProfileId AND breweryFavoriteDateTime = :breweryFavoriteDateTime";
		$statement = $pdo->prepare($query);
		$parameters = ["breweryFavoriteId" => $this->breweryFavoriteId, "breweryFavoriteBeerId" => $this->breweryFavoriteBreweryId, "breweryFavoriteProfileId" => $this->breweryFavoriteProfileId, "breweryFavoriteDateTime" => $this->breweryFavoriteDateTime];
		$statement->execute($parameters);
	}
	
	/**
	 * gets the favorite by beer id etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $breweryFavoriteId to search for
	 * @param int $breweryFavoriteBreweryId to search for
	 * @param int $breweryFavoriteProfileId to search for
	 * @param \DateTime $beerFavoriteDateTim
	 *
	 * return beerFavorite
	 */
	public static function getByAll(\PDO $pdo, int $breweryFavoriteId, int $breweryFavoriteBreweryId, int $breweryFavoriteProfileId, \DateTime $breweryFavoriteDateTime) : ?BreweryFavorite {
		// sanitize the faovite id before search
		if($breweryFavoriteId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($breweryFavoriteBreweryId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($breweryFavoriteProfileId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($breweryFavoriteDateTime <= 0) {
			throw(new\PDOException("Can't have negative Time"));
		}
		
		
		// create query table
		$query = "SELECT breweryFavoriteId, breweryFavoriteBeerId, breweryFavoriteProfileId, breweryFavoriteDateTime FROM BreweryFavorite WHERE breweryFavoriteId = :breweryFavoriteId AND breweryFavoriteBeerId = :breweryFavoriteBreweryId AND breweryFavoriteProfileId = :breweryFavoriteProfileId AND breweryFavoriteDateTime = :breweryFavoriteDateTime";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["breweryFavoriteId" => $breweryFavoriteId, "breweryFavoriteBeerId" => $breweryFavoriteBreweryId, "breweryFavoriteProfileId" => $breweryFavoriteProfileId, "breweryFavoriteDateTime" => $breweryFavoriteDateTime];
		$statement->execute($parameters);
		
		
		// grab the favorite from mySQL
		try {
			$breweryFavorite = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false ) {
				$breweryFavorite = new BreweryFavorite($row ["breweryFavoriteId"], $row["breweryFavoriteBreweryId"], $row["brewertFavoriteProfileId"], $row["breweryFavoriteDateTime"]);
			}
		}    catch(\Exception $exception) {
			//if the row can't convert rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($breweryFavorite);
	}
	
	/**
	 * gets the favorite by beer id non-etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBreweryFavoriteId(\PDO $pdo, int $breweryFavoriteId) : \SPLFixedArray {
		// sanitize the faovite id before search
		if($breweryFavoriteId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT breweryFavoriteId, breweryFavoriteProfileId, breweryFavoriteBeerId, breweryFavoriteDateTime FROM BreweryFavorite WHERE breweryFavoriteId = :breweryFavoriteId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["breweryFavoriteId" => $breweryFavoriteId];
		$statement->execute($parameters);
		
		//build array of favorites
		$breweryFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			 try {
				 $beerFavorite = new BreweryFavorite($row["breweryFavoriteId"], $row ["breweryFavoriteProfileId"], $row ["breweryFavoriteBreweryId"], $row["breweryFavoriteDateTime"]);
				 $breweryFavorites[$breweryFavorites->key()] = $beerFavorite;
				 $breweryFavorites->next();
			 } catch (\Exception $exception) {
			 	// if the row couldn't be converted rethrow it
				 throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		
		}
		return ($breweryFavorites);
	}
	
	/**
	 * gets the favorite by beer id non-etc 2
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBreweryProfileId(\PDO $pdo, int $breweryFavoriteProfileId) : \SPLFixedArray {
		// sanitize the faovite id before search
		if($breweryFavoriteProfileId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT breweryFavoriteId, breweryFavoriteProfileId, breweryFavoriteBeerId, breweryFavoriteDateTime FROM BreweryFavorite WHERE breweryFavoriteProfileId = :breweryFavoriteProfileId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["breweryFavoriteId" => $breweryFavoriteProfileId];
		$statement->execute($parameters);
		
		//build array of favorites
		$breweryFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$breweryFavorite = new new BreweryFavorite($row["breweryFavoriteId"], $row ["breweryFavoriteProfileId"], $row ["breweryFavoriteBreweryId"], $row["breweryFavoriteDateTime"]);
				$breweryFavorites[$breweryFavorites->key()] = $breweryFavorite;
				$breweryFavorites->next();
			} catch (\Exception $exception) {
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			
		}
		return ($breweryFavorites);
	}
	
	/**
	 * gets the favorite by beer id non-etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $breweryFavoriteBreweryId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBreweryFavoriteBreweryId(\PDO $pdo, int $breweryFavoriteBreweryId) : \SPLFixedArray {
		// sanitize the favorite id before search
		if($breweryFavoriteBreweryId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT breweryFavoriteId, breweryFavoriteProfileId, breweryFavoriteBeerId, breweryFavoriteDateTime FROM BreweryFavorite WHERE breweryFavoriteBreweryId = :breweryFavoriteBreweryId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["brewertFavoriteBreweryId" => $breweryFavoriteBreweryId];
		$statement->execute($parameters);
		
		//build array of favorites
		$breweryFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$breweryFavorite = newBreweryFavorite($row["breweryFavoriteId"], $row ["breweryFavoriteProfileId"], $row ["breweryFavoriteBreweryId"], $row["breweryFavoriteDateTime"]);
				$breweryFavorites[$breweryFavorites->key()] = $breweryFavorite;
				$breweryFavorites->next();
			} catch (\Exception $exception) {
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			
		}
		return ($breweryFavorites);
	}
 /**
* gets an array of readings based on its date
*
* @param \PDO $pdo connection object
* @param \DateTime $breweryFavoriteSunriseDateTime beginning date to search for
* @param \DateTime $breweryFavoriteSunsetDateTime ending date to search for
* @return \SplFixedArray of readings found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not the correct dates are in the wrong format
* @throws \InvalidArgumentException if either sun dates are in the wrong format
**/
 
	public static function getFavoriteByBeerFavoriteDateTime (\PDO $pdo, $breweryFavoriteSunriseDateTime, $breweryFavoriteSunsetDateTime) : \SplFixedArray {
		//enforce both date are present
		if((empty ($breweryFavoriteSunriseDateTime) === true) || (empty ($breweryFavoriteSunsetDateTime) === true)) {
			throw (new \InvalidArgumentException("dates are empty or insecure"));
		}
		//ensure both dates are in the correct format and are in the correct format and are secure
		try{
			$breweryFavoriteSunriseDateTime = self::validateDateTime($breweryFavoriteSunriseDateTime);
			$breweryFavoriteSunsetDateTime = self::validateDateTime($breweryFavoriteSunsetDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		
		
		//create query template
		$query = "SELECT breweryFavoriteId, breweryFavoriteProfileId, breweryFavoriteBeerId, breweryFavoriteDateTime FROM BreweryFavorite WHERE breweryFavoriteDateTime >= :breweryFavoriteSunriseDateTime AND breweryFavoriteDateTime <= :breweryFavoriteSunsetDateTime LIMIT :startRow, :pageSize ";
		$statement= $pdo->prepare($query);
		
		
		//format the dates so that mySQL can use them
		$formattedBreweryFavoriteSunriseDateTime = $breweryFavoriteSunriseDateTime->format("Y-m-d H:i:s.u");
		$formattedBreweryFavoriteSunsetDate = $breweryFavoriteSunsetDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["breweryFavoriteSunriseDateTime" => $formattedBreweryFavoriteSunriseDateTime, "breweryFavoriteSunsetDate" => $formattedBreweryFavoriteSunsetDate];
		$statement->bindParam(":startRow", $startRow, \PDO::PARAM_INT);
		$statement->bindParam(":pageSize", self::$pageSize);
		$statement->execute($parameters);
		
		
		//build an array of readings
		$breweryFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try{
				$beerFavorite = new BreweryFavorite($row["breweryFavoriteId"], $row ["breweryFavoriteProfileId"], $row ["breweryFavoriteBreweryId"], $row["breweryFavoriteDateTime"]);
				$breweryFavorites[$breweryFavorites->key()] = $breweryFavorites;
				$breweryFavorites->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($breweryFavorites);
	}
	
	/**
	 * formats state vars for Json serialization
	 *
	 * @return array results in state vars to serialize
	 *
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}

