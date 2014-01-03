<?php 
// INSERT NEW ceubanoenglish data table row
function insertTranslation($english,$cebuano) {
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	// first see if this translation already exists:
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query="SELECT english, cebuano FROM englishcebuano where english = '$english' OR cebuano = '$cebuano'";
		$STH = $DBH->query($query);
		if(!$STH){
			die("Could not connect" . $DBH->errorInfo());
		}
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
		if($row['english'] == $english) {
		
			echo "English and Cebuano of &nbsp;" . $english . " = " . $row["cebuano"] . " is already in the database! <br />";
			exit;
		}
		elseif ($cebuano == $row["cebuano"]){
			echo "Cebuano and English of &nbsp;" . $cebuano . " = " . $row["english"] . " is already in the database! <br />";
			exit;
		}
		$verified = 1;
		$qry = $DBH->prepare(
			'INSERT INTO englishcebuano (english, cebuano, verified) VALUES (:english, :cebuano, :verified)');
			$qry->bindParam(':english', $english);
			$qry->bindParam(':cebuano', $cebuano);
			$qry->bindParam(':verified', $verified);
			$qry->execute();
			echo "update successful!";
		}
		catch(PDOException $e) {  
			echo $e->getMessage();
	}



}



?>