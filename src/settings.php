<?php

$envPath = '';
if (array_key_exists('MAPP', getenv()))
{
	$envPath = getenv('MAPP');
} else if (array_key_exists('LAPP', getenv()))
{
	$envPath = getenv('LAPP');
} else
{
	echo 'Missing MAPP or LAPP environment variable! System will not function without this being set.';
	throw new Exception('Missing MAPP or LAPP environment variable! System will not function without this being set.');
};
$dotEnv = new \Dotenv\Dotenv($envPath . '/.env/', 'eden.env');
$dotEnv->load();

$applicationName = 'edeninfo';

return [
	'settings' => [
		'APP_NAME'               => $applicationName,
		'VERSION'                => $_ENV['APP_VERSION'],
		'BUILD'                  => $_ENV['APP_BUILD'],

//		Auth0 settings
		'AUTH0_ISSUER'           => $_ENV['APP_AUTH0_ISSUER'],
		'AUTH0_AUDIENCES_HOST'   => $_ENV['APP_AUTH0_AUDIENCES_HOST'],
		'AUTH0_ALGORITHMS'       => $_ENV['APP_AUTH0_ALGORITHMS'],
		'AUTH0_CREDPATH'         => $_ENV['APP_AUTH0_CREDPATH'],
		'AUTH0_CREDPREFIX'       => $_ENV['APP_AUTH0_CREDPREFIX'],
		'AUTH0_CREDEXT'          => $_ENV['APP_AUTH0_CREDEXT'],

//		 Monolog settings
		'logger'                 => [
			'name'  => $applicationName,
			'path'  => __DIR__ . $_ENV['LOG_PATH'] . $applicationName . '.log',
			'level' => $_ENV['LOG_LEVEL'],
		],
    ],
];