<?php 
	$myinput = strip_tags(substr($_GET['myinput'],0, 100));
	$myinput = mysql_escape_string($myinput); 
        $myinput = strtolower($myinput);
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query="SELECT english, cebuano FROM englishcebuano where lower(english) LIKE '$myinput%' OR lower(cebuano) LIKE '$myinput%'";
		$STH = $DBH->query($query);
		if(!$STH){
			die("Could not connect" . $DBH->errorInfo());
		}
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
                if(count($row) >=1){
                    $json = json_encode($row);

                            echo $json;//$string;
                }
	}
		catch(PDOException $e) {  
				echo $e->getMessage();
	}
  
?>

