<?php
class FileHelper extends Obj
{
    public function __construct() {
        
    }
    
    public static function deleteFilesFromDir($directory) {
        $files = glob($directory.'/*'); // get all file names
        //echo var_dump($files);
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                if(unlink($file)) { // delete file
                    echo "File [" . $file . "] deleted!<br>";
                }
            }
        }
    }
    
}
