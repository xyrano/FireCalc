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
    
    
    var CUDUrl = "./CUD.php";
    var Referrer = "./AddUserForm.php";
    var DebugOn = false;
    
    $("tr.select").on("dblclick", function(e) {
       $.fn.TT_InlineEdit(this, CUDUrl, DebugOn);      
    });
    
    
    $("a#delete").click(function(e) {        
        e.preventDefault();
        $.fn.TT_Delete(CUDUrl, Referrer, DebugOn);
    });
    
    
    $("a#save").click(function(e) {       
        e.preventDefault();
        var attr = $("fieldset").attr('Create');

        // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
        if (typeof attr !== typeof undefined && attr !== false) {
            // Element has this attribute       
            $.fn.TT_Create(CUDUrl, Referrer, DebugOn);
        }
        else
        {
            $.fn.TT_Update(CUDUrl, Referrer, DebugOn);
        }
    });
    
    
    
//    $("a#save").click(function(e) {        
//        var IdNewEditDelete = $("span#IdNewEditDelete").text();
//        e.preventDefault(); // prevent loading on click
//        
//        if(IdNewEditDelete === "new")
//        {        
//            var username = $("input#username").val();   
//            var password = $("input#password").val();            
//            var groupId = $("select#groupId").val(); // null = 0 value is to see all
//            var fireDeptId = $("select#fireDeptId").val();
//            
//            if(username === "")
//            {
//                new Info("Benutzername ist leer!");
//            }        
//            if(password === "")
//            {
//                new Info("Password ist leer!");
//            }
//            
//            var data = "username=" + username + "&password=" + password + "&groupId=" + groupId + "&fireDeptId=" + fireDeptId;  
//            $.ajax({
//                    type: "POST",
//                    url: "./JsUserSave.php",
//                    data: data,
//                    cache: false,
//                    success: function(data) 
//                    { 
//                        var jsonData = $.parseJSON(data); 
//                        new Info(jsonData.journalMessage);
//                        setTimeout(function() {
//                            window.location.href = "AddUserForm.php?do=new";
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
//               var username = $(this).val();         // value of current element
//               var groupId = $("select#groupId-"+recId).val();
//               var fireDeptId = $("select#fireDeptId-"+recId).val();
//               
//               if(username === "")
//               {
//                   new Info("#ID: " + recId + " ist leer - wird nicht aktualisiert!")
//               }
//               else
//               {
//                    var data = "recId=" + recId + "&username=" + username + "&groupId=" + groupId + "&fireDeptId=" + fireDeptId;
//                    $.ajax({
//                        type: "POST",
//                        url: "./JsUserSave.php",
//                        data: data,
//                        cache: false,
//                        success: function(data) 
//                        { 
//                            var jsonData = $.parseJSON(data); 
//                            new Info(jsonData.journalMessage);
//                            setTimeout(function() {
//                                window.location.href = "AddUserForm.php?do=edit";
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
//                        url: "./JsUserSave.php",
//                        data: data,
//                        cache: false,
//                        success: function(data) 
//                        { 
//                            var jsonData = $.parseJSON(data); 
//                            new Info(jsonData.journalMessage);
//                            setTimeout(function() {
//                                window.location.href = "AddUserForm.php?do=delete";
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