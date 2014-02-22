<?php
//Class for handling the requires/imports/includes of other files
/**
 * The Paws project autoloader. Make sure that this file is placed at the top level.
 * Author: Yaw Agyepong
 * Forked by: Steven Ng
 */
class AutoLoader {

	public static function autoLoad($object){        
        //echo 'attempting to load ',$object;
        
        if(file_exists(__DIR__."\\Classes\\".$object.".php")){
            $class = __DIR__."\\Classes\\".$object.".php";
            require_once $class;
            //echo $class, " loaded";
        }
		else {
            echo "$object not found";
        }
	}
}

?>