<?php 
//http://localhost/showdownscrap-main/test.php?id=gen8randombattle&bouton=decroissant
require('functions.php');
$pdo=database_connect();
?>
<form method="POST" action=""> 
  <button type="SUBMIT" value="supp" name="supp">Supprimer les utilisateurs</button>
</form>

<?php
$supp = isset($_POST['supp']) ? $_POST['supp'] : '';
  if($supp)
      {
        delete_table_user();
        insert_user_test();
        echo('La table des utilisateurs ont étaient supprimer');
      }
?>

<form method="POST" action=""> 
     Ajouter un utilisateur : <input type="text" name="Ajouter">
     <input type="SUBMIT" value="Ajouter"> 
</form>
<?php
$Ajouter = isset($_POST['Ajouter']) ? $_POST['Ajouter'] : '';
      if($Ajouter){
        adduser($Ajouter);
        echo('<p style="color:#FF0000";>Utilisateur '.$Ajouter.' ajouté dans la base de donnée</p><br>');
      } 
?>
<form method="POST" action=""> 
  <button type="SUBMIT" value="reload" name="reload">Recharger la base</button> /!\Attendre le message de validation avant de recharger ou cliquer sur un autre bouton
</form>

<?php

$supp = isset($_POST['reload']) ? $_POST['reload'] : '';
  if($supp)
      {
        $del=delete_table_users();
        foreach($pdo->query('SELECT username FROM user;') as $azzzz) {
          $okay[]=$azzzz['username'];
        }
        $compteur = count($okay);
        for ($i = 0; $i < $compteur; $i++){
          //echo($okay[$i]);
          // chemin d'accès à votre fichier JSON
          $url = 'http://pokemonshowdown.com/user/'.$okay[$i].'.json'; 
          //echo($url);
          //$url = 'data_user.json'; 
          // mettre le contenu du fichier dans une variable
          $url = str_replace(' ', '', $url);
          $context = stream_context_create(array(
            'http' => array('ignore_errors' => true),
        ));
        
          $data = file_get_contents($url, false, $context);
         // $data = file_get_contents($url); 
          // décoder le flux JSON
          $obj = json_decode('['.$data.']', true);
          // On récupére le format
        
        //var_dump($obj);
        
        //$req=delete_table();
        
          $username = $obj[0]['username'];
          $userid = $obj[0]['userid'];
          $registertime = $obj[0]['registertime'];
          $group = $obj[0]['group'];
          $formatid = 'gen7ou';
          $elo = isset($obj[0]["ratings"][$formatid]['elo']);
          if($elo==0){
            $elo=0;
          } else {
            $elo = $obj[0]["ratings"][$formatid]['elo'];
          }
          $gxe = isset($obj[0]["ratings"][$formatid]['gxe']);
          if($gxe==0){
            $gxe=0;
          } else {
            $gxe = $obj[0]["ratings"][$formatid]['gxe'];
          }
          $rpr = isset($obj[0]["ratings"][$formatid]['rpr']);
          if($rpr==0){
            $rpr=0;
          } else {
            $rpr = $obj[0]["ratings"][$formatid]['rpr'];
          }
          $rprd = isset($obj[0]["ratings"][$formatid]['rprd']);
          if($rprd==0){
            $rprd=0;
          } else {
            $rprd = $obj[0]["ratings"][$formatid]['rprd'];
          }
        
        //  echo($username . $userid . $registertime . $group . $formatid . $elo . $gxe . $rpr . $rprd);
        
              $query = $pdo->prepare( 
              "INSERT INTO users (username, userid, registertime, groups, formatid, elo, gxe, rpr, rprd) VALUES (:username, :userid, :registertime, :groups, :formatid, :elo, :gxe, :rpr, :rprd); "); 
              $query->bindValue(':username', $username, PDO::PARAM_STR);
              $query->bindValue(':userid', $userid, PDO::PARAM_STR);
              $query->bindValue(':registertime', $registertime, PDO::PARAM_STR);
              $query->bindValue(':groups', $group, PDO::PARAM_STR);
              $query->bindValue(':formatid', $formatid, PDO::PARAM_STR);
              $query->bindValue(':elo', $elo, PDO::PARAM_STR);
              $query->bindValue(':gxe', $gxe, PDO::PARAM_STR);
              $query->bindValue(':rpr', $rpr, PDO::PARAM_STR);
              $query->bindValue(':rprd', $rprd, PDO::PARAM_STR);
        //var_dump($row->elo);
              $resultat = $query->execute();
              
              }
        echo('<p style="color:#FF0000";>Données mise à jour !</p>');
      }
      
?>
<button onclick="window.location.href = 'btlt.php';">Retour BTLT</button>