$body = $("body");

$(document).ready(function() {
  
    $("#tabs").tabs();
  
    var errorValueGF = 0; // Fehlerpunkte Gruppenführer
    var errorValueME = 0; // Fehlerpunkte Melder
    var errorValueMA = 0; // Fehlerpunkte Maschinist
    var errorValueATF = 0; // Fehlerpunkte Angriffstruppführer
    var errorValueAT = 0; // Fehlerpunkte Agriffstrupp
    var errorValueATM = 0; // Fehlerpunkte Angriffstruppmann
    var errorValueWTF = 0; // Fehlerpunkte Wassertruppführer
    var errorValueWT = 0; // Fehlerpunkte Wassertrupp
    var errorValueWTM = 0; // Fehlerpunkte Wassertruppmann
    var errorValueSTF = 0; // Fehlerpunkte Schlauchtruppführer
    var errorValueST = 0; // Fehlerpunkte Schlauchtrupp
    var errorValueSTM = 0; // Fehlerpunkte Schlauchtruppmann
  
  
    $("td.disabledElem").removeAttr("id");
    
    // normal selectable error values 
    $("td.num").mousedown(function() {
       var errorValue = $(this).html();
       var errorId = $(this).attr('id');
       if(errorId === "" || errorId === undefined)
       {
           new Info("Die Auswertung ist breits für die Gruppe beendet, daher ist keine Änderung mehr möglich!");
       }
       else
       {
        var errorNumCount = parseInt($("td#inCase-"+errorId).html());
        var clickMode = event.which; // 1 = left click, 2 = middle click, 3 = right click

        if(isNaN(errorNumCount))
        {
            errorNumCount = 0;
        }
        //var errorRecId = $(this).attr("errorRecId");
        //var groupRecId = getUrlParameter("idx");

        var selected = $(this).hasClass("highlightErrorVal");

        // Wenn das Element noch keine Klasse "highlightErrorVal" oder die Fehleranzahl größer gleich 1 ist UND ein Links click ausgeführt wurde markiere den Fehler
        if((!selected || errorNumCount >= 1) && clickMode == 1)
        {
             $(this).addClass("highlightErrorVal");
             //alert("+" + errorValue + " " + errorId);             
             // Zähle die Fehleranzhal um 1 hoch (nur wenn ein entsprechendes Feld existiert)
             errorNumCount = errorNumCount + 1;
             $("td#inCase-"+errorId).html(errorNumCount);
             // Zähle Fehlernummern in DB und HTML
             countErrors(errorId, "+|"+errorValue, errorNumCount);
        }
        else
        {            
             // Entferne die Fehlermarkierung
             $(this).removeClass("highlightErrorVal");           
             //alert("-" + errorValue + " " + errorId);   
             // Wenn Rechtsclick erfolgt und die Fehleranzahl größer null ist verringere die Fehleranzahl um 1
             if(clickMode == 3 && errorNumCount > 0)
             {
                 errorNumCount = errorNumCount - 1;
                 $("td#inCase-"+errorId).html(errorNumCount);
             }

             // Wenn noch Fehler vorhanden sind belasse den Fehler als markiert
             if(errorNumCount > 0)
             {
                 $(this).addClass("highlightErrorVal");
             }

              // Zähle Fehlernummern in DB und HTML
             countErrors(errorId, "-|"+errorValue, errorNumCount);

        }  
    }
    }).contextmenu(function() {  // Contextmenu für diese Felder ausschalten
        return false;
    });


    function countErrors(errorId, errorValue, errorNumCount)
    {
        // errorId example '9-12-2-ufh-gf'
        // 9 = TruppId
        // 12 = FehlerNummer
        // 2 = FehlerNummer zusatz
        // ufh = Unterflurhydrant (Wettbewerbsart)
        // gf = gruppenführer (Identikator)
        var parts = errorId.split('-');
        var errorValueParts = errorValue.split('|');
        
        save(parts, errorValueParts, errorNumCount);
        
        switch(parts[4]) // Identikator ob gruppenführer, Melder, etc.
        {
            // Gruppenführer
            case 'gf':
                errorValueGF = $('td#errorPointsGF').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueGF = parseInt(errorValueGF) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueGF > 0)
                {
                    errorValueGF = parseInt(errorValueGF) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsGF").html(errorValueGF);
                break;
                
            // Melder
            case 'me':
                errorValueME = $('td#errorPointsME').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueME = parseInt(errorValueME) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueME > 0)
                {
                    errorValueME = parseInt(errorValueME) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsME").html(errorValueME);
                break;
              
            // Maschinist
            case 'ma':
                errorValueMA = $('td#errorPointsMA').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueMA = parseInt(errorValueMA) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueMA > 0)
                {
                    errorValueMA = parseInt(errorValueMA) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsMA").html(errorValueMA);
                break;   
            
            // Angriffstrupp
            case 'atf':
                errorValueATF = $('td#errorPointsATF').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueATF = parseInt(errorValueATF) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueATF > 0)
                {
                    errorValueATF = parseInt(errorValueATF) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsATF").html(errorValueATF);
                break;   
            
            case 'at':
                errorValueAT = $('td#errorPointsAT').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueAT = parseInt(errorValueAT) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueAT > 0)
                {
                    errorValueAT = parseInt(errorValueAT) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsAT").html(errorValueAT);
                break;   
                
            case 'atm':
                errorValueATM = $('td#errorPointsATM').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueATM = parseInt(errorValueATM) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueATM > 0)
                {
                    errorValueATM = parseInt(errorValueATM) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsATM").html(errorValueATM);
                break; 
             
            // Wassertrupp
            case 'wtf':
                errorValueWTF = $('td#errorPointsWTF').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueWTF = parseInt(errorValueWTF) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueWTF > 0)
                {
                    errorValueWTF = parseInt(errorValueWTF) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsWTF").html(errorValueWTF);
                break;   
            
            case 'wt':
                errorValueWT = $('td#errorPointsWT').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueWT = parseInt(errorValueWT) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueWT > 0)
                {
                    errorValueWT = parseInt(errorValueWT) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsWT").html(errorValueWT);
                break;   
                
            case 'wtm':
                errorValueWTM = $('td#errorPointsWTM').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueWTM = parseInt(errorValueWTM) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueWTM > 0)
                {
                    errorValueWTM = parseInt(errorValueWTM) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsWTM").html(errorValueWTM);
                break; 
                
            // Schlauchtrupp
            case 'stf':
                errorValueSTF = $('td#errorPointsSTF').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueSTF = parseInt(errorValueSTF) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueSTF > 0)
                {
                    errorValueSTF = parseInt(errorValueSTF) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsSTF").html(errorValueSTF);
                break;   
            
            case 'st':
                errorValueST = $('td#errorPointsST').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueST = parseInt(errorValueST) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueST > 0)
                {
                    errorValueST = parseInt(errorValueST) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsST").html(errorValueST);
                break;   
                
            case 'stm':
                errorValueSTM = $('td#errorPointsSTM').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueSTM = parseInt(errorValueSTM) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueSTM > 0)
                {
                    errorValueSTM = parseInt(errorValueSTM) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsSTM").html(errorValueSTM);
                break;                 
        }
    }
    
    
    
    $(document).on({
       ajaxStart: function() { $body.addClass("loading"); },
       ajaxStop: function() { $body.removeClass("loading"); }
    });
    
    
    function save(errorParts, errorValueParts, errorNumCount)
    {
        var contestId = $("span#contestId").text();
        var competitionType = "A-Teil"; // Fester Wert        
        var groupRecId = errorParts[0];
        var errorNum = errorParts[1];
        var errorSubNum = errorParts[2];
        var indicator = errorParts[3];
        var who = errorParts[4];
                
        var countingType = errorValueParts[0];
        if(countingType === '+')
        {
            countingType = "add";
        }
        else
        {
            countingType = "sub";
        }
        var errorValue = errorValueParts[1];
        
        var data = "contestId=" + contestId +
                "&competitionType=" + competitionType + 
                "&groupRecId=" + groupRecId + 
                "&errorNum=" + errorNum + 
                "&errorSubNum=" + errorSubNum + 
                "&errorValue=" + errorValue + 
                "&who=" + who + 
                "&indicator=" + indicator +
                "&countingType=" + countingType + 
                "&errorNumCount=" + errorNumCount;
        
        $.ajax
        (
            {
                type: "POST",
                url: "./JsAPartSave.php",
                data: data,
                cache: false,
                success: function(data) 
                { 
                    var jsonData = $.parseJSON(data); 
                    new Info(jsonData.journalMessage, { autoclose: 100 });
                    //setTimeout(function() {
                    //    window.location.href = "AddContestForm.php?do=new";
                    //}, 1000);

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
           }
        );   
    } // save brace
    
    
    
    //$("input.time").on('change keyup paste', function() {
    $("input.time").focusout(function() {
        var htmlId = $(this).attr('id');     // e.g.: 10-ufh-gf
        var value = $("input#"+htmlId).val();
       
        // next code will be only executetd when regEx match pass the time 00:00:00
        var regEx = new RegExp('^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$'); // Hour can be 0-19 or 20-23 - min are always 0-59
        if(regEx.test(value))
        {       
            var contestId = $("span#contestId").text();
            var parts = htmlId.split('-');       
            var groupRecId = parts[0];
            var competitionType = 'A-Teil'; // Fester Wert
            var indicator = parts[1]; // ufh o ow
            var who = parts[2];
       
            var data = "contestId="+ contestId + 
                "&groupRecId=" + groupRecId + 
                "&competitionType=" + competitionType + 
                "&indicator=" + indicator + 
                "&who=" + who + 
                "&value=" + value;
       
            $.ajax
            (
                {
                    type: "POST",
                    url: "./JsAPartSaveAdditions.php",
                    data: data,
                    cache: false,
                    success: function(data) 
                    { 
                        var jsonData = $.parseJSON(data); 
                        if(jsonData.ExceptionThrown === true)
                        {
                            new Info(jsonData.journalMessage);
                        }
                        else
                        {
                            new Info(jsonData.journalMessage, { autoclose: 100 });
                        }
                        //setTimeout(function() {
                        //    window.location.href = "AddContestForm.php?do=new";
                        //}, 1000);

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
               }
            );    
        }
    });
    
    
    
    // Eindruck
    $("div.impress").click(function() {
       var htmlId = $(this).attr('id');     // e.g.: 10-ufh-gf-3
       var value = $(this).text();
       var parts = htmlId.split('-');
       var contestId = $("span#contestId").text();
       var groupRecId = parts[0];
       var competitionType = "A-Teil"; // static string
       var indicator = parts[1];
       var who = parts[2];
       
       var data = "contestId=" + contestId + "&groupRecId=" + groupRecId + "&competitionType=" + competitionType + "&indicator=" + indicator + "&who=" + who + "&value=" + value;
       $(this).addClass("highlightErrorVal");
       
       // TODO: DeHighlight all other div.impress first, then highlight this
       
       $.ajax
        (
            {
                type: "POST",
                url: "./JsAPartSaveImpressions.php",
                data: data,
                cache: false,
                success: function(data) 
                { 
                    var jsonData = $.parseJSON(data); 
                    new Info(jsonData.journalMessage, { autoclose: 100 });
                    //setTimeout(function() {
                    //    window.location.href = "AddContestForm.php?do=new";
                    //}, 1000);

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
           }
        );
    });
    
    
    $("input.disqualified").click(function() {
        if($("input.disqualified").prop("checked", true))
        {
            new Info("Die Gruppe wird Disqualifiziert, wollen Sie wirklich fortfahren?<br>Die Gruppe erhält in der Wertung 0 Punkte!", 
            { 
                title: "Gruppendisqualifizierung", 
                buttons: [ {id:0, label: "Nein", val: '0'}, {id:1, label:"Disqualifizieren", val:'yes'} ],
                callback: function(val) 
                { 
                    if(val === 'yes')
                    {
                        //[0] = 'disqualified'; [1] = indicator (ow, ufh); [2] = groupRecId; [3] = contestId;
                        var htmlId = $('input.disqualified').attr("id");                        
                        var parts = htmlId.split('-');       
                        var groupRecId = parts[2];
                        var competitionType = 'A-Teil'; // Fester Wert
                        var indicator = parts[1]; // ufh o ow
                        var contestId = parts[3];
                        
                        var data = "contestId="+contestId+"&competitionType="+competitionType+"&groupRecId="+groupRecId+"&indicator="+indicator;
                        
                        // set disqualified in DB to yes/1
                        $.ajax
                        (
                            {
                                type: "POST",
                                url: "./JsAPartDisqualified.php",
                                data: data,
                                cache: false,
                                success: function(data) 
                                { 
                                    var jsonData = $.parseJSON(data); 
                                    new Info(jsonData.journalMessage, { autoclose: (1000) });
                                    //setTimeout(function() {
                                    //    window.location.href = "AddContestForm.php?do=new";
                                    //}, 1000);

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
                           }
                        );
                    }
                }
            });
        }
    });
    
});