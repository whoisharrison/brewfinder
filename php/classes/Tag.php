<?php


//NameSpace
require_once("autoload.php");

class Tag implements \JsonSerializable {

    /**
     * @var $tagId
     **/

    private $tagId;

    /**
     * @var $tagName
     **/
    private $tagName;

    public function __construct(?int $newTagId, string $newTagName) {

        try {
            $this->setTagId($newTagId);
            $this->setTagName($newTagName);
        }
        catch (\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));

        }

    }

    /**
     * accessor method
     * @return int|null for tag id
     **/
    public function getTagId() : ?int {
            return($this->tagId);
        }


    /**
     * @param int $newTagId
     * @throws \RangeException if tag id is not positive
     * @throws \TypeError if $newTagId is not an int or null
     *
     **/
    public function setTagId($newTagId) : void {
        //if new tag is null return it posthaste
        if($newTagId === null) {
            $this->tagId = null;
            return;
        }
        //verify if tag id is positive
        if($newTagId < 0) {
            throw(new \RangeException("tag id is not positive"));
        }

        //convert the new tag id to a tag id and store it
        $this->tagId = $newTagId;
    }

    /**
     * accessor method for tag name
     * @return string for tag name
     **/
    public function getTagName() : string {
        return($this->tagName);
    }

    /**
     * @param mixed $newTagName
     */
    public function setTagName($newTagName) : void {
        //enforce formatting on tag name
        $newTagName = trim($newTagName);
        $newTagName = filter_var($newTagName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        //check content
        if(empty($newTagName) === true) {
            throw(new \InvalidArgumentException("tag name is either empty or insecure"));
        }

        //check length
        if(strlen($newTagName) > 32) {
            throw(new \RangeException("tag name must be less than 32 characters"));
        }

        //store it
        $this->tagName = $newTagName;
    }


    public function insert(\PDO $pdo) : void {
        //enforce that tag id is not null
        if($this->tagId !== null) {
            throw(new \PDOException("this is not a new tag"));
        }

        //create query
        $query = "INSERT INTO tag(tagName) VALUES (:tagName)";
        $statement = $pdo->prepare($query);
        $parameters = [
            "tagName" => $this->tagName,
        ];
        $statement->execute($parameters);
        $this->tagName = intval($pdo->lastInsertId());
    }

    public function delete(\PDO $pdo) : void {
        //enforce that tag id is not null

        if($this->tagId === null) {
            throw(new \PDOException("unable to delete a tag that does not exist"));
        }

        //create query
        $query = "DELETE FROM tag WHERE tagId = :tagId";
        $statement = $pdo->prepare($query);
        $parameters = ["tagId" => $this->tagId];
        $statement->execute($parameters);

    }

    public static function getTagByTagId(\PDO $pdo, int $tagId) : ?Tag {
        //check if tag id is positive
        if($tagId <= 0) {
            throw(new \PDOException("tag id is not positive"));
        }
        //query for tag
        $query = "SELECT tagId, tagName FROM tag WHERE tagId = :tagId";
        $statement = $pdo->prepare($query);
        $parameters = ["tagId" => $tagId];
        $statement->execute($parameters);

        //fetch from mySQL
        try {
            $tag = null;
            $statement->setFetchMode(\PDO::FETCH_ASSOC);
            $row = $statement->fetch();
            if($row !== false) {
                $tag = new Tag($row ["tagId"], $row ["tagName"]);
            }
        } catch (\Exception $exception) {
            // of the row fails to convert re-throw
            throw(new \PDOException($exception->getMessage(), 0, $exception));
        }
        return($tag);
    }

    public static function getTagByTagName(\PDO $pdo, string $tagName) : \SplFixedArray {
        //Sanitize tag name
        $tagName = trim($tagName);
        $tagName = filter_var($tagName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

        if(empty($tagName) === true) {
            throw(new \PDOException("this is not a valid tag"));
        }

        //query for tag using tag name
        $query = "SELECT tagId, tagName FROM tag WHERE tagName LIKE :tagName";
        $statement = $pdo->prepare($query);

        //bind the tag name to the placeholder
        $tagName = "%$tagName%";
        $parameters = ["tagName" => $tagName];
        $statement->execute($parameters);


        //build array
        $tags = new \SplFixedArray($statement->rowCount());
        $statement->setFetchMode(\PDO::FETCH_ASSOC);

        while (($row = $statement->fetch()) !== false) {
            try {
                $tag = new Tag($row["tagId"], $row ["tagName"]);

                $tags[$tags->key()] = $tag;
                $tags->next();
            } catch (\Exception $exception) {
                throw(new \PDOException($exception->getMessage(), 0, $exception));
            }
        }
        return ($tags);
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
