<?php

// ----------- block for tsting------------------//

//$str = file_get_contents("result.htm");
//$js = json_decode($str, true);
//$str = $js["list"][0]["text"];
//$rs = html_entity_decode(str_replace('\u','&#x',$str), ENT_NOQUOTES,'UTF-8'); // коныертирет символы юникода в строк

//var_dump($js);

//get_str ();
foo_imap();
return 1;

// ----------- block for tsting------------------//

$fd = fopen("result.htm", "w+");

$url = "http://e.mail.ru/cgi-bin/auth"; 
 authorization ($url);
   
 $url = "https://e.mail.ru/agent/archive";
 $rs = get_agent_list($url);
 
 
 $url = "https://webarchive.mail.ru/iframe?history_enabled=1";
 $rs = get_hash($url);
 
 $hash = get_str ($rs);
 
 $url = "https://webarchive.mail.ru/ajax/dialog?opponent_email=night_post%40mail.ru&message_id=&sort=desc&".$hash;
 //echo $url;
 
 $rs = get_agent_msg ($url);
 //$rs = utf8_encode($rs);
 fwrite($fd, $rs);
 
 //var_dump(json_decode($rs));
  
 function get_str ($str)
{
  //$str = file_get_contents("result.htm");
  $pattern = '/hash:\s"[0-9a-z]+"/';
   preg_match($pattern, $str, $match);
   $tmp = str_replace('"', '', $match[0]);
   $tmp =  str_replace('hash: ', 'hash=', $tmp);
   return $tmp;
  

} 
 
 function foo_imap()
 {
	 $server = "{imap.mail.ru:143}";
	 $folder = "INBOX";
	 $user = "testov-79@mail.ru";
	 $pass = "testtest";
	 
	 $conn = imap_open($server.$folder, $user, $pass);
	 	if ($conn) echo 'Successful'; else {echo 'Failed'; die;}

	$mails = imap_search($conn, 'ALL');
	
	$first = $mails[2];
	
	$struct = imap_fetchstructure($conn, $first);
	
	$message = array();
	$header = imap_header($conn, $first);
	//var_dump($header);
   

   $message['subject'] = $header->subject;
   $elements = imap_mime_header_decode($message['subject']);
   
   for ($i=0; $i<count($elements); $i++) {
    echo "Charset: {$elements[$i]->charset}\n";
    echo "Text: {$elements[$i]->text}\n\n";
}

//$structure = imap_fetchstructure($mbox, $messageid);
   
   
   
	
	
	
	return 1;
	 
	 //---------------------------------
	 
	 $tmp = fopen("imap.txt", "w+");
	 
	 $mbox = imap_open("{imap.mail.ru}", "testov-79@mail.ru", "testtest", OP_HALFOPEN)
		  or die("can't connect: " . imap_last_error());

	$list = imap_list($mbox, "{imap.mail.ru}", "*");
	//print_r($list);
	
	if (is_array($list)) {
		foreach ($list as $val) 
		{
			$tmp1 = mb_convert_encoding($val,"UTF-8", "UTF7-IMAP");
			//echo $tmp1;
			//fwrite($tmp, $tmp1);
		}
	} else {
		echo "imap_list failed: " . imap_last_error() . "\n";
}

 imap_close($mbox);
 
//--------------------------------



return 1;
echo "Headers in INBOX\n";
$headers = imap_headers($mbox);

if ($headers == false) {
    echo "Call failed<br />\n";
} else {
    foreach ($headers as $val) {
        echo $val . "<br />\n";
    }
}

//-----------------------------

 
  imap_close($mbox);
 
 }
 
 
 
 //------------------------------------------------------------//
 
 function get_agent_msg ($url)
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
	//curl_setopt($ch, CURLOPT_COOKIEJAR, '/cookie2.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookie.txt');
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;
	
}
 
 
 
 function get_hash ($url)
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
	//curl_setopt($ch, CURLOPT_COOKIEJAR, '/cookie2.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookie.txt');
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	$result = strip_tags($result);
	return $result;
	
}

function authorization ($url) {
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_URL,$url); // set url to post to 
	curl_setopt($ch, CURLOPT_FAILONERROR, 1); 
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// allow redirects 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable 
	curl_setopt($ch, CURLOPT_TIMEOUT, 10); // times out after 4s 
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_POST, 1); // set POST method 
	curl_setopt($ch, CURLOPT_POSTFIELDS, "Login=testov-79&Domain=mail.ru&Password=testtest"); // add POST fields 
	curl_setopt($ch, CURLOPT_COOKIEJAR, '/cookie.txt');
	$result = curl_exec($ch); // run the whole process 
	
	curl_close($ch); 
	
	return $result;
}

function get_agent_list ($url)
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
	curl_setopt($ch, CURLOPT_COOKIEJAR, '/cookie2.txt');
	curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookie.txt');
	$result = curl_exec($ch); // run the whole process 
	curl_close($ch); 
	return $result;
	
}





 
 
 
 
 
 /*
 $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

   // откуда пришли на эту страницу
   //curl_setopt($ch, CURLOPT_REFERER, $url);
   //запрещаем делать запрос с помощью POST и соответственно разрешаем с помощью GET
   //curl_setopt($ch, CURLOPT_POST, 0);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   //отсылаем серверу COOKIE полученные от него при авторизации
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookie.txt');
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");
	curl_setopt($ch, CURLOPT_COOKIEJAR, '/cookie2.txt');
   $result = curl_exec($ch);
   
   print_r(curl_getinfo($ch));  
echo "\n\ncURL error number:" .curl_errno($ch);  
echo "\n\ncURL error:" . curl_error($ch); 

   curl_close($ch);
  
 $url = "http://www.mail.ru/agent?message&to=night_post@mail.ru";
 $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);

   // откуда пришли на эту страницу
   //curl_setopt($ch, CURLOPT_REFERER, $url);
   //запрещаем делать запрос с помощью POST и соответственно разрешаем с помощью GET
   //curl_setopt($ch, CURLOPT_POST, 0);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   //отсылаем серверу COOKIE полученные от него при авторизации
   curl_setopt($ch, CURLOPT_COOKIEFILE, '/cookie2.txt');
   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (Windows; U; Windows NT 5.0; En; rv:1.8.0.2) Gecko/20070306 Firefox/1.0.0.4");

   $result = curl_exec($ch);
   
   
  */ 
 

 

//echo $result;  

?>