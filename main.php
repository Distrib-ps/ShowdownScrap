<?php 
//http://localhost/showdownscrap-main/test.php?id=gen8randombattle&bouton=decroissant
require('functions.php');
$pdo=database_connect();
//$req=delete_table();
if(!empty($_GET))
{

  $id=$_GET['id'];
  // chemin d'accès à votre fichier JSON
  $url = 'http://pokemonshowdown.com/ladder/'.$id.'.json'; 
  //$url = 'data.json'; 
  // mettre le contenu du fichier dans une variable
  $data = file_get_contents($url); 
  // décoder le flux JSON
  $obj = json_decode('['.$data.']'); 
  // On récupére le format
} else {
    $url = 'http://pokemonshowdown.com/ladder/gen8ou.json'; 
    //$url = 'data.json'; 
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
<center>
<form name="id" method="GET">
<nav class="dropdownmenu">
            <ul>
              <li><input type='submit' value='gen8ou' name='id' /></li>
              <li><input type='submit' value='gen8randombattle' name='id' /></li>
              <li><input type='submit' value='gen7ou' name='id' /></li>
              <li><input type='submit' value='gen8ubers' name='id' /></li>
              <li><input type='submit' value='gen8uu' name='id' /></li>
            </ul>
</nav>
</form>


  <nav class="dropdownmenu">
  <ul><li><input type='submit' value='btlt' onclick="window.location='btlt.php';" /></li></ul>
  </nav>


<form method="POST" action=""> 
<div class="group">
     <input class="text" type="text" name="recherche" placeholder='Rechercher un utilisateur'>
     <span class="highlight"></span>
      <span class="bar"></span>
</div>
     <input type="SUBMIT" value="Rechercher"> 
     
</form>

<a href="<?php echo $_SERVER['REQUEST_URI']; ?>&bouton=decroissant">Décroissant</a>
<P><HR class="style18" SIZE="1"></P>
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
      "INSERT INTO test VALUES (:formatid, :formatt, :userid, :username, :w, :l, :t, :gxe, :r, :rd, :sigma, :rptime, :rpr, :rprd, :rpsigma, :elo); "); 
      $query->bindValue(':formatid', $formatid, PDO::PARAM_STR);
      $query->bindValue(':formatt', $format, PDO::PARAM_STR);
      $query->bindValue(':userid', $row->userid, PDO::PARAM_STR);
      $query->bindValue(':username', $row->username, PDO::PARAM_STR);
      $query->bindValue(':w', $row->w, PDO::PARAM_STR);
      $query->bindValue(':l', $row->l, PDO::PARAM_STR);
      $query->bindValue(':t', $row->t, PDO::PARAM_STR);
      $query->bindValue(':gxe', $row->gxe, PDO::PARAM_STR);
      $query->bindValue(':r', $row->r, PDO::PARAM_STR);
      $query->bindValue(':rd', $row->rd, PDO::PARAM_STR);
      $query->bindValue(':sigma', $row->sigma, PDO::PARAM_STR);
      $query->bindValue(':rptime', $row->rptime, PDO::PARAM_STR);
      $query->bindValue(':rpr', $row->rpr, PDO::PARAM_STR);
      $query->bindValue(':rprd', $row->rprd, PDO::PARAM_STR);
      $query->bindValue(':rpsigma', $row->rpsigma, PDO::PARAM_STR);
      $query->bindValue(':elo', $row->elo, PDO::PARAM_STR);
//var_dump($row->elo);
      $resultat = $query->execute();

    }
      $recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';
      if($recherche){
        show_user($recherche);
      } else {


        $colTab = ['decroissant']; 
        if (isset($_GET['bouton']) AND in_array($_GET['bouton'], $colTab))
        {
          show_db_order();

        } else {
        
            show_db(); 
        }
    }
      echo '</table>';
?>
            </div>
            <div id="data">
    
            </div>

  </center>
    </body>
</html>