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
    $("a#new").removeAttr("id").removeAttr("href");
    $("a#save").removeAttr("id").removeAttr("href");
    $("a#update").removeAttr("id").removeAttr("href");
    $("a#delete").removeAttr("id").removeAttr("href");
    
});


