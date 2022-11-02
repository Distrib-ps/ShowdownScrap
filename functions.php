
<?php

function database_connect() {
	static $pdo = null;
	
	if ($pdo === null) {
		$dns = 'mysql:host=localhost;dbname=showdownscrap;charset=utf8';
		$username = 'root';
		$password = '';
		
		$pdo = new PDO($dns, $username, $password);
	}
	
	return $pdo;

}
function show_db() {
    $pdo=database_connect();
    //sleep(5);
   // $cequetuveux = array();
    $i=1;
    foreach($pdo->query('SELECT * FROM test;') as $data) {
        // on affiche les résultats
        echo "<tr>
        <td>".$i++."</td>
        <td>".$data['username']."</td>
        <td>".$data['elo']."</td>
        <td>".$data['gxe']."</td>
        <td>".$data['w']."</td>
        <td>".$data['l']."</td>
        <td>".$data['l']+$data['w']."</td>
        </tr>";
       // $cequetuveux[]=$data['elo'];
    }
}
function show_db_order() {
    $pdo=database_connect();
    //sleep(5);
   // $cequetuveux = array();
    $i=500;
    foreach($pdo->query('SELECT * FROM `test` ORDER BY `test`.`elo` ASC') as $data) {
        // on affiche les résultats
        echo "<tr>
        <td>".$i--."</td>
        <td>".$data['username']."</td>
        <td>".$data['elo']."</td>
        <td>".$data['gxe']."</td>
        <td>".$data['w']."</td>
        <td>".$data['l']."</td>
        <td>".$data['l']+$data['w']."</td>
        </tr>";
       // $cequetuveux[]=$data['elo'];
    }
}
function delete_table() {

    $pdo=database_connect();
    $req = $pdo->prepare("TRUNCATE Table test");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
}
function delete_table_users() {

    $pdo=database_connect();
    $req = $pdo->prepare("TRUNCATE Table users");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
}
function delete_table_user() {

    $pdo=database_connect();
    $req = $pdo->prepare("TRUNCATE Table user");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
}
function insert_user_test() {

    $pdo=database_connect();
    //sleep(5);
    $sqlinsert = $pdo->prepare( 
    "INSERT INTO user (username) VALUES (:username); "); 
    $sqlinsert->bindValue(':username', 'BTLT007 AxCypher', PDO::PARAM_STR);
    $result_user = $sqlinsert->execute();
}

function selectAll() {

    $pdo=database_connect();
    $selectAll = $pdo->prepare("TRUNCATE Table test");
    $selectAll->setFetchMode(PDO::FETCH_ASSOC);
    $selectAll->execute();
}
function show_user($recherche) {
    $pdo=database_connect();
    //sleep(5);
   // $cequetuveux = array();
    $i=1;
    foreach($pdo->query("SELECT * FROM test WHERE username LIKE '%$recherche%';") as $data) {
        // on affiche les résultats
        echo "<tr>
        <td>".$i++."</td>
        <td>".$data['username']."</td>
        <td>".$data['elo']."</td>
        <td>".$data['gxe']."</td>
        <td>".$data['w']."</td>
        <td>".$data['l']."</td>
        <td>".$data['l']+$data['w']."</td>
        </tr>";
       // $cequetuveux[]=$data['elo'];
    }
}

function adduser($recherche) {
    $pdo=database_connect();
    //sleep(5);
    $sqlinsert = $pdo->prepare( 
    "INSERT INTO user (username) VALUES (:username); "); 
    $sqlinsert->bindValue(':username', $recherche, PDO::PARAM_STR);
    $result_user = $sqlinsert->execute();
}

function show_db_users() {
    $pdo=database_connect();
    //sleep(5);
   // $cequetuveux = array();
    $i=1;
    foreach($pdo->query('SELECT * FROM `users` ORDER BY `users`.`elo` DESC;') as $data) {
        // on affiche les résultats
        echo "<tr>
        <td>".$i++."</td>
        <td>".$data['username']."</td>
        <td>".$data['elo']."</td>
        <td>".$data['gxe']."</td>
        </tr>";
       // $cequetuveux[]=$data['elo'];
    }
}