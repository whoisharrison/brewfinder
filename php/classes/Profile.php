<?php
namespace com\michaelharrisonwebdev\brewfinder;
require_once("autoload.php");
/**
 * Brew Finder Sensor Profile
 *
 * This is a cross section of what is stored for a Brew Finder user.
 *
 * @author Shihlin Lu
 * @version 1.0.0
 */

class Profile implements \JsonSerializable {
	/**
	 * id for this Profile; this is the primary key
	 * @var int $profileId
	 **/
	private $profileId;

	/**
	 * image id for this Profile
	 * @var int $profileImageId
	 **/
	private $profileImageId;

	/**
	 * activation token that verifies that the profile is valid and not malicious
	 * @var $profileActivationToken
	 **/
	private $profileActivationToken;

	/**
	 * at handle for this Profile; this is a unique index
	 * @var string $profileAtHandle
	 **/
	private $profileAtHandle;

	/**
	 * actual content for this Profile
	 * @var string $profileContent
	 **/
	private $profileContent;

	/**
	 * email that belongs to this Profile; this is a unique index
	 * @var string $profileEmail
	 **/
	private $profileEmail;

	/**
	 * hash for profile password
	 * @var string $profileHash
	 **/
	private $profileHash;

	/**
	 * location x of this Profile
	 * @var float $profileLocationX
	 **/
	private $profileLocationX;

	/**
	 * location y of this Profile
	 * @var float $profileLocationY
	 **/
	private $profileLocationY;

	/**
	 * name of Profile user
	 * @var string $profileName
	 **/
	private $profileName;

	/**
	 * salt for profile password
	 * @var string $profileSalt
	 **/
	private $profileSalt;

