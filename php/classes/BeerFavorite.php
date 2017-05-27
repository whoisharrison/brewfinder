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
	
	private $beerFavoriteBeerId
	
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
		
		$this->setBeerFavoriteBeerId($newBeerFavoriteId);
		$this->setBeerFavoriteDate($newBeerFavoriteDate);
		
		}
		// determine exception type thrown
		catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
	
	
}

