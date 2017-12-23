<?php
/**
 * Created by PhpStorm.
 * User: danhm
 * Date: 22-Dec-17
 * Time: 12:40 AM
 */
$data = "This is aaaaaan 123 angry 0903 string" ;

//$pattern = "/[0-9]+/" ;

$pattern = "/[a-zA-Z]+/" ;
if(preg_match_all($pattern  , $data , $result )){
    var_dump($result) ;
    echo "True" ;
} else {
    echo "False" ;
}