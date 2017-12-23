<?php
/**
 * Created by PhpStorm.
 * User: danhm
 * Date: 22-Dec-17
 * Time: 07:21 PM
 */
include 'libs/Curl/Curl.php' ;
include 'libs/Curl/CaseInsensitiveArray.php' ;
include 'libs/Curl/Url.php' ;
include 'libs/Curl/StrUtil.php' ;
include 'libs/DiDom/Document.php' ;
include 'libs/DiDom/Query.php' ;
include 'libs/DiDom/Encoder.php' ;
include 'libs/DiDom/Errors.php' ;
include 'libs/DiDom/Element.php' ;


//include 'libs/Curl/Curl.php' ;


use Curl\Curl ;
use DiDom\Document ;

//$url = 'https://www.thegioididong.com/dtdd#i:1' ;

$url = 'https://tiki.vn/' ;
//$url = 'https://www.lazada.vn/dien-thoai-di-dong/?spm=a2o4n.home.cate_1_1.2.1ca59ba8XgcqPZ' ;
if(get_data($url , $content)){

//    echo htmlspecialchars($content) ;
//    echo get_name($content) ;
    get_content($content) ;
} else {
     ;
}


function get_name($content){
    $name ='' ;
    $var = '';

    $dom = new Document() ;
    $dom->load($content) ;
    $listName = $dom->find('h3');
//    var_dump($name) ;
    foreach ($listName as $namee){
        $name = $name .   $namee->text() ;
    }
    return $name  ;
}

function get_content($content){
    $document = new Document() ;
    $document->load($content) ;


//    THEGIOIDIDONG
//    $listItem = $document->find('li');
//    foreach ($listItem as $item){
//        if($item->has('h3') && $item->has('strong') && $item->has('img')) {
//            $name = $item->find('h3')[0] ;
//            echo $name . PHP_EOL ;
//
//            $price = $item->find('strong')[0] ;
//            echo $price . PHP_EOL ;
//
//            $img = $item->find('img')[0]->attr('src') ;
//            echo $img . PHP_EOL ;
//        }
//    }


    $listItem = $document->find('div[class=product-item]');
    foreach ($listItem as $item){
        if(true) {
            var_dump($item) ;
        }
    }

//    var_dump($listItem) ;
}



function download_file($url , $path){
    $curl =new Curl() ;
    echo 'Start download: '.$url .PHP_EOL ;

    $curl->setConnectTimeout(60) ;
    $curl->setTimeout(60) ;
    $curl->setOpt(CURLOPT_ENCODING , '') ;
    $curl->setOpt(CURLOPT_PROXY , '125.212.207.121:3128') ;

    $result = $curl->download($url , $path) ;
    if($result){
        echo 'Start download: '.$url ."[Success]".PHP_EOL ;
    } else {
        echo 'Start download: '.$url ."[Failed]".PHP_EOL ;

    }

    $curl->close() ;
}

function get_data($url , &$content){
    $curl  = new Curl() ;

    echo 'Start craw:' . $url . PHP_EOL ;

    $curl->setConnectTimeout(60) ;
    $curl->setTimeout(60) ;

    $curl->get($url) ;

    if(!$curl->error){
        $content = $curl->response ;
//        echo 'Start craw:' . $url . "[SUCCESS]". PHP_EOL ;
    } else {
        echo 'Start craw:' . $url . "[FAILED]". PHP_EOL ;
        echo $curl->errorMessage ;
    }
    $curl->close() ;

    return !$curl->error  ;
}