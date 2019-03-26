<?php
/**
 *
 * @author tanzberg
 */
interface xTblIface  // TODO: Better use abstract class
{
    //public function initAll(); // right now it is private
    
    public function init();
    
    public static function tableId();
    
    public function insert();
    
    public function update();
    
    public function delete();
}
