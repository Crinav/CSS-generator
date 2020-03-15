<?php
$array = array();
function my_scandir($dir_path){
   global $array;
    $handle = opendir($dir_path);
        while ($entry = readdir($handle)) {
            if (($entry !== ".") && ($entry !== "..")){
                if(is_dir($dir_path."/".$entry)){
                    my_scandir($dir_path."/".$entry);
                    }
                else{
                        array_push($array, $dir_path."/".$entry);
                        $array = preg_grep("/^.*\.(png)$/i", $array);
                        sort($array);
                }    
                    
            }    
        }
    closedir($handle);
     
    return $array;
}
?>