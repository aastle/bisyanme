<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of localize
 *
 * @author prometheus
 */
$languageGet = strip_tags(substr($_GET['language'],0, 100));
$language = mysql_escape_string($languageGet); 

$idGet = strip_tags(substr($_GET['tagId'],0, 100));
$id = mysql_escape_string($idGet); 

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
                $query = "";
            
                $query = "SELECT englishText,cebuanoText FROM cebuano.visayanlocalized WHERE domNodeId = '$id'";   
            
            
                $STH = $DBH->query($query);
		if(!$STH){
			die("Could not connect" . $DBH->errorInfo());
		}
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
                $dbText = "";
                if($language == "cebuano"){
                    $dbText = $row['cebuanoText'];
                }
                else if ($language == "english"){
                    $dbText = $row['englishText'];
                }
                if($dbText == null || strtolower($dbText) == "null"){
                    $dbText = "";
                }
                $response = new response();
                $response->responseText = $dbText;
                $json = json_encode($response);
                echo $json;
        }
    catch(PDOException $e) { 
            $result = "false";
            echo $result; //$e->getMessage();
	}

class response{
    public $responseText;
}
?>
