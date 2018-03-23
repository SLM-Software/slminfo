<?php


class EDENInfoRESTTest extends \Codeception\Test\Unit
{
	/**
	 * @var \UnitTester
	 */
	protected $tester;

	/**
	 * @var \API Results
	 */
	protected $apiResults;

	/**
	 * @var \accessToken
	 */
	protected $token;

	protected function _before()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://spotlightmartdev.auth0.com/oauth/token",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\"client_id\":\"sYcJC2UzUCBsNbq38LwQuZ9z28gGWC54\",\"client_secret\":\"52nHcXNMOL1LO1BU-4Wr09Fl5SyBiMbMoA85x6QIE7ur9UvaOngW-vnAd_fcNVY_\",\"audience\":\"https://localhost/edeninfo\",\"grant_type\":\"client_credentials\"}",
			CURLOPT_HTTPHEADER => array(
				"content-type: application/json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$this->token = json_decode($response)->access_token;
		}
	}

	protected function _after()
	{
	}

	// tests
	public function testEDENInfoREST()
	{
		$headers = [
			'Authorization' => $this->token,
			'Accept'        => 'application/json',
			'Cache-Control' => 'no-cache',
			'verify'        => false,
		];

		codecept_debug('Starting testEDENInfoREST - Executing edeninternal/version:');
		$this->client = new \GuzzleHttp\Client(['base_uri' => 'https://' . $_ENV['CURL_HOST'] . ':' . $_ENV['CURL_PORT'], 'timeout' => 2.0]);
		$res = $this->client->request('GET', '/edeninfo/version', ['verify' => false, 'headers' => $headers]);
		$this->apiResults = json_decode($res->getBody());
		$assertResult['TestVersion'] = $this->assertTrue( $this->apiResults->retPack->version == $_ENV['APP_VERSION']);
		$assertResult['TestBuild'] = $this->assertTrue($this->apiResults->retPack->build == $_ENV['APP_BUILD']);
		$this->displayAssertions($assertResult);
	}

	protected function displayAssertions($assertResult)
	{
		foreach ($assertResult as $key => $value)
		{
			if ($value == 0)
			{
				$resultDisplay = 'Passed';
			} else
			{
				$resultDisplay = 'Failed';
			}
			codecept_debug('-> Assertion[' . $key . '] ' . $resultDisplay);
		}
	}}