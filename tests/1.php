<?php
require_once 'vendor/autoload.php';

use Neoxygen\NeoClient\ClientBuilder;

$client = ClientBuilder::create()
    ->addConnection('default','http','localhost',7474,true,'neo4j','admin')
    ->setAutoFormatResponse(true)
    ->setDefaultTimeout(200)
    ->build();

    // Insertion
    // $query = 'CREATE (personne:Personne {id:"1",nom:"Woumtana",prenom:"Youssouf"}) RETURN personne';
    // $result = $client->sendCypherQuery($query)->getResult();
    // $query = 'CREATE (user:CategoriePersonne {name:"Physique"}) RETURN user';
    // $result = $client->sendCypherQuery($query)->getResult();


    // Get user registered and show
    // $user = $result->getSingleNode();
    // $name = $user->getProperty('name');
    // echo $name ;

    // Get all user
    // $q = 'MATCH (n:User) RETURN n.name';
    // $client->sendCypherQuery($q);
    // $result = $client->getRows();
    // $tabs = $result['n.name'];
    // foreach($tabs as $tab){
    //     // echo $tab;
    // }

    // Delete all data
    // $req = 'MATCH (n) DETACH DELETE n';
    // $result = $client->sendCypherQuery($req)->getResult();
    // print_r($result);

    // Delete all data of label
    // $req = 'MATCH (a:CategoriePersonne) 
    // DELETE a';
    // $result = $client->sendCypherQuery($req)->getResult();
    // print_r($result);

    // Delete single data of label
    // $req = "MATCH (a:Personne{ id: '1' }) 
    // DELETE a";
    // $result = $client->sendCypherQuery($req)->getResult();
    // print_r($result);

    // Update single data of label
    $req = "MATCH (n:Personne { id: '1' })
    SET n.prenom = 'Issouf'";
    $result = $client->sendCypherQuery($req)->getResult();
    print_r($result);