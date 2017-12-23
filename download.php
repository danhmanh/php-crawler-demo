<?php
/**
 * Created by PhpStorm.
 * User: danhm
 * Date: 21-Dec-17
 * Time: 01:12 PM
 */


$result = download_file("https://kenh14cdn.com/2017/640-2-1513607595163.jpg" , "data/img1.jpg") ;
if(empty($result)){
    echo "Download success" ;
} else {
    echo "Error:" . $result ;
}
function download_file($url , $path) {
    $f = fopen($path , 'w') ;

    $ch = curl_init($url) ;

    curl_setopt($ch , CURLOPT_FILE , $f) ;
    curl_setopt($ch , CURLOPT_TIMEOUT , 28800) ;

    curl_exec($ch) ;
    $e = curl_error($ch) ;
    curl_close($ch) ;
    fclose($f) ;

    return $e  ;
}