<?php
//Routes

// For Testing only
//var_dump($_SERVER);

$app->group('', function(){
	$this->get(
		'/edeninfo/version', function ($request, $response, $args) {
		$this->logger->info("version '/' route");
		$myEDENInfo = new \API\EDENInfo($this->logger, $this->get('settings'));

		return $response->withJson($myEDENInfo->getVersion());
	});
})->add(new Middleware($container));
