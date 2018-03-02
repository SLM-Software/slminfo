<?php
//Routes

// For Testing only
//var_dump($_SERVER);

$app->get(
    '/edeninfo/version', function ($request, $response, $args) {
    $this->logger->info("version '/' route");
	$versionSetting = $this->get('settings')['VERSION'];
	$buildSetting = $this->get('settings')['BUILD'];
    $myEDENInfo = new \API\EDENInfo($this->logger, $versionSetting, $buildSetting);

    return $response->withJson($myEDENInfo->getVersion());
});

$app->get(
    '/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("EDENInfo:catch-all '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
