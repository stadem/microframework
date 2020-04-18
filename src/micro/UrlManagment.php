<?php
namespace microframework\Tools;

class UrlManagment{

	public function whitelistIPs($ips){
		/*
		$whitelist = $ips;
		if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
			if(empty($_SERVER['HTTP_X_FORWARDED_PROTO']) || $_SERVER['HTTP_X_FORWARDED_PROTO'] == "http"){
				$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	// header('HTTP/1.1 301 Moved Permanently');
				// echo $redirect;
				header('Location: ' . $redirect);
				exit();
			}

		}*/
	}


	public function EnableHttpS(){	
			if(empty($_SERVER['HTTP_X_FORWARDED_PROTO']) || $_SERVER['HTTP_X_FORWARDED_PROTO'] == "http"){
				$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	// header('HTTP/1.1 301 Moved Permanently');
				// echo $redirect;
				header('Location: ' . $redirect);
				exit();
			}
	}

	public function removeWWW(){
		$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		$url = trim($url, '/');
		if (strpos($url, 'www.') !== false) {
			$url = str_replace('www.', '', $url);
		// echo "$url";
		// die();
		// header('Location: https://ngreece.com');
			header('Location: '.	$url);
			exit();		
		}

	}

	public function isLocal($urls){
		// print_r($urls);

		// $is_local = (
		// 	$_SERVER["HTTP_HOST"]=="127.0.0.1" ||
		// 	$_SERVER["HTTP_HOST"]=="localhost" ||
		// 	$_SERVER["HTTP_HOST"]=="192.168.2.5" ||
		// 	$_SERVER["HTTP_HOST"]=="192.168.2.4" ||
		// 	$_SERVER["HTTP_HOST"]=="192.168.2.3" ||
		// 	$_SERVER["HTTP_HOST"]=="192.168.1.5" 
		// );

		$url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


		$is_beta = 0;
		$is_online = 0;
		$is_local = 0;
		$doc_root = '';

		if (@strpos($_SERVER['SERVER_NAME'],$urls[0]) !== false) { 
			$is_local = 1;
		}


		if (@strpos($url,$urls[1]) !== false) { 
			$is_beta = 1;
			$doc_root = $urls[1].'/';
		}

		if (@strpos($url,$urls[2]) !== false) { 
			$is_online = 1;
			$doc_root = $urls[2].'/';
		}


		$return=array('is_local' => $is_local ,'is_beta' =>$is_beta  ,'is_online' =>$is_online,'doc_root' =>$doc_root);
		return($return);

	}




}

?>