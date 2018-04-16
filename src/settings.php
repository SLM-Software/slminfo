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

return [
	'settings' => [
		'ISSUER'                 => $_ENV['APP_ISSUER'],
		'AUDIENCES_HOST'         => $_ENV['APP_AUDIENCES_HOST'],
		'ALGORITHMS'             => $_ENV['APP_ALGORITHMS'],
		'displayErrorDetails'    => $_ENV['APP_DISPLAYERRORDETAILS'],
		'addContentLengthHeader' => $_ENV['APP_ADDCONTENTLENGTHHEADER'], // Allow the web server to send the content-length header
		'VERSION'                => $_ENV['APP_VERSION'],
		'BUILD'                  => $_ENV['APP_BUILD'],

		// Monolog settings
		'logger'                 => [
			'name'  => 'EDENINFO',
			'path'  => __DIR__ . $_ENV['LOG_PATH'] . 'edeninfo.log',
			'level' => $_ENV['LOG_LEVEL'],
		],
    ],
];