<?php
// include Wordpress core
require ($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
$swatch = array();
$typeElement = array();


require('config.php');
// enable documentation in included files
$docs = true;


// search through all files in theme folder and look for compoents they are prefixed with 'c' and with component in the file's comments
$components = array();
$filesearch = scandir('../');

// loop through all files in parent folder
foreach ($filesearch as &$file) {
    
    // look for components (prefixed with 'c')
    if(substr($file, 0, 1) == "c"){
    	// check it's actiually a component and not a filename beginning with 'c' 
    	// components have a comment of 'component' in the comments
		if( strpos(file_get_contents('../' . $file),'component') !== false) {
    		$components[] = rtrim($file,".php");;
	    }


    }
}

include('header.php');
	

	// Colours
	?>
    
    <div class="sgComponent" id="colours">   
        <h1 class="sgH1">Colours</h1>

        <?php

            echo "<p class='sgText'>" . $colourInfo . "</p>";
            foreach ($swatch as &$swatchData) {
            ?>
                <div class="sgColourSwatch sgText" data-clipboard-text="<?php echo $swatchData['hex']; ?>">
                    <div class="sgColourSwatchTile" style="background:<?php echo $swatchData['hex']; ?>"></div>
                    <div class="sgColourSwatchName"><?php echo $swatchData['name']; ?></div>
                    <div class="sgColourSwatchHex"><?php echo $swatchData['hex']; ?></div>
                </div>
            <?php
            }
        ?>
        
    </div>

	<?php
	// Typography
	?>
    
    <div class="sgComponent" id="typography">   
        <h1 class="sgH1">Typography</h1>

        <?php
            echo "<p class='sgText'>" . $typographyInfo . "</p>";

            foreach ($typeElement as &$typeElementData) {

            ?>
		        <div class="sgTypeBox">
		        	<div class="sgTypeLabel"><?php echo $typeElementData['label']; ?></div>
		        	<?php echo $typeElementData['sample']; ?>
		        </div>
		        <?php
		        if($typeElementData['note']){
		        	echo '<p class="sgText sgTypeNote">' . $typeElementData['note'] . '</p>';
		        } 
		        echo '<div class="sgTypeCSS"></div>';
            }
        ?>
        
        
    </div>






    <?php
	// Components
	foreach ($components as &$component) {
	    echo '<div class="sgComponent" id="' . $component . '">';
	    echo '<h1 class="sgH1">' . $component . '</h1>';
	    include('../' . $component . '.php');
	    echo "</div>";
	}



include('footer.php');


unset($component);
