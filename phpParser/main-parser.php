<?php
include 'func.php';

$fileCookie = "cookie.txt";
$url = "http://kolesa.kz/passport/login";
$str = getMainPage ($url, $fileCookie);
$url = get_creepRequestUrl($str);
printDebug($url);

$fileCookie = "cookieCreepy.txt";
getMainPage ($url, $fileCookie);
$str = file_get_contents($fileCookie);
$idCreepy = get_id($str);

printDebug("idCreepy:".$idCreepy);

// -----post запрос на авторизацию--------------------//
$url = "http://id.creepycrux.com/login.json";
$fileCookieIn = "cookieAuthIn.txt";
$fileCookieOut = "cookieAuthOut.txt";
$res = getAuth ($url, $idCreepy, $fileCookieIn);
//------------------------------------------------//

// ---- промежуточный запрос на получение kluid -----//
$str = file_get_contents($fileCookie);
$id = get_id($str);
printDebug("idforTimeOut:".$id);

//http://kolesa.kz/my?sessId=jasjobuf5mfubfkqihcvpei3q6&sessTimeout=31536000
$url = "http://kolesa.kz/my?sessId=".$id."&sessTimeout=31536000";
printDebug("urlTimeout:".$url);
$fileCookieIn = "cookieTimeout.txt";
getTimeout($url, $fileCookieIn );

return;




// ----- запрос на получение web страницы профиля ------- //

$url = "http://kolesa.kz/my";
$res = getProfile($url, $fileCookieIn);

printDebug($res);