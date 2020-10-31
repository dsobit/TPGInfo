<?php
include 'functions.php';
if(isset($_POST['function'])) {
    if($_POST['function'] == 'gettime') {
        echo gettime();
    }
    else if($_POST['function'] == 'getmenu') {
        echo json_encode(getmenu());
    }
}