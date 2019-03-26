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
    
    var debugOn = false;
    var CUDUrl = "./JsDistrictSave.php";
    var Referrer = "./AddDistrictForm.php";
    
    $("tr.select").on("dblclick", function(e) {
       $.fn.TT_InlineEdit(this, CUDUrl, debugOn); 
    });
    
    
    $("a#delete").click(function(e) {        
        e.preventDefault();
        $.fn.TT_Delete(CUDUrl, Referrer, debugOn);
    });
    
    
    $("a#save").click(function(e) {       
        e.preventDefault();
        var attr = $("fieldset").attr('Create');

        // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
        if (typeof attr !== typeof undefined && attr !== false) {
            // Element has this attribute       
            $.fn.TT_Create(CUDUrl, Referrer, debugOn);
        }
        else
        {
            $.fn.TT_Update(CUDUrl, "", debugOn);
        }
    });
    
    
    
    
    
//    $("a#delete").click(function(e) {
//        e.preventDefault();
//        var recId = $("tr.selected").attr('id');        
//        if(recId === "" || recId === undefined)
//        {
//            new Info("Kein Datensatz selektiert - daher wird nichts ausgeführt!")
//        }
//        else
//        {                    
//            var data = "recId=" + recId + "&identifier=delete"; // identifier for security reasons
//            $.ajax({
//                type: "POST",
//                url: "./JsDistrictSave.php",
//                data: data,
//                cache: false,
//                success: function(data) 
//                { 
//                    var jsonData = $.parseJSON(data); 
//                    new Info(jsonData.journalMessage);               
//                    window.location.href = "AddDistrictForm.php";
//                },
//                error: function (xhr, ajaxOptions, thrownError) {
//                    alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
//                },
//                statusCode: {
//                    404: function() {
//                        alert("Page not found!");
//                    },
//                    500: function() {
//                        alert("A server-side error has occurred.");
//                    }
//                },
//                complete: function(e, xhr, settings) {
//                    if(e.status !== 200)
//                    {
//                        alert(e.status);
//                    }
//                }                
//            }); 
//        }
//    });
//    
//    $("a#save").click(function(e) {
//        e.preventDefault();    
//        var IdNewEditDelete = $("span#IdNewEditDelete").text(); 
//        var recId = $("tr.selected").attr('id');        
//        if((recId === "" || recId === undefined) && IdNewEditDelete !== "new")
//        {
//            new Info("Kein Datensatz selektiert - daher wird nichts ausgeführt!")
//        }
//        else
//        {
//            if(IdNewEditDelete !== "new")
//            {
//                var districtName = $("td#district-"+recId).html();
//                var data = "recId=" + recId + "&district=" + districtName;
//                $.ajax({
//                    type: "POST",
//                    url: "./JsDistrictSave.php",
//                    data: data,
//                    cache: false,
//                    success: function(data) 
//                    { 
//                        var jsonData = $.parseJSON(data); 
//                        new Info(jsonData.journalMessage, { autoclose: 100 });                   
//                        window.location.href = "AddDistrictForm.php";                    
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
//                }); 
//            }
//        }
//    });
//    
//    
//    $("a#save").click(function(e) { 
//        e.preventDefault(); // prevent loading on click       
//        var IdNewEditDelete = $("span#IdNewEditDelete").text();                
//        if(IdNewEditDelete === "new")
//        {        
//            var district = $("input#district").val();        
//            if(district === "")
//            {
//                new Info("Landkreis ist leer!");
//            }        
//            var data = "district=" + district;  
//            $.ajax(
//            {
//                type: "POST",
//                url: "./JsDistrictSave.php",
//                data: data,
//                cache: false,
//                success: function(data) 
//                { 
//                    var jsonData = $.parseJSON(data); 
//                    new Info(jsonData.journalMessage, { autoclose: 100 });
//                    window.location.href = "AddDistrictForm.php";
//                },
//                error: function (xhr, ajaxOptions, thrownError) {
//                    alert("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
//                },
//                statusCode: {
//                    404: function() {
//                        alert("Page not found!");
//                    },
//                    500: function() {
//                        alert("A server-side error has occurred.");
//                    }
//                },
//                complete: function(e, xhr, settings) {
//                    if(e.status !== 200)
//                    {
//                        alert(e.status);
//                    }
//                }                
//           });               
//        }                                                        
//    });        
    
});