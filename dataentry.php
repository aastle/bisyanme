<!doctype html>
<head>
    <title>bisayan.me Data Entry Tool</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
    <link href="css/hot-sneaks/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="scripts/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    <script src="scripts/visayanAPI.js" type="text/javascript"></script>
    <script type='text/javascript'> 
        $(document).ready(function(){ 
            $("#insertButton").button({icons: {secondary : "ui-icon-circle-plus"}});
            $("#updateButton").button({icons: {secondary : "ui-icon-circle-check"}});
            $("#cancelButton").button({icons: {secondary : "ui-icon-circle-close"}});
            $("#insertButton").click(function(e){ 
                e.preventDefault(); 
                var buttonVal = $("#insertButton").val();
                    
                visayan.ajax_insert("#resultTagId","#english","#cebuano","./mysql/insert.php"); 
                        
            }); 
            $("#updateButton").click(function(e) {
                e.preventDefault();
                visayan.ajax_update("#resultTagId","#english","#cebuano","./mysql/update.php"); 
            });
                 
                 
            $("#listButton").click(function(e){
                e.preventDefault();
                visayan.list("#listDiv",".headenglish",".headcebuano","./mysql/list.php");
                
            });
        }); 
	

    </script> 
    <style>
        body{
            font: 100% "Rokkitt";
            margin: 50px;
        }
        button{
            font: 60% "Rokkitt";
        }
        .homediv{
            width: 16px;
            height: 16px;
        }
    </style>
</head>
<body class="bodyDataEntry">
    <div class="pageDataEntry" data-role="page">
        <div class="ui-state-default ui-corner-all homediv"  title="Go Home">
            <a href="http://bisayan.me"><span class="ui-icon ui-icon-home"></span>home</a>
        </div>
        <?php echo '<h1>Data Entry for bisayan.me</h1>'; ?>
        <?php echo '<h3>Enter the English <b>and</b> Cebuano word to update the database:</h3>'; ?>


        <div><br/></div>
        <form name="dataentryform" method="post">
            English:&nbsp;<input type="text" name="englishinput" id="english" />&nbsp;&nbsp;&nbsp;Cebuano:&nbsp;<input type="text" id="cebuano" name="cebuanoinput" />
            <div><span id="resultTagId" style="font-size:medium;font-weight:bold;"></span></div>
            <div><br/></div>
            <button type="submit" role="button" id="insertButton" aria-disabled="false" value="insert" 
                    class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">insert</span>
            </button>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
            <button type="submit" role="button" id="updateButton" value="update" aria-disabled="false"
                    class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">update</span>
            </button>
            <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>

            <button type="submit" role="button" aria-disabled="false" id="cancelButton" value="cancel"
                    class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">cancel</span>
            </button>
            <div><br/></div>
            <input type="submit" id="listButton" value="list all translations"/>
            <div class='listRow'><span style='width:150px;float:left;'> 
                    <a href='#' class='headenglish'>English</a></span> 
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <a href='#' class='headcebuano'>Cebuano</a></div>
            <div id="listDiv"></div>

        </form>

    </div>

</body>

</html>