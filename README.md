# CSS-generator  

A shell program who Concatenate all PNG images inside a folder and its subfolders in one sprite and write a stylesheet ready to use.  
  
![sprite](https://github.com/Crinav/CSS-generator/blob/master/sprite.png)  

## Languages
* PHP
* Shell linux  

## Features 
* Recursive search in folders
* Rename sprite and stylesheet file name
* Auto generate file extensions  

      
## How to Use  
  
MAN :
```    
    SYNOPSIS : css_generator.php  [OPTIONS]. . . assets_folder

    OPTIONS :        
    -r,--recursiveLook :
 For images into the assets_folder passed as arguement and all of its subfolders.

    -i,--output-image=IMAGE :
 Name of the generated image; If blank, the default name is « sprite.png ».

    -s,--output-style=STYLE :
 Name of the generated stylesheet; If blank, the default name is « style.css ».

    -h,--help :
 This manual helper.

```
## Contact  

Copyright (©) Christophe Navarro <navarro.christophe@gmail.com>

[linkedin](https://www.linkedin.com/in/christophe-navarro-b5173a171)  

## Screenshots
  
![sprite](https://github.com/Crinav/CSS-generator/blob/master/sprite.png)

Stylesheet created :
```
.sprite{

    background-image: url("sprite.png");

    background-repeat: no-repeat;

    display: block;

}
.sprite-Doodler{ 

    width: 225px;

    height: 225px;

    background-position: 0px 0px;

}
.sprite-affordable-price-225x225{ 

    width: 225px;

    height: 225px;

    background-position: -225px 0px;

}
.sprite-camera-logo-png-4{ 

    width: 225px;

    height: 225px;

    background-position: -450px 0px;

}
.sprite-facebook{ 

    width: 225px;

    height: 225px;

    background-position: -675px 0px;

}
.sprite-insta{ 

    width: 225px;

    height: 225px;

    background-position: -900px 0px;

}
.sprite-linkedin{ 

    width: 225px;

    height: 225px;

    background-position: -1125px 0px;

}
.sprite-vimeo{ 

    width: 225px;

    height: 225px;

    background-position: -1350px 0px;

}
.sprite-whatsapp-logo-vector-29{ 

    width: 225px;

    height: 225px;

    background-position: -1575px 0px;

}
.sprite-youtube{ 

    width: 225px;

    height: 225px;

    background-position: -1800px 0px;

}
```