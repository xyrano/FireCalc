var f5pressed = false;

$(document).ready(function() {
    $("body").keydown(function(e) {
        if(e.which === 116)
        {
            f5pressed = true;
        }
    });
    
    
    function getUrlParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) 
            {
                return sParameterName[1];
            }
        }
    } 
    
    $("a#new").removeAttr("id").removeAttr("href");
    $("a#update").removeAttr("id").removeAttr("href");
    
    var CUDUrl = "./JsFireDept2ContestSave.php";
    var Referrer = "./AddFireDept2ContestForm.php?idx=" + getUrlParameter("idx");
    
    $("tr.select").on("dblclick", function(e) {
       $.fn.TT_InlineEdit(this, CUDUrl); 
    });
    
    
    $("a#delete").click(function(e) {        
        e.preventDefault();
        $.fn.TT_Delete(CUDUrl, Referrer);
    });
    
    
    $("a#save").click(function(e) {       
        e.preventDefault();
        var attr = $("fieldset").attr('Create');

        // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
        if (typeof attr !== typeof undefined && attr !== false) {
            // Element has this attribute       
            $.fn.TT_Create(CUDUrl, Referrer);
        }
        else
        {
            $.fn.TT_Update(CUDUrl, Referrer);
        }
    });     
    
    
    
    // chained select in this case
    //$("#municipalId").chained("#districtId");  // von Landkreis zu Gemeinde
    //$("#fireDeptId").chained("#municipalId");  // von Gemeinde zu Feuerwehr
    
    /*
    //select (toggle) all checkboxes in new
    $("input#toggleCheckboxes").click(function() {
       if(this.checked) {
           $(":checkbox").each(function() {
              this.checked = true; 
           });
       } else {
           $(":checkbox").each(function() {
              this.checked = false; 
           });
       }
    });
    
    
    $("a#save").click(function(e) {        
        var IdNewEditDelete = $("span#IdNewEditDelete").text();
        e.preventDefault(); // prevent loading on click
               
        
        if(IdNewEditDelete === "edit")
        {
            // loop through all inputs
            // TODO: Depends on other Forms with bigger Data this is not a performant solution
            $("input").each(function(idx, el){               
               var idArray = this.id.split("-");  // get Array from element ID
               var id = idArray[0];               // retrieve element id name (id="district-3") = district
               var recId = idArray[1];            // retrieve element id recid (id="district-3") = 3
               var value = $(this).val();         // value of current element
               
               if(value === "")
               {
                   new Info("#ID: " + recId + " ist leer - wird nicht aktualisiert!")
               }
               else
               {
                    var data = "recId=" + recId + "&district=" + value + "&identifier=update";
                    $.ajax({
                        type: "POST",
                        url: "./JsFireDept2ContestSave.php?idx="+getUrlParameter("idx"),
                        data: data,
                        cache: false,
                        success: function(data) 
                        { 
                            var jsonData = $.parseJSON(data); 
                            new Info(jsonData.journalMessage);
                            setTimeout(function() {
                                window.location.href = "AddDistrictForm.php?do=edit";
                            }, 1000);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
                        },
                        statusCode: {
                            404: function() {
                                alert("Page not found!");
                            },
                            500: function() {
                                alert("A server-side error has occurred.");
                            }
                        },
                        complete: function(e, xhr, settings) {
                            if(e.status !== 200)
                            {
                                alert(e.status);
                            }
                        }                
                    });            
               }
               
            });
        }
        
        
        if(IdNewEditDelete === "delete")
        {
            $("input").each(function(idx, el)
            { 
                var idArray = this.id.split("-");  // get Array from element ID
                var id = idArray[0];               // retrieve element id name (id="district-3") = district
                var recId = idArray[1];            // retrieve element id recid (id="district-3") = 3
                var idx         = $('div#idx').text(); // same as in MenuItems
                  
                if($("input#" + this.id).prop('checked'))
                {
                    var data = "recId=" + recId + "&identifier=delete"; // identifier for security reasons
                    $.ajax({
                        type: "POST",
                        url: "./JsFireDept2ContestSave.php?idx="+getUrlParameter("idx"),
                        data: data,
                        cache: false,
                        success: function(data) 
                        { 
                            var jsonData = $.parseJSON(data); 
                            new Info(jsonData.journalMessage);
                            setTimeout(function() {
                                window.location.href = "AddFireDept2ContestForm.php?do=delete&idx="+idx;
                            }, 1000);
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
                        },
                        statusCode: {
                            404: function() {
                                alert("Page not found!");
                            },
                            500: function() {
                                alert("A server-side error has occurred.");
                            }
                        },
                        complete: function(e, xhr, settings) {
                            if(e.status !== 200)
                            {
                                alert(e.status);
                            }
                        }                
                    });    
                }
            });
        }
        
           
    });
    */
    
        
    
    
});