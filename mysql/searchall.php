<?php 
        $myinput = strtolower($_GET['myinput']);
	$host="bisayanme.netfirmsmysql.com";
//	$port=3306;
//	$socket="";
	$user="guest";
	$password="%Gu3st.";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query = "SELECT english, cebuano FROM englishcebuano ";
		$query .= " WHERE lower(english) LIKE CONCAT(:myinput,'%') OR lower(cebuano) LIKE CONCAT(:myinput,'%')";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':myinput', $myinput);
                $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$rows = $stmt->fetchAll();
                if(count($rows) >=1){
                    $json = json_encode($rows);

                            echo $json;//$string;
                }
	}
		catch(PDOException $e) {  
				echo $e->getMessage();
	}
  
?>
