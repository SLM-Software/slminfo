<?php
// Application middleware
// e.g: $app->add(new \Slim\Csrf\Guard);

use Auth0\SDK\JWTVerifier;
use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler;
use Auth0\SDK\Exception\CoreException;
use Auth0\SDK\Exception\InvalidTokenException;

class Middleware
{
	protected $container;

	public function __construct($container)
	{
		$this->container = $container;
	}

	/**
	 * Short Description
	 *
	 * Long Description
	 *
	 */
	public function __invoke($request, $response, $next)
	{
//		$this->myLogger->debug(__METHOD__);

		$headers = getallheaders();
		$myResponse = $response;

		try
		{
			$verifier = new JWTVerifier(['valid_audiences' => ['https://192.168.41.75/edeninfo'],
			                             'authorized_iss'  => ['https://spotlightmartdev.auth0.com/'],
			                             'supported_algs'  => ['RS256']
			]);
			$verifier->verifyAndDecode($headers['Authorization']);
		} catch (InvalidTokenException $e)
		{
			return $myResponse->withJson(array('errCode'    => 401,
			                                   'statusText' => $e->getMessage(),
			                                   'codeLoc'    => __METHOD__,
			                                   'custMsg'    => '',
			                                   'retPack'    => array('token' => $headers['Authorization'])));
		} catch (CoreException $e)
		{
			return $myResponse->withJson(array('errCode'    => 401,
			                                   'statusText' => $e->getMessage(),
			                                   'codeLoc'    => __METHOD__,
			                                   'custMsg'    => '',
			                                   'retPack'    => array('token' => $headers['Authorization'])));
		}

		$myResponse = $next($request, $response);

		return $myResponse;
	}
}




//use Auth0\SDK\JWTVerifier;
//use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler;
//use Psr\Http\Message\ServerRequestInterface;
//use Psr\Http\Message\ResponseInterface;
//use Interop\Container\ContainerInterface;

/**
 * Example middleware closure
 *
 * @param  \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
 * @param  \Psr\Http\Message\ResponseInterface      $response PSR7 response
 * @param  callable                                 $next     Next middleware
 *
 * @return \Psr\Http\Message\ResponseInterface
 */
//function ($request, $response, $next)
//{
//	$response->getBody()->write('BEFORE');
//	$response = $next($request, $response);
//	$response->getBody()->write('AFTER');
//
//	return $response;
//};
//
//function validateToken()
//{
//	try
//	{
//		$verifier = new JWTVerifier(['valid_audiences' => ['https://192.168.41.75/edeninfo'],
//		                             'authorized_iss'  => ['https://spotlightmartdev.auth0.com/'],
//		                             'supported_algs'  => ['RS256'],
//		                             'cache'           => new FileSystemCacheHandler() // This parameter is optional. By default no cache is used to fetch the Json Web Keys.]);
//		]);
//
//		$headers = getallheaders();
//		$decoded = $verifier->verifyAndDecode($headers['Authorization']);
//	} catch
//	(InvalidTokenException $e)
//	{
//		deny_access();
//	} catch (CoreException $e)
//	{
//		deny_access();
//	} finally
//	{
//		var_dump($decoded);
//	}
//};
//
///**
// * Deny Access
// *
// */
//function deny_access()
//{
//	$res = $this->app->response();
//	$res->status(401);
//	return $res;
//};
