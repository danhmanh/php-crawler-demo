<?php
/**
 * Created by PhpStorm.
 * User: danhm
 * Date: 20-Dec-17
 * Time: 11:21 AM
 */

//Disable warning text
error_reporting(E_ERROR) ;
set_time_limit(10) ;
$url = "https://mp3.zing.vn/"  ;
$proxy = trim(file_get_contents("proxy.txt")) ;

function getData($url , $proxy = null , $proxyType = null ){
    $curl = curl_init() ;

    curl_setopt($curl , CURLOPT_URL , $url) ;

    // Disable auto echo
    curl_setopt($curl , CURLOPT_RETURNTRANSFER , true) ;
    //curl_setopt($curl , CURLOPT_BINARYTRANSFER , 1) ;

    //Set user agent , fake browser
    curl_setopt($curl , CURLOPT_USERAGENT , "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/66.4.134 Chrome/60.4.3112.134 Safari/537.36") ;

    curl_setopt($curl , CURLOPT_TIMEOUT , 20) ;
    curl_setopt($curl , CURLOPT_CONNECTTIMEOUT , 20) ;
    curl_setopt($curl , CURLOPT_REFERER , "https://www.google.com" ) ;
    curl_setopt($curl , CURLOPT_ENCODING , '') ;
    curl_setopt($curl , CURLOPT_FOLLOWLOCATION , true) ;
    curl_setopt($curl , CURLOPT_MAXREDIRS , 5) ;


    //Proxy
    if(checkProxyLive($proxy) && isset($proxy)){
        curl_setopt($curl , CURLOPT_PROXY , $proxy) ;

        if(isset($proxyType)){
            curl_setopt($curl , CURLOPT_PROXYTYPE , $proxyType) ;
        }
    }




    $result = curl_exec($curl) ;

    curl_close($curl) ;
    return $result ;

}

function checkProxyLive($proxy){
    $waitTimeoutSeconds = 1 ;
    $proxySplit = explode( ":" , $proxy) ;
    $ip = $proxySplit[0] ;
    $port = $proxySplit[1] ;

    $result = false ;

    if($ip = fsockopen($ip , $port , $errCode , $errStr , $waitTimeoutSeconds )){
        $result = true ;
        fclose($ip) ;
    } ;

    return $result ;
}

echo getData($url , $proxy , "HTTP" ) ;
