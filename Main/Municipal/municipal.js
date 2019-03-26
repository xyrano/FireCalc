var f5pressed = false;

$(document).ready(function() {
    $("body").keydown(function(e) {
        if(e.which === 116)
        {
            f5pressed = true;
        }
    });
        
    
    $("a#start").removeAttr("id").removeAttr("href");
    $("a#update").removeAttr("id").removeAttr("href");
   
    var CUDUrl = "./JsMunicipalSave.php";
    var Referrer = "./AddMunicipalForm.php";
    
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
    
    
//    $("a#save").click(function(e) {        
//        var IdNewEditDelete = $("span#IdNewEditDelete").text();
//        e.preventDefault(); // prevent loading on click
//        
//        if(IdNewEditDelete === "new")
//        {        
//            var districtId = $("select#districtId").val();        
//            var municipal = $("input#municipal").val();
//            
//            if(municipal === "")
//            {
//                new Info("Gemeinde ist leer!");
//            } 
//            
//            var data = "municipal=" + municipal + "&districtId=" + districtId;  
//            $.ajax({
//                    type: "POST",
//                    url: "./JsMunicipalSave.php",
//                    data: data,
//                    cache: false,
//                    success: function(data) 
//                    { 
//                        var jsonData = $.parseJSON(data); 
//                        new Info(jsonData.journalMessage);
//                        setTimeout(function() {
//                            window.location.href = "AddMunicipalForm.php?do=new";
//                        }, 1000);
//                        
//                    },
//                    error: function (xhr, ajaxOptions, thrownError) {
//                        alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
//                    },
//                    statusCode: {
//                        404: function() {
//                            alert("Page not found!");
//                        },
//                        500: function() {
//                            alert("A server-side error has occurred.");
//                        }
//                    },
//                    complete: function(e, xhr, settings) {
//                        if(e.status !== 200)
//                        {
//                            alert(e.status);
//                        }
//                    }                
//               });               
//        }
//        
//        if(IdNewEditDelete === "edit")
//        {
//            // loop through all inputs
//            // TODO: Depends on other Forms with bigger Data this is not a performant solution
//            $("input").each(function(idx, el){               
//               var idArray = this.id.split("-");  // get Array from element ID
//               var id = idArray[0];               // retrieve element id name (id="district-3") = district
//               var recId = idArray[1];            // retrieve element id recid (id="district-3") = 3
//               var value = $(this).val();         // value of current element
//               
//               var districtId = $("select#districtId-"+recId).val();
//               
//               if(value === "")
//               {
//                   new Info("#ID: " + recId + " ist leer - wird nicht aktualisiert!")
//               }
//               else
//               {
//                    var data = "recId=" + recId + "&districtId=" + districtId + "&municipal=" + value;
//                    $.ajax({
//                        type: "POST",
//                        url: "./JsMunicipalSave.php",
//                        data: data,
//                        cache: false,
//                        success: function(data) 
//                        { 
//                            var jsonData = $.parseJSON(data); 
//                            new Info(jsonData.journalMessage);
//                            setTimeout(function() {
//                                window.location.href = "AddMunicipalForm.php?do=edit";
//                            }, 1000);
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
//                        },
//                        statusCode: {
//                            404: function() {
//                                alert("Page not found!");
//                            },
//                            500: function() {
//                                alert("A server-side error has occurred.");
//                            }
//                        },
//                        complete: function(e, xhr, settings) {
//                            if(e.status !== 200)
//                            {
//                                alert(e.status);
//                            }
//                        }                
//                    });            
//               }
//               
//            });
//        }
//        
//        
//        if(IdNewEditDelete === "delete")
//        {
//            $("input").each(function(idx, el)
//            { 
//                var idArray = this.id.split("-");  // get Array from element ID
//                var id = idArray[0];               // retrieve element id name (id="district-3") = district
//                var recId = idArray[1];            // retrieve element id recid (id="district-3") = 3
//                  
//                if($("input#" + this.id).prop('checked'))
//                {
//                    var data = "recId=" + recId + "&identifier=delete"; // identifier for security reasons
//                    $.ajax({
//                        type: "POST",
//                        url: "./JsMunicipalSave.php",
//                        data: data,
//                        cache: false,
//                        success: function(data) 
//                        { 
//                            var jsonData = $.parseJSON(data); 
//                            new Info(jsonData.journalMessage);
//                            setTimeout(function() {
//                                window.location.href = "AddMunicipalForm.php?do=delete";
//                            }, 1000);
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                            alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
//                        },
//                        statusCode: {
//                            404: function() {
//                                alert("Page not found!");
//                            },
//                            500: function() {
//                                alert("A server-side error has occurred.");
//                            }
//                        },
//                        complete: function(e, xhr, settings) {
//                            if(e.status !== 200)
//                            {
//                                alert(e.status);
//                            }
//                        }                
//                    });    
//                }
//            });
//        }
//        
//           
//    });
    
        
    
    
});