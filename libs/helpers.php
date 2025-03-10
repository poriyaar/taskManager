<?php

if (!defined("BASE_PATH")) {
     echo "permmison denied";
     die;
}

// other sintax

defined("BASE_PATH") or die("permmison denied");


function diePage($msg)
{
     echo "<div style='padding: 50px; width: 90%; margin: 50px auto; background: #cf9d9d; border: 1px solid #580909; color: #501111; border-radius: 10px; font-family: sans-serif;'>$msg</div>";
     die;
}

function isAjaxRequest()
{

     if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest")) {
          return true;
     }

     return false;
}

function dd()
{
     foreach (func_get_args() as $arg) {
          echo "<pre>";
          var_dump($arg);
          echo "</pre>";
     }
     exit();
}

function siteUrl($uri = '')
{
     return BASE_URL . "/".$uri ;
}