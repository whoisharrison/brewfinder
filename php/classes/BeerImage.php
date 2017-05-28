<?php

//namespace

/**
 * Class Beer Image
 * @author Billy Trabaudo (AKA QED)
 **/

class BeerImage implements \JsonSerializable {

    /**
     * @var Int $beerImageImageId
     **/
    private $beerImageImageId;


    /**
     * @var Int $beerImageBreweryId
     **/
    private $beerImageBreweryId;


    public function __construct(int $newBeerImageImageId, int $newBeerImageBreweryId){
        try {
            $this->setBeerImageImageId($newBeerImageImageId);
            $this->setBeerImageBreweryId($newBeerImageBreweryId);
        } catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }


    }

    /**
     * accessor method
     * @return int for $beerImageImageId
     */
    public function getBeerImageImageId(): int {
        return($this->beerImageImageId);

    }

    /**
     * @param Int $newBeerImageImageId
     * @throws \RangeException if beer image image id is not positive
     * @throws \TypeError if beer image image id is not an int
     */
    public function setBeerImageImageId(int $newBeerImageImageId) : void {
        //verify that the beer image image id is positive
        if($newBeerImageImageId <= 0) {
            throw(new \RangeException("beer image image id is not positive"));
        }

        //convert and store
        $this->beerImageImageId = $newBeerImageImageId;
    }


    /**
     * @return Int for $beerImageBreweryId
     */
    public function getBeerImageBreweryId(): int {
        return ($this->beerImageBreweryId);
    }

    /**
     * @param Int $newBeerImageBreweryId
     */
    public function setBeerImageBreweryId(int $newBeerImageBreweryId) : void {
        //verify that the beer image brewery id is positive

        if($newBeerImageBreweryId <= 0) {
            throw(new \RangeException("beer image brewery id is not positive"));
        }

        //convert and store
        $this->beerImageBreweryId = $newBeerImageBreweryId;
    }

    /**
     * @param PDO $pdo connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/

    public function insert(\PDO $pdo) : void {
        // enforce that the beer image id is not null
        if($this->beerImageImageId !== null) {
            throw(new \PDOException("not a new beer image"));
        }

        //create query
        $query = "INSERT INTO beerImage(beerImageImageId, beerImageBreweryId) VALUES (:beerImageImageId, beerImageBreweryId)";
        $statement = $pdo->prepare($query);
        $parameters = [
            "beerImageImageId" =>$this->beerImageImageId,
            "beerImageBreweryId" =>$this->beerImageBreweryId
        ];
        $statement->execute($parameters);
        $this->beerImageImageId = intval($pdo->lastInsertId());

    }

    /**
     * @param PDO $pdo connection object
     * @throws \PDOException when mySQL related errors occur
     * @throws \TypeError if $pdo is not a PDO connection object
     **/

    public function delete(\PDO $pdo) : void {
        //enforce that beer image image id is not null

        if($this->beerImageImageId === null) {
            throw(new \PDOException("unable to delete a beer image that does not exist"));
        }
        //create query
        $query = "DELETE FROM beerImageImageId WHERE beerImageImageId = :beerImageImageId";
        $statement = $pdo->prepare($query);
        $parameters = ["beerImageImageId" => $this->beerImageImageId];
        $statement->execute($parameters);

    }

    public static function getBeerImageByBeerImageImageId(\PDO $pdo, int $beerImageImageId) : \SplFixedArray {
        //make sure beer image image id is positive
        if($beerImageImageId <= 0) {
            throw(new \PDOException("beer image image id is not positive"));
        }

        //query for beer image
        $query = "SELECT beerImageImageId, beerImageBreweryId FROM beerImage WHERE beerImageImageId = :beerImageImageId";

        $statement = $pdo->prepare($query);
        $parameters = ["beerImageImageId" => $beerImageImageId];
        $statement->execute($parameters);

        $beerImages = new \SplFixedArray($statement->rowcount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {

            //fetch venue from mySQL
            try {
                $beerImage = new BeerImage($row ["beerImageImageId"], $row ["beerImageBreweryId"]);

                $beerImages[$beerImages->key()] =$beerImage;
                $beerImages->next();
            } catch (\Exception $exception) {
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($beerImages);
    }

    public static function getBeerImageByBeerImageBreweryId(\PDO $pdo, int $beerImageBreweryId) : \SplFixedArray {
        //make sure brewery image is positive
        if($beerImageBreweryId <= 0) {
            throw(new \PDOException("brewery image id is not positive"));
        }

        //query for brewery image
        $query = "SELECT beerImageImageId, beerImageBreweryId FROM beerImage WHERE beerImageBreweryId = :beerImageBreweryId";
        $statement = $pdo->prepare($query);
        $parameters = ["beerImageBreweryId" => $beerImageBreweryId];
        $statement->execute($parameters);

        $beerImages = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);
        while(($row = $statement->fetch()) !== false) {
            try {
                $beerImage = new BeerImage($row ["beerImageImageId"], $row ["beerImageBreweryId"]);

                $beerImages[$beerImages->key()] =$beerImage;
                $beerImages->next();
            } catch (\Exception $exception) {
                throw(new \PDOException($exception->getMessage(), 0, $exception));


        }
    }
    return ($beerImages);






































}