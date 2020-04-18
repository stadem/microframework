<?php
namespace microframework\Controler;

use \microframework\Escape\UrlEscpapeAndChars;
use \microframework\Creator\UrlCreator;

class UrlControler{

	public $module;
	
	public function setModule($module){
		$this->module = $module;
	}

	public function getModule(){
		return $this->module;
	}


	public function GetUrls(){		
		$Protect = new UrlEscpapeAndChars();
		$UrlCreator = new UrlCreator();

		$module = (isset($_GET['module'])) ? $Protect->ProtectUrl($_GET['module']) : 'welcome';
		$image = (isset($_GET['image'])) ? $Protect->ProtectUrl($_GET['image']) : '';
		$file = (isset($_GET['file'])) ? $Protect->ProtectUrl($_GET['file']) : '';
		if($module){
			$UrlCreator = $UrlCreator->UrlCreatorCheck($module);
		}


		return $UrlCreator;

	}


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
			// $mymod= self::returnpaths($module);
			// self::setModule($mymod);
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


	public function returnpaths(){


		// $UrlCreator = new UrlCreator();
		// $module = self::getModule();
		// $UrlCreator = $UrlCreator->UrlCreatorCheck($module);

		// return $UrlCreator;
		// return 
		// $module = self::getModule();
		// echo "$module";

		// echo self::getModule();

		// echo ' '.$module .' ' .$action ;

		return  array('module'=>'test','action'=>'t');
	}





}

?>