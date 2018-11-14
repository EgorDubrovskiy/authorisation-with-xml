<?php
session_start();
include '../../config.php';
require_once '../../libs/MyLibrary.php';

//блок инициализации
$path = "../../dataBase/dataBase.xml";
$xml = simplexml_load_file($path);
$Res = array();
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$remember = trim($_POST['remember']);
$User;

//блок валидации
foreach($xml as $U)
{
    if($U->Login == $login)
    {
        $User = $U;
        break;
    }
}
if(!isset($User))
{
    $Res['login'] = "Пользователь с данным логином не существует";
}
else{
    $password = md5($password.salt);
    if(!($User->Password == $password))
    {
        $Res['password'] = "Неверный пароль";
    }
}

//блок авторизации
if(empty($Res))
{
    $_SESSION['UserLogin'] = $login;
    $_SESSION['UserName'] = (string)$User->Name;
    if($remember == true)
    {
        setcookie("UserLogin", $login);
        $RememberToken = generateRandomString();
        setcookie("UserRememberToken", $RememberToken);
        $User->RememberToken = $RememberToken;
        $xml->asXML($path);
    }
}

echo json_encode($Res);