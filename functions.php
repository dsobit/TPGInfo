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
        $data [$i][3] = selectimage($data [$i][2]);
        //$data [$i][3]=  selectimage("url(/tingmargid/2015/PrognoosiPilv.php3?P=2cloud_thunder");

    }
    return $data;
}

function selectimage($weatherstring){
    //print ($weatherstring);
    $weatherstring = str_replace(")", " ",
        substr(strstr($weatherstring,"?P="), 3));

    if($weatherstring[0] == "0"){
        $weathericon = "sunny.svg";
    }
    else{
        if(strpos($weatherstring, "norain") !== false){
            if($weatherstring[0] == "1") $weathericon = "cloud-3.svg";
            else if ($weatherstring[0] == "2") $weathericon = "cloud-2.svg";
            else if ($weatherstring[0] == "3") $weathericon = "cloud-1.svg";
            else $weathericon = "cloud.svg";
        }
        else if (strpos($weatherstring, "rain") !== false)
            $weathericon = "raining.svg";
        else if (strpos($weatherstring, "snow") !== false)
            $weathericon = "snowing.svg";
        else if (strpos($weatherstring, "hail") !== false)
            $weathericon = "storm.svg";
        else if (strpos($weatherstring, "thunder") !== false)
            $weathericon = "thunderstorm.svg";
        else $weathericon = "thermometer.svg";
    }
    return $weathericon;
}

function getnews(){

}

function getbus(){
    /*$url = "https://web.peatus.ee/86014d17-925a-4540-8115-5a00d2d9f0cb";
    $json = file_get_contents($url);
    $jsondata = json_decode($json, True);
    print_r("start".$jsondata);*/

}

function getasendused(){

}

function getmenu(){

}

function gettime(){

}

?>
