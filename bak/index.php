<html>
<head>
<link href="css/Site.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="page" >
<?php echo '<h1>Welcome to visayan.me</h1>'; ?>
<?php echo '<h3>Enter the English <b>or</b> Cebuano word to translate below:</h3>'; ?>
<div><br/></div>
<form name="translateform" action="translation.php" method="post">
<input type="text" name="myinput"></input>
<br/>
<input type="submit" value="translate"></input>
</form>
</div>
</body>

</html>