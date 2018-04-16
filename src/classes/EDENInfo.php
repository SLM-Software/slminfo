<?php
/**
 * API's that provide information about EDEN API's
 *
 * This is a collection of API's that can be called to get information about EDEN API's. Such as, but not limited to, version of all API's. Other items
 * of information are location of documentation, getting a new SDK token, etc.
 *
 *
 */

namespace API;

/**
 * This is the EDENInfo parent class which contains non-complex methods.
 *
 *  Each API is either a method (function) in this class or a sub-call of Members.
 * There are no rules to determine if the API should be a method in this class or a sub-class
 * of members. If you feel that the method is to complex and should be refactored to a sub-class,
 * please do so!
 *
 * @param "Slim\Http\RequestMonolog\Logger" $logger The instance of the Logger created at startup.
 */
class EDENInfo
{
	/**
	 * @var "Slim\Http\RequestMonolog\Logger" $logger The instance of the Logger created at startup.
	 */
	protected $myLogger;

	/**
	 * @var array $mySettings This contains all the environment settings
	 */
	protected $mySetting;

	/**
	 * This will return the version and the build.
	 *
	 * Version is the year that the software was assembled. The build is the number of times the software
	 * has been successfully assembled. For the URL, see the example below.
	 *
	 * @api
	 *
	 * @example https://{Domain}/eden/api/edeninfo/version This will return the version and the build.
	 *
	 * @return array Keys: errCode, statusText, codeLoc, custMsg, retPack
	 */
	public function getVersion()
	{
		$this->myLogger->debug(__METHOD__);

		return array('errCode' => 0,
		             'statusText' => '',
		             'codeLoc' => __METHOD__,
		             'custMsg' => '',
		             'retPack' => array('version' => $this->mySetting['VERSION'], 'build' => $this->mySetting['BUILD']));
	}

	/**
	 * Class Constructor
	 *
	 * @param $logger
	 */
	public function __construct($logger, $mySetting)
	{
		$this->myLogger = $logger;
		$this->myLogger->debug(__METHOD__);

		$this->mySetting = $mySetting;
		$this->myLogger->debug(implode('|', $mySetting));
	}
}