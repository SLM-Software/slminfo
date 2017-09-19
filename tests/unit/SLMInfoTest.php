<?php


class SLMInfoTest extends \Codeception\Test\Unit
{
	/**
	 * @var \UnitTester
	 */
	protected $tester;

	/**
	 * @var \Settings
	 */
	protected $settings;

	/**
	 * @var \Logger
	 */
	protected $logger;

	/**
	 * @var \API Results
	 */
	protected $apiResults;

	protected function _before()
	{
		require __DIR__ . '/../../vendor/autoload.php';

// Instantiate the app
		$this->settings = require __DIR__ . '/../../src/settings.php';
		$app = new \Slim\App($this->settings);

// Set up dependencies
		require __DIR__ . '/../../src/dependencies.php';

// Register middleware
		require __DIR__ . '/../../src/middleware.php';

// Register routes
		require __DIR__ . '/../../src/routes.php';

// Start Logger
		$this->logger = new Monolog\Logger($this->settings['settings']['logger']['name']);
		$this->logger->pushProcessor(new Monolog\Processor\UidProcessor());
		$this->logger->pushHandler(new Monolog\Handler\StreamHandler($this->settings['settings']['logger']['path'], $this->settings['settings']['logger']['level']));
	}

	protected function _after()
	{
	}

	// tests
	public function testGetVersion()
	{
		$mySLMInfo = new \API\SLMInfo($this->logger);
		$this->apiResults = $mySLMInfo->getVersion();
		$this->outputReturnStringData();
		$this->assertTrue($this->apiResults['retPack']['version'] == 2017);
		$this->logger->debug('test has been run');

	}

	public function testBuild()
	{
		$mySLMInfo = new \API\SLMInfo($this->logger);
		$this->apiResults = $mySLMInfo->getVersion();
		$this->outputReturnStringData();
		$this->assertTrue($this->apiResults['retPack']['build'] == 1);
		$this->logger->debug('test has been run');

	}

	protected function outputReturnStringData()
	{
		//codecept_debug('$resultString = ' . implode(',', $this->apiResults));
		codecept_debug('errCode = ' . $this->apiResults['errCode']);
		codecept_debug('errText = ' . $this->apiResults['errText']);
		codecept_debug('errLoc = ' . $this->apiResults['errLoc']);
		codecept_debug('custMsg = ' . $this->apiResults['custMsg']);
		codecept_debug('version = ' . $this->apiResults['retPack']['version']);
		codecept_debug('build = ' . $this->apiResults['retPack']['build']);
	}
}