<!doctype html>
<head>
    <title>Data Entry bisayan.me</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
    <link href="css/hot-sneaks/jquery-ui-1.10.3.custom.css" rel="stylesheet">
    <script src="scripts/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    <script src="scripts/visayanAPI.js" type="text/javascript"></script>
    <script src="scripts/jquery.jsonp.js" type="text/javascript"></script>
    <script type='text/javascript'> 
        $(document).ready(function(){ 
            $(".listRow").css("visibility","hidden");
            $("#insertButton").button({icons: {secondary : "ui-icon-circle-plus"}});
            $("#updateButton").button({icons: {secondary : "ui-icon-circle-check"}});
            $("#resetButton").button({icons: {secondary : "ui-icon-circle-close"}});
            
            $("#insertButton").click(function(e){ 
                e.preventDefault(); 
                //var buttonVal = $("#insertButton").val();
                    
                //visayan.ajax_insert("#resultTagId","#english","#cebuano","./mysql/insert.php"); 
                visayan.jsonplib("#english","#bighugelabs",
                "http://words.bighugelabs.com/api/2/faf56bfe40e03e6aa55935fa70b79e39/")
                $("#english").val("");
                $("#cebuano").val("");
                        
            }); 
            $("#updateButton").click(function(e) {
                e.preventDefault();
                visayan.ajax_update("#resultTagId","#english","#cebuano","./mysql/update.php"); 
        
            });
 
            $("#resetButton").click(function(e){
               e.preventDefault(); 
               $("#english").val("");
               $("#cebuano").val("");
              $("#resultTagId").html("");
            });     
    
            $("#listButton").click(function(e){
                e.preventDefault();
               $(".listRow").css("visibility","visible");                
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
        .insertedupdated{
            text-decoration: underline;
            width: 150px;
            float: left;
        }
        #insertButton{
            color: darkgreen;
        }
        #updateButton {
            color: orangered;
        }
        #resetButton{
            color:darkred
        }
    </style>
</head>
<body spellcheck="true">
    <div class="pageDataEntry" data-role="page">
        <div style="text-align:right;">
            <div class="ui-state-default ui-corner-all homediv"  title="Go Home">
                <a href="http://bisayan.me"><span class="ui-icon ui-icon-home"></span>home</a>
            </div>
        </div>
        <?php echo '<h1>Data Entry for bisayan.me</h1>'; ?>
        <?php echo '<h3>Enter the English <b>and</b> Cebuano word to update the database:</h3>'; ?>


        <div><br/></div>
        <form name="dataentryform" method="post">
            <span class="intputLabels">English:&nbsp;</span>
            <input type="text" name="englishinput" id="english" spellcheck="true" required />
            &nbsp;&nbsp;&nbsp;
            <span class="intputLabels">Cebuano:&nbsp;</span>
            <input type="text" id="cebuano" name="cebuanoinput" spellcheck="false" required />
            
            <div><br/></div>
            <div><span id="resultTagId" style="font-size:medium;font-weight:bold;"></span></div>
            <div><br/></div>
            <div>Results from BigHugeLabs</div>
            <div id="bighugelabs"></div>
            <div>
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

            <button type="button" aria-disabled="false" id="resetButton" value="reset"
                    class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only">
                <span class="ui-button-text">reset</span>
            </button>
            </div>
            
            <div><br/></div>
            <div><br/></div>
            <div style="font-weight: bold;font-size: medium">Inserted/Updated</div>
            <div><span style='width:150px;float:left;' class="insertedupdated">English</span> 
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="insertedupdated">Cebuano</span>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="insertedupdated">Status</span></div>            
            <div id="enteredDiv"></div>
            <div><br/></div>
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
