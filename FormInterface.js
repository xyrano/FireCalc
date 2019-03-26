 /**
 * Save an event through ajax to specified site
 * @param {type} dataStr
 * @param {type} url
 * @param {type} redirect
 * @param {type} doSave
 * @param {type} showDebugData
 * @returns {undefined}
 */
function save(dataStr, url, redirect, doSave, showDebugData) {
    var isSaved = false;
    
    if(doSave === undefined) {
        doSave = false;
        new Info("no saving by this event!");
    }
    
    if(showDebugData === undefined) {
        showDebugData = false;
    }
       
      
    
    if(doSave === true)
    {
        $.ajax({
                type: "POST",
                url: url,
                data: dataStr, 
                cache: false,
                success: function(data) 
                { 
                    var jsonData = $.parseJSON(data);
                    
                    if(showDebugData) {
                        new Info(jsonData.journalMessage);
                    }
                    
                    if(jsonData.journalMessage === null)
                    {
                        new Info("Rückgabewert ist null!");
                    }
                    
                    if(jsonData.journalMessage === true)
                    {
                        window.location.href = redirect;                       
                    }
                    
                    if(jsonData.journalMessage === false)
                    {
                        new Info("Datensatz konnte nicht gespeichert werden!");
                    }
                    
                    if(jsonData.journalMessage !== true && jsonData.journalMessage !== false)
                    {
                        new Info(jsonData.journalMessage);
                        isSaved = true;
                        window.location.href = redirect; 
                    }
                    
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    new Info("Error in code: '" + ajaxOptions + "' [" + thrownError + "] and status: " + xhr.status + "<br>Text is: " + xhr.responseText);                    
                },
                statusCode: {
                    404: function() {
                        new Info("Page not found!");
                    },
                    500: function() {
                        new Info("A server-side error has occurred!");
                    }
                }
        });        
    }    
}




