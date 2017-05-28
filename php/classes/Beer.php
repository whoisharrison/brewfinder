<?php

//Name Space
require_once("autoload.php");

/**
 * Beer Venue
 * @author Billy Trabaudo
 **/

class Beer implements \JsonSerializable {

    /**
     * @var int $beerid
     **/

    private $beerId;

    /**
     * @var int $beerBreweryId
     */

    private $beerBreweryId;

    /**
     * @var int $beerImageId
     */

    private $beerImageId;

    /**
     * @var string $beerAvailability
     */

    private $beerAvailability;

    /**
     * @var string $beerContent
     */

    private $beerContent;

    /**
     * @var string $beerStyle
     */

    private $beerStyle;


    public function __construct(?int $newBeerId, ?int $newBeerBreweryId, ?int $newBeerImageId, string $newBeerAvailability, ?string $newBeerContent, string $newBeerStyle) {

        try {
            $this->setBeerId($newBeerId);
            $this->setBeerBreweryId($newBeerBreweryId);
            $this->setBeerImageId($newBeerImageId);
            $this->setBeerAvailability($newBeerAvailability);
            $this->setBeerContent($newBeerContent);
            $this->setBeerStyle($newBeerStyle);

        }
        catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * accessor method for beer id
     * @return int|null for beer id
     *
     **/
    public function getBeerId(): ?int {
        return $this->beerId;
    }

    /**
     *
     * @param int|null $newBeerId
     * @throws \RangeException if $newBeerId is not positive
     * @throws \TypeError if $newBeerId is not an integer or null
     **/
    public function setBeerId(?int $newBeerId) : void {
        //if new beer id is null return it posthaste
        if($newBeerId === null) {
            $this->beerId = null;
            return;
        }
        //verify that the beer id is positive
        if($newBeerId < 0) {
            throw(new \RangeException("beer id is not positive"));
        }

        $this->beerId = $newBeerId;
    }

    /**
     * @return int|null for beer brewery id
     */
    public function getBeerBreweryId(): ?int {

        return $this->beerBreweryId;
    }

    /**
     * @param int|null $newBeerBreweryId
     * @throws \RangeException if Id is not positive
     * @throws \TypeError if Id is not an int
     */
    public function setBeerBreweryId(?int $newBeerBreweryId) : void {

        if($newBeerBreweryId === null) {
            $this->beerBreweryId = null;
            return;
        }

        //verify that the beer brewery ID is positive
        if($newBeerBreweryId <= 0) {
            throw(new \RangeException("beer brewery id is not positive"));
        }

        $this->beerBreweryId = $newBeerBreweryId;
    }

    /**
     * @return int|null for beer image id
     */
    public function getBeerImageId(): ?int {
        return $this->beerImageId;
    }

    /**
     * @param int $newBeerImageId
     * @throws \RangeException if beer image id is not positve
     * @throws \TypeError if beer image id is not an int
     */
    public function setBeerImageId(?int $newBeerImageId) : void {

        if($newBeerImageId === null) {
            $this->beerImageId = null;
            return;
        }

        //verify that the beer image id is positive

        if($newBeerImageId <= 0) {
            throw(new \RangeException("beer image id is not positive"));
        }

        $this->beerImageId = $newBeerImageId;
    }

    /**
     * accessor method for beer availability
     * @return string for beer availability
     */
    public function getBeerAvailability(): string {
        return $this->beerAvailability;
    }

    /**
     * @param string $newBeerAvailability
     * @throws \InvalidArgumentException if Beer Availability is empty or insecure
     * @throws \RangeException if beer availability is greater than 5 characters
     * @throws \TypeError if beer availability is not a string
     */
    public function setBeerAvailability(string $newBeerAvailability) : void{
        $newBeerAvailability = trim($newBeerAvailability);
        $newBeerAvailability = filter_var($newBeerAvailability, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(empty($newBeerAvailability) === true) {
            throw(new \InvalidArgumentException("beer availability is empty or insecure"));
        }

        if(strlen($newBeerAvailability) > 5) {
            throw(new \RangeException("beer availability must be less than"));
        }

        $this->beerAvailability = $newBeerAvailability;

    }

    /**
     * @return string|null for beer content
     */
    public function getBeerContent(): ?string {
        return $this->beerContent;
    }

    /**
     * @param string $newBeerContent
     * @throws \InvalidArgumentException if beer content is empty or insecure
     * @throws \RangeException if beer content is greater than 500 characters
     */
    public function setBeerContent(?string $newBeerContent) : void {
        $newBeerContent = trim($newBeerContent);
        $newBeerContent = filter_var($newBeerContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(empty($newBeerContent) === true) {
            throw(new \InvalidArgumentException("beer content is either empty or insecure"));
        }

        if(strlen($newBeerContent) > 500) {
            throw(new \RangeException("Beer Content must be less than 500 characters"));
        }

        $this->beerContent = $newBeerContent;
    }

    /**
     * @return string for beer style
     */
    public function getBeerStyle(): string {
        return $this->beerStyle;
    }

    /**
     * @param string $newBeerStyle
     * @throws \InvalidArgumentException if beer style is empty or insecure
     * @throws \RangeException if beer style is greater than 32 characters
     */
    public function setBeerStyle(string $newBeerStyle) : void {
        $newBeerStyle = trim($newBeerStyle);
        $newBeerStyle = filter_var($newBeerStyle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(empty($newBeerStyle) === true) {
            throw(new \InvalidArgumentException("beer style is either empty or insecure"));
        }

        if(strlen($newBeerStyle) >= 32) {
            throw(new \RangeException("beer style must be less than or equal to 32 characters"));
        }

        $this->beerStyle = $newBeerStyle;
    }

    /**
     * @param \PDO $pdo connection object
     * @throws \PDOException when mySQL errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/


    public function insert(\PDO $pdo) : void {
        //enforce that beer id is not null
        if($this->beerId !== null) {
            throw(new \PDOException("not a new beer"));
        }

        //create query
        $query = "INSERT INTO beer(beerBreweryId, beerImageId, beerAvailability, beerContent, beerStyle) VALUES (:beerBreweryId, :beerImageId, :beerAvailability, :beerContent, :beerStyle)";
        $statement = $pdo->prepare($query);
        $parameters = [
            "beerBreweryId" => $this->beerBreweryId,
            "beerImageId" => $this->beerImageId,
            "beerAvailability" => $this->beerAvailability,
            "beerContent" => $this->beerContent,
            "beerStyle" => $this->beerStyle
        ];
        $statement->execute($parameters);
        $this->beerId = intval($pdo->lastInsertId());
    }

    /**
     * @param \PDO $pdo connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     */

    public function delete(\PDO $pdo) : void {
        //enforce that beer id is not null
        if($this->beerId === null) {
            throw(new \PDOException("unable to delete a beer that does not exist"));
        }

        //create query
        $query = "DELETE FROM beer WHERE beerId = :beerId";
        $statement = $pdo->prepare($query);
        $parameters = ["beerId" => $this->beerId];
        $statement->execute($parameters);
    }

    public function update(\PDO $pdo) : void {
        //enforce that beer id is not null
        if($this->beerId === null) {
            throw(new \PDOException("unable to update a beer that does not exist"));
        }

        $query = "UPDATE beer SET beerBreweryId = :beerBreweryId, beerImageId = :beerImageId, beerAvailability = :beerAvailability, beerContent = :beerContent, beerStyle = :beerStyle WHERE beerId = :beerId";
        $statement = $pdo->prepare($query);
        $parameters = [
            "beerBreweryId" => $this->beerBreweryId,
            "beerImageId" => $this->beerImageId,
            "beerAvailability" => $this->beerAvailability,
            "beerContent" => $this->beerContent,
            "beerStyle" => $this->beerStyle
        ];
        $statement->execute($parameters);

    }

    public static function getBeerByBeerId(\PDO $pdo, int $beerId) : ?Beer {

        //check if beer id is positive
        if($beerId <= 0) {
            throw(new \PDOException("beer id is not positive"));
        }

        //query for beer
        $query = "SELECT beerId, beerBreweryId, beerImageId, beerAvailability, beerContent, beerStyle FROM beer WHERE beerId = :beerId";

        $statement = $pdo->prepare($query);
        $parameters = ["beerId" => $beerId];
        $statement->execute($parameters);

        //fetch beer from mySQL
        try {
            $beer = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $beer = new Beer($row ["beerId"], $row ["beerBreweryId"], $row ["beerImageId"], $row ["beerAvailability"], $row ["beerContent"], $row ["beerStyle"]);
            }

        } catch (\Exception $exception) {
            //if the row can not convert re-throw
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }
        return($beer);


    }

    public static function getBeerByBeerAvailability(\PDO $pdo, string $beerAvailability) : \SplFixedArray {
        //Sanitize Beer Avail.
        $beerAvailability = trim($beerAvailability);
        $beerAvailability = filter_var($beerAvailability, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(empty($beerAvailability) === true) {
            throw(new \PDOException("not a valid availability"));
        }
        //query for beer using beer availability
        $query = "SELECT beerId, beerBreweryId, beerImageId, beerAvailability, beerContent, beerStyle FROM beer WHERE beerAvailability LIKE :beerAvailability";
        $statement = $pdo->prepare($query);

        //bind the beer avail. to the placeholder
        $beerAvailability = "%$beerAvailability%";
        $parameters = ["beerAvailability" => $beerAvailability];
        $statement->execute($parameters);

        //build array
        $beers = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        while (($row = $statement->fetch()) !== false) {

            try {
                $beer = new Beer($row ["beerId"], $row ["beerBreweryId"], $row ["beerImageId"], $row ["beerAvailability"], $row ["beerContent"], $row ["beerStyle"]);

                $beers[$beers->key()] = $beer;
                $beers->next();
            } catch (\Exception $exception) {
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($beers);
    }

    public static function getBeerByBeerStyle(\PDO $pdo, string $beerStyle) : \SplFixedArray
    {
        //Sanitize Beer Style
        $beerStyle = trim($beerStyle);
        $beerStyle = filter_var($beerStyle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if (empty($beerStyle) === true) {
            throw(new \PDOException("not valid beer style"));
        }
        //query for beer using beer style
        $query = "SELECT beerId, beerBreweryId, beerImageId, beerAvailability, beerContent, beerStyle FROM beer WHERE beerAvailability LIKE :beerStyle";
        $statement = $pdo->prepare($query);


        //bind the beer style to the placeholder
        $beerStyle = "%$beerStyle%";
        $parameters = ["beerStyle" => $beerStyle];
        $statement->execute($parameters);

        //build array
        $beers = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        while (($row = $statement->fetch()) !== false) {
            try {
                $beer = new Beer($row ["beerId"], $row ["beerBreweryId"], $row ["beerImageId"], $row ["beerAvailability"], $row ["beerContent"], $row ["beerStyle"]);

                $beers[$beers->key()] = $beer;
                $beers->next();
            } catch (\Exception $exception) {
                throw(new \PDOException($exception->getMessage(), 0, $exception));

            }

        }
        return ($beers);

    }

        /**
         * formats the state variables for JSON serialization
         *
         * @return array resulting state variables to serialize
         **/
        public function jsonSerialize() {
        $fields = get_object_vars($this);
        return ($fields);
        }




}


