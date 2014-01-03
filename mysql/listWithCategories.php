<?php

	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query = "SELECT id, english, cebuano, c.CategoryId, COALESCE(c.Category,'') as 'Category' ";
                $query .= " FROM englishcebuano e left join Categories c on e.categoryid = c.CategoryId";
		$stmt = $conn->prepare($query);
                $stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $json = json_encode($rows);

                            echo $json;
	}
		catch(PDOException $e) {  
				echo $e->getMessage();
	}
  
?>
