<?php

function getKolesa($url, $fileCookie)
{
    $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookie);  //В какой файл записывать
	//curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookie); // из какого файла читать
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result; 
        
}

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

function getAuthJavaScript($url, $fileCookieIn)
{
        $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieIn);  //В какой файл записывать
        //curl_setopt($ch, CURLOPT_VERBOSE, 1);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;    
    
}


function getMainPage($url, $fileCookieIn)
{
        $ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieIn);  //В какой файл записывать
	//curl_setopt($ch, CURLOPT_VERBOSE, 1);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieOut); // из какого файла читать
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;    
    
}


function printDebug($param) 
{
  echo "\n***********start*************************\n";
  echo $param;
  echo "\n************end*************************\n";
}

function postAuth($url, $idCreepy, $fileCookieIn, $fileCookieOut)
{
  $request = "email=vohulg@gmail.com&password=19791979&cookies=&rememberMe=1&id=".$idCreepy;
   $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
    //curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
    curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
    curl_setopt($ch, CURLOPT_POST, 1); // set POST method 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request); // add POST fields
    curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieIn);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieOut);
    curl_setopt($ch, CURLOPT_REFERER, "http://kolesa.kz/passport/login");
    curl_setopt($ch,CURLOPT_HTTPHEADER,array('Origin: http://kolesa.kz'));
    $result = curl_exec($ch); // run the whole process 
    curl_close($ch);   
}

function postCreate($url,$fileCookieCreateIn, $fileCookieCreateOut)
{
      
    $boundary = '--192278645511';
    $data = array('cat' => 'spare.parts', 
        'uuid' => '', 
        'das[spare.name]'=>'Стекло',
        'das[text]'=> 'все запчасти на прадо',
        'das[multiple.select]' => '{"cars":{"96":{"title":"Toyota","data":{"110":{"title":"Land Cruiser 70","data":{"1":{"title":"<span class=\"generation-years\">1984&nbsp;&mdash;&nbsp;н. в.</span>&nbsp;&nbsp; ","data":{}}}}}}},"engines":{"96":{}}}',
        'das[region.list]' => '1',
        'das[map.lat]' => '',
        'das[map.lon]' => '',
        'das[map.zoom]' => '12',
        'das[map.name]' => '',
        'das[map.type]' => '',
        'file[]' => '',
        '_phones[0][cCode]' => '+7',
        '_phones[0][code]' => '707',
        '_phones[0][number]' => '7893057',
        'das[email]' => 'vohulg@gmail.com',
        'das[comments_allowed_for]' => '2',
        'das[has_change]' => '0',       
        
        );
    $body = multipart_build_query($data, $boundary);
    
    printDebug($body);
    
       
    
    /*
     cat	spare.parts
id	
uuid	
das[spare.name]	Зеркало на прадо
das[text]	зеркало на прадо 78 левое
das[multiple.select]	{"cars":{"96":{"title":"Toyota","data":{"110":{"title":"Land Cruiser 70","data":{"1":{"title":"<span class=\"generation-years\">1984&nbsp;&mdash;&nbsp;н. в.</span>&nbsp;&nbsp; ","data":{}}}}}}},"engines":{"96":{}}}
das[region.list]	1
das[region]	Алматы
das[map.lat]	
das[map.lon]	
das[map.zoom]	12
das[map.name]	
das[map.type]	
file[]	
_phones[0][cCode]	+7
_phones[0][code]	727
_phones[0][number]	3797592
_phones[1][cCode]	+7
_phones[1][code]	
_phones[1][number]	
_phones[2][cCode]	+7
_phones[2][code]	
_phones[2][number]	
das[email]	vohulg@gmail.com
das[comments_allowed_for]	2
das[has_change]	0
     */
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data; boundary=$boundary"));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieCreateIn);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieCreateOut);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);   
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable
    //curl_setopt($ch,CURLOPT_HTTPHEADER,array('Cookie:lastMapLand=yamap'));
    //curl_setopt($ch,CURLOPT_HTTPHEADER,array('Referer: http://kolesa.kz/a/new?cat=spare.parts'));
    $response = curl_exec($ch);
    curl_close($ch); 
    return $response;
    
}

function multipart_build_query($fields, $boundary){
$retval = '';
foreach($fields as $key => $value)
    {
        if ($key == 'file[]')
            $retval .= "$boundary\r\nContent-Disposition: form-data; name=\"$key\";filename=''\r\nContent-Type: application/octet-stream\r\n\r\n$value\r\n";
        
        else 
            $retval .= "$boundary\r\nContent-Disposition: form-data; name=\"$key\"\r\n\r\n$value\r\n";
    }
$retval .= "--$boundary--";
return $retval;
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

function getTimeout($url, $fileCookieIn, $fileCookieOut )
{
     $ch = curl_init(); 
	 curl_setopt($ch, CURLOPT_HEADER, true);
       curl_setopt($ch, CURLOPT_REFERER, "http://kolesa.kz/passport/login");
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
		//curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
        curl_setopt($ch, CURLOPT_ENCODING,"gzip, deflate"); 
          curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieIn);
	//curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieOut);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;       
    
}

function getCreateNew($url, $fileCookieNewIn, $fileCookieNewOut )
{
    $ch = curl_init(); 
	 curl_setopt($ch, CURLOPT_HEADER, true);
       	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
        //curl_setopt($ch, CURLOPT_ENCODING,"gzip, deflate"); 
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieNewIn);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieNewOut);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;  
    
    
}

function getCreateSpare($url, $fileCookieCreateNewIn, $fileCookieCreateNewOut )
{
    $ch = curl_init(); 
	 curl_setopt($ch, CURLOPT_HEADER, true);
       	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
        curl_setopt($ch, CURLOPT_ENCODING,"gzip, deflate"); 
          curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, $fileCookieCreateNewIn);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $fileCookieCreateNewOut);
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;  
    
}