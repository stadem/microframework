<?php
namespace microframework\Creator;

use \microframework\Escape\UrlEscpapeAndChars;
use \microframework\Controler\UrlControler;

class UrlCreator{

	public $module;
	public $action;


	public function setModule($module){
		$this->module = $module;
	}


	public function setAction($action){
		$this->action = $action;
	}


	public function getModule(){
		return $this->module;
	}


	public function getAction(){
		return $this->action;
	}

	// $Protect = new UrlEscpapeAndChars();

	public function UrlCreator($module){
		// echo $module;
		$Protect = new UrlEscpapeAndChars();
		$items = $Protect->explode_trim($module);
		$CountItems = count($items);

		$item0 = (isset($items[0])) ? $Protect->ProtectFileUrl($items[0]) : '';
		$item1 = (isset($items[1])) ? $Protect->ProtectFileUrl($items[1]) : '';

		if($CountItems == 1){
			$main= 'pages';
			$action= $item0;
			self::loadPage($main,$action);
		}

		if($CountItems == 2){
			if($item0 === 'p'){self::loadFilename('website_views/pages/layout/places.php');
		}else{		
			$mod = $item0;
			$action= $item1;	
			self::loadFilename('website_views/pages/layout/'.$mod.'/'.$action.'.php');		
		}

	}

	if($CountItems > 2){
		self::loadPage('common',"404");
		die(); 
	}

	return $items;

}



public function UrlCreatorCheck($module){
		// echo $module;
	$Protect = new UrlEscpapeAndChars();
	$items = $Protect->explode_trim($module);
	$CountItems = count($items);
	$mod = "";
	$action= "";

	$item0 = (isset($items[0])) ? $Protect->ProtectFileUrl($items[0]) : '';
	$item1 = (isset($items[1])) ? $Protect->ProtectFileUrl($items[1]) : '';

	if($CountItems == 1){
		$main= 'pages';
		$action= $item0;
	}

	if($CountItems == 2){
		if($item0 === 'p'){

		}else{		
			$mod = $item0;
			$action= $item1;
		}

	}

	if($CountItems > 2){
		die();
	}

	return array('CountItems' => $CountItems, 'action' =>$action , 'module' =>$mod);

}















public function loadPage($module,$action){

	$filename = ($module==='common') ? 'website_views/common/'.$action.'.php':
	'website_views/'.$module.'/layout_single/'.$action.'.php';

	// self::setModule($module);
		// echo "<br> [$module] [$action] [$filename]<hr>";
	if (file_exists($filename)) {
		require($filename);
	}else{
			// $data  = array(	
			// 	"Type"=>"system",
			// 	"Status"=>'normal',
			// 	"Page" => "controler",
			// 	"LogMessage"=>"HTTP/1.1 404 Not Found ".json_encode($_REQUEST),
			// 	"Referer"=>$_SERVER['PHP_SELF']
			// );
			// $GetReq = @CallApiLogManager($data);
			// header('HTTP/1.1 404 Not Found');
		self::loadPage('common',"404");
		die();
	}
}



public function loadFilename($filename){
	if (file_exists($filename)) {
		require($filename);
	}else{
			// $data  = array(	
			// 	"Type"=>"system",
			// 	"Status"=>'normal',
			// 	"Page" => "controler",
			// 	"LogMessage"=>"HTTP/1.1 404 Not Found ".json_encode($_REQUEST),
			// 	"Referer"=>$_SERVER['PHP_SELF']
			// );
			// $GetReq = @CallApiLogManager($data);
			// header('HTTP/1.1 404 Not Found');
		self::loadPage('common',"404");
		die ();
	}
}




}

?>