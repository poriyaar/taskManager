<?php

include "bootstrap/init.php";



if (!isLoggedIn()) {
     header("Location:" . siteUrl("auth.php"));
}


if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])) {
     $deletedCount = deleteFolder($_GET['delete_folder']);
     // echo $deletedCount . " folder succesfully deleted";
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])) {
     $deletedCount = deleteTask($_GET['delete_task']);
     // echo $deletedCount . " task succesfully deleted";
}


$folders = getFolders();

$tasks = getTasks();

// dd($tasks);

include "tpl/tpl-index.php";
