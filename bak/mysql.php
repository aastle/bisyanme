<?php 
function getTranslation($myinput) {
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query="SELECT english, cebuano FROM englishcebuano where english = '$myinput' OR cebuano = '$myinput'";
		$STH = $DBH->query($query);
		if(!$STH){
			die("Could not connect" . $DBH->errorInfo());
		}
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
		if($row['english'] == $myinput) {
		
			echo "Cebuano:&nbsp;" . $row["cebuano"] . "<br />";
		}
		elseif ($myinput == $row["cebuano"]){
			echo "English:&nbsp;" . $row["english"] . "<br />";
		}
		}
		catch(PDOException $e) {  
    echo $e->getMessage();
	
	}
}
  
?>

