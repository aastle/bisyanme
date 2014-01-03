<?php 
// INSERT NEW ceubanoenglish data table row
	$english = strip_tags(substr($_POST['english'],0, 100));
	$english = mysql_escape_string($english); 
        $englishLower = strtolower($english);


	$cebuano = strip_tags(substr($_POST['cebuano'],0, 100));
	$cebuano = mysql_escape_string($cebuano); 
        $cebuanoLower = strtolower($cebuano);

	$host="bisayanme.netfirmsmysql.com";
//	$port=3306;
//	$socket="";
	$user="editor";
	$password="%3d1t0r.";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
        $DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// first see if this translation already exists:
	try {
		$query="SELECT english, cebuano FROM englishcebuano where lower(english) = '$englishLower' OR lower(cebuano) = '$cebuanoLower'";
		$STH = $DBH->query($query);
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		$row=$STH->fetch();
                $dbEnglishLower = strtolower($row['english']);
                $dbCebuanoLower = strtolower($row['cebuano']);
		if(($dbEnglishLower == $englishLower) || ($cebuanoLower == $dbCebuanoLower)) {
                        $json = json_encode($row);
			echo $json; //"English ". $row['english'] . " and Cebuano "  . $row['cebuano'] . " is already in the database!";
			exit;
		}
//		elseif ($cebuanoLower == $dbCebuanoLower){
//			echo "Cebuano and English of &nbsp;" . $row['cebuano'] . " = " . $row['english'] . " is already in the database! <br />";
//			exit;
//		}
		$verified = 1;
                $newresult = new myresult();
		$qry = $DBH->prepare(
			'INSERT INTO englishcebuano (english, cebuano, verified) VALUES (:english, :cebuano, :verified)');
			$qry->bindParam(':english', $english);
			$qry->bindParam(':cebuano', $cebuano);
			$qry->bindParam(':verified', $verified);
			$newresult->result = $qry->execute();
                        $newresult->english = $english;
                        $newresult->cebuano = $cebuano;
                        //$newresult->result = true;
                        //$result = "{'result':true}";// true;
                        $json = json_encode($newresult);
			echo $json;//"Update successful!";
		}
		catch(PDOException $e) { 
                    $errorResult = new myresult();
                    $errorResult->result = false;
                    $errorResult->message = "PDOException";//$e->getTraceAsString();
                    $json = json_encode($errorResult);
			echo $json;//$e->getMessage();
	}
        
        class myresult{
            public $result = null;
            public $english = null;
            public $cebuano = null;
            public $message = null;
        }

?>