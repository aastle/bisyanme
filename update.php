<?php 
// UPDATE ceubanoenglish data table row
	$english = strip_tags(substr($_POST['english'],0, 100));
	$english = mysql_escape_string($english); 

	$cebuano = strip_tags(substr($_POST['cebuano'],0, 100));
	$cebuano = mysql_escape_string($cebuano); 

	$host="bisayanme.netfirmsmysql.com";
//	$port=3306;
//	$socket="";
	$user="editor";
	$password="%3d1t0r.";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
                $result = new myresult();
                $result->result = false;
		$verified = 1;
		$qry = $DBH->prepare(
			'UPDATE englishcebuano SET english = :english, cebuano = :cebuano, verified = :verified WHERE english = :english');
			$qry->bindParam(':english', $english);
			$qry->bindParam(':cebuano', $cebuano);
			$qry->bindParam(':verified', $verified);
			$result->result = $qry->execute();
                        $result->english = $english;
                        $result->cebuano = $cebuano;
                        $json = json_encode($result);
			echo $json;
		}
		catch(PDOException $e) {
                $result = new myresult();
                $result->result = false;
                $result->message = $e->getMessage();
                $errorjson = json_encode($result);
		echo $errorjson; //$e->getMessage();
	}
        class myresult{
            public $result = null;
            public $english = null;
            public $cebuano = null;
            public $message = null;
        }


?>