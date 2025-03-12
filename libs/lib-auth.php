<?php


if (!defined("BASE_PATH")) {
     echo "permmison denied";
     die;
}

// other sintax

defined("BASE_PATH") or die("permmison denied");


function register($usersData)
{
     global $pdo;

     #validate TODO
     $password = password_hash($usersData['password'], PASSWORD_BCRYPT);
     $sql = "INSERT INTO `users` (name,email,password) VALUES (:name , :email, :password);";
     $stmt = $pdo->prepare($sql);
     // $stmt->execute(['folderName' => $folderName, 'useer_id' => $current_user_id]);
     $stmt->execute(array(':name' => $usersData['name'], ':email' => $usersData['email'], ':password' => $password));
     return $stmt->rowCount();
}

function login($email, $password)
{
     $user = getUser($email);
     if (!$user) {
          return false;
     }
     // check password
     if (password_verify($password, $user->password)) {
          $_SESSION['login'] = $user;
          return true;
     }

     return false;
}

function getUser($email)
{
     global $pdo;
     $sql =  "SELECT * FROM `users` WHERE email = :email";
     $stmt = $pdo->prepare($sql);
     $stmt->execute([':email' => $email]);
     $records = $stmt->fetchAll(PDO::FETCH_OBJ);
     return $records[0] ?? null;
}

function isLoggedIn()
{
     return isset($_SESSION['login']) ? true : false;
}

function getLoginUser()
{
     return $_SESSION['login'] ?? null;
}

function getCurrentUserId()
{
     // get login user id
     return  getLoginUser()->id ?? 0;
}

function logout()
{
     unset($_SESSION['login']);
}
