<?php
require_once './mysql/updateTranslationsWithCategories.php';

    $categoryId = $_POST['categories'];
    //$translations = $_POST['translations'];
    $mysqlUpdateEngWithCat = new updateTranslationsWithCategories();
    $c = 0;
    foreach($_POST['translations'] as $value)
    {
        $mysqlUpdateEngWithCat->updateCategoriesEnglish($categoryId, $value);
       $c++; 
    }
    $results = array("category" => $categoryId,"count" => $c);
    echo json_encode($results);
?>
