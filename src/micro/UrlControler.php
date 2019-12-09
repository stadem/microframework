<?php
namespace microframework\Controler;

use \microframework\Escape\UrlEscpapeAndChars;
use \microframework\Creator\UrlCreator;

class UrlControler{

	public function UrlControl(){
		// echo " ".$_GET['module'];
		$Protect = new UrlEscpapeAndChars();
		$UrlCreator = new UrlCreator();
		// $UrlCreator

		$module = (isset($_GET['module'])) ? $Protect->ProtectUrl($_GET['module']) : '';
		$image = (isset($_GET['image'])) ? $Protect->ProtectUrl($_GET['image']) : '';
		$file = (isset($_GET['file'])) ? $Protect->ProtectUrl($_GET['file']) : '';


		# PAGE  ... test on /page/action
		if($module){		
			// $UrlCreator = new UrlCreator($module);
			$UrlCreator = $UrlCreator->UrlCreator($module);
			die();


		# IMAGE  ... test on /img/myfile.jpg
		}else if($image){ 

			$UrlCreator = $UrlCreator->UrlCreator($module);
			die('image');

	# FILE  ... test on /file/myfile.pdf
		}else if($file){			

			$UrlCreator = $UrlCreator->UrlCreator($module);
			die('file');

		}else{
			
			$UrlCreator = $UrlCreator->loadPage('pages','welcome');
			die();
		}
	}









}

?>