<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
header('Access-Control-Allow-Origin: *');
if(isset($_POST['form_data'])) {
    $reqLog = new \Myclass\DumpClass();
    $reqLog->log($_POST['form_data'], __DIR__);
    echo $_POST['form_data']; // вернем полученное в ответе
    exit;
}