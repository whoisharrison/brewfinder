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
	 * Valid at handle to use
	 * @var string $VALID_ATHANDLE
	 **/
	protected $VALID_ATHANDLE = "@barkparkz";

	/**
	 * Valid cloudinary id to use
	 * @var string $VALID_CLOUDINARYID
	 **/

	protected $VALID_CLOUDINARYID;

	/**
	 * Valid email to use
	 * @var string $VALID_EMAIL
	 **/
	protected $VALID_EMAIL = "lea@barkparkz.com";

	/**
	 * Valid hash to use.
	 * @var string $VALID_HASH
	 **/
	protected $VALID_HASH;

	/**
	 * Valid salt to use to create the profile object to own the test.
	 * @var string $VALID_SALT;
	 **/
	protected $VALID_SALT;

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