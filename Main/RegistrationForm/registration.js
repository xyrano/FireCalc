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
    
    $("a#update").removeAttr("id").removeAttr("href");
    $("a#delete").removeAttr("id").removeAttr("href");
    
    
     $("a").click(function(e) {        
        var IdNewEditDelete = $("span#IdNewEditDelete").text();        
        var whatsClicked = $(this).attr('id');
        
        switch(whatsClicked)
        {
            case 'save':                
                e.preventDefault(); // prevent loading on click
                var contestId = $("select#contestId").val();
                var fireDeptId = $("input#fireDeptId").val();
                var confirmed = $("input#confirmed").prop('checked');
                 
                var data = "contestId=" + contestId + "&fireDeptId=" + fireDeptId + "&confirmed=" + confirmed + "&identifier=insert";
                
                if(confirmed === false)
                {
                    new Info("Sie müssen die Anmeldung explizit bestätigen!", 
                    { 
                        title: 'Bestätigung',
                        buttons: [
                                    {id: 0, label: 'Bestätigen', val: 'ok'},
                                    {id: 1, label: 'Abbruch', val: '0'}
                                 ],
                        callback: function(val) 
                        { 
                            if(val === 'ok')
                            {
                                new Info("Sie haben Verbdindlich zugesagt!");
                                confirmed = true;
                                data = "contestId=" + contestId + "&fireDeptId=" + fireDeptId + "&confirmed=" + confirmed + "&identifier=insert";
                                save(data);
                            }
                            else
                            {
                                new Info("Vorgang abgebrochen!");
                            }
                        }
                    });                     
                }
                else
                {
                    save(data);
                }                                                                
                break;
        }
    });
    
    
    function save(_data)
    {
        $.ajax({
            type: "POST",
            url: "./JsRegistrationSave.php?idx="+getUrlParameter("idx"),
            data: _data,
            cache: false,
            success: function(data) 
            { 
                var jsonData = $.parseJSON(data); 
                new Info(jsonData.journalMessage);
                setTimeout(function() {
                    window.location.href = "RegistrationForm.php?do=start";
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


