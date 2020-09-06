<?php
    require_once 'vendor/autoload.php';
    use Neoxygen\NeoClient\ClientBuilder;

    $client = ClientBuilder::create()
    ->addConnection('default','http','localhost',7474,true,'neo4j','admin')
    ->setAutoFormatResponse(true)
    ->setDefaultTimeout(200)
    ->build();

    $id = '';
    $nom = '';
    if(isset($_POST['cat_person_id_mod'])){
        // Update
        $req = "MATCH (n:CategoriePersonne { id: '".$_POST['cat_person_id_mod']."' })
        SET n.name = '".$_POST['cat_person_name_mod']."'
        ";
        $result = $client->sendCypherQuery($req)->getResult();
        { ?>
            <script>window.location.assign('cat-personne.php')</script>
        <?php }
    }
    if($_GET['cat_person_id']){
        $q = "MATCH (n:CategoriePersonne {id:'".$_GET['cat_person_id']."'}) RETURN n";
        $client->sendCypherQuery($q);
        $result = $client->getRows();
        if(count($result) > 0){
            $tab_personnes = $result['n'];
            foreach($tab_personnes as $tab_personne){
                $id = $tab_personne['id'];
                $nom = $tab_personne['name'];
            }
        }else{ ?>
            <script>window.location.assign('cat-personne.php')</script>
        <?php }
    }else{ ?>
        <script>window.location.assign('cat-personne.php')</script>
    <?php }
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
            <a href="personne.php">RETOUR</a>
        </div>
        <h1>Modification des informations d'une catégoire de personne</h1>
        <form action="edit-cat-personne.php" method="POST">
            <div>
                <label for="">Id</label><br>
                <input type="text" id="" name="cat_person_id_mod" readonly value="<?php echo $id; ?>" required>
            </div>
            <div>
                <label for="">Nom</label><br>
                <input type="text" id="" name="cat_person_name_mod" value="<?php echo $nom; ?>" required>
            </div>
            <div style="margin-top:30px;">
                <button type="submit">ENREGISTRER</button>
            </div>
            <div style="margin-top:30px;">
                <button type="reset">EFFACER</button>
            </div>
        </form>
    </body>
    <footer></footer>
</html>