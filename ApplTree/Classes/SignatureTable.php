<?php
/**
 * Description of SignatureTable
 *
 * @author tanzberg
 */
Class SignatureTable extends SysTable
{
    /**
     * Holds the TableName
     * @var str TableName
     */
    public $tableName           = "SignatureTable";
    
    /**
     * Holds the RecId
     * @var int RecId
     */
    public $fldRecId            = FLDRECID;
    
    /**
     * Holds the GroupRecId
     * @var int GroupRecId
     */
    public $fldGroupRecId       = FLDGROUPID;
    
    /**
     * Holds the Function of the Member in the Group e.g. Kreisjugendfeuerwehrwart
     * @var str Function
     */
    public $fldFunction         = FLDSIGNATUREFUNCTION;
    
    /**
     * Holds the Description
     * @var text Description
     */
    public $fldSigDescription   = FLDSIGNATUREDESCRIPTION;
    
    /**
     * Holds the Image File
     * @var image Image
     */
    public $fldSigImage         = FLDSIGNATUREIMAGE;
    
    /**
     * Holds the Image Extension
     * @var str Image Extension
     */
    public $fldSigImageExt      = FLDIMAGEEXT;
    
    /**
     * Holds the Forename
     * @var str Forename
     */
    public $fldForename         = FLDFORENAME;
    
    /**
     * Holds the Surname
     * @var str Surname
     */
    public $fldSurname          = FLDSURNAME;
    
    
    
    
    /**
     * Construct an new Obj
     * @param int $recId RecId
     */
    public function __construct($recId = null, $groupRecId = null) {
        parent::__construct();
        if($recId != null && $groupRecId == null)
        {
            $this->fldRecId[FLDVALUE] = $recId;
            $this->init();
        }
        
        if($recId == null && $groupRecId != null)
        {
            // Check if a User is member of an Group so initate 
            // only Signatures from this Group otherwise select all                            
            $groupRecId = sysGetGroupIdOfUser();                    
            
            if($groupRecId)
            {
                $this->fldGroupRecId[FLDVALUE] = $groupRecId;
                $this->initAll()->where($this->fldGroupRecId[FLDNAME]." = " . $groupRecId)->fetch();
            }
            else
            {                    
                $this->initAll()->fetch();
            }
        }
    }
    
    /**
     * Gets the tablenum
     * @return int TableId
     */
    public static function tableId() {
        return tablenum(new SignatureTable());
    }
    
    
    /**
     * Create an new Obj from RecId find
     * @param int $recId RecId
     * @return \DistrictTable DistrictTable Obj
     */
    public static function find($recId) {
        return new SignatureTable($recId);
    }
    
    
    
    /**
     * Get or Sets an Image
     * @param type $imageData
     * @param int $width Width of image on Get
     * @param int $height Height of image on Get
     * @param boolean $onlyFile set to true if you want only the BinaryData
     * @return img <img html tag with properties
     */
    public function signature($imageData = null, $width = null, $height = null, $onlyFile = false) {
        if($imageData != null) {
            $this->fldSigImage[FLDVALUE] = $imageData;
        }
        
        if($onlyFile) {
            return $this->fldSigImage[FLDVALUE];
        }
        
        return '<img src="data:image/jpeg;base64,'.base64_encode( $this->fldSigImage[FLDVALUE] ).'" style="width:'.$width.'px; height:'.$height.'px;"/>';
    }
}






class SignatureTable_OLD extends xTable implements xTblIface
{
    private static $tablename = "SignatureTable";
    private static $tableId = 19;
    public $recId;
    /**
     * Hold a Map with initiated RecId´s
     * @var Map
     */
    public $recIdMap;
    
    /**
     * Hold the GroupRecId to reference each sig to the Group
     * @var int GroupRecId
     */
    private $fldGroupRecId;
    
    
    /**
     * Hold the function
     * @var str SignatureFunction
     */
    private $fldSigFunction;
    
    
    /**
     * Hold the description
     * @var str Description
     */
    private $fldSigDescription;
    
    
    /**
     * Hold the Image as bin data
     * @var imageblob image
     */
    private $fldSignature;
    
    /**
     * Holds the Extension of the image
     * @var str Extension of file
     */
    private $fldSignatureExtension;
    
    /**
     * Holds the Forename
     * @var str(30) Forename
     */
    private $fldForename;
    
    /**
     * Holds the Surname
     * @var str(40) Surname
     */
    private $fldSurname;
    
    
    /**
     * Initiate a new Object
     * @param int $recId RecId of Table
     * @param int $groupRecId RecId of Group [optional]<br>
     * It will be selected automatically by Group per default
     * @throws Exception
     */
    public function __construct($recId = null, $groupRecId = null) {
        try 
        {                  
            $this->initFields();
            $this->recId = $recId;
            $this->recIdMap = new Map();

            parent::__construct(self::$tablename, true); 

            $this->xGenerateFieldSet($this);
            if($recId)
            {
                $this->init(); // initiate Single record
            }  
            else
            {     
                // Check if a User is member of an Group so initate 
                // only Signatures from this Group otherwise select all                
                if(sysGetGroupIdOfUser())
                {
                    $groupRecId = sysGetGroupIdOfUser();                    
                }
                
                if($groupRecId)
                {
                    $this->groupRecId($groupRecId);
                    $this->initFromGroupRecId();
                }
                else
                {                    
                    $this->initAll();
                }
            }
            
        } 
        catch (Exception $ex) 
        {
            throw new Exception($ex);
        }
    }
    
