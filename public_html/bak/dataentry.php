<html>
<head>
<link href="css/Site.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page" >
<?php echo '<h1>Data Entry for visayan.me</h1>'; ?>
<?php echo '<h3>Enter the English <b>and</b> Cebuano word to update the database:</h3>'; ?>
<div><br/></div>
<form name="dataentryform" action="insertResults.php" method="post">
English:&nbsp;<input type="text" name="english"></input>&nbsp;&nbsp;&nbsp;Cebuano:&nbsp;<input type="text" name="cebuano"></input>
<br/>
<input type="submit" value="insert"></input>
</form>
</div>
</body>

</html>