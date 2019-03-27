<?php
require_once("../Factory.php");
if(!isset($_SESSION))
{
    session_start();
}

$login = new LoginLogout();
if($login->logout())
{
    header('Location: ' . SysConstants::sysAbsoluteProjectPath);
}
    
