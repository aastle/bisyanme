<?php 
	if ( session_id() == '' )
		session_start();    
?><!DOCTYPE html>
<html>
<head>
    <title>Bisayan.me Categorization Tool</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
	<link href="css/Site.css" rel="stylesheet" type="text/css" />
	<script src="scripts/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="scripts/categoriesAPI.js" type="text/javascript"></script>
	<script type='text/javascript'> 
		categories.categorylist("#listDiv", "./mysql/GetCategories.php");
	//    categories.translationlist("#translationsDiv", "./mysql/listWithCategories.php")
			
		$(function(){ 
			if ( typeof jQuery !== 'undefined' ) {
			
				$('form').submit(function(e) {
					var serial = $(this).serialize();
					categories.ajax_update("./serializeArray.php", serial,"#resultsDiv")
					console.log(serial);
					e.preventDefault();
				});
				
				$('#clearAllCheckBoxes').on('click',function(){
					   $('form input[type=checkbox]:checked').each(function(){
					   $(this).attr('checked',false);
				   })
				});
				
			} else {

				console.warn( 'jQuery not loaded' );
			}
		}); 
	</script> 
</head>
	<body>
	<div class="pageCategories" data-role="page">
		<h1>Tool for Categorizing Cebuano Translations</h1>
		<h3>Choose the category first, then select the translations that belong to that category:</h3>
		<hr />
		<div id="resultsDiv"></div>
			<form name="categoryform" method="post">
				<hr />
				<div class="centerDiv">
					<input type="submit" id="submitCategory" value="Update Categories" class="submitButton" />
				</div>

				<div id="categoryFloater">No Category Chosen
					<br />
					<input type="submit" id="submitCategoryFloater" value="Update Categories" class="submitButton" /></div>
					<div id="listDiv"></div>
					<hr />
					<div id="catChoice"></div>
					<div><input id="clearAllCheckBoxes" type="button" value="Clear All Checkboxes" target="#"></button></div>
					<hr />
				<div id="translationsDiv"></div>
			</form>
	</div>
</body>

</html>