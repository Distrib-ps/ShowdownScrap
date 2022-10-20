
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
    sleep(5);
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
function delete_table() {

    $pdo=database_connect();
    $req = $pdo->prepare("TRUNCATE Table test");
    $req->setFetchMode(PDO::FETCH_ASSOC);
    $req->execute();
}

function selectAll() {

    $pdo=database_connect();
    $selectAll = $pdo->prepare("TRUNCATE Table test");
    $selectAll->setFetchMode(PDO::FETCH_ASSOC);
    $selectAll->execute();
}