<?php

function getweather(){
    $url = "https://ilm.ee/sisu/2015/json_linnailm.php3?linn=L*tallinn*0";
    $jsondata = file_get_contents($url);
    print($jsondata);
}

function getnews(){

}

function getbus(){

}

function getasendused(){

}

function getmenu(){

}

function gettime(){

}

?>
