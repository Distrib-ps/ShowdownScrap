<?php 
require('test2.php');
$pdo=database_connect();
$req=delete_table();

if(!empty($_POST))
{

  $id=$_POST['id'];
  // chemin d'accès à votre fichier JSON
  //$url = 'http://pokemonshowdown.com/ladder/'.$id.'.json'; 
  $url = 'data.json'; 
  // mettre le contenu du fichier dans une variable
  $data = file_get_contents($url); 
  // décoder le flux JSON
  $obj = json_decode('['.$data.']'); 
  // On récupére le format
  } else {
    //$url = 'http://pokemonshowdown.com/ladder/gen8ou.json'; 
    $url = 'data.json'; 
    $data = file_get_contents($url); 
    $obj = json_decode('['.$data.']'); 
  }
  $formatid = $obj[0]->formatid;
  $format = $obj[0]->format;


$selectAll = selectAll();

?> 

<html>
    <head>
        <link rel="stylesheet" href="style.css">            
</head>
<form name="id" method="POST">
<nav class="dropdownmenu">
            <ul>
              <li><input type='submit' value='gen8ou' name='id' /></li>
              <li><input type='submit' value='gen8randombattle' name='id' /></li>
              <li><input type='submit' value='gen8ou' name='id' /></li>
              <li><input type='submit' value='gen7ou' name='id' /></li>
              <li><input type='submit' value='gen8ubers' name='id' /></li>
              <li><input type='submit' value='gen8uu' name='id' /></li>
            </ul>
</nav>
</form>
    <body>
        <div id="demo">
            <h1></h1>
            <h2></h2>
            
            <!-- Responsive table starts here -->
            <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
            <div class="table-responsive-vertical shadow-z-1">
            <!-- Table starts here -->
            <div class="wrapper">
                <div class="profile">
                   <table id= "gen8ou" border="2">
                   <?= "<caption>" . $obj[0]->format . "</caption>" ?>
                <thead>
                  <tr>
                    <th></th>
                    <th>User</th>
                    <th>Elo</th>
                    <th>GXE</th>
                    <th>W</th>
                    <th>L</th>
                    <th>Total</th>
                  </tr>
                </thead>

                    <?php
$i=1;      
  foreach(array_slice($obj[0]->toplist, 0) as $row)
  { 

  
      $query = $pdo->prepare( 
      "INSERT INTO test VALUES 
      ('".$formatid."', '".$format."', '".$row->userid."\n', '".$row->username."\n', '".$row->w."', '".$row->l."', '".$row->t."', '".$row->gxe."', '".$row->r."', '".$row->rd."', '".$row->sigma."', '".$row->rptime."', '".$row->rpr."', '".$row->rprd."', '".$row->rpsigma."', 
      '".$row->elo."'); "); 
      $query->setFetchMode(PDO::FETCH_ASSOC);
      $query->execute();

  }
  
      show_db(); 
      echo '</table>';
?>
            </div>
            <div id="data">
    
            </div>

            
    </body>
</html>