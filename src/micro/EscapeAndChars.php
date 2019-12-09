<?php
namespace microframework\Escape;


class UrlEscpapeAndChars{



public function ProtectFileUrl($str)
{
	$str = self::secure($str);
	$str = trim($str);
	$str=htmlentities($str, ENT_QUOTES, 'utf-8', FALSE);
	$str=mb_convert_encoding($str,"ISO-8859-7","UTF-8");
	return	$str;
}




public function ProtectUrl($str)
{
	$str = self::escape($str);
	$str = trim($str);
	return	$str;
}





public function escape($str)
{
	$search=array("\\","\0","\n","\r","\x1a","'",'"'," ","*");
	$replace=array("\\\\","\\0","\\n","\\r","\Z","\'",'\"',"","");
	return str_replace($search,$replace,$str);
}


public function secure($str)
{
	$search=array("*","?"," ","'","@","#","!",".php",".html",".htm");
	$replace=array("","","","","","","","","");
	return str_replace($search,$replace,$str);
}


public function secure_allow_space($str)
{
	$search=array('\\',"*","$","?","'","@","#","!",".php",".html",".htm","/",'&',"%","=","-");
	$replace=array("","","","","","","","","","","","",'','','','');
	return str_replace($search,$replace,$str);
}





public function daysLeft($EndedRequestDate){

	$datysText ='';
	$current_date = new DateTime(date('Y-m-d H:i:s'), new DateTimeZone('Europe/Athens'));
                //$EndedRequestDate = $TravellerRequestData['requerstAllowedTo'];   
	$end_date = new DateTime($EndedRequestDate, new DateTimeZone('Europe/Athens'));
   // echo "$current_date  ||   $end_date <br>";


	$interval = $current_date->diff($end_date);
                $daysleft =  $interval->format('%a'); //%S
                $Hoursleft =  $interval->format('%H'); //%S
                    $Minsleft =  $interval->format('%i'); //%S
                    // echo "$daysleft $Hoursleft    $Minsleft<br>";
                    // print_r($interval);
                    // $datetime1 = new DateTime('2009-10-11');
                    // $datetime2 = new DateTime('2009-10-13');
                    // $interval = $datetime1->diff($datetime2);
                    // $interval = $current_date->diff($end_date);
                    // echo $interval->format("%H:%I:%S");
                    // echo $interval->format('%R%a days');

                    if ($Hoursleft > 1  || $Hoursleft == 00) { 
                    	$Hoursleft = $Hoursleft.' <span class="l_hours"> ώρες</span>';
                    }else{
                    	$Hoursleft = $Hoursleft.' <span class="l_hours"> ώρα</span>';
                    }

                    if ($daysleft > 1 ) { 
                    	$daysleft = $daysleft.' <span class="l_days"> Ημέρες</span>';
                    }else{
                    	$daysleft = $daysleft.' <span class="l_day"> Ημέρα</span>';
                    }

                    $datysText= ' '.$daysleft.' '.$Hoursleft.'';
                // if ($daysleft!=0){ 
                //  $daysleft = $daysleft.' Ημέρες ';  
                //  $datysText= ' ('.$daysleft.$Hoursleft.')';
                // }else{ 
                //  $daysleft = '';
                // }


                    if ($daysleft > 30){ 
                    // $daysleft = '30d +'; $Hoursleft=''; 
                    // $datysText = ' ('.$daysleft.$Hoursleft.')';
                    }

                    return $datysText;
                }


	   /**
     * Sanitize URL from PHP_SELF
     *
     * This next function sanitizes the output from the PHP_SELF server variable. It is a modificaton of a function of the same name used by the WordPress Content Management System:
     * The trouble with using the server variable unfiltered is that it can be used in a cross site scripting attack. 
     * Most references will simply tell you to filter it using htmlentities(), however even this appears not to be sufficient hence the belt and braces approach in this function.
     * Others suggest leaving the action attribute of the form blank, or set to a null string. Doing this, though, leaves the form open to an iframe clickjacking attack.
     * http://blog.andlabs.org/2010/03/bypassing-csrf-protections-with.html
     * @access  public
     * @param   string
     * @return  bool
     */



	   public function esc_url($url) {

	   	if ('' == $url) {
	   		return $url;
	   	}

	   	$url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);

	   	$strip = array('%0d', '%0a', '%0D', '%0A');
	   	$url = (string) $url;

	   	$count = 1;
	   	while ($count) {
	   		$url = str_replace($strip, '', $url, $count);
	   	}

	   	$url = str_replace(';//', '://', $url);

	   	$url = htmlentities($url);

	   	$url = str_replace('&amp;', '&#038;', $url);
	   	$url = str_replace("'", '&#039;', $url);

	   	if ($url[0] !== '/') {
        // We're only interested in relative links from $_SERVER['PHP_SELF']
	   		return '';
	   	} else {
	   		return $url;
	   	}
	   }




	   public function escapegr($str)
	   {
	   	$search=array('α',"β","γ","δ","ε","ζ",'η',"θ","ι","κ","λ","μ","ν","ξ","ο","π","ρ","σ","τ","υ","φ","χ","ψ","ω");
                //$replace=array("","","","","","",'',"","","","","","","","","","","","","","","","","");
               // return str_replace($search,$replace,$str);
			   //if (in_array($str, $search))	   
			 // if (strpos_array($str, $search))
			  // 		return false;


	   }

	   public function escapegrkaps($str)
	   {
	   	$search=array('Α',"Β","Γ","Δ","Ε","Ζ",'Η',"Θ","Ι","Κ","Λ","Μ","Ν","Ξ","Ο","Π","Ρ","Σ","Τ","Υ","Φ","Χ","Ψ","Ω");
	   	$replace=array("","","","","","",'',"","","","","","","","","","","","","","","","","");
                //return str_replace($search,$replace,$str);
	   	if (in_array($str, $search))   		
	   		return false;

	   }


	   static function explode_trim($str, $delimiter = '/') {
//remove trailing slashes in URLs with PHP
	   	$str = rtrim($str,"/");
	   	if ( is_string($delimiter) ) {
	   		$str = trim(preg_replace('|\\s*(?:' . preg_quote($delimiter) . ')\\s*|', $delimiter, $str));
	   		return explode($delimiter, $str);
	   	}
	   	return $str;
	   } 

	   //list($actions, $candyprice)= array_pad(explode("/", $_GET["size"]),2,null);






	   static function get_ext($key) { 
	   	$key=strtolower(substr(strrchr($key, "."), 1));
		//convert jpeg to jpg. 
	   	$key=str_replace("jpeg","jpg",$key);   
	   	return($key); 
	   }



	}

	?>