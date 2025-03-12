<?php

include "bootstrap/init.php";

$homeUrl = siteUrl();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $action = $_GET['action'];
     $params = $_POST;
     if ($action == 'register') {
          $result =  register($params);

          if (!$result) {
               message("Error : an error in Register");
          } else
               message("Registeration is Successfull. wellcmoe to task. <br> 
          <a href='$homeUrl/auth.php'>Please login</a>
          ", "success");
     } else if ($action == 'login') {
          $result = login($params['email'], $params['password']);

          if (!$result) {
               message("Error : an error in login");
          } else
               redirect(siteUrl());
          //      message("you are logged to task. <br> 
          // <a href='$homeUrl'>Home</a>
          // ", 'success');
     }
}


include "tpl/tpl-auth.php";
