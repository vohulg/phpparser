<?php


function get_creepRequestUrl($str)
{
    //<script src="//id.creepycrux.com/auth.js?r=1846"></script>
    $pattern = '/id.creepycrux.com\/auth.js\?r\=[0-9]+/';
   preg_match($pattern, $str, $match); 
   var_dump($match);
   return $match[0];
    
}


function get_id($str)
{
   $pattern = '/sess_id\s[0-9a-z]+/';    
   preg_match($pattern, $str, $match);
   $tmp = str_replace('sess_id', '', $match[0]);
   $tmp = trim($tmp);
   return $tmp;    
    
}


function getMainPage($url, $fileCookie)
{
        $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookie);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookie);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;    
    
}


function printDebug($param) 
{
  echo "********************\n";
  echo $param;
  echo "\n********************\n";
}

function getAuth($url, $idCreepy, $fileCookie)
{
        
    $request = "email=vohulg@gmail.com&password=19791979&cookies=&rememberMe=1&id=".$idCreepy;
    printDebug($request);
    
    $ch = curl_init(); 
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
       
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_POST, 1); // set POST method 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // add POST fields
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookie);
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieOut);
	$result = curl_exec($ch); // run the whole process 
        curl_close($ch);
    
    
}


function getProfile($url, $fileCookieOut)
{
     $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieOut);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieOut);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;   
    
    
}

function getTimeout($url, $fileCookieIn )
{
     $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieIn);
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieIn);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;   
    
    
}
