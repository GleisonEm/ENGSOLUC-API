<?php

return [
	'default' => env('DB_CONNECTION', 'mysql'),

	'migrations' => 'migrations',

	'connections' => [
		'mysql' => [
			'driver' => 'mysql',
			'host' => env('DB_HOST', '127.0.0.1'),
			'port' => env('DB_PORT', '3306'),
			'database' => env('DB_DATABASE', 'forge'),
			'username' => env('DB_USERNAME', 'forge'),
			'password' => env('DB_PASSWORD', ''),
			'unix_socket' => env('DB_SOCKET', ''),
			'prefix' => env('DB_PREFIX', ''),
			'charset' => 'utf8mb4',
			'collation' => 'utf8mb4_unicode_ci',
			'prefix_indexes' => true,
			'strict' => false,
		],
		'mongodb-mongo' => [
			'driver' => 'mongodb',
			'host' => env('DB_MONGO_HOST', '127.0.0.1'),
			'port' => env('DB_MONGO_PORT', 27017),
			'database' => env('DB_MONGO_DATABASE', 'homestead'),
			'username' => env('DB_MONGO_USERNAME', 'homestead'),
			'password' => env('DB_MONGO_PASSWORD', 'secret'),
			'options' => [
				'database' => 'admin',
			],
		],
	],
];
