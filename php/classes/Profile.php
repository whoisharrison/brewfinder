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