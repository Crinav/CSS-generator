#!/usr/bin/php
<?php
include_once ("dir.php");
//déclaration des variables
$longopts  = array("help","recursiveLook","output-image::","output-style::");
$options = getopt("i::s::hro:", $longopts);
$nameCSS = "my_style.css";
$path = __DIR__;
$name = "sprite.png";
$erreur = "this file already exists";
$erreurfolder = "please enter a valid output folder\n";
//fonction de gestion d'erreurs
function erreur(){               
    $reponse = "";
    
    while($reponse !== "y" || $reponse !== "n"){
        $reponse = readline("Do you want concatenate data ? (y/n)\n");
        if($reponse == "n"){
            unset($reponse);
            exit;
        }
        if($reponse == "y"){unset($reponse);break;}
    }
}
//Si des options sont présentes dans la commande
if(!empty($options) ){
      if(is_dir($argv[$argc-1])){
          $path = __DIR__."/".$argv[$argc-1];
      }
          
        if(isset($options["help"]) || isset($options["h"])){ 
            echo  "\033[32m 
    DESCRIPTION : Concatenate all PNG images inside a folder in one sprite and write a style sheet ready to use.\n\n        
    SYNOPSIS : css_generator.php  [OPTIONS]. . . assets_folder\n\n
    OPTIONS :        
    -r,--recursiveLook :\n For images into the assets_folder passed as arguement and all of its subdirectories.\n
    -i,--output-image=IMAGE :\n Name of the generated image; If blank, the default name is « sprite.png ».\n
    -s,--output-style=STYLE :\n Name of the generated stylesheet; If blank, the default name is « style.css ».\n
    -h,--help :\n This manual helper.\n\033[0m ";
        exit;
        }
        //gestion des options i output-image et des erreurs
        if(empty($options["output-image"])){
            $name = "sprite.png";
        }
        else{
            if(isset($options["output-image"])){
                
                if(is_file($path."/".$options["output-image"])){
                    echo "the file ".$name." already exists\n";
                    erreur();
                }
                $info = new SplFileInfo($options["output-image"]);
                
                if($info->getExtension() == "png"){
                    $name = $options["output-image"];
                    
                }
                elseif($info->getExtension() !== "png"){
                    $name = $options["output-image"].".png";
                    
                }
                unset($info);
            }
        }
        if(empty($options["i"])){
            $name = "sprite.png";    
        }
        else{
            if(isset($options["i"])){
            
                if(is_file($path."/".$options["i"])){
                    echo "the file ".$name." already exists\n";
                    erreur();
                }
                else{
                    $info = new SplFileInfo($options["i"]);
                
                    if($info->getExtension() == "png"){
                        $name = $options["i"];
                        
                    }
                    elseif($info->getExtension() !== "png"){
                        $name = $options["i"].".png";
                        
                    }
                    unset($info);
                }            
            }
        }
        
        //gestion des options s output-style et des erreurs
        if(empty($options["output-style"])){
           $nameCSS = "my_style.css"; 
        }
        else{   
            if(isset($options["output-style"])){
                if(file_exists($path."/".$options["output-style"])){
                    echo "the file ".$nameCSS." already exists\n";
                    erreur();
                }
                else{
                    $info = new SplFileInfo($options["output-style"]);
                
                    if($info->getExtension() == "css"){
                        $nameCSS = $options["output-style"];
                        
                    }
                    elseif($info->getExtension() !== "css"){
                        $nameCSS = $options["output-style"].".css";
                    
                    }
                    unset($info);
                }    
            }
        }
        if(empty($options["s"])){
            $nameCSS = "my_style.css";
        }
        else{
            if(isset($options["s"])){
                if(file_exists($path."/".$options["s"])){
                    echo "the file ".$nameCSS." already exists\n";
                    erreur();
                }
                else{
                    $info = new SplFileInfo($options["s"]);
                    
                    if($info->getExtension() == "css"){
                        $nameCSS = $options["s"]; 
                        
                    }
                    elseif($info->getExtension() !== "css"){
                        $nameCSS = $options["s"].".css"; 
                        
                    }
                    unset($info);
                }
            }
        }
        //gestion des options r et recursiveLook   
        $scan = my_scandirNoRecursive($path);
        if (isset($options["recursiveLook"])){
            if(substr($argv[array_key_last($argv)],0 ,1) == "-") {
                $path = __DIR__;
                $scan = my_scandirNoRecursive($path);
            }
            else{
                if(is_dir($argv[$argc - 1])){
                    
            $path = $argv[$argc - 1];
            $scan = my_scandir($path);
                 }
                 else{
                     exit($erreurfolder);
                 }
            }     
        }
        
        
        
        if (array_key_exists("r", $options)){
            
            if(substr($argv[array_key_last($argv)],0 ,1) == "-") {
                
                $path = __DIR__;
                $scan = my_scandirNoRecursive($path);
            }
            else{
                if(is_dir($argv[array_key_last($argv)])){
                    
            $path = $argv[$argc - 1];
            $scan = my_scandir($path);
            
                 }
                 else{
                     exit($erreurfolder);
                 }
            }     
       }
        
        
    my_merge_image($scan);       
}
//si il n'a aucune option de présentes
if(empty($options)){
    $flag = 0;
    ($argc !==1) ? : exit($erreurfolder) ;
    
        if(isset($argv[1])){
            $path = $argv[1];
            if(is_dir($path)){
                
                if (file_exists($name)){

                    echo("the file ".$name." already exists\n");
                    $reponse = "";
                    while($reponse !== "y" || $reponse !== "n"){
                        $reponse = readline("Do you want concatenate data ? (y/n)\n");
                        if($reponse == "n"){
                            unset($reponse);
                            exit;
                        }
                        if($reponse == "y"){unset($reponse);break;}
                    }
                    $name = "sprite.png";
                    echo $path."\n";
                    my_merge_image(my_scandirNoRecursive($path));
                    $flag = 1;
                    }
                else{
                    $name = "sprite.png";
                    echo $path."\n";
                    my_merge_image(my_scandirNoRecursive($path));
                    $flag = 1;
                    }

                    if($flag == 0){
                        if(file_exists($nameCSS)) {
                            echo("the file ".$nameCSS." already exists\n");
                            $reponse = "";

                            while($reponse !== "y" || $reponse !== "n"){
                                $reponse = readline("Do you want concatenate data ? (y/n)\n");
                                if($reponse == "n"){
                                    unset($reponse);
                                    exit;
                                }
                                if($reponse == "y"){unset($reponse);break;}
                            }
                            $nameCSS = "my_style.css";
                            echo $path."\n";
                            my_merge_image(my_scandirNoRecursive($path));
                            
                        }
                        else{
                            $nameCSS = "my_style.css";
                            echo $path."\n";
                            my_merge_image(my_scandirNoRecursive($path));
                        }
                }
            }
            else{
                exit($path." is not a valid directory\n");
            }
        }
        else{
            exit($erreurfolder);
        }
         
}
//Ecriture du texte commun pour le fichier CSS
function baseCss($nameCSS){ 
    global $name;
    global $nameCSS;
    
    $cssbase = ".sprite{\n
    background-image: url(".'"'.$name.'"'.");\n
    background-repeat: no-repeat;\n
    display: block;\n
}\n";
    $handle = fopen($nameCSS, "w");
    $write = fwrite($handle, $cssbase);
}
//fonction pour créer le sprite
function my_merge_image($scandir){
    
    global $nameCSS;
    
    global $name;
    
    baseCss($nameCSS);
    $files_tmp = array();
    $largeur = 0;
    
    foreach($scandir as $file){
        $tab = getimagesize($file);
        list($x, $y) = $tab;
        $files_tmp[$file] = array($x, $y);
        
    }
    function hautmax($files_tmp){
        if(is_array($files_tmp)){
            foreach($files_tmp as $key => $value){
                $files_tmp[$key] = hautmax($value[1]);
            }
        return max($files_tmp);
        }
        else{
            return $files_tmp;
        }
    }
    
    $hauteurmax = hautmax($files_tmp);
    
    function longmax($files_tmp){
        if(is_array($files_tmp)){
            foreach($files_tmp as $key => $value){
                $files_tmp[$key] = longmax($value[0]);
            }
        return array_sum($files_tmp);
        }
        else{
            return $files_tmp;
        }
    }
    $longueurmax = longmax($files_tmp);
       
    $cadre = imagecreatetruecolor($longueurmax, $hauteurmax);
    $fond = imagecolorallocatealpha($cadre, 255, 255, 255, 127);
    imagefill($cadre, 0, 0, $fond);
    imagealphablending($cadre, false);
    imagesavealpha($cadre, true);
    $pos = 0;
    $i = 0;
    $neg = null;
   
    foreach ($scandir as $value){ 
        $info = getimagesize($value);
        
        $imgpng = imagecreatefrompng($value);
        imagecopymerge($cadre, $imgpng, $pos, 0, 0, 0, $info[0], $info[1], 100);
           
        my_generate_css($info,$scandir, $pos, $i);
        $pos = $pos + $info[0];
        $i++;
    }
    
    imagepng($cadre, $name);
    imagedestroy($imgpng);
    
}
//fonction pour generer la suite du CSS en fonction des images fournies  
function my_generate_css($info, $scandir, $pos, $i){
    ($pos == 0) ? $neg = "" : $neg = "-";
    global $nameCSS;
    $chaine = '|.(.*?)/|iU';
    $scandir = preg_replace($chaine,'',$scandir);
$css = ".sprite-".substr($scandir[$i], 0,-4)."{ \n
    width: ".$info[0]."px;\n
    height: ".$info[1]."px;\n
    background-position: ".$neg.$pos ."px 0px;\n
}\n";
    $handle = fopen($nameCSS, "a");
    $write = fwrite($handle, $css);
    fclose($handle);
}
//fonction scandir du dossier courant
function my_scandirNoRecursive($dir_path){
    $array = array();
    $handle = opendir($dir_path);
         while ($entry = readdir($handle)) {
            if (($entry !== ".") && ($entry !== "..")){
                if(!is_dir($entry)){
                    array_push($array, $dir_path."/".$entry);
                    $array = preg_grep("/^.*\.(png)$/i", $array);
                    sort($array);
                }
            }
        }
    return $array;
}
?>