	/**
	 * Constructor for this Profile
	 *
	 * @param int $newProfileId id of the Profile
	 * @param int $newProfileImageId image id of the Profile
	 * @param string|null $newProfileActivationToken activation token
	 * @param string $newProfileAtHandle string containing the profile at handle
	 * @param string $newProfileContent string containing user profile content data
	 * @param string $newProfileEmail user email address
	 * @param string $newProfileHash string containing password hash
	 * @param float $newProfileLocationX float containing user's declared location (x coordinates)
	 * @param float $newProfileLocationY float containing user's declare location (y coordinates)
	 * @param string $newProfileName name of user profile
	 * @param string $newProfileSalt string containing profile salt
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds (e.g., strings too large, negative integers)
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 * @Documentation https://php.net/manual/en/language.oop5.decon.php
	 **/
	public function __construct(?int $newProfileId, ?int $newProfileImageId, ?string $newProfileActivationToken, string $newProfileAtHandle, string $newProfileContent, string $newProfileEmail, string $newProfileHash, ?float $newProfileLocationX, ?float $newProfileLocationY, string $newProfileName, string $newProfileSalt) {
		try {
			$this->setProfileId($newProfileId);
			$this->setProfileImageId($newProfileImageId);
			$this->setProfileActivationToken($newProfileActivationToken);
			$this->setProfileAtHandle($newProfileAtHandle);
			$this->setProfileContent($newProfileContent);
			$this->setProfileEmail($newProfileEmail);
			$this->setProfileHash($newProfileHash);
			$this->setProfileLocationX($newProfileLocationX);
			$this->setProfileLocationY($newProfileLocationY);
			$this->setProfileName($newProfileName);
			$this->setProfileSalt($newProfileSalt);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			// determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * Acessor method for profile id
	 *
	 * @return int|null value of profile id
	 **/
	public function getProfileId(): ?int {
		return ($this->profileId);
	}

	/**
	 * Mutator method for profile id
	 *
	 * @param int $newProfileId new value of profile id
	 * @throws \RangeException if $newProfileId is not positive
	 * @throws \TypeError if $newProfileId is not an integer
	 **/
	public function setProfileId(?int $newProfileId): void {
		if($newProfileId === null) {
			$this->profileId=null;
			return;
		}

		// verify that the profile id is positive
		if($newProfileId <= 0) {
			throw(new \RangeException("profile id is not positive"));
		}

		// convert and store the profile id
		$this->profileId = $newProfileId;
	}

	/**
	 * Accessor method for profile image id
	 *
	 * @return int|null value of profile image id
	 **/
	public function getProfileImageId(): ?int {
		return($this->profileImageId);
	}

	/**
	 * Mutator method for profile image id
	 * @param int $newProfileImageId
	 * @throws \RangeException if profile image id is not positive
	 * @throws \TypeError if profile image id is not an int
	 **/
	public function setProfileImageId(?int $newProfileImageId): void {
		if($newProfileImageId === null) {
			$this->profileImageId = null;
			return;
		}

		// verify that the profile image id is positive
		if($newProfileImageId <= 0) {
			throw(new \RangeException("profile image id is not positive"));
		}

		// convert and store the profile image id
		$this->profileImageId = $newProfileImageId;
	}

	/**
	 * Accessor method for profile activation token
	 *
	 * @return string value of the activation token
	 **/
	public function getProfileActivationToken(): ?string {
		return($this->profileActivationToken);
	}

	/**
	 * Mutator method for profile activation token
	 *
	 * @param string $newProfileActivationToken
	 * @throws \InvalidArgumentException if the token is not a string or insecure
	 * @throws \RangeException if the token is not exactly 32 characters
	 * @throws \TypeError if the activation token is not a string
	 **/
	public function setProfileActivationToken(?string $newProfileActivationToken): void {
		if($newProfileActivationToken === null) {
			$this->profileActivationToken = null;
			return;
		}

		$newProfileActivationToken = strtolower(trim($newProfileActivationToken));
		if(ctype_xdigit($newProfileActivationToken) === false) {
			throw(new\RangeException("user activation token is not valid"));
		}

		// make sure user activation token is only 32 characters
		if(strlen($newProfileActivationToken) !== 32) {
			throw(new \RangeException("user activation token has to be 32"));
		}
		$this->profileActivationToken = $newProfileActivationToken;
	}

	/**
	 * Accessor method for profile at handle
	 *
	 * @return string value of at handle
	 **/
	public function getProfileAtHandle(): string {
		return($this->profileAtHandle);
	}

	/**
	 * Mutator method for profile at handle
	 *
	 * @param string $newProfileAtHandle new value of at handle
	 * @throws \InvalidArgumentException if the at handle is not a string or insecure
	 * @throws \RangeException if $newAtHandle is > 32 characters
	 * @thrwos \TypeError if the $newAtHandle is not a string
	 **/
	public function setProfileAtHandle(string $newProfileAtHandle) : void {
		// verify that the handle is secure
		$newProfileAtHandle = trim($newProfileAtHandle);
		$newProfileAtHandle = filter_var($newProfileAtHandle, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileAtHandle) === true) {
			throw(new \InvalidArgumentException("profile at handle is empty or insecure"));
		}

		// verify that the at handle will fit in the database
		if(strlen($newProfileAtHandle) > 32) {
			throw(new \RangeException("profile at handle is too large"));
		}

		// store the handle
		$this->profileAtHandle = $newProfileAtHandle;
	}

	/**
	 * Accessor method for profile content
	 *
	 * @return string value of profile content
	 **/
	public function getProfileContent() {
		return($this->profileContent);
	}

	/**
	 * Mutator method for profile content
	 * @param string|null $newProfileContent new content of profile
	 * @throws \InvalidArgumentException if $newProfileContent is insecure
	 * @throws \RangeException if $newProfileContent is >750
	 * @throws \TypeError if $newProfileContent is not a string
	 **/
	public function setProfileContent(string $newProfileContent): void {
		// verify that the profile content is secure
		$newProfileContent = trim($newProfileContent);
		$newProfileContent = filter_var($newProfileContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileContent) === true) {
			throw(new \InvalidArgumentException("profile content is empty or insecure"));
		}

		// verify that the profile content will fit in the database
		if(strlen($newProfileContent) > 750) {
			throw(new \RangeException("profile content is too large"));
		}

		// store the profile content
		$this->profileContent = $newProfileContent;
	}

	/**
	 * Accessor method for profile email
	 *
	 * @return string value of email
	 **/
	public function getProfileEmail(): string {
		return $this->profileEmail;
	}

	/**
	 * Mutator method for email
	 *
	 * @param string $newProfileEmail new value of email
	 * @throws \InvalidArgumentException if $newProfileEmail is insecure
	 * @throws \RangeException if $newProfileEmail is >128
	 * @throws \TypeError if $newProfileEmail is not a string
	 **/
	public function setProfileEmail(string $newProfileEmail) : void {
		// verify the email is secure
		$newProfileEmail = trim($newProfileEmail);
		$newProfileEmail = filter_var($newProfileEmail, FILTER_VALIDATE_EMAIL);
		if(empty($newProfileEmail) === true) {
			throw(new \InvalidArgumentException("profile email is empty or insecure"));
		}

		// verify that the email will fit in the database
		if(strlen($newProfileEmail) > 128) {
			throw(new \RangeException("profile email is too large"));
		}

		// store the email
		$this->profileEmail = $newProfileEmail;
	}
	/**
	 * Accessor method for profile hash
	 *
	 * @return string value of profile hash
	 **/
	public function getProfileHash(): string {
		return $this->profileHash;
	}

