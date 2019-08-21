<?php
     //$files = array ();
     //$files = glob("/home/www/emc/htdocs/mmb/ylin/pcpverif/daily/2019/20190721/*");
     //$files = glob("../daily/2019/20190721/*",GLOB_BRACE);
     $files = scandir('../../daily/2019/20190721');
     //var_dump ($files);
     //echo "Files from directory: ".$files;

     //Get the Models and list them to be displayed
     $strings = array();
     foreach($files as $val){
         //get the substring
         $strings[] = substr($val, 0, strpos($val,"."));
         //check for duplication
         //add the value to the list
     }

     $modelNames = array_unique($strings);
     
     var_dump($modelNames);

?>
