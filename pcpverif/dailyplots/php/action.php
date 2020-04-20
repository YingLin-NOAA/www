<?php

if (isset($_POST['year']) ) {
    // do user authentication as per your requirements
    // ...
    // ...
    // based on successful authenticationi

    $year = $_POST['year'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $level = $_POST['level'];
    //$path = '/home/www/emc/htdocs/mmb/ylin/pcpverif/daily/'.$year.'/'.$year.$month.$day.'/*.gif';
    $dir = '../../daily/'.$year.'/'.$year.$month.$day;
    if ($level == 'OCONUS'){
      $dir = '../../daily/'.$year.'/'.$year.$month.$day.'.oconus';
    }
    $files = array();

    //$files = glob($path);
    $images = preg_grep('~\.(jpeg|jpg|png|gif)$~', scandir($dir));
    
    //Loop through the files and extract the Model Names that are available in the Directory
    // Which will help populate the Model Select form.
     $strings = array();
     foreach($images as $val){
         //get the substring
         $strings[] = substr($val, 0, strpos($val,"."));
     }

     $modelNames = array_unique($strings);
    

   // var_dump($files);
    //echo json_encode(array('success' => 1));
    echo json_encode(array('files' => $images, 'searchDir' => $dir, 'modelNames' => $modelNames) );
} else {
    echo json_encode(array('success' => 1));
}


  /* taken from: https://github.com/eladkarako/download.eladkarako.com */

 // $path = 'resources';
 // $files = [];
 // $handle = @opendir('./' . $path . '/');

 // while ($file = @readdir($handle))
//    ("." !== $file && ".." !== $file) && array_push($files, $file);
//  @closedir($handle);
//  sort($files); //uksort($files, "strnatcasecmp");

//  $files = json_encode($files);

//  unset($handle,$ext,$file,$path);



?>

