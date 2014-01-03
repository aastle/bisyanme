var categories = (function(){
  var API = {};
  
    API.categorylist = function(listID, postURL){
//                       	  $(listID).show(); 
// just testing
	   
	  $.get(postURL, function(){})
            .success(function(data){
                  var respObj = $.parseJSON(data);
                  API.buildCategoriesList(listID,respObj);
                $('input[name=categories]').click(function() {
                    var categoryId = $(this).attr("id");
                    var catValue = $(this).val();
                    $("#categoryFloater").html("<b>" + categoryId + "</b> category" + 
                    "<br/><input type='submit' id='submitCategoryFloater' value='Update Categories' class='submitButton'' />");
                    });
                    API.translationlist("#translationsDiv", "./mysql/listWithCategories.php");
              });
        
          
    };
    
    API.buildCategoriesList = function(listID, categoriesParam){
               $.each(categoriesParam, function(index,value){
                var category = value.Category;
                var categoryid = value.CategoryId;

               $(listID).append('<input type="radio" name="categories" value="' + categoryid 
                                    + '" id="' + category + '"' + ' />'
                                    + API.UpperCaseFirstLetter(category)); 
                
               });
    };
    
    
    API.translationlist = function(listID,postURL){
      var decoded = {};
      $.get(postURL, function(data){
         decoded = $.parseJSON(data);
         $.each(decoded, function(index,value){
             var id = value.id;
             var english = value.english;
             var cebuano = value.cebuano;
             var categoryid = value.CategoryId;
             var category = value.Category;
             var categoryClass = "categoryClass";
             // add an extra class name to the class attribute
             // of the span that displays the Category name in the list
             // of English Cebuano translations.  When we update
             // the db with categories we only want to update new (categoryClass of "no", uncategorized
             // rows.
             if(!categoryid){
                 categoryClass += " no";
                 category = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
             }
             else{
                 categoryClass += " yes";
                 
             }
             // We have to add square brackets after the value of the name attribute of each checkbox
             // so that our PHP file will loop through the POSTed values
               $(listID).append("<table><tbody><tr class='listRow'><td><input type='checkbox' name='translations[]' value='" 
                   + id + "' id='" + english + "' >" 
                   + API.UpperCaseFirstLetter(english) + "</td><td class='cebuanoCol'>" 
                   + API.UpperCaseFirstLetter(cebuano) + "</td>" 
                   + "<td class='" + categoryClass +"' id='tc" + id + "'>" + category + "</td>");
             $(listID).append("</tr>")
         });
         $(listID).append('</tbody></table>');
            $('[type="checkbox"]').change(function() {
                // Radio button attributes
                var categoryId =  $('form input[type=radio]:checked').val() ;
                var catValue = $('form input[type=radio]:checked').attr("id");
                
                // Checkbox attributes:
                var engId = $(this).attr("id");
                var translCatId = "#tc" + $(this).val();
                
                if($(this).is(':checked')){
                               
                    $(translCatId).text(catValue);
                    $("#resultsDiv").text("checkbox checked");
                }
                else if(!$(this).is(':checked')) {
                    $('#resultsDiv').text("Unchecked Check Box!!!")
                    $(translCatId).text("");
                }
                });

      });
    };
        API.updated = false;
        API.ajax_update = function (postURL, form, resultTagId ) {
             
	  $.post(postURL, form, function(serialdata){
	   var parsed = $.parseJSON(serialdata);
           $(resultTagId).text("Category number: " + parsed.category + ".  Count of posted form elements: " + parsed.count);
//	   if (data === "1"){ 
//               API.updated = true;
//            $("#resultTagId").html("Update successful"); 
//           }
//            else if(data === "0"){
//                API.updated = false;
//                $("#resultTagId").html("Update failed.  Unknown database error!"); 
//            }
     	   
	  }) 
        };

            API.UpperCaseFirstLetter = function(value){
                var firstLetter = value.substring(0,1);
                var formalWord = value.replace(firstLetter, firstLetter.toUpperCase());
                return formalWord;
       }
return API;
}());
