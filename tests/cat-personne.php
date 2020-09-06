<?php
    require_once 'vendor/autoload.php';
    use Neoxygen\NeoClient\ClientBuilder;
    $client = ClientBuilder::create()
        ->addConnection('default','http','localhost',7474,true,'neo4j','admin')
        ->setAutoFormatResponse(true)
        ->setDefaultTimeout(200)
        ->build();

    if(isset($_POST['cat_person_id'])){
        // Insert
        $query = "CREATE (personne:CategoriePersonne {name:'".$_POST['cat_person_name']."', id:'".$_POST['cat_person_id']."'}) RETURN personne";
        $result = $client->sendCypherQuery($query)->getResult();
    }
    if($_GET['cat_person_id']){
        // Delete single data of label
        $req = "MATCH (a:CategoriePersonne{ id: '".$_GET['cat_person_id']."' }) 
        DELETE a";
        $result = $client->sendCypherQuery($req)->getResult();
    }

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
                font-size:20px;
                width:100%;
                padding:17px 7px;
            }
            div{
                padding:10px;
                width:48%;
                float:left;
            }
            label{
                font-size:20px;
            }
            button{
                cursor:pointer;
                width:100%;
                font-size:25px;
                border: 1px solid #aaa;
                background:#eee;
                padding:30px 100px;
            }
            h1{
                font-size:50px;
            }
            table{
                border-top:1px solid #000;
                border-bottom:1px solid #000;
                text-align:left;
                width:100%;
                border-left:1px solid #000;
                border-right:1px solid #000;
            }
            table th, td{
                border-left:1px solid #000;
                border-bottom:1px solid #000;
                padding:20px;
            }
        </style>
    </head>
    <body>
        <div style="width:100%;text-align:left;margin-bottom:50px;">
            <a href="index.php">RETOUR</a>
        </div>
        <h1>Formulaire de création de catégorie de personne</h1>
        <form action="cat-personne.php" method="POST">
            <div>
                <label for="">Id</label><br>
                <input type="text" id="" name="cat_person_id" required>
            </div>
            <div>
                <label for="">Nom</label><br>
                <input type="text" id="" name="cat_person_name" required>
            </div>
            <div style="margin-top:30px;">
                <button type="submit">ENREGISTRER</button>
            </div>
            <div style="margin-top:30px;">
                <button type="reset">EFFACER</button>
            </div>
        </form>
        <div style="width:100%;">
            <h1 style="margin-top:100px;text-align:center;">Liste des categories de personne</h1>
        </div>
        <table>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>ACTION</th>
            </tr>
            <?php
                $query = 'MATCH (n:CategoriePersonne) RETURN n';
                $client->sendCypherQuery($query);
                $result = $client->getRows();
                $tab_personnes = $result['n'];
                foreach($tab_personnes as $tab_personne){
                    echo '
                        <tr>
                            <td>'.$tab_personne['id'].'</td>
                            <td>'.$tab_personne['name'].'</td>
                            <td>
                                <a href="edit-cat-personne.php?cat_person_id='.$tab_personne['id'].'">Editer</a>
                                <a href="cat-personne.php?cat_person_id='.$tab_personne['id'].'">Supprimer</a>
                            </td>
                        </tr>
                    ';
                }
            ?>
        </table>
    </body>
    <footer></footer>
</html>