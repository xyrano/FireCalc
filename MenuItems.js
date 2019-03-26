$(document).ready(function() {
    var location = window.location.hostname + "/ffab/Main";
    var idx         = $('div#idx').text();  // gloabal functionality for reports or forms 
    
    var windowHeight = 450;
    var windowWidth = 750;
    var windowX = 900; // seems to be buggy ?!
    var windowY = 300;
               

    
    // Immitate here a clickable row logic to get into the selection for buttons or other logic
    /* Select a row <b>SINGLE SELECT</b>    
     * Or Select multiple line by holding the ctrl Key
     */
    $("tr.select").click(function(event)
    {       
        var eventObj = window.event ? window.event : event; // because FireFox is too stupid
        if(eventObj.ctrlKey)
        {
            // Multi Select with ctrl Key
            $(this).addClass("selected");
            if($(this).is(":nth-child(odd)"))
            {
                $(this).css("background-color", "#eaaf51");
            }
        }
        else
        {
            // Single Select
            
            // Selektierte Zeile bekommt die Klasse "selected" und damit "Farbe"
            // ausserdem werden aus allen anderen Zeilen die Klasse herausgenommen - somit verlieren diese Zeilen die "Farbe"
            // zudem wird ebenfalls an allen Zeilen die Hintergrund farbe auf "0" gesetzt, da evtl. eine nth-child Klasse angesprochen wurde s.u.
            $(this).addClass("selected").siblings().removeClass("selected").css("background-color","");//.removeClass(":nth-child(odd)");

            // Wenn eine Zeile einer nth-child Klasse geklickt wurde wird die Farbe durch hinzufügen einer selected klasse nicht überschrieben
            // dies funktioniert mit der Hintergrundfarbe, die wird hier gesetzt sofern es eine nth-child Klasse ist.
            // in der obrigen Funktion wird diese falls gesetzt an allen Zeilen wird zurückgesetzt
            if($(this).is(":nth-child(odd)"))
            {
                $(this).css("background-color", "#eaaf51");
            }
        }
    });
    
    
    
    
    
   
    
    
        
    function openWindow(pathTo, windowTitle) {        
        if(pathTo && windowTitle)
        {                      
            // absolute path
            $.getJSON("/ffab/getWindowProperties.php?windowTitle=" + windowTitle, function(data) 
            {
                $.each(data, function(i, item)
                {                  
                    switch(item.field)
                    {                          
                        case 'windowHeight':
                            if(item.value > 0)
                                windowHeight = item.value;
                            break;

                        case 'windowWidth':
                            if(item.value > 0)
                                windowWidth = item.value;
                            break;

                        case 'windowX':
                            if(item.value > 0)
                                windowX = item.value;
                            break;

                        case 'windowY':
                            if(item.value > 0)
                                windowY = item.value;
                            break;                          
                    }                
                });
            })//.success(function(jqXHR, textStatus, errorThrown) { alert("second success"+ textStatus + " | " + jqXHR.responseText); })
            .error(function(jqXHR, textStatus, errorThrown) { alert("error" + textStatus + " | " + jqXHR.responseText); })//;
            .complete(function(jqXHR, textStatus, errorThrown) 
            { 
                var properties = 'width=' + windowWidth + ', height=' + windowHeight + ', top=' + windowY + ', left=' + windowX + ', directories=0, location=0, resizable=0, menubar=0, toolbar=0, scrollbars=1, status=0, titlebar=0';
                window.open(pathTo, windowTitle, properties, 'false');
            });     
        }
    }
    
    
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
    
    // Comes from F1 key
    $("body").keydown(function(e) {
        if(e.which === 112) // F1 key (help)
        {
            e.preventDefault();
            helpFileConstruct();
        }
    });
    
    // Comes from Form link
    $("a#help").click(function(ev) {
        ev.preventDefault();
        helpFileConstruct();
    });    
    
    function helpFileConstruct() {
        
        var windowLocation = window.location.href;
        var ret = windowLocation.split('.php'); 
        var helpFileUrl = ret[0];
        var actionStr = getUrlParameter("do");
        
        switch(actionStr) {
            case 'start':
                helpFileUrl = helpFileUrl + ".HelpOverview.php";
                break;
            case 'new':
                helpFileUrl = helpFileUrl + ".HelpNew.php";
                break;
            case 'edit':
                helpFileUrl = helpFileUrl + ".HelpEdit.php";
                break;
            case 'delete':
                helpFileUrl = helpFileUrl + ".HelpDelete.php";
                break;
            default:
                helpFileUrl = helpFileUrl + ".HelpOverview.php";
                actionStr = "default";
                break;
        }
        
       checkHelpFile(helpFileUrl, actionStr, windowLocation);
    }
    
    function checkHelpFile(helpFileUrl, actionStr, windowLocation) {
        var windowTitle = $(document).attr('title');     
        
        $.ajax({
            //type: 'HEAD',
            url: helpFileUrl,
            success: function(helpFileContent, status, xhr) {
                
                new Info("<div style='overflow-y: scroll; overflow-x: scroll; height: 300px;'>" + helpFileContent + "</div>", { title: "Hilfe - " + windowTitle, buttons: [ {id:0, label: "Schlie&szlig;en", val: 'x'} ] });
            },  
            error: function() {
                var helpFileTxt = "Es konnte kein Hilfedokument gefunden werden!";
                new Info("<b>Location: " + windowLocation + "</b>\n\
              <br><b>HelpFile: " + helpFileUrl + "</b>\n\
              <br><b>Parameter: " + actionStr + "</b>\n\
              <br><i>->" + helpFileTxt + "</i>", { title: "Hilfe - " + windowTitle, buttons: [ {id:0, label: "Schlie&szlig;en", val: 'x'} ] });
            }
        });
    }
    
    $("a#FormOptions").click(function(ev) {
        ev.preventDefault();
        createFormOptionsDialog();
    });  
      
    function createFormOptionsDialog() {
        var recId = $("tr.selected").attr('id'); 
        var tableId = $("tr.selected").attr("tableId");
        if(recId === "" || recId === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 } );
        }
        else
        {
            $.ajax({
                url: "http://localhost/ffab/FormOptionsDialog.php?TableId="+tableId+"&RecId="+recId,
                success: function(formOptionsDialogContent, status, xhr) {
                    new Info("<div style='overflow-y: scroll; overflow-x: hidden; height: 200px;'>" + formOptionsDialogContent + "</div>", { title: "Eigenschaften", buttons: [ { id:0, label: "Schlie&szlig;en", val: 'x' } ] });
                }
            })
            
        }
    }  
      
 
    
    
    
    
    
    // Benutzer aufnehmen
    $('a#addUser').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/UserManagement/AddUserForm.php";  
        openWindow(pathTo, "User");
    });
    
    
    // KJF Group aufnehmen
    $('a#addKJFGroups').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/KJFGroups/AddGroupForm.php";        
        openWindow(pathTo, "KJFGroups");               
    });
    
    
    // Einstellungen    
    $('a#adminSetup').click(function(ev){
        ev.preventDefault();        
        var pathTo = "http://" + location + "/AdminSetup/AddAdminSetupForm.php";                    
        openWindow(pathTo, "AdminSetup");      
    });
    
    
    
    // Stammdaten Landkreis
    $('a#addDistrict').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/District/AddDistrictForm.php";            
        openWindow(pathTo, "District");  
    });
    
    // Stammdaten Gemeinden
    $('a#masterDataMunicipality').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/Municipal/AddMunicipalForm.php";            
        openWindow(pathTo, "Municipal");  
    });
    
    // Stammdaten Feuerwehren
    $('a#masterDataFireDepartments').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/FireDept/AddFireDeptForm.php";            
        openWindow(pathTo, "FireDepartments");  
    });
    
     // Bundeswettbewerbe
    $('a#contest').click(function(ev){
        ev.preventDefault();
        var pathTo = "http://" + location + "/Contest/AddContestForm.php";            
        openWindow(pathTo, "Contest");  
    });
    
    
    // Feuerwehren [button in AddContestForm]
    $('input#FireDept2Contest').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/FireDept2Contest/AddFireDept2ContestForm.php?idx=" + id;              
            openWindow(pathTo, "FireDept2Contest");  
        }
    });
    
    
    // Gruppen [button in AddContestForm]
    $('input#MemberGroups').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
             // maybe we came from MemberGroupsChooser we get the id over the select
            id = $("select#contestId").val();                        
        }
        
        if(id === "" || id === undefined) 
        {
           new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/MemberGroups/AddMemberGroupsForm.php?idx=" + id;  
            openWindow(pathTo, "MemberGroups");  
        }        
    });
    
    
    // Member [button in AddMemberGroupsForm]
    $('input#Member').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
             // maybe we came from MemberGroupsChooser we get the id over the select
            id = $("select#contestId").val();                        
        }
        
        if(id === "" || id === undefined) 
        {
           new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/Member/Member.php?idx=" + id;  
            openWindow(pathTo, "Member");  
        }        
    });
    
    
    // Gruppenverwaltung link vom dashboard
    $("a#MemberGroups").click(function(ev) {
        ev.preventDefault();
        // Before it can be opened we have to choose which Contest associated to the Groups
        // assigned into a new Form        
        var pathTo = "http://" + location + "/MemberGroups/AddMemberGroupsFormChooser.php";  
        openWindow(pathTo, "MemberGroupsChoose"); 
    });
    
    
    
    // A-Teil [button in AddContestForm]
    $('input#APart').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/A-Part/APartForm.php?idx=" + id;  
            openWindow(pathTo, "APart");  
        }
    });
    
    
    
    // B-Teil [button in AddContestForm]
    $('input#BPart').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/B-Part/BPartForm.php?idx=" + id;  
            openWindow(pathTo, "BPart");  
        }
    });
    
    
    // Auswertung ... [button in AddContestForm]
    $('input#Evaluation').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            new Info("Die Tempor&auml;re Auswertungsberechnung kann sehr lange dauern.<br>\n\
                    Soll diese jetzt ausgeführt werden?<br>\n\
                    Das sich &ouml;ffnende Fenster kann bei der Berechnung geschlossen werden, es werden keine Daten gespeichert!", 
            { 
                title: 'Tempor&auml;re Auswertungsberechnung',
                buttons: [
                            {id: 0, label: 'OK', val: 'ok'},
                            {id: 1, label: 'Abbruch', val: '0'}
                         ],
                callback: function(val) 
                { 
                    if(val === 'ok')
                    {
                        var pathTo = "http://" + location + "/Evaluation/EvaluationForm.php?idx=" + id;  
                        openWindow(pathTo, "Evaluation"); 
                    }
                    else
                    {
                        new Info("Vorgang abgebrochen!", { autoclose: 500 });
                    }
                }
            });             
        }
    });
    
    
    
    
    // Mitlgiederverwaltung [button in AddContestForm] and [dashboard]
    $('#MemberManagement').click(function(ev){      // only Id because of source from input and/or anchor 
        ev.preventDefault();
        var pathTo = "http://" + location + "/MemberManagement/AddMemberForm.php?page=0";  // page=0 to indicate that is with pagination
        openWindow(pathTo, "MemberManagement");       
    });
    
    
    // Mitglieder Export [button in AddMemberForm]
    $('input#MemberExport').click(function(ev){     
        ev.preventDefault();
        var pathTo = "http://" + location + "/MemberManagement/MemberExport.php";  
        openWindow(pathTo, "MemberExport");      
    });
    
    // Mitglieder Import [button in AddMemberForm]
    $('input#MemberImport').click(function(ev){     
        ev.preventDefault();
        var pathTo = "http://" + location + "/MemberManagement/MemberImport.php";  
        openWindow(pathTo, "MemberImport");               
    });
    
    
    // Anmeldebogen
    $('#RegistrationForm').click(function(ev){       
        ev.preventDefault();
        var pathTo = "http://" + location + "/RegistrationForm/RegistrationForm.php";  
        openWindow(pathTo, "RegistrationForm");       
    });
    
    
    // KJF Gruppen Unterschriften / KjfGroupSignatures
    $('input#KjfGroupSignatures').click(function(ev){
        ev.preventDefault();
        var id = $("tr.selected").attr('id');   
        if(id === "" || id === undefined) 
        {
            new Info("Kein Datensatz selektiert!", { autoclose: 1000 });
        }
        else
        {
            var pathTo = "http://" + location + "/KJFGroupSignatures/SignatureMgmt.php?idx=" + id;  
            openWindow(pathTo, "SignatureMgmt");  
        }
    });
    
    
    
    // Delete Post from BugBox
    $('#deletePost').click(function(ev){       
        ev.preventDefault();
        var pathTo = "http://" + location + "/RegistrationForm/RegistrationForm.php";  
        alert("asdasd");
        //openWindow(pathTo, "RegistrationForm");       
    });
    
    
    // Buchen ... [button in Evaluation]
    $('input#EvaluationEnd').click(function(ev){     
        ev.preventDefault();
        // Contest Idx => RecId From Contest
        var idx = getUrlParameter("idx"); // get IDX from Form before because we have no selected tr at this point
        if(idx === "" || idx === undefined) 
        {
            new Info("Formularaufruf nicht möglich!");
        }
        else
        {
            var pathTo = "http://" + location + "/EvaluationEnd/EvaluationEnd.php?idx=" + idx;  
            openWindow(pathTo, "Auswertung Ende");      
        }
    });
    
    
    /// REPORTS 
    
    // Siegerliste [button in Evaluation]
    $('input#RepWinnerListShort').click(function(ev){     
        ev.preventDefault();
        // Contest Idx => RecId From Contest
        var idx = getUrlParameter("idx"); // get IDX from Form before because we have no selected tr at this point
        if(idx === "" || idx === undefined) 
        {
            new Info("Reportaufruf nicht möglich!");
        }
        else
        {                         
            new Info("Wenn noch keine Feuerwehr Ausgewertet wurde (Buchen) dann kann kein Report generiert werden!<br><br>Sortierung: Aufsteigend!", 
            { 
                title: 'Möglichkeiten',               
                buttons: [
                            {id: 0, label: 'Kurz (ohne Punkte)', val: 'short'},
                            {id: 1, label: 'Lang (mit Punkte)', val: 'long'},
                            {id: 2, label: 'Abbruch', val: '0'}
                         ],
                callback: function(val) 
                {            
                    if(val === 'short')
                    {
                        var pathTo = "http://" + location + "/Evaluation/RepWinnerListShort.php?idx=" + idx + "&listType=short";                          
                    }
                    else if(val === 'long')
                    {
                        var pathTo = "http://" + location + "/Evaluation/RepWinnerListShort.php?idx=" + idx + "&listType=long"; 
                    }
                    
                    if(val !== '0')
                    {
                        openWindow(pathTo, "Evaluation WinList");
                        //alert(pathTo);
                    }
                }
            });
        }
    });
    
    
    // Urkunden [button in Evaluation]
    $('input#RepWinnersCertificate').click(function(ev){     
        ev.preventDefault();
        // Contest Idx => RecId From Contest
        var idx = getUrlParameter("idx"); // get IDX from Form before because we have no selected tr at this point
        if(idx === "" || idx === undefined) 
        {
            new Info("Reportaufruf nicht möglich!");
        }
        else
        {                         
            new Info("Wenn noch keine Feuerwehr Ausgewertet wurde (Buchen) dann kann kein Report generiert werden!<br><br>Sortierung: Aufsteigend!", 
            { 
                title: 'Möglichkeiten',               
                buttons: [
                            {id: 0, label: 'Urkunden', val: 'short'},
                            {id: 1, label: 'Abbruch', val: '0'}
                         ],
                callback: function(val) 
                {            
                    if(val === 'short')
                    {
                        var pathTo = "http://" + location + "/Evaluation/RepWinnersCertificate.php?idx=" + idx + "&listType=short";                          
                    }
                  
                    
                    if(val !== '0')
                    {
                        openWindow(pathTo, "Evaluation WinnersCertificate");
                        //alert(pathTo);
                    }
                }
            });
        }
    });
    
    
    // Fehlerbogen [button in Evaluation]
    $('input#RepErrorReport').click(function(ev){     
        ev.preventDefault();
        // Contest Idx => RecId From Contest
        var idx = getUrlParameter("idx"); // get IDX from Form before because we have no selected tr at this point
        if(idx === "" || idx === undefined) 
        {
            new Info("Reportaufruf nicht möglich!");
        }
        else
        {                         
            new Info("Wenn noch keine Feuerwehr Ausgewertet wurde (Buchen) dann kann kein Report generiert werden!<br><br>Sortierung: Aufsteigend!", 
            { 
                title: 'Möglichkeiten',               
                buttons: [
                            {id: 0, label: 'Fehlerbogen (mit Details)', val: 'withDetails'},
                            {id: 1, label: 'Fehlerbogen (ohne Details)', val: 'withoutDetails'},
                            {id: 2, label: 'Abbruch', val: '0'}
                         ],
                callback: function(val) 
                {            
                    if(val === 'withDetails')
                    {
                        var pathTo = "http://" + location + "/Evaluation/RepErrorReport.php?idx=" + idx + "&listType=long";                          
                    }
                  
                    if(val === 'withoutDetails')
                    {
                        var pathTo = "http://" + location + "/Evaluation/RepErrorReport.php?idx=" + idx + "&listType=short";                          
                    }
                    
                    if(val !== '0')
                    {
                        openWindow(pathTo, "Evaluation WinnersCertificate");
                        //alert(pathTo);
                    }
                }
            });
        }
    });
    
    
});

