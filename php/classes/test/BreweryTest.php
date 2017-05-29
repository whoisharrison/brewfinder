<?php
//namespace com/michaelharrisonwebdev;

//use ?\?\?\Brewery;

// Grab the class under scrutiny
require_once(dirname(__DIR__) . "/autoload.php");

/**
 * Full PHPUnit test for the Brewery class.
 *
 * All mySQL and PDO enabled methods are tested for both invalid and valid inputs.
 *
 * @see Brewery
 * @author Lea McDuffie <lea@littleloveprint.io>
 **/
class BreweryTest extends BrewfinderTest {
	/**
	 * Placeholder until account activation is created.
	 * @var string $VALID_ACTIVATION
	 **/
	protected $VALID_ACTIVATION;

	/**
	 * Valid address
	 * @var string $VALID_ADDRESS1
	 **/
	protected $VALID_ADDRESS1;

	/**
	 * Valid address
	 * @var string $VALID_ADDRESS2
	 **/

	protected $VALID_ADDRESS2;

	/**
	 * Valid city
	 * @var string $VALID_CITY
	 **/
	protected $VALID_CITY;

	/**
	 * Valid content
	 * @var string $VALID_CONTENT
	 **/
	protected $VALID_CONTENT;

	/**
	 * Valid email to use
	 * @var string $VALID_EMAIL
	 **/
	protected $VALID_EMAIL = "lea@brewfinder.com";

	/**
	 * Valid hash to use.
	 * @var string $VALID_HASH
	 **/
	protected $VALID_HASH;

	/**
	 * Valid image id
	 * @var int|null $VALID_IMAGEID
	 **/
	protected $VALID_IMAGEID;

	/**
	 * Valid location x to use.
	 * @var float $VALID_LOCATIONX
	 **/
	protected $VALID_LOCATIONX = 43.5945;

	/**
	 * Valid location y to use.
	 * @var float $VALID_LOCATIONY
	 **/
	protected $VALID_LOCATIONY = 83.8889;

	/**
	 * Valid name
	 * @var string $VALID_NAME
	 **/
	protected $VALID_NAME;

	/**
	 * Valid phone
	 * @var string $VALID_PHONE
	 **/
	protected $VALID_PHONE;

	/**
	 * Valid salt to use to create the profile object to own the test.
	 * @var string $VALID_SALT;
	 **/
	protected $VALID_SALT;

	/**
	 * Valid state
	 * @var string $VALID_STATE;
	 **/
	protected $VALID_STATE;

	/**
	 * Valid zip
	 * @var int $VALID_ZIP
	 **/
	protected $VALID_ZIP;