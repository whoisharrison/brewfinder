<?php
require_once("autoload.php");

/*
 * brewfinder BeerFavorite class
 *
 * @author Luc FLynn <lucnmsu@gmail.com>
 * @coauthors & @editors: Billy Trabaudo, Lea McDuffie, Michael Harrison, Shihlin Lu
 * version 0.0.0
 * */

class BeerFavorite implements \JsonSerialize {
	use ValidateDate;
	
	/*
	 * primary key for the beer favorite
	 *
	 * */
	
	private $beerFavoriteId;
	
	/*
	 * id for the beer that is favorited
	 *
	 */
	
	private $beerFavoriteBeerId;
	
	/*
	 * favorites profileId
	 *
	 */
	private $beerFavoriteProfileId;
	
	/*
	 * favorites date
	 *
	 */
	private $beerFavoriteDate;

	
	/*
	 * constructor for this BeerFavorite
	 * @param int|null $newBeerFavoriteId id of this beerFavorite or null if a new favorite
	 * @param int $newBeerFavoriteProfileId id of the Profile that did this favorite
	 * @param int $newBeerFavoriteBreweryId id of the Brewery
	 * @param int $newBeerFavoriteDate
	 * @param string $newBeerFavoriteStyle style of beer.
	 *
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * */
	
	
	public function __construct(int $newBeerFavoriteId, int $newBeerFavoriteBeerId, int $newBeerFavoriteProfileId, int $newBeerFavoriteDate) {
		try {
		
		$this->setBeerFavoriteId($newBeerFavoriteId);
		$this->setBeerFavoriteBeerId($newBeerFavoriteBeerId);
		
		$this->setBeerFavoriteProfileId($newBeerFavoriteId);
		$this->setBeerFavoriteDate($newBeerFavoriteDate);
		
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
	public function getBeerFavoriteId(): ?int
	{
		return $this->beerFavoriteId;
	}
	
	/**
	 * mutator method for product id
	 *
	 * @param int|null $newBeerFavoriteId
	 * @throws \RangeException if $newBeerFavoriteId is not positive
	 * @throws \TypeError if $newBeerFavoriteId is not an integer
	 *
	 * */
	
	/**
	 * @param mixed $beerFavoriteId
	 */
	public function setBeerFavoriteId( int $newBeerFavoriteId) : void
	{
		if($newBeerFavoriteId === null ) {
			$this->beerFavoriteId = null;
			return;
		}
		
		if($newBeerFavoriteId <= 0 ) {
			throw(new\RangeException("Id not positive"));
		}
		//convert and store the ID
		$this->beerFavoriteId = $newBeerFavoriteId;
	}
	

	
	/**
	 * Accessor method for BeerFavoriteBeerId
	 * @return mixed
	 */
	public function getBeerFavoriteBeerId(): int
	{
		return ($this->beerFavoriteBeerId);
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
	 * @param mixed $beerFavoriteBeerId
	 */
	public function setBeerFavoriteBeerId(int $newBeerFavoriteBeerId) : void
	{
		// verifies id is positive
		if($newBeerFavoriteBeerId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->beerFavoriteBeerId = $newBeerFavoriteBeerId;
	}
	
	/**
	 * Accessor method for BeerFavoriteProfileId
	 * @return mixed
	 */
	public function getBeerFavoriteProfileId(): int
	{
		return ($this->beerFavoriteProfileId);
	}
	
	/*
	 * mutator method for beerFavoriteProfileId
	 *
	 * @param int $newBeerFavoriteProfileId new value of id
	 * @throws \RangeException if the id is not positive
	 * @throw \TypeError if the id is not an int
	 *
	 * */
	/**
	 * @param mixed $beerFavoriteProfileId
	 */
	public function setBeerFavoriteProfileId(int $newBeerFavoriteProfileId) : void
	{
		// verifies id is positive
		if($newBeerFavoriteProfileId <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->beerFavoriteProfileId = $newBeerFavoriteProfileId;
	}
	
	/**
	 * Accessor method for BeerFavoriteBeerId
	 * @return mixed
	 */
	public function getBeerFavoriteDate(): int
	{
		return ($this->beerFavoriteBeerId);
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
	 * @param mixed $beerFavoriteBeerId
	 */
	public function setBeerFavoriteDate(int $newBeerFavoriteDate) : void
	{
		// verifies id is positive
		if($newBeerFavoriteDate <= 0) {
			throw(new \RangeException("Id is not positve"));
		}
		$this->beerFavoriteBeerId = $newBeerFavoriteBeerId;
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
		if($this->beerFavoriteId === null || $this->beerFavoriteBeerId === null || $this->beerFavoriteProfileId === null) {
			throw(new \PDOException("not a valid favorite"));
		}
		// creates query table
		$query = "INSERT INTO BeerFavorite(beerFavoriteId, beerFavoriteBeerId, beerFavoriteProfileId) VALUES (:beerFavoriteProfileId, :beerFavoriteBeerId, :beerFavoriteProfileId)";
		$statement = $pdo->prepare($query);
		//bind the member vars to the place holders
		$parameters = ["beerFavoriteId" => $this->beerFavoriteId, "beerFavoriteBeerId" => $this->beerFavoriteBeerId, "beerFavoriteProfileId" => $this->beerFavoriteProfileId];
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
		if($this->beerFavoriteId === null || $this->beerFavoriteBeerId === null || $this->beerFavoriteProfileId === null) {
			throw(new \PDOException("not a valid favorite"));
		}
		// create query template
		$query = "DELETE FROM BeerFavorite WHERE beerFavoriteId = :beerFavoriteId AND beerFavoriteBeerId = :beerFavoriteBeerId AND beerFavoriteProfileId = :beerFavoriteProfileId";
		$statement = $pdo->prepare($query);
		$parameters = ["beerFavoriteId" => $this->beerFavoriteId, "beerFavoriteBeerId" => $this->beerFavoriteBeerId, "beerFavoriteProfileId" => $this->beerFavoriteProfileId];
		$statement->execute($parameters);
	}
	
	/**
	 * gets the favorite by beer id etc
	 *
	 * @param \PDO $pdo PDO connection obect
	 * @param int $beerFavoriteId to search for
	 * @param int $beerFavoriteBeerId to search for
	 * @param int $beerFavoriteProfileid to search for
	 */
	public static function getFavoriteByBeerFavoriteIdAndBeerFavoriteBeerIdAndBeerFavoriteProfileId(\PDO $pdo, int $beerFavoriteId, int $beerFavoriteBeerId, int $beerFavoriteProfileId) : ?BeerFavorite {
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
		// create query table
		$query = "SELECT beerFavoriteId, beerFavoriteBeerId, beerFavoriteProfileId FROM BeerFavorite WHERE beerFavoriteId =:beerFavoriteId AND beerFavoriteBeerId = :beerFavoriteBeerId AND beerFavoriteProfileId = :beerFavoriteProfileId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteId, "beerFavoriteBeerId" => $beerFavoriteBeerId, "beerFavoriteProfileId" => $beerFavoriteProfileId];
		$statement->execute($parameters);
		// grab the favorite from mySQL
		try {
			$beerFavorite = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false ) {
				$beerFavorite = new BeerFavorite($row ["beerFavoriteId"], $row[$beerFavoriteBeerid], $row[$this->beerFavoriteProfileId]);
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
		$query = "SELECT beerFavoriteId beerFavoriteProfileId, beerFavoriteBeeId FROM beerFavorite WHERE beerFavoriteId = :beerFavoriteId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			 try {
				 $beerFavorite = new BeerFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"]);
				 $beerFavorites[$beerFavorite->key()] = $beerFavorite;
				 $beerFavorite->next();
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
		$query = "SELECT beerFavoriteId beerFavoriteProfileId, beerFavoriteBeeId FROM BeerFavorite WHERE beerFavoriteProfileId = :beerFavoriteProfileId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteId" => $beerFavoriteProfileId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerFavorite = new BeerFavorite($row["beerFavoritePId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"]);
				$beerFavorites[$beerFavorite->key()] = $beerFavorite;
				$beerFavorite->next();
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
		// sanitize the faovite id before search
		if($beerFavoriteBeerId <= 0) {
			throw(new \PDOException("Id not positive"));
		}
		// create query table
		$query = "SELECT beerFavoriteId beerFavoriteProfileId, beerFavoriteBeeId FROM BeerFavorite WHERE beerFavoriteBeerId = :beerFavoriteBeerId";
		$statement = $pdo->prepare($query);
		//bind the placeholders
		$parameters = ["beerFavoriteBeerId" => $beerFavoriteBeerId];
		$statement->execute($parameters);
		
		//build array of favorites
		$beerFavorites = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		
		while(($row = $statement->fetch()) !== false) {
			try {
				$beerFavorite = new BeerFavorite($row["beerFavoriteId"], $row ["beerFavoriteProfileId"], $row ["beerFavoriteBeerId"]);
				$beerFavorites[$beerFavorite->key()] = $beerFavorite;
				$beerFavorite->next();
			} catch (\Exception $exception) {
				// if the row couldn't be converted rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
			
		}
		return ($beerFavorites);
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

