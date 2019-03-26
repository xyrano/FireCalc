$body = $("body");

$(document).ready(function() {
  
    $("#tabs").tabs();
    
    $(document).on({
       ajaxStart: function() { $body.addClass("loading"); },
       ajaxStop: function() { $body.removeClass("loading"); }
    });
    
    var errorValueL1 = 0; // Fehlerpunkte Läufer 1
    var errorValueL2 = 0; // Fehlerpunkte Läufer 2
    var errorValueL3 = 0; // Fehlerpunkte Läufer 3
    var errorValueL4 = 0; // Fehlerpunkte Läufer 4
    var errorValueL5 = 0; // Fehlerpunkte Läufer 5
    var errorValueL6 = 0; // Fehlerpunkte Läufer 6
    var errorValueL7 = 0; // Fehlerpunkte Läufer 7
    var errorValueL8 = 0; // Fehlerpunkte Läufer 8
    var errorValueL9 = 0; // Fehlerpunkte Läufer 9
    
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
    
    // normal selectable error values 
    $("td.num").mousedown(function() {
       var errorValue = $(this).html();
       var errorId = $(this).attr('id');
       var errorNumCount = parseInt($("td#inCase-"+errorId).html());
       var clickMode = event.which; // 1 = left click, 2 = middle click, 3 = right click
       
       if(isNaN(errorNumCount))
       {
           errorNumCount = 0;
       }
       
       
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
        
        switch(parts[3]) // Identikator ob gruppenführer, Melder, etc.
        {
            // Läufer 1
            case 'L1':
                errorValueL1 = $('td#errorPointsL1').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL1 = parseInt(errorValueL1) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL1 > 0)
                {
                    errorValueL1 = parseInt(errorValueL1) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL1").html(errorValueL1);
                break;
            // Läufer 2
            case 'L2':
                errorValueL2 = $('td#errorPointsL2').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL2 = parseInt(errorValueL2) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL2 > 0)
                {
                    errorValueL2 = parseInt(errorValueL2) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL2").html(errorValueL2);
                break;    
            // Läufer 3
            case 'L3':
                errorValueL3 = $('td#errorPointsL3').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL3 = parseInt(errorValueL3) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL3 > 0)
                {
                    errorValueL3 = parseInt(errorValueL3) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL3").html(errorValueL3);
                break;       
            // Läufer 4
            case 'L4':
                errorValueL4 = $('td#errorPointsL4').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL4 = parseInt(errorValueL4) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL4 > 0)
                {
                    errorValueL4 = parseInt(errorValueL4) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL4").html(errorValueL4);
                break;
            // Läufer 5
            case 'L5':
                errorValueL5 = $('td#errorPointsL5').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL5 = parseInt(errorValueL5) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL5 > 0)
                {
                    errorValueL5 = parseInt(errorValueL5) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL5").html(errorValueL5);
                break;
            // Läufer 6
            case 'L6':
                errorValueL6 = $('td#errorPointsL6').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL6 = parseInt(errorValueL6) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL6 > 0)
                {
                    errorValueL6 = parseInt(errorValueL6) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL6").html(errorValueL6);
                break;
            // Läufer 7
            case 'L7':
                errorValueL7 = $('td#errorPointsL7').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL7 = parseInt(errorValueL7) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL7 > 0)
                {
                    errorValueL7 = parseInt(errorValueL7) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL7").html(errorValueL7);
                break;
            // Läufer 8
            case 'L8':
                errorValueL8 = $('td#errorPointsL8').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL8 = parseInt(errorValueL8) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL8 > 0)
                {
                    errorValueL8 = parseInt(errorValueL8) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL8").html(errorValueL8);
                break;
            // Läufer 1
            case 'L9':
                errorValueL9 = $('td#errorPointsL9').html();
                if(errorValueParts[0] === '+')
                {
                    errorValueL9 = parseInt(errorValueL9) + parseInt(errorValueParts[1]);
                }
                if(errorValueParts[0] === '-' && errorValueL9 > 0)
                {
                    errorValueL9 = parseInt(errorValueL9) - parseInt(errorValueParts[1]);
                }
                $("td#errorPointsL9").html(errorValueL9);
                break;
        }
    }
    
    
    
    
    function save(errorParts, errorValueParts, errorNumCount)
    {
        var contestId = $("span#contestId").text();
        var competitionType = "B-Teil"; // Fester Wert
        var groupRecId = errorParts[0];
        var errorNum = errorParts[1];
        var errorSubNum = errorParts[2];
        var indicator = ""; // indicator dosen´t exist in B-Teil!
        var who = errorParts[3];
                
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
                url: "./JsBPartSave.php",
                data: data,
                cache: false,
                success: function(data) 
                { 
                    var jsonData = $.parseJSON(data); 
                    new Info(jsonData.journalMessage, {  autoclose: 100 }); // http://messijs.github.io/MessiJS/demos/
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
    
    
    
    
    // Time
    $("input.time").focusout(function() {
        var htmlId = $(this).attr('id');     // e.g.: 10-ufh-gf
        var value = $("input#"+htmlId).val();
       
        if(value.length == 5)
        {
            // no seconds was sent because it´s :00
            var time = value + ":00";
        }
        else
        {
            var time = value;
        }
        // next code will be only executetd when regEx match pass the time 00:00:00
        var regEx = new RegExp('^([0-1]?[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$'); // Hour can be 0-19 or 20-23 - min are always 0-59
        if(regEx.test(time))
        {       
            var contestId = $("span#contestId").text();
            var parts = htmlId.split('-');       
            var groupRecId = parts[0];
            var competitionType = 'B-Teil'; // Fester Wert
            var indicator = parts[1]; // ufh o ow
            var who = parts[2];
       
            var data = "contestId=" + contestId + 
                "&groupRecId=" + groupRecId + 
                "&competitionType=" + competitionType + 
                "&indicator=" + indicator + 
                "&who=" + who + 
                "&value=" + time;
       
            $.ajax
            (
                {
                    type: "POST",
                    url: "./JsBPartSaveAdditions.php",
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
        }
    });
    
    
    
    // Eindruck
    $("div.impress").click(function() {
       var htmlId = $(this).attr('id');     // e.g.: 10-ufh-gf-3
       var value = $(this).text();
       var contestId = $("span#contestId").text();
       var parts = htmlId.split('-');
       var groupRecId = parts[0];
       var competitionType = "B-Teil"; // static string
       var indicator = parts[1];
       var who = parts[2];
       
       var data = "contestId=" + contestId + "&groupRecId=" + groupRecId + "&competitionType=" + competitionType + "&indicator=" + indicator + "&who=" + who + "&value=" + value;
       $(this).addClass("highlightErrorVal");
       
       $.ajax
        (
            {
                type: "POST",
                url: "./JsBPartSaveImpressions.php",
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
                        var competitionType = 'B-Teil'; // Fester Wert
                        var indicator = parts[1]; // BP
                        var contestId = parts[3];
                        
                        var data = "contestId="+contestId+"&competitionType="+competitionType+"&groupRecId="+groupRecId+"&indicator="+indicator;
                        
                        // set disqualified in DB to yes/1
                        $.ajax
                        (
                            {
                                type: "POST",
                                url: "./JsBPartDisqualified.php",
                                data: data,
                                cache: false,
                                success: function(data) 
                                { 
                                    var jsonData = $.parseJSON(data); 
                                    new Info(jsonData.journalMessage, { autoclose: (1000) });
                                    setTimeout(function() {
                                        window.location.href = "BPartForm.php?idx=" + getUrlParameter("idx");
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
                           }
                        );
                    }
                }
            });
        }
    });
    
});


