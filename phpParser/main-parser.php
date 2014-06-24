<?php
include 'func.php';

//----- обнуление файлов для ранения куков и логов ошибок -----//

if (file_exists("php_errors.log"))
        unlink("php_errors.log");

if (file_exists("cookieTimeout.txt"))
        unlink("cookieTimeout.txt");

if (file_exists("cookiePassportIn.txt"))
        unlink("cookiePassportIn.txt");

if (file_exists("cookieCreepy.txt"))
        unlink("cookieCreepy.txt");

if (file_exists("cookieTest.txt"))
        unlink("cookieTest.txt");

if (file_exists("cookieAuthIn.txt"))
        unlink("cookieAuthIn.txt");

//-------------------------------------------------------------//

$fileCookieIn = "cookiePassportIn.txt";
$fileCookieOut = "cookiePassportOut.txt";

// ---------первый запрос ------------------------------------//
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


// -----третий post запрос на авторизацию------------------------//
$url = "http://id.creepycrux.com/login.json";
$fileCookieTimeOutIn = "cookieAuthIn.txt";
$fileCookieTimeOutOut = "cookieCreepy.txt";
$res = postAuth ($url, $idCreepy, $fileCookieTimeOutIn, $fileCookieTimeOutOut);


// ---- четвертый промежуточный запрос на получение kluid -----//
//http://kolesa.kz/my?sessId=jasjobuf5mfubfkqihcvpei3q6&sessTimeout=31536000
$str = file_get_contents($fileCookie);
$id = get_id($str);
printDebug("idforTimeOut:".$id);
$url = "http://kolesa.kz/my?sessId=".$id."&sessTimeout=31536000";
printDebug("urlTimeout:".$url);
$fileCookieIn = "cookieTimeout.txt";
$fileCookieOut = "cookiePassportIn.txt";
$res = getTimeout($url, $fileCookieIn, $fileCookieOut );
//printDebug("getTimeout:".$res);



// -- переход на страниц создания обявления
$url = "http://kolesa.kz/a/new";
$fileCookieNewIn = "cookieTimeout.txt";
$fileCookieNewOut = "cookieTimeout.txt";
$res = getCreateNew($url, $fileCookieNewIn, $fileCookieNewOut );
file_put_contents("postNew.htm", $res);


// ---- переход на страницу заполнения полей
//http://kolesa.kz/a/new?cat=spare.parts
$url = "http://kolesa.kz/a/new?cat=spare.parts";
$fileCookieCreateNewIn = "cookieTimeout.txt";
$fileCookieCreateNewOut = "cookieTimeout.txt";
$res = getCreateSpare($url, $fileCookieCreateNewIn, $fileCookieCreateNewOut );
file_put_contents("postNewSpare.htm", $res);


// ---- post запрос на создание нового объявления

$url = "http://kolesa.kz/a/create";
$fileCookieCreateIn = "cookieCreateIn.txt";
$fileCookieCreateOut = "cookieTimeout.txt";
$res =   postCreate($url,$fileCookieCreateIn, $fileCookieCreateOut);
file_put_contents("postCreateResponse.htm", $res);


//$url = "http://kolesa.kz/a/new?cat=spare.parts";

//http://scraperblog.blogspot.com/2013/07/php-curl-multipart-form-posting.html - пример заполнения формы

