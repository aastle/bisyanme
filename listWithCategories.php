<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
//$myinput = strip_tags(substr($_GET['myinput'],0, 100));
	//$myinput = mysql_escape_string($myinput); 
        //$myinput = strtolower($myinput);
	$host="localhost";
	$port=3306;
	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
		$query="SELECT id, english, cebuano, c.CategoryId, COALESCE(c.Category,'') as 'Category' FROM englishcebuano e left join Categories c on e.categoryid = c.CategoryId";
		$STH = $DBH->query($query);
		if(!$STH){
			die("Could not connect" . $DBH->errorInfo());
		}
		//$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetchAll(PDO::FETCH_ASSOC);
                    $json = json_encode($row);

                            echo $json;//$string;
	}
		catch(PDOException $e) {  
				echo $e->getMessage();
	}
  
?>

