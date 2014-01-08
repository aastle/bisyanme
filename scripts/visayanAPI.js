/* File Created: July 16, 2012 */
/*******************************************************************************
**
** By Alan W. Astle
** Deus Ex Machine, LLC
** Endicott, NY
** Rev. 1 07/16/2012
*******************************************************************************/

/*******************************************************************************
**
** DEM (Deus Ex Machine) grants you ("Licensee") a non-
** exclusive, royalty free, license to use, modify and redistribute this
** software in source and binary code form, provided that i) this copyright
** notice and license appear on all copies of the software; and ii) Licensee does
** not utilize the software in a manner which is disparaging to DEM.
**
** This software is provided "AS IS," without a warranty of any kind.  ALL
** EXPRESS OR IMPLIED CONDITIONS, REPRESENTATIONS AND WARRANTIES, INCLUDING ANY
** IMPLIED WARRANTY OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE OR NON-
** INFRINGEMENT, ARE HEREBY EXCLUDED.  DEM AND ITS LICENSORS SHALL NOT BE LIABLE
** FOR ANY DAMAGES SUFFERED BY LICENSEE AS A RESULT OF USING, MODIFYING OR
** DISTRIBUTING THE SOFTWARE OR ITS DERIVATIVES.  IN NO EVENT WILL DEM  OR ITS
** LICENSORS BE LIABLE FOR ANY LOST REVENUE, PROFIT OR DATA, OR FOR DIRECT,
** INDIRECT, SPECIAL, CONSEQUENTIAL, INCIDENTAL OR PUNITIVE DAMAGES, HOWEVER
** CAUSED AND REGARDLESS OF THE THEORY OF LIABILITY, ARISING OUT OF THE USE OF
** OR INABILITY TO USE SOFTWARE, EVEN IF DEM  HAS BEEN ADVISED OF THE POSSIBILITY
** OF SUCH DAMAGES.
**
*******************************************************************************/


