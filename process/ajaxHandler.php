<?php


include_once  "../bootstrap/init.php";

if (!isAjaxRequest()) {
     diePage("Invalid Request");
}


if (!isset($_POST['action']) || empty($_POST['action'])) {
     diePage("Invalid Action");
}


switch ($_POST['action']) {
     case 'addFolder':
          if (!isset($_POST['folderName']) || strlen($_POST['folderName']) < 3) {
               echo "نام وارد شده درست نیست";
               die;
          }
          echo addFolder($_POST['folderName']);
          break;
     case 'addTask':
          $folderId = $_POST['folderId'];
          $taskTitle = $_POST['taskTitle'];

          if (!isset($folderId) || (empty($folderId))) {
               echo "فولدر را انتخاب کنید";
               die;
          }
          if (!isset($taskTitle) || strlen($taskTitle) < 3) {

               echo "نام وارد شده کوتاه است";
               die;
          }
          echo addTask($taskTitle, $folderId);
          break;
     case 'doneToggle':
          $taskId = $_POST['taskId'];
          if (!isset($taskId) || !is_numeric($taskId)) {
               echo "ایدی تسک نامعتبر";
               die;
          }

          changeStatus($taskId);


          break;
     default:
          diePage("Invalid Action");
          break;
}
