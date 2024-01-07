<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

	function optionsCatalogue (Request $request, Response $response, $args) {
	    
	    // Evite que le front demande une confirmation à chaque modification
	    $response = $response->withHeader("Access-Control-Max-Age", 600);
	    
	    return addHeaders ($response);
	}

	function hello(Request $request, Response $response, $args) {
	    $array = [];
	    $array ["nom"] = $args ['name'];
	    $response->getBody()->write(json_encode ($array));
	    return $response;
	}

	function  getSearchCalatogue (Request $request, Response $response, $args) {
		
	    $filtre = $args['filtre'];
	    $flux = '[{ "id": 1, "name": "Produit 1", "category": "Catégorie 1", "price": 10 },
		{ "id": 2, "name": "Produit 2", "category": "Catégorie 1", "price": 11 },
		{ "id": 3, "name": "Produit 3", "category": "Catégorie 1", "price": 12 },
		{ "id": 4, "name": "Produit 4", "category": "Catégorie 1", "price": 13 },
		{ "id": 5, "name": "Produit 5", "category": "Catégorie 1", "price": 14 },
	
		{ "id": 6, "name": "Produit 6", "category": "Catégorie 2", "price": 10 },
		{ "id": 7, "name": "Produit 7", "category": "Catégorie 2", "price": 12 },
		{ "id": 8, "name": "Produit 8", "category": "Catégorie 2", "price": 14 },
		{ "id": 9, "name": "Produit 9", "category": "Catégorie 2", "price": 16 },
		{ "id": 10, "name": "Produit 10", "category": "Catégorie 2", "price": 18 },
		
		{ "id": 11, "name": "Produit 11", "category": "Catégorie 3", "price": 13 },
		{ "id": 12, "name": "Produit 12", "category": "Catégorie 3", "price": 16 },
		{ "id": 13, "name": "Produit 13", "category": "Catégorie 3", "price": 19 },
		{ "id": 14, "name": "Produit 14", "category": "Catégorie 3", "price": 21 },
		{ "id": 15, "name": "Produit 15", "category": "Catégorie 3", "price": 24 }]';		
		//$response->getBody()->write($flux);

		if ($filtre) {
			$data = json_decode($flux, true); 
	
			$res = array_filter($data, function($obj) use ($filtre) { 
				// Filtrer sur le nom, la catégorie et le prix
				return strpos($obj["category"], $filtre) !== false ||
					   strpos((string)$obj["price"], $filtre) !== false;
			});
	
			$response->getBody()->write(json_encode(array_values($res)));
		} else {
			$response->getBody()->write($flux);
		}
	
		return addHeaders($response);
	}

	// API Nécessitant un Jwt valide
	function getCatalogue (Request $request, Response $response, $args) {
		$flux = '[{ "id": 1, "name": "Produit 1", "category": "Catégorie 1", "price": 10 },
		{ "id": 2, "name": "Produit 2", "category": "Catégorie 1", "price": 11 },
		{ "id": 3, "name": "Produit 3", "category": "Catégorie 1", "price": 12 },
		{ "id": 4, "name": "Produit 4", "category": "Catégorie 1", "price": 13 },
		{ "id": 5, "name": "Produit 5", "category": "Catégorie 1", "price": 14 },
	
		{ "id": 6, "name": "Produit 6", "category": "Catégorie 2", "price": 10 },
		{ "id": 7, "name": "Produit 7", "category": "Catégorie 2", "price": 12 },
		{ "id": 8, "name": "Produit 8", "category": "Catégorie 2", "price": 14 },
		{ "id": 9, "name": "Produit 9", "category": "Catégorie 2", "price": 16 },
		{ "id": 10, "name": "Produit 10", "category": "Catégorie 2", "price": 18 },
		
		{ "id": 11, "name": "Produit 11", "category": "Catégorie 3", "price": 13 },
		{ "id": 12, "name": "Produit 12", "category": "Catégorie 3", "price": 16 },
		{ "id": 13, "name": "Produit 13", "category": "Catégorie 3", "price": 19 },
		{ "id": 14, "name": "Produit 14", "category": "Catégorie 3", "price": 21 },
		{ "id": 15, "name": "Produit 15", "category": "Catégorie 3", "price": 24 }]';	    
	    $response->getBody()->write($flux);
	    
	    return addHeaders ($response);
	}

	function optionsUtilisateur (Request $request, Response $response, $args) {
	    
	    // Evite que le front demande une confirmation à chaque modification
	    $response = $response->withHeader("Access-Control-Max-Age", 600);
	    
	    return addHeaders ($response);
	}

	// API Nécessitant un Jwt valide
	function getUtilisateur (Request $request, Response $response, $args) {
	    
	    $payload = getJWTToken($request);
	    $login  = $payload->userid;
	    
		$flux = '{"nom":"martin","prenom":"jean"}';
	    
	    $response->getBody()->write($flux);
	    
	    return addHeaders ($response);
	}

	// APi d'authentification générant un JWT
	function postLogin (Request $request, Response $response, $args) {  

		$payload = $request->getParsedBody();

		$login = $payload['login'];
		$password = $payload['password'];
	
		if ($login === 'emma' && $password === 'toto') {

			$flux = '{"nom":"martin","prenom":"jean"}';
			
			$response = createJwT ($response);
			$response->getBody()->write($flux );
			
			return addHeaders ($response);
		}
		else {
			$response->getBody()->write('{"error":"Invalid credentials"}');
			return $response->withStatus(401); 
		}
	}