var visayan = (function () {
    var API = {};
    API.ajax_search = function (resultTagId,input,postURL){ 
        $(resultTagId).show(); 
        var search_val=$(input).val(); 
        $.get(postURL, {
            myinput : search_val
        }, function(data){
            if (data.length>0){ 
                var translation = $.parseJSON(data);
                if(translation.english.toLowerCase() == search_val.toLowerCase()){
                    $(resultTagId).html("English: " + API.UpperCaseFirstLetter(translation.english) +", Cebuano: " + API.UpperCaseFirstLetter(translation.cebuano)); 
                }
                else if(translation.cebuano.toLowerCase() === search_val.toLowerCase()) {
                    $(resultTagId).html("Cebuano: " + API.UpperCaseFirstLetter(translation.cebuano) +", English: " + API.UpperCaseFirstLetter(translation.english)); 
               
                }
                $(input).val("");
            } 
        }) 
    };
    API.status = "unprocessed";
    API.inserted = false;
    API.ajax_insert = function (resultTagId, englishinput, cebuanoinput,postURL) {
        $(resultTagId).show(); 
        var english_val=$(englishinput).val(); 
        var cebuano_val=$(cebuanoinput).val();
        $.post(postURL, {
            english : english_val, 
            cebuano :cebuano_val
        }, function(data){
            var decoded = $.parseJSON(data);
            
            if(decoded.result){
                API.inserted = true;
                API.status = "inserted";
                $("#resultTagId").html("Insert successful!  English: " + decoded.english + " | Cebuano: " + decoded.cebuano).css("color","green"); 
                
                API.append_entered(decoded.english, decoded.cebuano, "#enteredDiv", "inserted");
                $(englishinput).val("");
                $(cebuanoinpunt).val("");
                    
            }
            else if (decoded.result != true && decoded.message == undefined) {
                API.inserted = false;
                API.status = "exists";
                
                $("#resultTagId").html("Translation alread exists in the data base.<br/> English: " 
                    + decoded.english + " | Cebuano: "  + decoded.cebuano).css("color","red"); 
                API.append_entered(decoded.english, decoded.cebuano, "#enteredDiv", "exists");
                $("#english").val("");
                $("#cebuano").val("");
                   
            }
            else if(decoded.result != true && decoded.message != undefined){
                API.inserted = false;
                API.status = "failed";
                $("#resultTagId").html("Message: "+decoded.message+".  English: " + decoded.english + " | Cebuano: "  + decoded.cebuano).css("color","red"); 
                
                API.append_entered(decoded.english, decoded.cebuano, "#enteredDiv", "failed");
                $("#english").val("");
                $("#cebuano").val("");
                   
            }
               
        }) 
    };
    API.updated = false;
    API.ajax_update = function (resultTagId, englishinput, cebuanoinput,postURL) {
        $(resultTagId).show(); 
        var english_val=$(englishinput).val(); 
        var cebuano_val=$(cebuanoinput).val();
        $.post(postURL, {
            english : english_val, 
            cebuano :cebuano_val
        }, function(data){
            if (data.result){ 
                API.updated = true;
                API.status = "updated";
                $("#resultTagId").html("Update successful"); 
                API.append_entered(english_val, cebuano_val, "#enteredDiv", "updated");
            
            }
            else if(data.result == false && data.message == undefined){
                API.updated = false;
                API.status = "failed";
                $("#resultTagId").html("Update failed.  Unknown database error! "); 
                API.append_entered(english_val, cebuano_val, "#enteredDiv", "updated");
                
            }
            else if(!data.result && data.message != undefined){
                API.updated = false;
                API.status = "failed";
                $("#resultTagId").html("Update failed. Database error = " + data.message); 
                API.append_entered(english_val, cebuano_val, "#enteredDiv", "updated");
                
            }
     	   
        }) 
    };
    API.list = function(listID,sortEngId,sortCebuId, postURL){
        $(listID).show(); 
        $(sortEngId).show();
        $(sortCebuId).show();
	   
        $.get(postURL, function(data){
	    
            var decoded = $.parseJSON(data);
               
            $(sortCebuId).click(function(e){
                e.preventDefault();
                decoded.sort(function(el1, el2) {
                        
                    return API.Compare(el1, el2, "cebuano");
                        
                });
                API.RenderList(decoded, listID);
            });
               
            $(sortEngId).click(function(e){
                e.preventDefault();
                decoded.sort(function(el1,el2){
                    return API.Compare(el1, el2, "english");
                });
                API.RenderList(decoded, listID);
            });
               
            API.RenderList(decoded, listID);
               
        });
               
    };
        
    API.RenderList = function(decoded,listID){
        $(listID).empty();
        $.each(decoded, function(index,value){
            var english = value.english;
            var cebuano = value.cebuano;

            $(listID).append("<div class='listRow'><span style='width:150px;float:left;'>" + API.UpperCaseFirstLetter(english) + "</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span>" + API.UpperCaseFirstLetter(cebuano) + "</span></div>"); 
                
        });
        $(".listRow:odd").css("background-color","#E8E8E8");
          
    };
        
    API.append_entered = function(english,cebuano,listID, status){
        $(listID).prepend("<div class='enteredRow'><span class='insertedupdated'>" 
            + API.UpperCaseFirstLetter(english) 
            + "</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='insertedupdated'>" 
            + API.UpperCaseFirstLetter(cebuano) + 
            "</span><span>&nbsp;&nbsp;&nbsp;&nbsp;</span><span class='insertedupdated'>"
            + status
            +"</span></div>"); 
                
        $(".enteredRow:odd").css("background-color","#E8E8E8");
           
          
    };     
        
    API.Compare = function(el1,el2,arrindex) {
        return el1[arrindex].toLowerCase() == el2[arrindex].toLowerCase() ? 0 : (el1[arrindex].toLowerCase() < el2[arrindex].toLowerCase() ? -1 : 1);
    };
        
    API.UpperCaseFirstLetter = function(value){
        var firstLetter = value.substring(0,1);
        var formalWord = value.replace(firstLetter, firstLetter.toUpperCase());
        return formalWord;
    }
    API.localizePage = function(lang){
        // assume page is a collection of HTML elements
        // Filter elements that contain the id attribute
        // Iterate through collection looking for 
        // non-empty text attributes/properties
        // Ignore textboxes
        var page = $('*[id]');
        $.each(page, function(){
            var currentId = $(this).attr("id");
            if(currentId){
                var jqcurrentId = '#' + currentId;
                var text = $(jqcurrentId).text();
                if(text){
                    // start calling helper functions
                    // to localize text based on language 
                    // choice
                    API.getLocalizedText(currentId,lang,jqcurrentId);
                        
                    
                }else if($(jqcurrentId).val()){
                    // form elements use val() instead of text()
                    // for innput html elements
                    API.getLocalizedText(currentId,lang,jqcurrentId);
                }
                    
            }
        });
    }
    API.returnData = "";
    API.getLocalizedText = function(id,lang,selectId){
        // jQuery's ajax function is asynchronous, so returning from 
        // a javascript function might not return the value returned from 
        // the asynchronous call.  Use success or complete to wait for jQuery
        // ajax to return before returning from the enclosing function
        var returnText = '';
        $.get("./mysql/localize.php",{
            language:lang,
            tagId:id
        },function(){
            })
        .success(function(data){
            var respObj = $.parseJSON(data);
            var returnText = respObj.responseText;
            API.setLocalizedText(selectId,returnText);
        });
              
    };
     	   
    API.setLocalizedText = function(id,textLocalized){
            
        if($(id).get(0).tagName.toLowerCase() != "input" && id != "#listDiv"){
            $(id).text(textLocalized);
        } else if($(id).get(0).tagName.toLowerCase() == "input"){
            if ($(id).attr("type") == "submit"){
                $(id).val(textLocalized);
            }
        }
    }; 
    
    //get a synonym for the Engish word entered in the dataentry page
    API.bighugelabs = function(input,id,url){
        var _input = $(input).val();
        var _url = url + _input +"/json";
        $.ajax({
            crossDomain: true,
            type:"GET",
            contentType: "application/json; charset=utf-8",
            async:true,
            url: _url,
            //data: {projectID:1},
            dataType: "jsonp",                
            jsonpCallback: 'fnsuccesscallback'
        }).done(function(data,textStatus, xhr){
            $(id).html(xhr.status);
        }).fail(function(){
            $(id).html("404 not found from Alan");
        });
    }
    API.jsonplib = function(input,id,url){
        var _input = $(input).val();
        var _url = url + _input +"/json";
        $.jsonp({
            url:_url,
            callbackParameter: "callback",
            complete: function(xOptions, textStatus){
                $(id).html(textStatus);
            },
            error: function() {
                // Will be notified of an error requesting 'a-service'
                $(id).html("error from Alan")
            }
        });
    }
    API.GetCategories = function(){
        var returnText = '';
        $.get("./mysqlGetCategories.php",function(){
            })
        .success(function(data){
            var respObj = $.parseJSON(data);
            var returnText = respObj.responseText;
            return returnText;
        });

    };
        
    API.SetCopyright = function() {
        var copyText = "";
        var date = new Date();
        var thisYear = date.getFullYear();
        copyText = "Copyright &COPY; " + thisYear + " Deus Ex Machine, LLC";
        return copyText;
    };
        
    return API;
}());