<?php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	date_default_timezone_set('America/Lima');
	require_once "vendor/autoload.php";
	$isDevMode = true;
	$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
	$conn = array(
	'host' => 'dpg-cok0d7gl6cac73e70b2g-a.oregon-postgres.render.com',
	'driver' => 'pdo_pgsql',
	'user' =>'cnam_l5ol_usera',
	'password' => 'VoZBXopqdGnJ5Vilgny4Jc0ANIK6XqPY',
	'dbname' => 'cnam_l5ol',
	'port' => '5432'
	);


	$entityManager = EntityManager::create($conn, $config);



