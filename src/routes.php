<?php
//Routes

$app->get(
    '/slm/api/slminfo/version', function ($request, $response, $args) {
    $this->logger->info("version '/' route");

    $data = array('year' => '2017', 'build' => '1');
    return $response->withJson($data);
});

$app->get(
    '/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("SLMInfo:catch-all '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