	/**
	 * Mutator method for profile hash
	 *
	 * @param string $newProfileHash
	 * @throws \RangeException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 **/
	public function setProfileHash(string $newProfileHash): void {
		// enforce that the hash is properly formatted
		$newProfileHash = trim($newProfileHash);
		$newProfileHash = strtolower($newProfileHash);
		if(empty($newProfileHash) === true) {
			throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
		}

		// enforce that the hash is exactly 128 characters
		if(strlen($newProfileHash) !== 128) {
			throw(new \RangeException("profile hash must be 128 characters"));
		}

		// store the hash
		$this->profileHash = $newProfileHash;
	}

	/**
	 * Accessor method for profile location x
	 *
	 * @return float $profileLocationX value of profile location x
	 **/
	public function getProfileLocationX() {
		return($this->profileLocationX);
	}

	/**
	 * Mutator method for profile location x
	 *
	 * @param float $newProfileLocationX new value of profile location x
	 * @throws \RangeException if $newProfileLocationX is not between -180 and 180
	 * @throws \TypeError if $newProfileLocationX is not an integer
	 **/
	public function setProfileLocationX(float $newProfileLocationX) {
		$newProfileLocationX = $newProfileLocationX == 0.0 ? 0.0 : filter_var($newProfileLocationX, FILTER_VALIDATE_FLOAT);

		// if profile location x is null, immediately return it
		if($newProfileLocationX === false) {
			throw(new \InvalidArgumentException("location x is not a valid data type"));
		}

		// verify that the profile location x is positive
		if($newProfileLocationX < -180 || $newProfileLocationX > 180) {
			throw(new \RangeException("location x is not within range"));
		}

		// convert and store profile location x
		$this->profileLocationX = $newProfileLocationX;
	}

	/**
	 * Accessor method for profile location y
	 *
	 * @return float $profileLocationY value of profile location x
	 **/
	public function getProfileLocationY() {
		return($this->profileLocationY);
	}

	/**
	 * Mutator method for profile location y
	 *
	 * @param float $newProfileLocationY new value of profile location x
	 * @throws \RangeException if $newProfileLocationY is not between -90 and 90
	 * @throws \TypeError if $newProfileLocationY is not an integer
	 **/
	public function setProfileLocationY(float $newProfileLocationY) {
		$newProfileLocationY = $newProfileLocationY = 0.0 ? 0.0 : filter_var($newProfileLocationY, FILTER_VALIDATE_FLOAT);

		// if the profile location y is null, immediately return it
		if($newProfileLocationY === false) {
			throw(new \InvalidArgumentException("location y is not a valid data type"));
		}

		// verify that profile location y is positive
		if($newProfileLocationY < -90 || $newProfileLocationY > 90) {
			throw(new \RangeException("location y is not within range"));
		}

		// convert and store profile location y
		$this->profileLocationY = $newProfileLocationY;
	}

	/**
	 * Accessor method for profile name
	 *
	 * @return string value of profile name
	 **/
	public function getProfileName() {
		return($this->profileName);
	}

	/**
	 * Mutator method for profile name
	 *
	 * @param string $newProfileName
	 * @throws \InvalidArgumentException if the profile name is not a string or insecure
	 * @throws \RangeException if $newProfileName is > 64 characters
	 * @throws \TypeError if $newProfileName is not a string
	 **/
	public function setProfileName(string $newProfileName): void {
		// verify that the name is secure
		$newProfileName = trim($newProfileName);
		$newProfileName = filter_var($newProfileName, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newProfileName) === true) {
			throw(new \InvalidArgumentException("profile name is no empty or insecure"));
		}

		// verify that the name will fit in the database
		if(strlen($newProfileName) > 32) {
			throw(new \RangeException("profile name is too large"));
		}

		// store the name
		$this->profileName = $newProfileName;
	}

	/**
	 * Accessor method for profile salt
	 *
	 * @return string representation of the salt hexadecimal
	 **/
	public function getProfileSalt(): string {
		return $this->profileSalt;
	}

	/**
	 *
	 * Mutator method for profile salt
	 *
	 * @param string $newProfileSalt
	 * @throws \InvalidArgumentException if the salt is not secure
	 * @throws \RangeException if $newProfileSalt is not 64 characters
	 * @throws \TypeError if profile salt is not a string
	 */
	public function setProfileSalt(string $newProfileSalt): void {
		// enforce that the salt is properly formatted
		$newProfileSalt = trim($newProfileSalt);
		$newProfileSalt = strtolower($newProfileSalt);

		// enforce that the salt is a string representation of a hexadecimal
		if(!ctype_xdigit($newProfileSalt)) {
			throw(new \InvalidArgumentException("profile password salt is empty or insecure"));
		}

		// enforce that the salt is exactly 128 characters
		if(strlen($newProfileSalt) !== 64) {
			throw(new \RangeException("profile salt must be 64 characters"));
		}

		// store the salt
		$this->profileSalt = $newProfileSalt;
	}




	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables
	 */
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		return($fields);
	}
}