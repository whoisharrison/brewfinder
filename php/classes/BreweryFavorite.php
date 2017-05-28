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
	 * @param mixed $newBeerFavoriteId
	 */
	public function setBreweryFavoriteId(int $newBeerFavoriteId) : void {
		
		if($newBeerFavoriteId === null ) {
			$this->breweryFavoriteId = null;
			return;
		}
		
		if($newBeerFavoriteId <= 0 ) {
			throw(new\RangeException("Id not positive"));
		}
		//convert and store the ID
		$this->breweryFavoriteId = $newBeerFavoriteId;
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
	 * @param mixed $newBeerFavoriteBeerId
	 */
	public function setBreweryFavoriteBreweryId(int $newBeerFavoriteBeerId) : void
	{
		// verifies id is positive
		if($newBeerFavoriteBeerId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->breweryFavoriteBreweryId = $newBeerFavoriteBeerId;
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
	 * @param mixed $newBeerFavoriteProfileId
	 */
	public function setBreweryFavoriteProfileId(int $newBeerFavoriteProfileId) : void
	{
		// verifies id is positive
		if($newBeerFavoriteProfileId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->breweryFavoriteProfileId = $newBeerFavoriteProfileId;
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
	public function setBreweryFavoriteDateTime($newBeerFavoriteDateTime = null ) : void {
		// if the data is null, use the current date and time
		if($newBeerFavoriteDateTime === null) {
			$this->newBeerFavoriteDateTime = new \DateTime();
			return;
		}
		// store the validateDate trait
		try {
			$newBeerFavoriteDateTime = self::validateDateTime($newBeerFavoriteDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new$exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->breweryFavoriteDateTime=$newBeerFavoriteDateTime;
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
		$query = "INSERT INTO BeerFavorite(beerFavoriteId, beerFavoriteBeerId, beerFavoriteProfileId, beerFavoriteDateTime) VALUES (:beerFavoriteId, :beerFavoriteBeerId, :beerFavoriteProfileId, :beerFavoriteDateTime)";
		$statement = $pdo->prepare($query);
		//bind the member vars to the place holders
		$parameters = ["beerFavoriteId" => $this->breweryFavoriteId, "beerFavoriteBeerId" => $this->breweryFavoriteBreweryId, "beerFavoriteProfileId" => $this->breweryFavoriteProfileId, "beerFavoriteDateTime" => $this->breweryFavoriteDateTime];
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
		$query = "DELETE FROM BeerFavorite WHERE beerFavoriteId = :beerFavoriteId AND beerFavoriteBeerId = :beerFavoriteBeerId AND beerFavoriteProfileId = :beerFavoriteProfileId AND beerFavoriteDateTime = :beerFavoriteDateTime";
		$statement = $pdo->prepare($query);
		$parameters = ["beerFavoriteId" => $this->breweryFavoriteId, "beerFavoriteBeerId" => $this->breweryFavoriteBreweryId, "beerFavoriteProfileId" => $this->breweryFavoriteProfileId, "beerFavoriteDateTime" => $this->breweryFavoriteDateTime];
		$statement->execute($parameters);
	}
	
	/**
	 * gets the favorite by beer id etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileId to search for
	 * @param \DateTime $beerFavoriteDateTim
	 *
	 * return beerFavorite
	 */
	public static function getFavoriteByBeerFavoriteIdAndBeerFavoriteBeerIdAndBeerFavoriteProfileIdAndBeerFavoriteDateTime(\PDO $pdo, int $beerFavoriteId, int $beerFavoriteBeerId, int $beerFavoriteProfileId, \DateTime $beerFavoriteDateTime) : ?BreweryFavorite {
		// sanitize the faovite id before search
		if($beerFavoriteId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($beerFavoriteBeerId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($beerFavoriteProfileId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		if($beerFavoriteDateTime <= 0) {
			throw(new\PDOException("Can't have negative Time"));
		}
		
		
		// create query table
		$query = "SELECT beerFavoriteId, beerFavoriteBeerId, beerFavoriteProfileId, beerFavoriteDateTime FROM BeerFavorite WHERE beerFavoriteId =:beerFavoriteId AND beerFavoriteBeerId = :beerFavoriteBeerId AND beerFavoriteProfileId = :beerFavoriteProfileId AND beerFavoriteDateTime = :beerFavoriteDateTime";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteId, "beerFavoriteBeerId" => $beerFavoriteBeerId, "beerFavoriteProfileId" => $beerFavoriteProfileId, "beerFavoriteDateTime" => $beerFavoriteDateTime];
		$statement->execute($parameters);
		
		
		// grab the favorite from mySQL
		try {
			$beerFavorite = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false ) {
				$beerFavorite = new BreweryFavorite($row ["beerFavoriteId"], $row["beerFavoriteBeerId"], $row["beerFavoriteProfileId"], $row["beerFavoriteDateTime"]);
			}
		}    catch(\Exception $exception) {
			//if the row can't convert rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($beerFavorite);
	}
	
	/**
	 * gets the favorite by beer id non-etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBeerFavoriteId(\PDO $pdo, int $beerFavoriteId) : \SPLFixedArray {
		// sanitize the faovite id before search
		if($beerFavoriteId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT beerFavoriteId beerFavoriteProfileId, beerFavoriteBeerId, beerFavoriteDateTime FROM BeerFavorite WHERE beerFavoriteId = :beerFavoriteId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			 try {
				 $beerFavorite = new BreweryFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"], $row["beerFavoriteDateTime"]);
				 $beerFavorites[$beerFavorites->key()] = $beerFavorite;
				 $beerFavorites->next();
			 } catch (\Exception $exception) {
			 	// if the row couldn't be converted rethrow it
				 throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		
		}
		return ($beerFavorites);
	}
	
	/**
	 * gets the favorite by beer id non-etc 2
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBeerProfileId(\PDO $pdo, int $beerFavoriteProfileId) : \SPLFixedArray {
		// sanitize the faovite id before search
		if($beerFavoriteProfileId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT beerFavoriteId, beerFavoriteProfileId, beerFavoriteBeerId, beerFavoriteDatetime FROM BeerFavorite WHERE beerFavoriteProfileId = :beerFavoriteProfileId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteProfileId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerFavorite = new BreweryFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"], $row["beerFavoriteDateTime"]);
				$beerFavorites[$beerFavorites->key()] = $beerFavorite;
				$beerFavorites->next();
			} catch (\Exception $exception) {
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			
		}
		return ($beerFavorites);
	}
	
	/**
	 * gets the favorite by beer id non-etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBeerFavoriteBeerId(\PDO $pdo, int $beerFavoriteBeerId) : \SPLFixedArray {
		// sanitize the favorite id before search
		if($beerFavoriteBeerId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT beerFavoriteId beerFavoriteProfileId, beerFavoriteBeeId beerFavoriteDateTime FROM BeerFavorite WHERE beerFavoriteBeerId = :beerFavoriteBeerId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteBeerId" => $beerFavoriteBeerId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerFavorite = new BreweryFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"], $row ["beerFavoriteDateTime"]);
				$beerFavorites[$beerFavorites->key()] = $beerFavorite;
				$beerFavorites->next();
			} catch (\Exception $exception) {
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			
		}
		return ($beerFavorites);
	}
 /**
* gets an array of readings based on its date
*
* @param \PDO $pdo connection object
* @param \DateTime $beerFavoriteSunriseDateTime beginning date to search for
* @param \DateTime $beerFavoriteSunsetDateTime ending date to search for
* @return \SplFixedArray of readings found
* @throws \PDOException when mySQL related errors occur
* @throws \TypeError when variables are not the correct dates are in the wrong format
* @throws \InvalidArgumentException if either sun dates are in the wrong format
**/
 
	public static function getFavoriteByBeerFavoriteDateTime (\PDO $pdo, $beerFavoriteSunriseDateTime, $beerFavoriteSunsetDateTime) : \SplFixedArray {
		//enforce both date are present
		if((empty ($beerFavoriteSunriseDateTime) === true) || (empty ($beerFavoriteSunsetDateTime) === true)) {
			throw (new \InvalidArgumentException("dates are empty or insecure"));
		}
		//ensure both dates are in the correct format and are in the correct format and are secure
		try{
			$beerFavoriteSunriseDateTime = self::validateDateTime($beerFavoriteSunriseDateTime);
			$beerFavoriteSunsetDateTime = self::validateDateTime($beerFavoriteSunsetDateTime);
		} catch(\InvalidArgumentException | \RangeException $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		
		
		//create query template
		$query = "SELECT beerFavoriteId, beerFavoriteProfileId, beerFavoriteBeerId, beerFavoriteDateTime from BeerFavorite WHERE beerFavoriteDateTime >= :beerFavoriteSunriseDateTime AND beerFavoriteDateTime <= :beerFavoriteSunsetDateTime LIMIT :startRow, :pageSize ";
		$statement= $pdo->prepare($query);
		
		
		//format the dates so that mySQL can use them
		$formattedBeerFavoriteSunriseDateTime = $beerFavoriteSunriseDateTime->format("Y-m-d H:i:s.u");
		$formattedBeerFavoriteSunsetDate = $beerFavoriteSunsetDateTime->format("Y-m-d H:i:s.u");
		$parameters = ["beerFavoriteSunriseDateTime" => $formattedBeerFavoriteSunriseDateTime, "beerFavoriteSunsetDate" => $formattedBeerFavoriteSunsetDate];
		$statement->bindParam(":startRow", $startRow, \PDO::PARAM_INT);
		$statement->bindParam(":pageSize", self::$pageSize);
		$statement->execute($parameters);
		
		
		//build an array of readings
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try{
				$beerFavorite = new BreweryFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"], $row["beerFavoriteDateTime"]);
				$beerFavorites[$beerFavorites->key()] = $beerFavorite;
				$beerFavorites->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return($beerFavorites);
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

