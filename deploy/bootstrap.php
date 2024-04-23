<?php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;
	date_default_timezone_set('America/Lima');
	require_once "vendor/autoload.php";
	$isDevMode = true;
	$config = Setup::createYAMLMetadataConfiguration(array(__DIR__ . "/config/yaml"), $isDevMode);
	$conn = array(
	'host' => 'dpg-cojuckgcmk4c73c47g9g-a.oregon-postgres.render.com',
	'driver' => 'pdo_pgsql',
	'user' => 'cnam_ccza_user',
	'password' => 'jNpnToG4mPPwKQVFmd7Wm6AbDpQHwjam',
	'dbname' => 'cnam_ccza',
	'port' => '5432'
	);


	$entityManager = EntityManager::create($conn, $config);



