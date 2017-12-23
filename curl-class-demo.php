<?php
/**
 * Created by PhpStorm.
 * User: danhm
 * Date: 21-Dec-17
 * Time: 11:58 PM
 */

set_time_limit(0) ;

//include 'libs/Curl/CaseInsensitiveArray.php' ;
//include 'libs/Curl/Curl.php' ;
//include 'libs/Curl/MultiCurl.php' ;

include 'php-curl-class/src/Curl/Curl.php' ;
include 'php-curl-class/src/Curl/CaseInsensitiveArray.php' ;
include 'php-curl-class/src/Curl/Url.php' ;
include 'php-curl-class/src/Curl/StrUtil.php' ;



use \Curl\Curl ;


$url = $_GET['url'] ;
//$url = "https://stackoverflow.com/" ;
if(getData($url)){
    //Get source
    preg_match( '#<audio data-html5-video="" autoplay="" src="(.+?)" id="zplayerjs1"#',$html ,  $matches) ;
    var_dump($matches) ;

}

echo htmlspecialchars(getData($url)) ;

function getData($url){
    $curl = new Curl() ;
    $html = $curl->get($url) ;
    $curl->setOpt(CURLOPT_ENCODING , '') ;
    $flag = false ;

    if($curl->error){
        echo "Error:" . $curl->errorMessage ;
    } else {
        echo $curl->response ;
        $flag = true ;
    }
    $curl->close() ;

    return $flag ;

}



