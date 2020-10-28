<?php
include 'functions.php';
$weather = getweather();
$stopName = array("Kiive","Majaka põik","Pae") ;
$stopdata = getbus();?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" crossorigin="anonymous" rel="stylesheet">
    <title>Title</title>
</head>
<body>
<div class="main">
    <div class="sidebarbox">
        <div class="logobox"><img id="logoimg" src="assets/svg/logo.svg" alt="TPG logo"></div>
        <div class="timebox">
            <div class="vertical-center">
                <span>
                <h1 id="clock"></h1>
                </span>
            </div>
        </div>
        <div class="datebox">
            <div class="vertical-center">
                <span>
                    <h1 id="dateq"></h1>
                    <h1 id="month"></h1>
                    <h1 id="year"></h1>
                </span>
            </div>
        </div>
        <div class="analogtimebox">
            <div class="vertical-center">
                <div>
                    <svg
                        class="progress-ring"
                        width="120"
                        height="120">
                        <circle
                            class="progress-ring__circle"
                            stroke="red"
                            stroke-width="8"
                            fill="transparent"
                            r="52"
                            cx="60"
                            cy="60"/>
                        <text id="progressper" x="50%" y="50%" text-anchor="middle" stroke="#000"  dy=".3em"></text>
                    </svg>
                </div>
                <p1 class="boldtxt">Aega on jäänud tunni lõppuni</p1><br>
            </div>
        </div>
    </div>

    <div class="newsbox">

        <div class="newsline">
            <h1 id="newsTitle">Uudised</h1>
            <h2>Uudiste teema</h2>
            <p1>
                On recommend tolerably my belonging or am. Mutual has cannot beauty indeed now sussex merely you. It possible no husbands jennings ye offended packages pleasant he. Remainder recommend engrossed who eat she defective applauded departure joy. Get dissimilar not introduced day her apartments. Fully as taste he mr do smile abode every. Luckily offered article led lasting country minutes nor old. Happen people things oh is oppose up parish effect. Law handsome old outweigh humoured far appetite.
                Yet remarkably appearance get him his projection. Diverted endeavor bed peculiar men the not desirous. Acuteness abilities ask can offending furnished fulfilled sex. Warrant fifteen exposed
            </p1>
        </div>
    </div>

    <div class="databox">
        <div class="ilm">
            <?php for ($i = 0; $i < 5; $i++){?>
            <div id="ilm<?php echo $i+1;?>">
                <img class="weathericon" src="assets/svg/weathericons/<?php echo $weather[$i][3];?>" alt="Weather icon"><br>
                <p1 id="tmp<?php echo $i+1;?>"><?php echo $weather[$i][0];?>°C</p1>
                <p1 id="date<?php echo $i+1;?>"><?php echo $weather[$i][1];?></p1>
            </div>
            <?php }?>
        </div>
        <div class="data">
            <div class="peatused">
                <div class="peatus1">
                    <div class="row">
                        <img class="peatusicon" src="assets/svg/bus-stop2.svg" alt="Bus-stop icon">
                        <p1 id="peatusTitle1"><?php echo $stopName[2]?> peatus</p1>
                    </div>
                    <div class="row">
                        <p1 class="boldtxt" id="busnum1"><?php echo $stopdata[2][0][0]?></p1>
                        <p1 id="bustime1"><?php echo $stopdata[2][0][1]?></p1>
                    </div>
                    <hr>
                    <div class="row">
                        <p1 class="boldtxt" id="busnum2"><?php echo $stopdata[2][1][0]?></p1>
                        <p1 id="bustime2"><?php echo $stopdata[2][1][1]?></p1>
                    </div>

                </div>
                <div class="peatus2">
                    <div class="row">
                        <img class="peatusicon" src="assets/svg/tram.svg" alt="Bus-stop icon">
                        <p1 id="peatusTitle2"><?php echo $stopName[1]?> peatus</p1>
                    </div>
                    <div class="row">
                        <p1 class="boldtxt" id="busnum3"><?php echo $stopdata[1][0][0]?></p1>
                        <p1 id="bustime3"><?php echo $stopdata[1][0][1]?></p1>
                    </div>
                    <hr>
                    <div class="row">
                        <p1 class="boldtxt" id="busnum4"><?php echo $stopdata[1][1][0]?></p1>
                        <p1 id="bustime4"><?php echo $stopdata[1][1][1]?></p1>
                    </div>
                </div>
            </div>
            <div class="uldandmed">
                <h2 id="uldandmetetitle">Koolitöö muudatused ja asendused</h2>
                <div class="cdata">
                    <div class="vertical-center">
                        <span>
                            <p1>Kool töötab tava režiimis</p1><br>
                        </span>
                    </div>
                </div>
            </div>
        </div>



        <div class="asendused">
            <h2 id="asendusteTitle">Koolisöökla päevamenüü</h2>
        </div>
    </div>
</div>

<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/script.js"></script>

</body>
</html>