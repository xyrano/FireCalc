<?php
if(!isset($_SESSION))
{
    session_start();
}

require_once("../ApplTree/Classes/SysPropertyDefinition.php");
require_once("../ExtendedDataTypes.php");

function do_autoload($ClassName) {
    $Class = $ClassName; 
    //echo $ClassName."<br>";
    switch(substr($ClassName, 0, 3))
    {
        case 'Tbl':
            require_once("../ApplTree/Tables/".$Class . ".php");
            break;  
               
        default:
            require_once("../ApplTree/Classes/".$Class . ".php");
            break;
    }   
}    

spl_autoload_register('do_autoload'); // neue implementierung der auoloader func


?>
