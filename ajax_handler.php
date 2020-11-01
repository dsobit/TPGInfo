<?php
include 'functions.php';
if(isset($_POST['function'])) {
    if($_POST['function'] == 'gettime') {
        echo gettime();
    }
    else if($_POST['function'] == 'getmenu') {
        if(getmenu() !== null)echo json_encode(getmenu(), JSON_UNESCAPED_UNICODE);
    }
    else if($_POST['function'] == 'getweather') {
        if(getweather() !== null)echo json_encode(getweather(), JSON_UNESCAPED_UNICODE);
    }
}