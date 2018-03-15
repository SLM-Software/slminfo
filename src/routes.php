<?php
//Routes

// For Testing only
//var_dump($_SERVER);

$app->group('', function(){
	$this->get(
		'/edeninfo/version', function ($request, $response, $args) {
		$this->logger->info("version '/' route");
		$versionSetting = $this->get('settings')['VERSION'];
		$buildSetting = $this->get('settings')['BUILD'];
		$myEDENInfo = new \API\EDENInfo($this->logger, $versionSetting, $buildSetting);

		return $response->withJson($myEDENInfo->getVersion());
	});
})->add(new Middleware($container));


// This is not needed as we don't want to provide any information about our API's except to registered users.
//
//$app->get(
//    '//edeninfo/[{name}]', function ($request, $response, $args) {
//    // Sample log message
//    $this->logger->info("EDENInfo:catch-all '/' route");
//
//    // Render index view
//    return $this->renderer->render($response, 'index.phtml', $args);
//});
