<?php

function redirection($url){
    $url = filter_var($url, FILTER_SANITIZE_URL);
    header("location:" . URL_PROJECT . $url);
    exit();
}