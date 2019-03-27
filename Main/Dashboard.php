
<?php
require_once("../Factory.php");
require_once("../Functions.php");
if(!isset($_SESSION))
{
    session_start();
}

try
{
    AdminSetup::initValuesFirstTime();

    $userSession = new UserSession();
    $userSession->updateTime();
}
catch(Exception $ex)
{
    Obj::getException($ex);
    exit;
}


if(@$_SESSION[SysConstants::sysLoggedIn] != 1)
{
    exit;
}

$isOnline = isOnline();
if($isOnline)
{
    ?>
    <script src="https://code.jquery.com/jquery-latest.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?php
}
else
{        
    ?>
    <script src="../jquery-3.2.1.min.js"></script>
    <script src="../jquery-ui-1.11.4.js"></script>
    <?php
}
?>
    <link rel="stylesheet" type="text/css" href="../messi.min.css" />    
    
<script src="../MenuItems.js"></script>
<script src="../messi.min.js"></script>


<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">  -->
<style>
    body 
    {
        background-color: #f5f5f5;
    }

    .dashboardOuterBox
    {
        
        background-color: aliceblue;
        border: 1px solid #000000;
        position: absolute;
        width: 800px;
        height: 90%;         
        margin-left: -400px;
        overflow: scroll;
        overflow-x: hidden;
        top: 10px;
        left: 50%;
    }
    
    .dashboardHeader
    {
        border: inherit;
    }
    
    .dashboardBoxes {
        float: left;
        width: 50%;
        padding: 20px;
        box-sizing: border-box;
    }
    
    
    
    fieldset {
        border: 1px solid #000000;
    }
    
    a:hover {
        cursor: pointer;
        cursor: hand;
        text-decoration: underline;
    }
    
    .BugBoxContent{
        border: 1px solid black;
        width: 90%;
        padding: 20px;
        height: 100px;
        margin-bottom: 5px;
        /*margin-left: 10px;*/
        margin-right: 10px;
        overflow-x: auto;
        box-sizing: border-box;
    }
    </style>      

    
    <script>
    $(document).ready(function() {              
        
        $("div#BugBoxContent").mouseleave(function() {                          
            load();
        });
        
        $("input#BugBoxContentRefresh").click(function(ev) {
            ev.preventDefault();
            load(); 
        });
        
        
        function load() {
            $.ajax({    //create an ajax request to load_page.php
                type: "GET",
                url: "./BugBoxLoad.php",             
                dataType: "html",   //expect html to be returned                
                success: function(response){                    
                    $("#BugBoxContent").html(response);
                    //alert(response);
                }
            });
        }
        
        $("textarea#BugBoxMessage").focusout(function(ev) {
           ev.preventDefault();
           var bugboxMessage = $("textarea#BugBoxMessage").val();
           if(bugboxMessage)
           {               
               $.ajax({
                    type: "POST",
                    url: "./BugBoxSave.php",
                    data: "message="+bugboxMessage,
                    cache: false,
                    success: function(data) 
                    { 
                        var jsonData = $.parseJSON(data); 
                        if(jsonData.journalMessage === true)
                        {
                            $("textarea#BugBoxMessage").val('');
                            new Info("Vielen Dank, wir werden uns um dieses Anliegen kümmern und zur Prüfung einreichen!<br>Das Thema wird dann hier weiterbehandelt.");                              
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
        });
    });
    </script>
        

<div class="dashboardOuterBox">    
    <div class="dashboardHeader">Dashboard f&uuml;r <?=(sysIsUserAdmin()) ? "Admin" : "Benutzer";?> - <a href="logout.php">Abmelden</a></div>
    <br>
    
    <?php
    
    if($isOnline == false) {
        echo "<fieldset><legend>info</legend><i>Note: you´re not connected with the www so some functions are not working!</i><br>"
                . "<i>You´re using jquery 3.2.1.min local copy version</i><br>"
                . "<i>and jquery UI 1.11.4 local copy version</i></fieldset>";
    }
    
    if(sysIsUserAdmin())
    {
        ?>
        <div class="dashboardBoxes">
            <fieldset>
                <legend><b>Administration</b></legend>
                <ul>
                    <li><a id="addUser">Benutzer</a></li>
                    <li><a id="addKJFGroups">KJF Gruppen</a></li>
                    <li><a id="adminSetup">Einstellungen</a></li>
                </ul>  
                <hr>
                <i>Information: <br><br>                   
                <pre><?=$_SERVER['SERVER_SOFTWARE'];?></pre>    
                <pre><?=print_r($_SESSION);?></pre></i>
                <br><hr>
                <?php
                if(AdminSetup::findRecId(AdminSetup::getLastRecId())->fldDeleteUploadedMemberFiles[FLDVALUE])
                {                    
                    FileHelper::deleteFilesFromDir("MemberManagement/uploads");
                }
                ?>                
            </fieldset>
        </div>
        <?php
    }
    ?>
    
    <div class="dashboardBoxes">
        <fieldset>
            <legend>Stammdaten</legend>
            <ul>
                <li><a id="addDistrict">Landkreis</a></li>
                <li><a id="masterDataMunicipality">Gemeinden</a></li>
                <li><a id="masterDataFireDepartments">Feuerwehren</a></li>
                <li><a id="MemberManagement">Mitglieder</a></li>
            </ul>
        </fieldset>
    </div>   
    
    <div class="dashboardBoxes">
        <fieldset>
            <legend>Bundeswettbewerb</legend>
            <ul>
                <li><a id="contest">Bundeswettbewerbe</a></li> 
                <li><a id="">Gesamtauswertung</a></li>
            </ul>
        </fieldset>
    </div>
    
    <?php
    if(sysIsUserUser())
    {
        ?>
        <div class="dashboardBoxes">
            <fieldset>
                <legend>Feuerwehr Spezifische Daten</legend>
                <ul>
                    <li><a id="RegistrationForm">Anmeldung zum Bundeswettbewerb</a></li>
                    <li><a id="MemberGroups">Gruppenverwaltung</a></li>                
                </ul>
            </fieldset>
        </div>
        <?php
    }
    ?>
    
    
    <div class="dashboardBoxes">
        <fieldset>
            <legend>BugBox</legend>
            Melde einen Fehler oder Verbesserung ...<br>
            <input type="submit" id="BugBoxContentRefresh" style="width:20px; height:20px; background-image: url(refresh-button-icon-63755.png); background-size: 15px 15px;" value="">
            <textarea style="width: 100%; height: 50px" id="BugBoxMessage"></textarea>     
            <!--<input type="submit" id="BugBoxPost" value="Veröffentlichen"><br>  
            <hr>
            <div id="BugBoxContent" style="overflow: scroll; overflow-x: hidden; background-color: #fff; border: 1px solid #000000; width: 100%; height: 100px;"></div>     -->                                                                      
        </fieldset>
    </div>
    
    <div class="dashboardBoxes">

        <fieldset>
            
        </fieldset>
    </div>
    
</div>
