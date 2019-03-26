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
    
    $("a#save").removeAttr("id").removeAttr("href");
    
    var debugOn = true;
    var CUDUrl = "./CUD.php";
    var Referrer = "./SignatureMgmt.php?idx=" + getUrlParameter("idx");
    
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
            $.fn.TT_Update(CUDUrl, Referrer, debugOn);
        }
    });
});

