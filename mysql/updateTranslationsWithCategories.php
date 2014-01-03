<?php 
// UPDATE ceubanoenglish data table row with Category Id 
class updateTranslationsWithCategories 
{

    public function updateCategoriesEnglish($categoryid, $englishId) 
    {

	$host="localhost";
//	$port=3306;
//	$socket="";
	$user="root";
	$password="m1st3rb34r";
	$dbname="cebuano";
	error_reporting(E_ALL); ini_set('display_errors', '1');
	try {
		$DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $password); 
                $result = "false";
		$qry = $DBH->prepare(
			'UPDATE englishcebuano SET categoryid = :categoryid WHERE id = :id');
			$qry->bindParam(':categoryid', $categoryid);
			$qry->bindParam(':id', $englishId);
			$qry->execute();
                        $result = true;
			echo $result;
		}
		catch(PDOException $e) { 
                    $result = "false";
			echo $result; //$e->getMessage();
                }
    }
    
}


?>