<?php
/**
 * API's that provide information about SLM API's
 *
 * This is a collection of API's that can be called to get information about SLM API's. Such as, but not limited to, version of all API's. Other items
 * of information are location of documentation, getting a new SDK token, etc.
 *
 *
 */

namespace API;

/**
 * Class SLMInfo
 */
class SLMInfo
{
	/**
	 * Class Variable area
	 */
	/**
	 * @var "Slim\Http\RequestMonolog\Logger" $logger The instance of the Logger created at startup.
	 */
	protected $myLogger;

	/**
	 * This will return the version and the build.
	 *
	 * Version is the year that the software was assembled. The build is the number of times the software
	 * has been successfully assembled. For the URL, see the example below.
	 *
	 * @api
	 *
	 * @example http://localhost/slm_api/slminfo/version This will return the version and the build.
	 *
	 *
	 * @return array Keys: errCode, statusText, codeLoc, custMsg, retPack
	 *                      errCode is 0 for Success or 900 for error
	 *                      statusText contains system generated error message for debugging
	 *                      codeLoc is the class and method that throw the error
	 *                      custMsg is the message that is displayed to the end user (customer or member)
	 *                      retPack is the payload that is return to the caller
	 */
	public function getVersion()
	{
		$this->myLogger->debug(__METHOD__);

		//@todo The version and build needs to be moved to a configuration file, so it can be updated by the build process.

		return array('errCode' => 0, 'statusText' => '', 'codeLoc' => __METHOD__, 'custMsg' => '', 'retPack' => array('version' => '2017', 'build' => '1'));
	}

	/**
	 * Class Constructor
	 *
	 * @param $logger
	 */
	public function __construct($logger)
	{
		$this->myLogger = $logger;
		$this->myLogger->debug(__METHOD__);
	}
}