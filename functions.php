<?php
include('config.php');
include ('simple_html_dom.php');
$timeconfig = gettiming();
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
    /*$url[0] = "https://transport.tallinn.ee/siri-stop-departures.php?stopid=1426"; //Pae 50;58;55
    $url[1] = "https://transport.tallinn.ee/siri-stop-departures.php?stopid=1430"; // Pae 13;7
    $url[2] = "https://transport.tallinn.ee/siri-stop-departures.php?stopid=1424"; //Majaka põik 2;4
    $url[3] = "https://transport.tallinn.ee/siri-stop-departures.php?stopid=1412"; //Kiive 50;58;7;13
    $stopname[0] = "Pae";
    $stopname[1] = "Pae";
    $stopname[2] = "Majaka";
    $stopname[3] = "Kiive";
    for ($i=0; $i<4; $i++){
        $data = file_get_contents($url[$i]);
        $data = array_slice(explode(",", $data),6);
        if($i==2) $data = array_slice(explode("tram", implode(" ",$data)),1);
        else $data = array_slice(explode("bus", implode(" ",$data)),1);

        $index = 0;
        foreach ($data as $datapiece){
            $stopdata[$i][$index][0] = $stopname[$i];
            $datapiece = explode(" ", $datapiece);
            $stopdata[$i][$index][1] = $datapiece[1];
            $time = intval($datapiece[3]);
            $stopdata[$i][$index][2] = gmdate("H:i",$time);
            //print($stopdata[0][$index][0].$stopdata[0][$index][1]);
            $index++;
        }
    }*/

    $url = "https://transport.tallinn.ee/siri-stop-departures.php?stopid=1412,1424,1426,1430";
    $stopName =  array("Kiive","Majaka põik","Pae","Pae") ;
    $data = file_get_contents($url);
    $data = explode("stop,", $data);
    $data = str_replace(array("1412", "1424", "1426", "1430"),"",$data);
    unset($data[0]);

    $stop = 0;
    foreach($data as $line){

        if (strpos($line, 'bus') !== false) $line = explode("bus", $line);
        else if (strpos($line, 'tram') !== false) $line = explode("tram", $line);
        unset($line[0]);
        $linenum = 0;
        foreach ($line as $tunit){
            $tunit = explode(",", $tunit);
            unset($tunit[0]);
            $result[$stop][$linenum][0] = $stopName[$stop];
            $result[$stop][$linenum][1] = $tunit[1];
            $time = intval($tunit[2]);
            $result[$stop][$linenum][2] = gmdate("H:i",$time);
            $linenum++;
            //print ($stopName[$stop]." ". $result[$stop][0]." ".$result[$stop][1]."<br>");
        }
        $stop++;
    }


    if (!empty($result)) {
        return $result;
    }
}

function getasendused(){

}

function getmenu(){
    $url = "http://www.astuleleek.ee/et/public.menu-aca27372-33ca-453d-beef-44e11a28fd4f/foodtypes-2/groups-1/";
    $data = file_get_html($url);
    $count = 0;
    $dayselect = 0;
    foreach($data->find('tr') as $row) {
        $column = $row->find('td',0)->plaintext;
        if($column != "Keskmine:"){
            if(strpos($column, 'Esmaspäev') !== false){
                $count = 0;
                $dayselect = 0;
            }
            else if(strpos($column, 'Teisipäev') !== false){
                $count = 0;
                $dayselect = 1;
            }
            else if(strpos($column, 'Kolmapäev') !== false){
                $count = 0;
                $dayselect = 2;
            }
            else if(strpos($column, 'Neljapäev') !== false){
                $count = 0;
                $dayselect = 3;
            }
            else if(strpos($column, 'Reede') !== false){
                $count = 0;
                $dayselect = 4;
            }
            else{
                $menudata[$dayselect][$count] = $column;
                $count++;

            }
        }
    }
    if (!empty($menudata)) {
        return $menudata;
    }
}

function gettime(){
    global $timeconfig;
    date_default_timezone_set('Europe/Riga');
    $count = 0;
    foreach ($timeconfig as $nexttime){
        if($count>0) $previous = $count-1;
        else $previous = $count;
        $previousTime = $timeconfig[$previous];
        if(date('H:i') < date('H:i', strtotime($nexttime))){
            return $previousTime." ".$nexttime;
        }
        $count++;
    }
    return "00:00";
}


