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
    // $query = 'CREATE (personne:CategoriePersonne {name:"Physique"}) RETURN personne';
    // $result = $client->sendCypherQuery($query)->getResult();


    // Get personne registered and show
    // $personne = $result->getSingleNode();
    // $name = $personne->getProperty('name');
    // echo $name ;

    // Get all personne
    // $q = 'MATCH (n:personne) RETURN n.name';
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
    // $req = "MATCH (n:Personne { id: '1' })
    // SET n.prenom = 'Issouf'";
    // $result = $client->sendCypherQuery($req)->getResult();
    // print_r($result);
?>
<html>
    <head>
        <style>
            body{
                text-align:center;
                padding:50px;
            }
            form{
                padding:30x;
                text-align:left;
            }
            input{
                width:100%;
                padding:7px;
            }
            div{
                padding:10px;
                width:48%;
                float:left;
            }
            button{
                cursor:pointer;
                width:100%;
                font-size:25px;
                border: 1px solid #aaa;
                background:#eee;
                padding:100px 100px;
            }
            h1{
                font-size:50px;
            }
        </style>
    </head>
    <body>
        <h1>MENU</h1>
        <div>
            <button onclick="goTo('cat-personne.php')">CATEGORIE DE PERSONNE</button>
        </div>
        <div>
            <button onclick="goTo('personne.php')">PERSONNE</button>
        </div>
    </body>
    <footer></footer>
</html>
<script>
    function goTo(url){
        window.location.assign(url)
    }
</script>