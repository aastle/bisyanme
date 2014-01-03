<?php

$languageGet = strip_tags(substr($_GET['language'],0, 100));
$language = mysql_escape_string($languageGet); 

$id = $_GET['tagId']; 

$host="bisayanme.netfirmsmysql.com";
//$port=3306;
//$socket="";
$user="guest";
$password="%Gu3st.";
$dbname="cebuano";
error_reporting(E_ALL); ini_set('display_errors', '1');
// first see if this translation already exists:

	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
                $query = "";
            
                $query = "SELECT englishText,cebuanoText FROM cebuano.visayanlocalized WHERE domNodeId = :id";   
            
            
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row=$stmt->fetch();
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