    public static function tableId() {
        return SignatureTable::$tableId;
    }
    
    private function initFields() {
        $this->fldGroupRecId = SysPropertys::fldProp("GroupRecId", "INT(10)"); 
        $this->fldSigFunction = SysPropertys::fldProp("SigFunction", "VARCHAR(50)");
        $this->fldSigDescription = SysPropertys::fldProp("SigDescription", "VARCHAR(100)");
        $this->fldSignature = SysPropertys::fldProp("SignaturePic", "LONGBLOB");
        $this->fldSignatureExtension = SysPropertys::fldProp("SignatureExtension", "VARCHAR(10)");
        $this->fldForename = SysPropertys::fldProp("ForeName", "VARCHAR(30)");
        $this->fldSurname = SysPropertys::fldProp("Surname", "VARCHAR(40)");
    }
    
    public function init($recId = null) {
        if($recId != null)
        {
            $this->recId = $recId;
        }
        if($this->recId == "" || $this->recId == null)
        {
            echo "init not possible!<br>". __CLASS__ ."/". __METHOD__ ."";
        }
        else
        {
            $this->xInit($this);
        }
    }
    
    
    public function initFromGroupRecId() {              
        $this->recIdMap = $this->selectAllOrderBy("WHERE ".$this->fldGroupRecId[sysFldName]." = '".$this->fldGroupRecId[sysFldValue]."'");        
    }
   
    private function initAll() {
        $this->recIdMap = $this->selectAllOrderBy(); 
    }
    
    public function insert() {
        try
        {              
            //$this->validate();            
            return $this->xInsert($this);
        }
        catch(Exception $ex)
        {
            //echo str_replace("\n", "<br>", $ex->getTraceAsString());
            throw new Exception($ex->getMessage());            
        }
    }
    
    public function update(){
        return $this->xUpdate($this);
    }
    
    public function delete() {
        return $this->xDelete($this);
    }
    
    public static function find($recId) {
        return new SignatureTable($recId);
    }
    
    
    /**
     * Comes from GroupTable (Landkreisgruppe)
     * @param int $groupRecId RecId of Group
     * @return int RecId
     */
    public function groupRecId($groupRecId = null) {
        if($groupRecId != null) {
            $this->fldGroupRecId[sysFldValue] = $groupRecId;
        }
        
        return $this->fldGroupRecId[sysFldValue];
    }
    
    
    public function signatureFunction($function = null) {
        if($function != null) {
            $this->fldSigFunction[sysFldValue] = $function;
        }
        
        return $this->fldSigFunction[sysFldValue];
    }
    
    
    public function signatureDescription($description = null) {
        if($description != null) {
            $this->fldSigDescription[sysFldValue] = $description;
        }
        
        return $this->fldSigDescription[sysFldValue];
    }
    
    
    /**
     * Get or Sets an Image
     * @param type $imageData
     * @param int $width Width of image on Get
     * @param int $height Height of image on Get
     * @param boolean $onlyFile set to true if you want only the BinaryData
     * @return img <img html tag with properties
     */
    public function signature($imageData = null, $width = null, $height = null, $onlyFile = false) {
        if($imageData != null) {
            $this->fldSignature[sysFldValue] = $imageData;
        }
        
        if($onlyFile) {
            return $this->fldSignature[sysFldValue];
        }
        
        return '<img src="data:image/jpeg;base64,'.base64_encode( $this->fldSignature[sysFldValue] ).'" style="width:'.$width.'px; height:'.$height.'px;"/>';
    }
    
    
    public function signatureExtension($extension = null) {
        if($extension != null) {
            $this->fldSignatureExtension[sysFldValue] = $extension;
        }
        
        return $this->fldSignatureExtension[sysFldValue];
    }
    
    
    public function forename($forename = null) {
        if($forename != null) {
            $this->fldForename[sysFldValue] = $forename;
        }
        
        return $this->fldForename[sysFldValue];
    }
    
    public function surname($surname = null) {
        if($surname != null) {
            $this->fldSurname[sysFldValue] = $surname;
        }
        
        return $this->fldSurname[sysFldValue];
    }
    
    /**
     * Get the Name in formated order<br>
     * If $surnameAtFirst is set to false, the name is <b>forename surname</b><br>
     * otherwise it will be <b>surname, forename</b>
     * @param str $surnameAtFirst name
     * @return str name
     */
    public function name($surnameAtFirst = true) {
        if($surnameAtFirst) {
            return $this->surname() . ", " . $this->forename();
        }
        return $this->forename() . " " . $this->surname();
    }
}
