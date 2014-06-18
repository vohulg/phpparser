<?php
include 'func.php';

//unlink("php_errors.log");
unlink("cookieTimeout.txt");
unlink("cookiePassportIn.txt");
unlink("cookieCreepy.txt");

$fileCookieIn = "cookiePassportIn.txt";
$fileCookieOut = "cookiePassportOut.txt";

// ---------первый запрос ---------------------------//
$url = "http://kolesa.kz/passport/login";
$str = getMainPage ($url, $fileCookieIn );

/*
$text = file_get_contents($fileCookieIn);
$array = explode("\n", $text);
$newstr = '';
for ($i=0; $i < 5; $i++)
  $newstr .= $array[$i]."\n"; 
file_put_contents($fileCookieIn, $newstr);
 * */
 


//--- отправляем второй запрос на http://id.creepycrux.com/auth.js?r=5312
$url = get_creepRequestUrl($str);
printDebug($url);
$fileCookie = "cookieCreepy.txt";
getAuthJavaScript ($url, $fileCookie);
$str = file_get_contents($fileCookie);
$idCreepy = get_id($str);

printDebug("idCreepy:".$idCreepy);


// -----третий post запрос на авторизацию--------------------//
$url = "http://id.creepycrux.com/login.json";
$fileCookieIn = "cookieAuthIn.txt";
$fileCookieOut = "cookieCreepy.txt";
$res = getAuth ($url, $idCreepy, $fileCookieIn, $fileCookieOut);
//------------------------------------------------//

// ---- четвертый промежуточный запрос на получение kluid -----//
//http://kolesa.kz/my?sessId=jasjobuf5mfubfkqihcvpei3q6&sessTimeout=31536000
$str = file_get_contents($fileCookie);
$id = get_id($str);
printDebug("idforTimeOut:".$id);
$url = "http://kolesa.kz/my?sessId=".$id."&sessTimeout=0";
printDebug("urlTimeout:".$url);
$fileCookieIn = "cookieTimeout.txt";
$fileCookieOut = "cookiePassportIn.txt";
$res = getTimeout($url, $fileCookieIn, $fileCookieOut );
//printDebug("getTimeout:".$res);



return;

// ----- запрос на получение web страницы профиля ------- //

$url = "http://kolesa.kz/my";
$res = getProfile($url, $fileCookieIn);

printDebug($res);