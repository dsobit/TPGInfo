<?php

function getweather(){
    $url = "http://ilm.ee/sisu/2015/json_linnailm.php3?linn=L*tallinn*0";
    $json = file_get_contents($url);
    $jsondata = json_decode($json, True);

    for ($i = 0; $i < 5; $i++){
        $temp = $jsondata["NOAA"][$i]["temp"];
        $date = $jsondata["NOAA"][$i]["date"];

        $formatedTemp = $text = str_replace(" .. ", ' - ', $temp);
        $formatedDate = date("d.m.Y", strtotime($date));

        $data [$i][0]=  ($formatedTemp);
        $data [$i][1]=  ($formatedDate);
        $data [$i][2]=  ($jsondata["NOAA"][$i]["sumpilv"]);
    }
    print_r($data);
    return $data;
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
