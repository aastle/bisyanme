<html>
<head>
<link rel='stylesheet' href='css/Site.css' type='text/css' />
</head>
<body>
<div class='page' style='text-align: center;'><br/>
<br/>

<?php
include "mysql.php";
getTranslation($_POST[myinput]); 
?>
<br/>
<form>
<input type="button" value="back" onClick="parent.location='index.php'" />
</form></div>
</body>
</html>