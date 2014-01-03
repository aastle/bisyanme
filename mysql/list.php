<?php

	$host="bisayanme.netfirmsmysql.com";
	$port=3306;
	$socket="";
	$user="guest";
	$password="%Gu3st.";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query = "SELECT id, english, cebuano FROM englishcebuano";
		$stmt = $conn->prepare($query);
                $stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $json = json_encode($rows);

                            echo $json;//$string;
	}
		catch(PDOException $e) {  
				echo $e->getMessage();
	}
  //end of list
?>
