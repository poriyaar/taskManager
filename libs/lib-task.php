<?php

if (!defined("BASE_PATH")) {
     echo "permmison denied";
     die;
}

// other sintax

defined("BASE_PATH") or die("permmison denied");

/** folders Functions */

function deleteFolder($folderId)
{
     global $pdo;

     $sql = "DELETE FROM folders WHERE id = $folderId";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     return $stmt->rowCount();
}


function getFolders()
{
     global $pdo;
     $current_user_id = getCurrentUserId();

     $sql = "SELECT * FROM folders WHERE user_id = $current_user_id";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     $recordes = $stmt->fetchAll(PDO::FETCH_OBJ);
     return $recordes;
}

function addFolder($folderName)
{
     global $pdo;
     $current_user_id = getCurrentUserId();
     $sql = "INSERT INTO `folders` (name,user_id) VALUES (:folderName , :user_id);";
     $stmt = $pdo->prepare($sql);
     // $stmt->execute(['folderName' => $folderName, 'useer_id' => $current_user_id]);
     $stmt->execute(array(':folderName' => $folderName, ':user_id' => $current_user_id));
     return $stmt->rowCount();
}

/** tasks Functions */
function getTasks()
{
     global $pdo;
     $current_user_id = getCurrentUserId();
     $folder = $_GET['folder_id'] ?? null;
     $folderCondition = '';
     if (isset($folder) && is_numeric($folder)) {
          $folderCondition = " AND folder_id=$folder";
     }


     $sql = "SELECT * FROM tasks WHERE user_id = $current_user_id  $folderCondition ";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     $recordes = $stmt->fetchAll(PDO::FETCH_OBJ);
     return $recordes;
}

function deleteTask($taskId)
{
     global $pdo;

     $sql = "DELETE FROM tasks WHERE id = $taskId";
     $stmt = $pdo->prepare($sql);
     $stmt->execute();
     return $stmt->rowCount();
}

function addTask($taskTitle, $folderId)
{
     global $pdo;
     $current_user_id = getCurrentUserId();
     $sql = "INSERT INTO `tasks` (title,user_id,folder_id) VALUES (:title , :user_id, :folder_id);";
     $stmt = $pdo->prepare($sql);
     // $stmt->execute(['folderName' => $folderName, 'useer_id' => $current_user_id]);
     $stmt->execute(array(':title' => $taskTitle, ':user_id' => $current_user_id, ':folder_id' => $folderId));
     return $stmt->rowCount();
}


function changeStatus($taskId)
{
     global $pdo;
     $current_user_id = getCurrentUserId();
     $sql = "UPDATE `tasks` SET `status` = 1 - `status`  WHERE user_id = :userId AND id = :taskId";
     $stmt = $pdo->prepare($sql);
     $stmt->execute(['taskId' => $taskId, 'userId' => $current_user_id]);
     return $stmt->rowCount();
}
