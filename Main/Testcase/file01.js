$(document).ready(function() {
    var selectedRecId = 0;
    var rowIsSelected = 0;
    
    window.onload = init;
    
    
    function init() 
    {
        // initializations ...
    }
    
    $.fn.DTT_InlineEdit = function() {
        
    }
    
    
    $("#searchInput").keyup(function () {
       //split the current value of searchInput
       var data = this.value.split(" ");
       //create a jquery object of the rows
       var jo = $("#fbody").find("tr");
       if (this.value == "") {
           jo.show();
           return;
       }
       //hide all the rows
       jo.hide();

       //Recusively filter the jquery object to get results.
       jo.filter(function (i, v) {
           var $t = $(this);
           for (var d = 0; d < data.length; ++d) {
               if ($t.is(":contains('" + data[d] + "')")) {
                   return true;
               }
           }
           return false;
       })
       //show the rows that match.
       .show();
   }).focus(function () {
       this.value = "";
       $(this).css({
           "color": "black"
       });
       $(this).unbind('focus');
   }).css({
       "color": "#C0C0C0"
   });
    
    
    
    /**
     * Enter the row by DoubleClick - the select comes from selected selector, select an select makes a select selectable :-D
     */
    $("tr.select").on("dblclick", function(e) 
    {
        var recId = $(this).attr("id");
        
        if(selectedRecId === recId || selectedRecId === 0)
        {
            selectedRecId = recId;
            rowIsSelected++;
            
            
            if(rowIsSelected > 1)
            {
                // Row was two times fired with a DblClick so remove Controls
                removeAllControls(recId);
                rowIsSelected = 0;
            }
            else
            {
                // Loop through every TD 
                $(this).children().each(function(columnIdx, td) {
                    // get span inside an TD                    
                    var type = $(this).find("span").attr("type");
                    // Ggf. sind mehrere span´s in einer TD, dies muss berücksichtigt werden!!!
                    var countedSpans = $(this).find("span").length;
                    if(countedSpans > 1)
                    {
                        // TD case with more as 1 span objects
                        $(this).find("span").each(function() {
                            var spanType = $(this).attr("type");
                            switchToControl(spanType, this);
                        });
                    }
                    else
                    {
                        // Normal TD case
                        if(type !== undefined)
                        {
                            // Switch to Control and provide it to an TD
                            // only to TD´s with type attr
                            switchToControl(type, this);
                        }
                    }
                });    
            }            
        }
        else
        {
            // Row is per dblClick changed
            // remove all Controls - but values in TD´s are lost at this point - take care of it
            removeAllControls(selectedRecId);
            
            selectedRecId = recId;
            // now same logic as above
            // Loop through every td with an type attr
            $(this).children().each(function(columnIdx, td) {
                var type = $(this).find("span").attr("type");
                var countedSpans = $(this).find("span").length;
                if(countedSpans > 1)
                {
                    // TD case with more as 1 span objects
                    $(this).find("span").each(function() {
                        var spanType = $(this).attr("type");
                        switchToControl(spanType, this);
                    });
                }
                else
                {
                    if(type !== undefined)
                    {
                        // Switch to Control and provide it to an TD
                        // only to TD´s with type attr
                        switchToControl(type, this);
                    }
                }
            });  
        }                
    });
    
    
    
    
    
    
    
    
    function removeAllControls(selectedRecId) {
        // selectedRecId is the RecId from previous selected Row
        // loop thorugh each TD from previous row
        $("tr#"+selectedRecId).children().each(function(columnIdx, td) {
            var type = $(this).find("span").attr("type");
            var countedSpans = $(this).find("span").length;
            if(countedSpans > 1)
            {
                // TD case with more as 1 span objects
                $(this).find("span").each(function() {
                    var spanType = $(this).attr("type");
                    switchToControl(spanType, this, true);
                });
            }
            else
            {
                if(type !== undefined)
                {
                    switchToControl(type, this, true); // Last param control to removes the Ctrl                
                }
            }
        });
    }
    
    /**
     * Decide which Control should be Provided by the type attr
     * @param {str} type The Type attr str
     * @param {Object} element The Element which is looped
     * @returns {null} no return
     */
    function switchToControl(type, element, getVal4Remove)
    {
        getVal4Remove = getVal4Remove || false;
        switch(type.toLowerCase())
        {
            case 'text': 
                if(getVal4Remove)
                {
                    rmTextCtrl(element);
                }
                else
                {
                    prvdTextCtrl(element); 
                }
                break;
            
            case 'date':
                if(getVal4Remove)
                {
                    rmDateCtrl(element);
                }
                else
                {
                    prvdDateCtrl(element);
                }
                break;
                
            case 'time':
                if(getVal4Remove)
                {
                    rmTimeCtrl(element);
                }
                else
                {
                    prvdTimeCtrl(element);
                }
                break;
             
            case 'datetime':
                if(getVal4Remove)
                {
                    rmDateTimeCtrl(element);
                }
                else
                {
                    prvdDateTimeCtrl(element);
                }
                break;
                
            case 'enum':
                if(getVal4Remove)
                {
                    rmEnumCtrl(element);
                }
                else
                {
                    prvdEnumCtrl(element);
                }
                break;
                
            case 'checkbox':
                if(getVal4Remove)
                {
                    rmCheckboxCtrl(element);
                }
                else
                {
                    prvdCheckboxCtrl(element);
                }
                break;
        }        
    }
    
    
    
    
    /**
     * Provide an Input Control
     * @param {Object} element The current element
     * @returns {null} no return
     */
    function prvdTextCtrl(element) {
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            if(checkOnSpecialChars($(element).html()) === false) 
            {
                var elemValue = $(element).html();
                var elemName = $(element).attr("name");
                var elemWidth = ($(element).width()+10);
                elemWidth = (elemWidth===10) ? 50 : elemWidth;
                var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";            
                $(element).html(""); // empty html
                $(element).text(""); // empty text
                $(element).empty();               
                $(element).append("<input type=\"text\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + ">");
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
        else
        {
            if(checkOnSpecialChars($(element).find("span").html()) === false) 
            {
                var elemValue = $(element).find("span").html();
                var elemName = $(element).find("span").attr("name");
                var elemWidth = ($(element).find("span").width()+10);
                elemWidth = (elemWidth===10) ? 50 : elemWidth;
                var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";            
                $(element).find("span").html(""); // empty html
                $(element).find("span").text(""); // empty text
                $(element).find("span").empty();               
                $(element).find("span").append("<input type=\"text\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + ">");
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
    }
    
    
    
    function prvdDateCtrl(element) {
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            if(checkOnSpecialChars($(element).html()) === false) 
            {
                var elemValue = $(element).html();
                var elemName = $(element).attr("name");
                var elemWidth = ($(element).width()+70);
                elemWidth = (elemWidth===70) ? 130 : elemWidth;
                var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";    
                $(element).html("");
                $(element).text("");
                $(element).append("<input type=\"date\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + ">");
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
        else
        {
            if(checkOnSpecialChars($(element).find("span").html()) === false) 
            {
                var elemValue = $(element).find("span").html();
                var elemName = $(element).find("span").attr("name");
                var elemWidth = ($(element).find("span").width()+70);
                var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";    
                $(element).find("span").html("");
                $(element).find("span").text("");
                $(element).find("span").append("<input type=\"date\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + ">");
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
    }
    
    
    
    
    function prvdTimeCtrl(element) {
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            if(checkOnSpecialChars($(element).html()) === false) 
            {
                var elemValue = $(element).html();
                var elemName = $(element).attr("name");
                var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";  
                var elemWidth = ($(element).width()+50);
                elemWidth = (elemWidth===50) ? 90 : elemWidth;
                $(element).html("");
                $(element).text("");
                $(element).append("<input type=\"time\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" step=\"1\" " + elemEditable + ">");
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
        else
        {
            if(checkOnSpecialChars($(element).find("span").html()) === false) 
            {
                var elemValue = $(element).find("span").html();
                var elemName = $(element).find("span").attr("name");
                var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";    
                $(element).find("span").html("");
                $(element).find("span").text("");
                $(element).find("span").append("<input type=\"time\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + ($(element).width()+50) + "px;\" step=\"1\" " + elemEditable + ">");
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
    }
    
    
    
    function prvdDateTimeCtrl(element) {
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            if(checkOnSpecialChars($(element).html()) === false) 
            {
                var elemValue = $(element).html();
                var elemName = $(element).attr("name");
                var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";    
                var elemWidth = ($(element).width()+70);
                elemWidth = (elemWidth===70) ? 130 : elemWidth;
                $(element).html("");
                $(element).text("");
                $(element).append("<input type=\"datetime\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + ">");
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
        else
        {
            if(checkOnSpecialChars($(element).find("span").html()) === false) 
            {
                var elemValue = $(element).find("span").html();
                var elemName = $(element).find("span").attr("name");
                var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";    
                $(element).find("span").html("");
                $(element).find("span").text("");
                $(element).find("span").append("<input type=\"datetime\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + ($(element).width()+20) + "px;\" " + elemEditable + ">");
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("input#"+elemName).addClass("mandatoryField");
                }
            }
        }
    }
    
    
    function prvdEnumCtrl(element) {    
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            var elemValue = $(element).html();
            var elemName = $(element).attr("name");
            var elemEditable = ($(element).attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";
            var elemSelectMultiple = ($(element).attr("enummultiple") === "true" || $(element).attr("enummultiple") === "0") ? "multiple" : "";
            var elemWidth = ($(element).width()+70);
                elemWidth = (elemWidth===70) ? 130 : elemWidth;
            var url2File = $(element).attr("enumData");
            var options = loadEnumOptions(url2File);
            if(url2File !== undefined && options !== undefined)
            {
                $(element).html("");
                $(element).text("");
                $(element).append("<select " + elemSelectMultiple + " id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + "></select>");
                $.each(options, function(i, identifier){
                    var selected = (elemValue === identifier.value) ? "selected" : "";
                    $("select#"+elemName).append("<option value=\""+ identifier.recId +"\" " + selected + ">"+ identifier.value +"</option>");
                });  
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("select#"+elemName).addClass("mandatoryField");
                }
            }
            else
            {
                new Info("Enum kann nicht geladen werden!");
            }   
        }
        else
        {
            var elemValue = $(element).find("span").html();
            var elemName = $(element).find("span").attr("name");
            var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";
            var elemSelectMultiple = ($(element).find("span").attr("enummultiple") === "true" || $(element).find("span").attr("enummultiple") === "0") ? "multiple" : "";
            var url2File = $(element).find("span").attr("enumData");
            var options = loadEnumOptions(url2File);
            if(url2File !== undefined && options !== undefined)
            {
                $(element).find("span").html("");
                $(element).find("span").text("");
                $(element).find("span").append("<select " + elemSelectMultiple + " id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + ($(element).width()+30) + "px;\" " + elemEditable + "></select>");
                $.each(options, function(i, identifier){
                    var selected = (elemValue === identifier.value) ? "selected" : "";
                    $("select#"+elemName).append("<option value=\""+ identifier.recId +"\" " + selected + ">"+ identifier.value +"</option>");
                });  
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("select#"+elemName).addClass("mandatoryField");
                }
            }
            else
            {
                new Info("Enum kann nicht geladen werden!");
            }   
        }
    }
    
    
    
    function prvdCheckboxCtrl(element) {
        validateCtrl(element);
        // A checkbox Control is alway a simple Yes/No Enum
        if(element.tagName === "SPAN")
        {
            var elemValue = $(element).html();
            var elemName = $(element).attr("name");
            var elemEditable = ($(element).attr("editable") === "false") ? "disabled" : "";
            var elemWidth = ($(element).width()+50);
                elemWidth = (elemWidth===50) ? 30 : elemWidth;
            $(element).html("");
            $(element).text("");
            var selectedNo = (elemValue === "Nein") ? "selected" : "";
            $(element).append("<select id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + "><option value=\"1\">Ja</option><option value=\"0\" " + selectedNo + ">Nein</option></select>");
            if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
            {
                $("select#"+elemName).addClass("mandatoryField");
            }
        }
        else
        {
            var elemValue = $(element).find("span").html();
            var elemName = $(element).find("span").attr("name");
            var elemEditable = ($(element).find("span").attr("editable") === "false") ? "disabled" : "";
            $(element).find("span").html("");
            $(element).find("span").text("");
            var selectedNo = (elemValue === "Nein") ? "selected" : "";
            $(element).find("span").append("<select id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + ($(element).width()+30) + "px;\" " + elemEditable + "><option value=\"1\">Ja</option><option value=\"0\" " + selectedNo + ">Nein</option></select>");
            if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
            {
                $("select#"+elemName).addClass("mandatoryField");
            }
        }
    }
    
    
    
    // #######################  Removes Controls and restore values ####################    
    
    function rmTextCtrl(element) { 
        if(element.tagName === "SPAN")
        {
            var valueCtrl = $(element).find("input").val();
            var valueElem = $(element).text();
            if(valueCtrl !== undefined) //&& valueElem !== valueCtrl)
            {
                $(element).find("input").remove();
                $(element).html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
        else
        {
            var valueCtrl = $(element).find("span").find("input").val();
            var valueElem = $(element).find("span").text();
            if(valueCtrl !== undefined) //&& valueElem !== valueCtrl)
            {
                $(element).find("span").find("input").remove();
                $(element).find("span").html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
    }
    
    function rmDateCtrl(element) {
        if(element.tagName === "SPAN")
        {
            var valueCtrl = $(element).find("input").val();
            var valueElem = $(element).text();
            if(valueCtrl !== undefined)
            {
                $(element).find("input").remove();
                $(element).html((valueCtrl) ? valueCtrl : valueElem);    // maybe check if all value are empty and set to 01/01/1900     
            }
        }
        else
        {
            var valueCtrl = $(element).find("span").find("input").val();
            var valueElem = $(element).find("span").text();
            if(valueCtrl !== undefined)
            {
                $(element).find("span").find("input").remove();
                $(element).find("span").html((valueCtrl) ? valueCtrl : valueElem);    // maybe check if all value are empty and set to 01/01/1900     
            }
        }
    }
    
    function rmTimeCtrl(element) {
        if(element.tagName === "SPAN")
        {
            var valueCtrl = $(element).find("input").val();
            var valueElem = $(element).text();
            if(valueCtrl !== undefined)
            {
                $(element).find("input").remove();
                $(element).html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
        else
        {
            var valueCtrl = $(element).find("span").find("input").val();
            var valueElem = $(element).find("span").text();
            if(valueCtrl !== undefined)
            {
                $(element).find("span").find("input").remove();
                $(element).find("span").html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
    }
    
    function rmDateTimeCtrl(element) {
        rmTextCtrl(element); // goto it is the same logic as Text
    }
    
    function rmEnumCtrl(element) {
        // From enum options came only the recId value <option value="recId">, get the text between the options -> html()
        // Get´s the selected text
        if(element.tagName === "SPAN")
        {
            var valueCtrl = $(element).find("select option:selected").text(); 
            var valueElem = $(element).text();
            if(valueCtrl !== undefined && valueElem !== valueCtrl)        
            {
                $(element).find("select").remove();
                $(element).html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
        else
        {
            var valueCtrl = $(element).find("span").find("select option:selected").text(); 
            var valueElem = $(element).find("span").text();
            if(valueCtrl !== undefined && valueElem !== valueCtrl)        
            {
                $(element).find("span").find("select").remove();
                $(element).find("span").html((valueCtrl) ? valueCtrl : valueElem);        
            }
        }
    }
    
    function rmCheckboxCtrl(element) {
        rmEnumCtrl(element); // goto it is the same logic as enum
    }
    
    /**
     * validates an Control if attr name and type is available
     * @param {type} element
     * @returns {undefined}
     */
    function validateCtrl(element) {
        if(element.tagName === "SPAN") // tagName is UPPER CASE
        {
            // Comes from multiple span tag inside of an TD
            if($(element).attr("name") === undefined)
            {
                new Info("Kein Name für Element " + element.toString());
            }

            if($(element).attr("type") === undefined)
            {
                new Info("Kein Typ für Element " + element.toString());
            }  
        }
        else
        {
            // Normal TD Case
            if($(element).find("span").attr("name") === undefined)
            {
                new Info("Kein Name für Element " + element.toString());
            }

            if($(element).find("span").attr("type") === undefined)
            {
                new Info("Kein Typ für Element " + element.toString());
            }  
        }
    }
    
    /**
     * 
     * @param {type} str
     * @returns {Boolean} true if an special char is found
     */
    function checkOnSpecialChars(str) {
        var specialChars = "<>@#$%^*_+[]{};|'\"\\/~`=";
        
        for(var i = 0; i < specialChars.length;i++)
        {
            if(str.indexOf(specialChars[i]) > -1)
            {
                return true
            }
        }
        return false;                
    }
    
    
    function loadEnumOptions(url2File) {
        if(url2File === undefined || url2File === "")
        {
            new Info("Enum kann nicht geladen werden!");
        }
        else
        {            
            var ret;
            $.ajax({
               url: url2File,
               dataType: "json",
               async: false,
               data: "",
               cache: true,
               success: function(data)
               {
                   ret = data;
               }
            });
            return ret;            
        }
    }
    
    
    
    $("a#save").click(function(e) {
        // Save an record
        e.preventDefault();
        var recId = $("tr.selected").attr("id");
        var tableId = $("tr.selected").attr("tableId");
        var canBeUpdate = true;
        var runInDataPostStr = false;
        var dataPostStr = "tableId=" + tableId + "&recId="+recId;
        // get only changed rows - idetified by attr("changed")
        $("tr.selected").children().each(function(columnIdx, td) {
            // in td
            var tdContent = $(td).html();
            if($(td).attr("type") !== undefined)
            {
                //find out it is an input / select or text val
                if(tdContent.startsWith("<")) // controls are <input or <select - not the best way search for an better way ...
                {
                    // control is still there                    
                    var elemName = $(td).attr("name");
                    var ctrlValue = $("#"+elemName).val();
                    if(($(td).attr("mandatory") === "true" || $(td).attr("mandatory") === "1") && ctrlValue === "" || ctrlValue === undefined)
                    {
                        new Info("Das Feld <u>" + elemName + "</u> ist obligatorisch!");
                        canBeUpdate = false;
                    }
                    else
                    {           
                        dataPostStr += "&"+elemName+"="+ctrlValue;
                        runInDataPostStr = true;
                    }                    
                }
            }
        });
        
        if(canBeUpdate && runInDataPostStr)
        {
            // no validation errors and dataPostStr is set = ready to update
            alert(dataPostStr);
        }
        else
        {
            new Info("Es wurde kein Datensatz zum Speichern bearbeitet!", { autoclose: 1500 });
        }
        
    });
    
    
    
    $("a#delete").click(function(e) 
    {        
        e.preventDefault();
        new Info("Sollen wirklich die selektierten Datensätze gelöscht werden?", 
        { 
            title: 'Datensätze löschen',
            buttons: [
                        {id: 0, label: 'OK', val: 'ok'},
                        {id: 1, label: 'Abbruch', val: '0'}
                     ],
            callback: function(val) 
            { 
                if(val === 'ok')
                {
                    // get all selected tr´s in every tr is the recId to delete
                    $("tr.selected").each(function() {
                        var tableId = $(this).attr("tableId");
                        var recId = $(this).attr("id");                        
                        if(tableId !== undefined && recId !== undefined)
                        {
                            // at this point we have a recId but no Information which table ...
                            // ajax request to an Gloabl Factory with TableId and RecId which is unique
                            alert("tableId="+tableId+"&recId="+recId);
                        }                        
                    });
                }
                else
                {
                    new Info("Vorgang abgebrochen!", { autoclose: 500 });
                }
            }
        });
    });
    
   
});

