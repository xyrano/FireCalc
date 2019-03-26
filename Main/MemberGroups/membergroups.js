 var selectedMemberIds = [];
 var listOfMember;
 var numOfMember = 0;
$(document).ready(function() {
     
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
    
    
    

    $(function() {
        $( "#targetList, #sourceList" ).sortable({
            connectWith: ".connectedSortable"           
        }).disableSelection();

        $( "#targetList" ).on( "sortreceive", function(event, ui) {
            if($("#targetList li").length > 10)
            {
                $(ui.sender).sortable('cancel');
            }
        });          
    });
    
   

    var debugOn = false;
    var CUDUrl = "./JsMemberGroupSave.php";
    var Referrer = "./AddMemberGroupsForm.php?idx="+getUrlParameter("idx");
    
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
        var ok = true;
        var memberIdsArray = $("#targetList").sortable("toArray");
        if(memberIdsArray.length < 9)
        {
            new Info("Gruppenmitglieder anzahl stimmt nicht!<br>Es sind nur " + memberIdsArray.length + " von mindestens 9 vorhanden!");
            ok = false;
        }
        
        if(ok)
        {
            // For some browsers, `attr` is undefined; for others, `attr` is false. Check for both.
            if (typeof attr !== typeof undefined && attr !== false) {
                // Element has this attribute               
                $.fn.TT_Create(CUDUrl, Referrer, debugOn, memberIdsArray);
            }
            else
            {
                $.fn.TT_Update(CUDUrl, Referrer, debugOn, memberIdsArray);
            }
        }
    });

    /*

     $("a#save").click(function(e) {        
        var IdNewEditDelete = $("span#IdNewEditDelete").text();
        e.preventDefault(); // prevent loading on click
        
        if(IdNewEditDelete === "new")
        {        
            var contestId = $("input#contestId").val();
            var fireDeptId = $("select#fireDeptId").val();
            var groupName = $("input#groupName").val();
            var suffix = $("select#suffixId").val();
            //var memberIdsArray = selectedMemberIds;
            var memberIdsArray = $("#targetList").sortable("toArray");
            var ok = true;
            
            if(groupName === "")
            {
                new Info("Gruppenname fehlt!");
                ok = false;
            }
            
            if(memberIdsArray.length < 9)
            {
                new Info("Gruppenmitglieder anzahl stimmt nicht!<br>Es sind nur " + memberIdsArray.length + " von mindestens 9 vorhanden!");
                ok = false;
            }
            
            var  data = "contestId=" + contestId + "&fireDeptId=" + fireDeptId + "&groupName=" + groupName + "&suffix=" + suffix + "&memberIdsArray=" + memberIdsArray;
            if(ok)
            {
                save(data, "./JsMemberGroupSave.php", "AddMemberGroupsForm.php?do=new&idx="+getUrlParameter("idx"), true);
            }
        }
        
        
        if(IdNewEditDelete === "edit")
        {
            var idx = $("#idx").val();
            var recId = $("#recId").val();
            var contestId = $("input#contestId").val();
            var fireDeptId = $("select#fireDeptId").val();
            var groupName = $("input#groupName").val();
            var suffix = $("select#suffixId").val();
            var memberIdsArray = $("#targetList").sortable("toArray");
            var ok = true;
            
            if(groupName === "")
            {
                new Info("Gruppenname fehlt!");
                ok = false;
            }
            
            if(memberIdsArray.length < 9)
            {
                new Info("Gruppenmitglieder anzahl stimmt nicht!<br>Es sind nur " + memberIdsArray.length + " von mindestens 9 vorhanden!");
                ok = false;
            }
            
            var  data = "recId=" + recId + "&contestId=" + contestId + "&fireDeptId=" + fireDeptId + "&groupName=" + groupName + "&suffix=" + suffix + "&memberIdsArray=" + memberIdsArray + "&identifier=edit";
            if(ok)
            {
                save(data, "./JsMemberGroupSave.php", "AddMemberGroupsForm.php?do=edit&idx="+getUrlParameter("idx"), true);
            }
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
                    save(data, "./JsMemberGroupSave.php", "AddMemberGroupsForm.php?do=delete&idx="+getUrlParameter("idx"), false);
                }
            });
        }
    });
    
    
    function save(data, url2Save, redirectUrl, redirect)
    {
        $.ajax(
        {
            type: "POST",
            url: url2Save,
            data: data,
            cache: false,
            success: function(data) 
            { 
                var jsonData = $.parseJSON(data); 
                if(jsonData.journalMessage === false)
                {
                    jsonData.journalMessage = "Unbekannter Fehler?!";
                }
                new Info(jsonData.journalMessage);
                if(redirect) {
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 1000);
                }
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

    */
    
});

