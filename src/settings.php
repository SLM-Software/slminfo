<?php
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Dotenv.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Loader.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Validator.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/ExceptionInterface.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidPathException.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidFileException.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/InvalidCallbackException.php';
require __DIR__ . '/../vendor/vlucas/phpdotenv/src/Exception/ValidationException.php';

$dotEnv = new \Dotenv\Dotenv(__DIR__ . '/../../../../../../', 'eden.env');
$dotEnv->load();

return [
	'settings' => [
		'displayErrorDetails'    => $_ENV['APP_DISPLAYERRORDETAILS'],
		'addContentLengthHeader' => $_ENV['APP_ADDCONTENTLENGTHHEADER'], // Allow the web server to send the content-length header
		'VERSION' => $_ENV['APP_VERSION'],
		'BUILD' => $_ENV['APP_BUILD'],

		// Renderer settings
		'renderer'               => [
			'template_path' => __DIR__ . '/../templates/',
		],

		// Monolog settings
		'logger'                 => [
			'name'  => 'EDENINFO',
			'path'  => __DIR__ . $_ENV['LOG_PATH'] . 'edeninfo.log',
			'level' => $_ENV['LOG_LEVEL'],
		],
    ],
];