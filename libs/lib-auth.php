<?php


if (!defined("BASE_PATH")) {
     echo "permmison denied";
     die;
}

// other sintax

defined("BASE_PATH") or die("permmison denied");


function isLoggedIn()
{
     return false;
}

function getCurrentUserId()
{
     // get login user id
     return 1;
}
