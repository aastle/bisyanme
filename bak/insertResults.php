<html>
<head>
<link href="css/Site.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page" >
<?php echo '<h3>Update Results:</h3>'; ?>
<?php 
include "insert.php";
insertTranslation($_POST[english],$_POST[cebuano]);
?>

<div><br/>
<input type="button" value="back" onClick="parent.location='dataentry.php'" />

</div>
</div>
</body>

</html>