<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);


use Auth0\SDK\JWTVerifier;
use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Interop\Container\ContainerInterface;

$headers =  getallheaders();
echo $headers['Authorization'], "\n\n\n";

$verifier = new JWTVerifier([
	'valid_audiences' => ['https://192.168.41.75/edeninfo'],
	'authorized_iss' => ['https://spotlightmartdev.auth0.com/'],
	'supported_algs' => ['RS256'],
	'cache' => new FileSystemCacheHandler() // This parameter is optional. By default no cache is used to fetch the Json Web Keys.

]);

$decoded = $verifier->verifyAndDecode($headers['Authorization']);

var_dump($decoded);

