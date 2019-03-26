var f5pressed = false;

$(document).ready(function() {
    $("body").keydown(function(e) {
        if(e.which === 116)
        {
            f5pressed = true;
        }
    });
    
    $("a#new").removeAttr("id").removeAttr("href");
    //$("a#save").hide("fast").removeAttr("href");
    $("a#delete").removeAttr("id").removeAttr("href"); 
    $("a#update").removeAttr("id").removeAttr("href");
    
    $("a#save").click(function(e) {        
        var IdNewEditDelete = $("span#IdNewEditDelete").text();
        e.preventDefault(); // prevent loading on click
                        
        if(IdNewEditDelete === "edit")
        {
            // loop through all inputs
            // TODO: Depends on other Forms with bigger Data this is not a performant solution
            //$("input").each(function(idx, el){               
               //var idArray = this.id.split("-");  // get Array from element ID
               //var id = idArray[0];               // retrieve element id name (id="district-3") = district
               //var recId = idArray[1];            // retrieve element id recid (id="district-3") = 3
               var recId = $("input#recId").val();
               var idleTime = $("input#idleTime").val();         // value of current element
               var idleTimeFormat = $("select#idleTimeFormat").val();
               var pageRefreshUpdatesIdleTime = $("input#pageRefreshUpdatesIdleTime").prop('checked');
               var deleteUploadedMemberFiles = $("select#deleteUploadedMemberFiles").val();
               var hideContestAfterToday = $("input#hideContestAfterToday").prop('checked');
               var deleteMemberAtAgeOf = $("input#deleteMemberAtAgeOf").val();
               var errorPointsPerDefault = $("input#errorPointsPerDefault").val();
               var timePerDefault = $('input#timePerDefault').val();
               var timePerDefaultOW = $('input#timePerDefaultOW').val();
               var errorPointsPerDefaultBPart = $("input#errorPointsPerDefaultBPart").val();
               var autoMemberIdentId = $("select#autoMemberIdentId").val();
               
               
                if(pageRefreshUpdatesIdleTime === true)
                {
                    pageRefreshUpdatesIdleTime = 1;
                }
                
                if(hideContestAfterToday === true)
                {
                    hideContestAfterToday = 1;
                }
               
                if(recId === "")
                {
                    new Info("#ID: " + recId + " ist leer - wird nicht aktualisiert!")
                }
                else
                {
                    var data = "recId=" + recId + 
                            "&idleTime=" + idleTime + 
                            "&idleTimeFormat=" + idleTimeFormat + 
                            "&pageRefreshUpdatesIdleTime=" + pageRefreshUpdatesIdleTime + 
                            "&deleteUploadedMemberFiles=" + deleteUploadedMemberFiles + 
                            "&hideContestAfterToday=" + hideContestAfterToday +
                            "&deleteMemberAtAgeOf=" + deleteMemberAtAgeOf + 
                            "&errorPointsPerDefault=" + errorPointsPerDefault + 
                            "&timePerDefault=" + timePerDefault + 
                            "&timePerDefaultOW=" + timePerDefaultOW + 
                            "&errorPointsPerDefaultBPart=" + errorPointsPerDefaultBPart + 
                            "&autoMemberIdentId=" + autoMemberIdentId;
                    $.ajax({
                        type: "POST",
                        url: "./JsAdminSetupSave.php",
                        data: data,
                        cache: false,
                        success: function(data) 
                        { 
                            var jsonData = $.parseJSON(data); 
                            new Info(jsonData.journalMessage);
                            setTimeout(function() {
                                window.location.href = "AddAdminSetupForm.php?do=edit";
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
            //});
        }                                           
    });
    
        
    
    
});