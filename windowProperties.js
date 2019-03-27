var f5pressed = false;
var inFormOrLink = false;

var height = 0, width = 0, x = 0, y = 0;
var windowName = "";

$(document).ready(function() {
    $("body").keydown(function(e) {
        if(e.which === 116)
        {
            f5pressed = true;
        }
    });
    

    $('a').on('click', function() {  
        getProperties();        
        inFormOrLink = true; 
    });
    $('form').on('submit', function() { 
        getProperties();
        inFormOrLink = true; 
    });
    
   

    $(window).on("beforeunload", function() { 
        if(f5pressed === false && inFormOrLink === false)
        {
            // propably a better or alternative version is to ctch all necessary properties by clicking an event?!
            // so then we have a workaround becasue this wont work sometimes?!
            getProperties();
            save();
        }
    });
    
    function getProperties() {
        width = $(window).width();
        height = $(window).height();
        x = window.screenX;
        y = window.screenY;  
        windowName = window.window.name;
    }
   
    function save() {
        var data = "windowTitle=" + windowName + "&width=" + width + "&height=" + height + "&x=" + x + "&y=" + y;
        
        // TODO: perhaps a dynamics recursive propertie is better?
        //var savePage = "../../saveWindowProperties.php"; // localhost        
        var savePage = "/FireTool/saveWindowProperties.php"; // absolute Path like in MenuItems
       
        $.ajax(
        {
            type: "POST",
            url: savePage,
            data: data,
            cache: false,
            success: function(data) 
            { 
                var jsonData = $.parseJSON(data); 
                //alert(jsonData.journalMessage);
            } ,
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

