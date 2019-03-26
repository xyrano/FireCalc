$(document).ready(function() {
    //$("div.progressAniDiv").hide();
    var selectedRecId = 0;
    var rowIsSelected = 0;
    var Obj;                // Cur Object
    var CUD_Url = "";       // URL 2 File for Creating, Updating or Deleting
    var Referrer_Url = "";  // URL 2 File which is automatically loaded after Ajax Request
    var DebugOn = false;    // Returns usefull Messages and don´t commit Data to CUD File
    var AdditionalParameter; // Additional Parameter
    
    
   
// Uncomment here if we want to init some things on window build
//    window.onload = init;
//    
//    function init() 
//    {
//        // initializations ...
//        
//    }
    
    /**
     * Provide the ability to Control an Manage data in Tables
     * @param {str} _object Current Object normally a table row which the Controls should be provided
     * @param {str} _url CUD File which is called to interact with DB
     * @param {boolean} _debugOn true if Debugging should be enabled
     * @returns {void}
     */ 
    $.fn.TT_InlineEdit = function(_object, _url, _debugOn, _additionalParam) {
        _debugOn = _debugOn || false; // set debugOn default to false if debugOn is null, 0 or undefined
        _additionalParam = _additionalParam || false; // Set Additional Parameter to false if no one was set
        
        Obj = _object;
        CUD_Url = _url;
        DebugOn = _debugOn;
        AdditionalParameter = _additionalParam;
        
        main();     
    }; 
    
   
        
    /**
     * Delete a Record (Delete in DB over CUD File)
     * @param {str} _url URL 2 CUD File
     * @param {str} _referrer URL who´s called when Request is completed
     * @param {boolean} _debugOn true if Debugged should be enabled
     * @returns {void}
     */    
    $.fn.TT_Delete = function(_url, _referrer, _debugOn) {
        _debugOn = _debugOn || false; // set debugOn default to false if debugOn is null, 0 or undefined
        CUD_Url = _url;
        Referrer_Url = _referrer;
        DebugOn = _debugOn;
        doDeleting();
    };
    
    /**
     * Update a Record (Update to DB over CUD File)
     * @param {str} _url URL 2 CUD File
     * @param {str} _referrer URL who´s called when Request is completed
     * @param {boolean} _debugOn true if Debugged should be enabled
     * @returns {void}
     */
    $.fn.TT_Update = function(_url, _referrer, _debugOn, _additionalParam) {
        _debugOn = _debugOn || false; // set debugOn default to false if debugOn is null, 0 or undefined
        _additionalParam = _additionalParam || false; // Set Additional Parameter to false if no one was set
        
        CUD_Url = _url;
        Referrer_Url = _referrer;
        DebugOn = _debugOn;
        AdditionalParameter = _additionalParam;
        
        doUpdate();
    };
    
    /**
     * Create a Record (Insert to DB over CUD File)
     * @param {str} _url URL 2 CUD File
     * @param {str} _referrer URL who´s called when Request is completed
     * @param {boolean} _debugOn true if Debugged should be enabled
     * @returns {void}
     */
    $.fn.TT_Create = function(_url, _referrer, _debugOn, _additionalParam) {
        _debugOn = _debugOn || false; // set debugOn default to false if debugOn is null, 0 or undefined
        _additionalParam = _additionalParam || false; // Set Additional Parameter to false if no one was set
        
        CUD_Url = _url;
        Referrer_Url = _referrer;
        DebugOn = _debugOn;
        AdditionalParameter = _additionalParam;
        
        doCreate();
    };
    
    /**
     * Provide controls in the New Form
     * @returns {void}
     */
    $.fn.TT_New = function(_debugOn) {
        _debugOn = _debugOn || false; // set debugOn default to false if debugOn is null, 0 or undefined
        DebugOn = _debugOn;
        CreateControls();
    };
    
    
    
    $("#searchInput").keyup(function () {
       //split the current value of searchInput
       var data = this.value.split(" ");
       //create a jquery object of the rows
       var jo = $("#fbody").find("tr");
       if (this.value === "") {
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
    
    
    
    function CreateControls() {
        // catch span´s inside an fieldset        
        //var countedSpans = $("span#Create").length;
        $("fieldset").find("span#Create").each(function(idx, span) {
            var type = $(span).attr("type");
            switchToControl(type, span);
        });
    }
    
    
    /**
     * Enter the row by DoubleClick - the select comes from selected selector, select an select makes a select selectable :-D
     */
    //$("tr.select").on("dblclick", function(e) 
    function main()
    {
        //$("div.progressAniDiv").show();
        //$("div.progressAniDiv").addClass("loading");
        var recId = $(Obj).attr("id");
        
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
                $(Obj).children().each(function(columnIdx, td) {
                    // get span inside an TD                    
                    var type = $(td).find("span").attr("type");
                    // Ggf. sind mehrere span´s in einer TD, dies muss berücksichtigt werden!!!
                    var countedSpans = $(td).find("span").length;
                    if(countedSpans > 1)
                    {
                        // TD case with more as 1 span objects
                        $(td).find("span").each(function(idx, span) {
                            var spanType = $(span).attr("type");
                            switchToControl(spanType, span);
                        });
                    }
                    else
                    {
                        // Normal TD case
                        if(type !== undefined)
                        {
                            // Switch to Control and provide it to an TD
                            // only to TD´s with type attr
                            switchToControl(type, td);
                        }
                    }
                });    
            }  
            //$("div.progressAniDiv").removeClass("loading");
            //$("div.progressAniDiv").hide();
        }
        else
        {
            // Row is per dblClick changed
            // remove all Controls - but values in TD´s are lost at Obj point - take care of it
            removeAllControls(selectedRecId);
            
            selectedRecId = recId;
            // now same logic as above
            // Loop through every td with an type attr
            $(Obj).children().each(function(columnIdx, td) {
                var type = $(td).find("span").attr("type");
                var countedSpans = $(td).find("span").length;
                if(countedSpans > 1)
                {
                    // TD case with more as 1 span objects
                    $(td).find("span").each(function(idx, span) {
                        var spanType = $(span).attr("type");
                        switchToControl(spanType, span);
                    });
                }
                else
                {
                    if(type !== undefined)
                    {
                        // Switch to Control and provide it to an TD
                        // only to TD´s with type attr
                        switchToControl(type, td);
                    }
                }
            });  
        } 
        // make some actions after creation
         $("#municipalId").chained("#districtId"); // Make always a chained select - between district (Landkreis) and municipal (Gemeinde)
    }//);
    
    
    
    
    
    
    
    
    function removeAllControls(selectedRecId) {
        // selectedRecId is the RecId from previous selected Row
        // loop thorugh each TD from previous row
        $("tr#"+selectedRecId).children().each(function(columnIdx, td) {
            var type = $(td).find("span").attr("type");
            var countedSpans = $(td).find("span").length;
            if(countedSpans > 1)
            {
                // TD case with more as 1 span objects
                $(td).find("span").each(function(idx, span) {
                    var spanType = $(span).attr("type");
                    switchToControl(spanType, span, true);
                });
            }
            else
            {
                if(type !== undefined)
                {
                    switchToControl(type, td, true); // Last param control to removes the Ctrl                
                }
            }
        });
    }
    
    /**
     * Decide which Control should be Provided by the type attr
     * @param {str} type The Type attr str
     * @param {Object} element The Element which is looped
     * @param {Boolean} getVal4Remove [optional] default =false  
     * @returns {null} no return
     */
    function switchToControl(type, element, getVal4Remove)
    {
        getVal4Remove = getVal4Remove || false; // set debugOn default to false if debugOn is null, 0 or undefined
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
                
            case 'file':
                if(getVal4Remove)
                {
                    
                }
                else
                {
                    prvdFileCtrl(element);
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
            var elemValue = $(element).html().trim();            
            var elemName = $(element).attr("name");
            var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";
            var elemSelectMultiple = ($(element).attr("enummultiple") === "true" || $(element).attr("enummultiple") === "1") ? "multiple" : "";
            var elemWidth = ($(element).width()+70);
                elemWidth = (elemWidth===70) ? 130 : elemWidth;
            var url2File = $(element).attr("enumData");           
            var options = loadEnumOptions(url2File);
            if(url2File !== undefined && options !== undefined)
            {
                $(element).html("");
                $(element).text("");
                $(element).append("<select " + elemSelectMultiple + " id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + "></select>");
                // If not mandatory provide an blank enum option
                if($(element).attr("mandatory") !== "true" || $(element).attr("mandatory") !== "1")
                {
                    $("select#"+elemName).append("<option value=\"-1\">---</option>");
                }
                $.each(options, function(i, identifier){
                    var selected = (elemValue === identifier.value || identifier.selected === true) ? "selected" : ""; // identifier comes from enum.php
                    var class4ChainedSel = (identifier.class) ? "class=" + identifier.class : ""; 
                    $("select#"+elemName).append("<option " + class4ChainedSel + " value=\""+ identifier.recId +"\" " + selected + ">"+ identifier.value +"</option>");
                });  
                if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
                {
                    $("select#"+elemName).addClass("mandatoryField");
                }
            }
            else
            {
                new Info("Enum <u>" + elemName + "</u> kann nicht geladen werden!");
            }   
        }
        else
        {
            var elemValue = $(element).find("span").html().trim();
            var elemName = $(element).find("span").attr("name");
            var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";
            var elemSelectMultiple = ($(element).find("span").attr("enummultiple") === "true" || $(element).find("span").attr("enummultiple") === "1") ? "multiple" : "";
            var url2File = $(element).find("span").attr("enumData");           
            var options = loadEnumOptions(url2File);
            if(url2File !== undefined && options !== undefined)
            {
                $(element).find("span").html("");
                $(element).find("span").text("");
                $(element).find("span").append("<select " + elemSelectMultiple + " id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + ($(element).width()+30) + "px;\" " + elemEditable + "></select>");
                // If not mandatory provide an blank enum option
                if($(element).attr("mandatory") !== "true" || $(element).attr("mandatory") !== "1")
                {
                    $("select#"+elemName).append("<option value=\"-1\">---</option>");
                }
                
//                if(elemSelectMultiple)
//                {
//                    // Bei einer Multiple Selection sind ggf. HTML Elemente vorhanden - diese müssen berücksichtigt werden!!!
//                    if($("ul", elemValue) || $("li", elemValue))
//                    {
//                        var multipleSelectedElements = new Array();
//                        $(elemValue).each(function(index) {
//                          multipleSelectedElements[index] = $(this).text(); 
//                        });
//                    }
//                }  
                
                // Durchlaufe die aus der Datei geladenen EnumElemente ...
                $.each(options, function(i, identifier){
                    if(elemSelectMultiple)
                    {
                        // Bei einer Multiple Selection sind ggf. HTML Elemente vorhanden - diese müssen berücksichtigt werden!!!
                        if($("ul",elemValue) || $("li", elemValue))
                        {
                            var selected = "";
                            $(elemValue).each(function() {
                                var val = $(this).text();
                                if(val === identifier.value) {
                                    selected = "selected";
                                } 
                            });                            
                        }
                    }
                    else
                    {
                        var selected = (elemValue === identifier.value) ? "selected" : "";
                    }
                    var class4ChainedSel = (identifier.class) ? "class=" + identifier.class : ""; 
                    $("select#"+elemName).append("<option " + class4ChainedSel + " value=\""+ identifier.recId +"\" " + selected + ">"+ identifier.value +"</option>");
                }); 
                
                // Gebe den Feld ein CSS Class zur Anzeige das es Obligatorisch ist
                if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
                {
                    $("select#"+elemName).addClass("mandatoryField");
                }
            }            
        }
    }
    
    function UrlExistsStatus(_url) {
        var http = new XMLHttpRequest();
        http.open("HEAD", _url, false);
        http.send();
        return http.status;
    }
    
    function prvdCheckboxCtrl(element) {
        validateCtrl(element);
        // A checkbox Control is alway a simple Yes/No Enum
        if(element.tagName === "SPAN")
        {
            var elemValue = $(element).html();
            var elemName = $(element).attr("name");
            var elemEditable = ($(element).attr("editable") === "false") ? "disabled" : "";
            var elemWidth = 50; //(Always 50) //($(element).width()+50);
            //    elemWidth = (elemWidth===50) ? 40 : elemWidth;
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
            var elemWidth = 50;
            $(element).find("span").html("");
            $(element).find("span").text("");
            var selectedNo = (elemValue === "Nein") ? "selected" : "";
            $(element).find("span").append("<select id=\"" + elemName + "\" name=\"" + elemName + "\" style=\"width: " + (elemWidth) + "px;\" " + elemEditable + "><option value=\"1\">Ja</option><option value=\"0\" " + selectedNo + ">Nein</option></select>");
            if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
            {
                $("select#"+elemName).addClass("mandatoryField");
            }
        }
    }
    
    
    // File Control
    function prvdFileCtrl(element) {
        validateCtrl(element);
        if(element.tagName === "SPAN")
        {
            var elemValue = $(element).html();
            var elemName = $(element).attr("name");
            var elemWidth = ($(element).width()+10);
            elemWidth = (elemWidth===10) ? 200 : elemWidth;
            var elemEditable = ($(element).attr("editable") === "false" || $(element).attr("editable") === "0") ? "disabled" : "";            
            $(element).html(""); // empty html
            $(element).text(""); // empty text
            $(element).empty();               
            $(element).append("<form enctype=\"multipart/form-data\"><input type=\"file\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + "></form>");
            if($(element).attr("mandatory") === "true" || $(element).attr("mandatory") === "1")
            {
                $("input#"+elemName).addClass("mandatoryField");
            }
        }
        else
        {
            var elemValue = $(element).find("span").html();
            var elemName = $(element).find("span").attr("name");
            var elemWidth = ($(element).find("span").width()+10);
            elemWidth = (elemWidth===10) ? 200 : elemWidth;
            var elemEditable = ($(element).find("span").attr("editable") === "false" || $(element).find("span").attr("editable") === "0") ? "disabled" : "";            
            $(element).find("span").html(""); // empty html
            $(element).find("span").text(""); // empty text
            $(element).find("span").empty();               
            $(element).find("span").append("<form enctype=\"multipart/form-data\"><input type=\"file\" id=\"" + elemName + "\" name=\"" + elemName + "\" value=\"" + elemValue + "\" style=\"width: " + elemWidth + "px;\" " + elemEditable + "></form>");
            if($(element).find("span").attr("mandatory") === "true" || $(element).find("span").attr("mandatory") === "1")
            {
                $("input#"+elemName).addClass("mandatoryField");
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
        var specialChars = "<>@#$%^*_+[]{}|'\"\\/~`="; // ; is out because of encodeUriComponent & => &amp; that would fail
        
        for(var i = 0; i < specialChars.length;i++)
        {
            if(str.indexOf(specialChars[i]) > -1)
            {
                return true;
            }
        }
        return false;                
    }
    
    
    function loadEnumOptions(url2File) {
        if(url2File === undefined || url2File === "")
        {
            new Info("Enum kann nicht aus Datei '<u>" + url2File + "</u>' geladen werden!");
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
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if(ajaxOptions === "parsererror")
                        new Info("Parse Error!<br>Message:[" + xhr.responseText+"]");
                    else
                        new Info("Error: Sorry but saving has returned a failure!\r\nStatus is: " + xhr.status + " Error: " + thrownError);
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
            return ret;            
        }
    }
    
    function escapeHtml(txt) {
//        return txt
//            .replace(/&/g, "&amp;")
//            .replace(/</g, "&lt;")
//            .replace(/>/g, "&gt;")
//            .replace(/"/g, "&quot;")
//            .replace(/'/g, "&#039;");
        //return escape(txt);
        return encodeURIComponent(txt);
    }
    
    function doCreate(isUpdate = false) {        
        var canBeUpdate = true;
        var runInDataPostStr = false;
        if(isUpdate)
        {
            var tableId = $("fieldset.selected").attr("tableId");
            var dataPostStr = "identifier=Update&tableId=" + tableId;
        }
        else
        {
            var tableId = $("fieldset").attr("tableId");
            var dataPostStr = "identifier=Create&tableId=" + tableId;
        }
        
        // If an Additional Parameter was set so send it
        // was created by Form MemberGroups member array
        if(AdditionalParameter)
        {
            dataPostStr += "&AddParam="+AdditionalParameter;
        }
        
        $("fieldset").find("span#Create").each(function(idx, span) 
        {            
            if($(span).find("input").length >= 1 || $(span).find("select").length >=1)
            {
                // Control is present
                var elemName = $(span).attr("name");
                var ctrlValue = $("#"+elemName).val();
                if(($(span).attr("mandatory") === "true" || $(span).attr("mandatory") === "1") && (ctrlValue === "" || ctrlValue === undefined || ctrlValue === null || ctrlValue === "-1"))
                {
                    new Info("Das Feld <u>" + elemName + "</u> ist obligatorisch und muss ausgefüllt werden!");
                    canBeUpdate = false;
                }
                else
                {           
                    dataPostStr += "&"+elemName+"="+escapeHtml(ctrlValue);
                    runInDataPostStr = true;
                } 
            }
        });
        
        if(canBeUpdate && runInDataPostStr)
        {
            // no validation errors and dataPostStr is set = ready to update            
            ajaxReq(dataPostStr);
        }
        else
        {
            new Info("Es wurde kein Datensatz zum Speichern bearbeitet!", { autoclose: 1300 });
        }
    }
    
    
    
    function doUpdate() {
        
        if($("fieldset.selected").attr("id") === "Update") 
        {
            doCreate(true);            
        } 
        else 
        {
        
            var recId = $("tr.selected").attr("id");
            var tableId = $("tr.selected").attr("tableId");
            var canBeUpdate = true;
            var runInDataPostStr = false;
            var dataPostStr = "identifier=Update&tableId=" + tableId + "&recId="+recId;

            // If an Additional Parameter was set so send it
            // was created by Form MemberGroups member array
            if(AdditionalParameter)
            {
                dataPostStr += "&AddParam="+AdditionalParameter;
            }

            // get only changed rows - idetified by attr("changed")
            $("tr.selected").children().each(function(columnIdx, td) {
                // in td
                var tdContent = $(td).find("span").html();
                var countedSpans = $(td).find("span").length;
                if(countedSpans > 1)
                {
                    // In an TD but the TD has more as one Span > Fields
                     // TD case with more as 1 span objects
                    $(td).find("span").each(function(idx, span) {
                        var spanType = $(span).attr("type");
                        if(spanType !== undefined)
                        {
                            if($(td).find("span").find("input").length >= 1 || $(td).find("span").find("select").length >=1)
                            {
                                // Control is present
                                var elemName = $(span).attr("name");
                                var ctrlValue = $("#"+elemName).val();
                                if( 
                                    ($(span).attr("mandatory") === "true" || $(span).attr("mandatory") === "1") 
                                    && (ctrlValue === "" || ctrlValue === undefined || ctrlValue === null || ctrlValue === "-1"))
                                {
                                    new Info("Das Feld <u>" + elemName + "</u> ist obligatorisch und muss ausgefüllt werden!");
                                    canBeUpdate = false;
                                }
                                else
                                {           
                                    dataPostStr += "&"+elemName+"="+escapeHtml(ctrlValue);
                                    runInDataPostStr = true;
                                } 
                            }
                        }
                    });
                }
                else
                {
                    // In an normal TD
                    if($(td).find("span").attr("type") !== undefined)
                    {                    
                        //find out it is an input / select or text val                    
                        //if(tdContent.startsWith("<") 
                        if(startsWithOwnFun(tdContent)
                                && (tdContent.substring(1, 6) === "input" || tdContent.substring(1, 7) === "select")) // controls are <input or <select - not the best way search for an better way ...
                        {
                            // control is still there                    
                            var elemName = $(td).find("span").attr("name");
                            var ctrlValue = $("#"+elemName).val();
                            if(
                                ($(td).find("span").attr("mandatory") === "true" || $(td).find("span").attr("mandatory") === "1") 
                                && (ctrlValue === "" || ctrlValue === undefined || ctrlValue === null || ctrlValue === "-1"))
                            {
                                new Info("Das Feld <u>" + elemName + "</u> ist obligatorisch und muss ausgefüllt werden!");
                                canBeUpdate = false;
                            }
                            else
                            {           
                                dataPostStr += "&"+elemName+"="+escapeHtml(ctrlValue);
                                runInDataPostStr = true;
                            }                    
                        }
                    }
                }
            });        
        
            // Own function because IE is obvisouly too stupid!
            function startsWithOwnFun(_element) {
                if(!String.prototype.startsWith) {
                    String.prototype.startsWith = function(search, pos) {
                        return this.substr(!pos || pos < 0 ? 0: +pos, search.length) === search;
                    };
                } else {
                    return _element.startsWith("<");
                }
            }

            if(canBeUpdate && runInDataPostStr)
            {
                // no validation errors and dataPostStr is set = ready to update                       
                ajaxReq(dataPostStr);            
            }
        }
    }
    
    
    
    
    
    
    function doDeleting() {
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
                    $("tr.selected").each(function(idx, tr) {
                        var tableId = $(tr).attr("tableId");
                        var recId = $(tr).attr("id");                        
                        if(tableId !== undefined && recId !== undefined)
                        {
                            // at Obj point we have a recId but no Information which table ...
                            // ajax request to an Gloabl Factory with TableId and RecId which is unique
                            //alert("identifier=delete&tableId="+tableId+"&recId="+recId);
                            //alert(CUD_Url.toString());
                            ajaxReq("identifier=delete&tableId="+tableId+"&recId="+recId);
                        }                        
                    });
                }
                else
                {
                    new Info("Vorgang abgebrochen!", { autoclose: 500 });
                }
            }
        });
    }
    
    
    
    function ajaxReq(data) 
    {
        if(DebugOn)
        {
            new Info("Debugging Session - Autocommit to DB is off!<br>PostetStr is:<br> " + data.split('&').join('&<br>'));
        }
        else
        {
            if(CUD_Url === undefined || CUD_Url === "")
            {
                CUD_Url = "./CUD.php";
            }
        
        
            $.ajax({
                type: "POST",
                url: CUD_Url,
                data: data,
                cache: false,
//                processData: false,
//                contentType: false,
                success: function(data) 
                { 
                    var jsonData = $.parseJSON(data); 
                    new Info(jsonData.journalMessage, { autoclose: 1000 });  
                    setTimeout(1000*4); // 4 seconds delay so the user can read hopefully the message ;-)
                    if(Referrer_Url !== undefined)
                    {
                        window.location.href = Referrer_Url;
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
    }
    
   
});

