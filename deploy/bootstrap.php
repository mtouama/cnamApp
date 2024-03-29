<?php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	date_default_timezone_set('America/Lima');
	require_once "vendor/autoload.php";
	$isDevMode = true;
	$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
	$conn = array(
	'host' => 'dpg-co3hao6d3nmc739csiag-a.oregon-postgres.render.com',
	'driver' => 'pdo_pgsql',
	'user' => 'cnambdd_user',
	'password' => 'oZvEBkIR2EMUPuyOQkSeAYUA9yIeG1os',
	'dbname' => 'cnambdd',
	'port' => '5432'
	);


	$entityManager = EntityManager::create($conn, $config);



