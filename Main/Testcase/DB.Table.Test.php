<?php
require_once("../../ExtendedDataTypes.php");
require_once("../../ApplTree/Classes/Base.php");
require_once("../../ApplTree/Classes/Database.php");
require_once("../../ApplTree/Classes/SysTableBase.php");
require_once("../../ApplTree/Classes/SysTable.php");


class MemberTableTest extends SysTable
{
    public $tableName = "MemberTableTest";
    public $fldRecId = FLDRECID;
    public $fldForename = FLDFORENAME;
    public $fldSurname = FLDSURNAME;
    public $fldUsername = FLDUSERNAME;
    public $fldBirthdate = FLDBIRTHDATE;
    
    public function __construct($recId = null) {
        parent::__construct(); // Database construct
        if($recId != null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
    }  
    
   
    public static function findByUserName($username) {
        $M = new MemberTable();
        $M->query = "SELECT * FROM $M->tableName WHERE ".$M->fldUsername[FLDNAME]." = '".$username."'";
        $M->fetch();
        return $M;
    }   
}



//// Insert - use ttsbegin and ttscommit or ttsabort
//$MT = new MemberTableTest();
////$MT->fldRecId[FLDVALUE] = 2;
//$MT->fldForename[FLDVALUE] = "TEST";
//$MT->fldSurname[FLDVALUE] = "TEST";
//$MT->fldUsername[FLDVALUE] = "TEST";
//////echo $MT->fldForename[FLDLABEL]["en"]." .....: ". $MT->fldForename[FLDVALUE];
//$MT->ttsbegin();
//if($MT->doInsert())
//    $MT->ttscommit();
//else
//    $MT->ttsabort ();


//// Direct init with given RecId
//$MT = new MemberTableTest(6);
//echo $MT->getNumOfRows();
//echo "<br>";
//echo $MT->fldForename[FLDLABEL]["de"]." .....: ". $MT->fldForename[FLDVALUE];
//echo "<br>";
//echo $MT->fldSurname[FLDLABEL]["de"].".......: ". $MT->fldSurname[FLDVALUE];
////$MT->toString();


//// find method
//$M = MemberTableTest::findByUserName("xyrano");
//echo $M->getNumOfRows();
//echo "<br>";
//echo $M->fldForename[FLDLABEL]["de"]." .....: ". $M->fldForename[FLDVALUE];
//echo "<br>";
//echo $M->fldSurname[FLDLABEL]["de"].".......: ". $M->fldSurname[FLDVALUE];


//// Single initAll with only one next
//$MT = new MemberTableTest();
//$MT->initAll()->orderBy($MT->fldSurname[FLDNAME])->fetch();
//$MT->next();
//echo $MT->fldUsername[FLDVALUE]."<br>";
//echo "TableID: ".$MT->fldTableId[FLDVALUE];
//echo $MT->fldCreatedDateTime[FLDNAME]."...: ".$MT->fldCreatedDateTime[FLDVALUE];


//// while / Iterate thorugh records with order by
//$MT = new MemberTableTest();
//$MT->initAll()->orderBy($MT->fldForename[FLDNAME]." ASC, ".$MT->fldSurname[FLDNAME]." DESC")->fetch();
//while($MT->next()) 
//{
//    echo $MT->fldForename[FLDLABEL]["de"]." ".$MT->fldSurname[FLDLABEL]["de"].".....: ".$MT->fldRecId[FLDVALUE]." - ".$MT->fldForename[FLDVALUE]." ".$MT->fldSurname[FLDVALUE]."<br>";    
//}


//// Update all records
//$MT = new MemberTableTest();
//$MT->initAll()->fetch();
//
//while($MT->next())
//{    
//    $MT->ttsbegin();
//    $MT->fldBirthdate[FLDVALUE] = '1985-02-08';
//    $MT->doUpdate();
//    $MT->ttscommit();
//    
//}

// Build function
function tablenum($table){
    echo SysTableIdReference::findOrCreate($table->tableName)->fldRecId[FLDVALUE];
}

echo tablenum(new MemberTableTest());


  $M = new MemberTableTest();
  $M->fldForename[FLDVALUE] = "Timo";
  $M->fldSurname[FLDVALUE] = "Tanzberger";
  $M->fldUsername[FLDVALUE] = "tanzi";;
  $M->fldBirthdate[FLDVALUE] = "16.02.1985";
  $M->ttsbegin();
  $M->insert();
  $M->ttscommit();