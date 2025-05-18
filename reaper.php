<?php
include('simple_html_dom.php');

$html = file_get_html('index.html');
//$u = 'http://themeaone.com/hexa-preview/hexa/';
//$u = 'http://demo.themegoals.com/html/ideabox/';
//$u = 'https://pixinvent.com/demo/crypto-ico/';
//$u = 'http://demo.themenio.com/cryptocoin/';

// $u = 'http://grandetest.com/theme/ico-html/';
//$u = 'https://coreui.io/demo/';
$u = 'https://d1kit.com/pat2echo/';

// find all link
	// foreach($html->find('a') as $e)
	//    echo $e->href . '<br>';

$var = '/css/fonts/icomoon.ttf;
/css/fonts/icomoon.woff?cplj';



if( ! $var ){
	foreach( $html->find('img') as $e){
	    $var .= $e->src . ':';
	}

	foreach($html->find('script') as $e){
	    $var .= $e->src . ':';
	}
	foreach($html->find('link') as $e){
	    $var .= $e->href . ':';
	}
}

// print_r( $var );

$array = explode(':', $var );
echo '<ol>';
foreach( $array as $sval ){
	$sval = trim($sval);
	if( $sval ){
		$a = explode("/", $sval );
		$folder = '';
		$name = $sval;
		if( isset( $a[0] ) && isset( $a[1] ) && $a[1] ){
			$x = count($a);
			$name = $a[ $x - 1 ];
			unset( $a[ $x - 1 ] );
			foreach( $a as $aa ){
				if( $aa == '..' ){
					continue;
				}
				$folder .= $aa . '/';
				echo '<li>Checking Folder: <strong>'.$folder.'</strong></li>';
				if( ! file_exists( $folder ) ){
					create_folder( $folder );
				}
			}
		}
		
		$image_url = $u . $sval;
		$image_url = str_replace( "/pat2echo/../", "/", $image_url );
		if( ! file_exists( $sval ) ){
			print_r( $sval );
			echo '<li>Saving File: <strong>'.$folder.$name.'</strong></li>';
			// The URL of the image you want to download

			// Get the image data
			$image_data = file_get_contents( str_replace( "/pat2echo/../", "/", $image_url ) );

			// Check if the data was successfully retrieved
			if ($image_data === false) {
			    echo "Error: Failed to download the image.";
			} else {
			    // Save the image to the specified folder
			    file_put_contents($folder . $name, $image_data);
			}

			// file_put_contents( $folder.$name , file_get_contents( $u . $sval ) );
		}else{
			echo '<li>Skipping, File Already Exist: <strong>'.$folder.$name.'</strong></li>';
		}
	}
}
echo '</ol>';

function create_folder( $directory_name ){
	
	if(!(is_dir( $directory_name ))){
		echo '<li>Creating Folder: <strong>'.$directory_name.'</strong></li>';
		$oldumask = umask(0);
		
		mkdir(( $directory_name ),0755);
		
		umask( $oldumask );
	}
	
	//Folder URL
	return $directory_name;
}
/*
owl/owl.carousel.css:
owl/owl.theme.css: 
bxslider/jquery.bxslider.css:
revolution/css/layers.css:
revolution/css/settings.css:
video-popup/magnific-popup.css:
slick/slick.css:
slick/slick-theme.css:
video_player/css/mediaelementplayer.min.css:
jquery-ui/jquery-ui.css:
*/
?>