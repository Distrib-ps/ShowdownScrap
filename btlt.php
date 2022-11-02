<?php 
//http://localhost/showdownscrap-main/test.php?id=gen8randombattle&bouton=decroissant
require('functions.php');
?> 
<html>
    <head>
        <link rel="stylesheet" href="style.css">            
</head>
<center>
        <div id="demo">
            <div class="table-responsive-vertical shadow-z-1">
            <!-- Table starts here -->
            <div class="wrapper">
                <div class="profile">
                   <table id= "gen8ou" border="2">
                   <?php $formatid = 'gen7ou'; ?>
                   <?= "<caption>" . $formatid . "</caption>" ?>
                <thead>
                  <tr>
                    <th></th>
                    <th>User</th>
                    <th>Elo</th>
                    <th>GXE</th>
                  </tr>
                </thead>

<?php
        
      show_db_users(); 
      echo '</table>';
?>
            </div>
            <div id="data">
    
            </div>
            <a href="main.php">Retour</a>
            <a href="admin.php">Admin</a>

</center>
            
    </body>
</html>