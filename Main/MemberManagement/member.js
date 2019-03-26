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
            if (sParameterName[0] === sParam) 
            {
                return sParameterName[1];
            }
        }
    } 
    
    
    $("a#start").removeAttr("id").removeAttr("href");
    $("a#update").removeAttr("id").removeAttr("href");
    
    
    var CUDUrl = "./JsMemberSave.php";
    var Referrer = "./AddMemberForm.php?page=" + getUrlParameter("page"); // TODO: check also on 'char'
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
            // Element has this attribute "Create" so call Create func.      
            $.fn.TT_Create(CUDUrl, Referrer, DebugOn);
        }
        else
        {
            // Call Update func.
            $.fn.TT_Update(CUDUrl, Referrer, DebugOn);
        }
    });
    
//     $("a#save").click(function(e) {        
//        var IdNewEditDelete = $("span#IdNewEditDelete").text();
//        e.preventDefault(); // prevent loading on click
//        
//        if(IdNewEditDelete === "new")
//        {        
//            var identityNum = $("input#identityNum").val();
//            var surname = $("input#surname").val();
//            var forename = $("input#forename").val();
//            var birthday = $("input#birthday").val();
//            var entryDate = $("input#entryDate").val();
//            var fireDeptId = $("select#fireDeptId").val();
//            var gender = $("select#gender").val();
//            
//            if(identityNum === "")
//            {
//                new Info("Ausweisnummer ist leer!");
//            }
//            else if(birthday === "")
//            {
//                new Info("Geburtsdatum ist leer!");
//            }
//            else
//            {
//                var data = "identityNum=" + identityNum + "&surname=" + surname + "&forename=" + forename + "&birthday=" + birthday + "&entryDate=" + entryDate + "&fireDeptId=" + fireDeptId + "&gender=" + gender;
//                $.ajax(
//                {
//                    type: "POST",
//                    url: "./JsMemberSave.php",
//                    data: data,
//                    cache: false,
//                    success: function(data) 
//                    { 
//                        var jsonData = $.parseJSON(data); 
//                        new Info(jsonData.journalMessage);
//                        setTimeout(function() {
//                            window.location.href = "AddMemberForm.php?do=new";
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
//            }
//        } // New brace
//        
//        
//        if(IdNewEditDelete === "edit")
//        {
//            var recId = $("#recId").text(); // div
//            var identityNum = $("input#identityNum").val();
//            var surname = $("input#surname").val();
//            var forename = $("input#forename").val();
//            var birthday = $("input#birthday").val();
//            var entryDate = $("input#entryDate").val();
//            var fireDeptId = $("select#fireDeptId").val();
//            var gender = $("select#gender").val();
//            
//            if(identityNum === "")
//            {
//                new Info("Ausweisnummer ist leer!");
//            }
//            else if(birthday === "")
//            {
//                new Info("Geburtsdatum ist leer!");
//            }
//            else
//            {
//                var data = "recId=" + recId + "&identityNum=" + identityNum + "&surname=" + surname + "&forename=" + forename + "&birthday=" + birthday + "&entryDate=" + entryDate + "&fireDeptId=" + fireDeptId + "&gender=" + gender + "&identifier=update";
//                $.ajax(
//                {
//                    type: "POST",
//                    url: "./JsMemberSave.php",
//                    data: data,
//                    cache: false,
//                    success: function(data) 
//                    { 
//                        var jsonData = $.parseJSON(data); 
//                        new Info(jsonData.journalMessage);
//                        setTimeout(function() {
//                            window.location.href = "AddMemberForm.php";
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
//            }
//        } // Update brace
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
//                        url: "./JsMemberSave.php",
//                        data: data,
//                        cache: false,
//                        success: function(data) 
//                        { 
//                            var jsonData = $.parseJSON(data); 
//                            new Info(jsonData.journalMessage);
//                            setTimeout(function() {
//                                window.location.href = "AddMemberForm.php?do=delete";
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
//        } // delete brace
//        
//        
//    }); // save click brace
    
// autcomplete directly from JQuery    
//    $( function() 
//    {
//        var cache = {};
//        $( "#searchVal" ).autocomplete({
//            minLength: 2,
//            source: function( request, response ) 
//            {
//                var term = request.term;
//                if ( term in cache ) 
//                {
//                    response( cache[ term ] );
//                    return;
//                }
// 
//                $.getJSON( "search.php", request, function( data, status, xhr ) 
//                {
//                    cache[ term ] = data;
//                    response( data );
//                });
//            }
//        });
//    });


    // Here a better solution
    $("#searchVal").bind("change", function(e){
      $.getJSON("search.php?searchVal=" + $("#searchVal").val(),
        function(data)
        {
            $.each(data, function(i, item)
            {
                switch(item.field)
                {
                    case 'recId':
                        $("#recId").text(item.value); // div
                        break;
                        
                    case 'identityNum':
                        $("#identityNum").val(item.value);
                        break;
                        
                    case 'gender':
                        $("#gender").val(item.value);
                        break;
                        
                    case 'forename':
                        $("#forename").val(item.value);
                        break;
                    
                    case 'surname':
                        $("#surname").val(item.value);
                        break;
                        
                    case 'birthday':
                        $("#birthday").val(item.value);
                        break;
                        
                    case 'entryDate':
                        $("#entryDate").val(item.value);
                        break;
                        
                    case 'fireDeptId':
                        $("#fireDeptId").val(item.value);
                        break;
                }                
            });
        });
    });
    
});