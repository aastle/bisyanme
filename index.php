<html>
    <head>
        <title>Bisayan.me</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
        <link href="css/Site.css" rel="stylesheet" type="text/css" />
        <script src="scripts/jquery-1.8.3.min.js" type="text/javascript"></script>
        <script src="scripts/visayanAPI.js" type="text/javascript"></script>
<?php 
    session_start();
    
    
?>
        <script type='text/javascript'> 
            $(document).ready(function(){ 
                $("#copyright").html(visayan.SetCopyright);
                $('.headenglish').hide();
                $('.headcebuano').hide();
                $("#translateButtonIndex").click(function(e){ 
                    e.preventDefault(); 
                    visayan.ajax_search("#search_results","#myinput","./mysql/search.php"); 
//                    $.get("./clickCounter.php", function(data){
//                       var mycount = data;//$.parseJSON(data);
//                       $("#translateCount").html(mycount);
//                    });
                }); 

                $("#listButtonIndex").click(function(e){
                e.preventDefault();
                //$('.listRow').empty();
                visayan.list("#listDiv",".headenglish",".headcebuano","./mysql/list.php");
                
                });
                $(".cebuanolocal").click(function(e){
                    e.preventDefault();
                    visayan.localizePage("cebuano");
                });
                 $(".englishlocal").click(function(e){
                     e.preventDefault();
                    visayan.localizePage("english");
                });
   
            }); 
	
 
        </script> 
    </head>
    <body>
        <div class="page">
            <div style="float:left;" class="header">
                <span style="float:right"><img class="englishlocal" src="/images/us.png" /></span>&nbsp;
                <span style="float:right"><a href="#"  class="englishlocal" > English</a></span>
                <span style="float:right">&nbsp;|&nbsp;</span>
                <span style="float:right"><img class="cebuanolocal" src="/images/ph.png" /></span>&nbsp;
                <span  class="cebuanolocal"  style="float:right"><a href="#">Cebuano</a></span>
            </div>
            <div class="main">
                
            <h1 id="indexH1">Welcome to bisayan.me</h1>
            <h3 id="indexH3">Enter the English <b>or</b> Cebuano word to translate below:</h3>
            
            <div><br/></div>
            
            <form name="translateform"  method="get">
                <div>
                    <input type="text" class="textEntry" id="myinput" name="myinput"/>
                </div>
                <div><br/></div>
                <div class="centerDiv">
                    <input type="submit" class="submitButton" value="translate" id="translateButtonIndex"/>
<!--                    <span>Translations: </span><span id="translateCount" ></span>-->
                </div>
                <div><br/></div>
            <div><span id="search_results" style="font-size:medium;font-weight:bold;"></span></div>
                
                <div><br/></div>
                
                <div class="centerAllTranslationsDiv">
                    <a href="#"  id="listButtonIndex" class="bold">list all translations</a>
                </div>
                
            </form>
            <div><br/></div>
                   <div class='listRow'><span style='width:150px;float:left;'> 
                   <a href='#' class='headenglish'>English</a></span> 
                   <span>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                   <a href='#' class='headcebuano'>Cebuano</a></div>

            <div id="listDiv">
            </div>
            </div>
            <div class="footer"><span id="copyright">Copyright &COPY; <?php echo date("Y"); ?> Deus Ex Machine, LLC</span></div>
        </div>
    </body>

</html>