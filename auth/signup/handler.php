<?php
include '../../config.php';

//блок инициализации
$path = "../../dataBase/dataBase.xml";
$xml = simplexml_load_file($path);
$Res = array();
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$passwordСonf = trim($_POST['passwordСonf']);
$email = trim($_POST['email']);
$name = trim($_POST['name']);

//блок валидации
if(strlen($login) < 4 || strlen($login) > 10)
{
    $Res['login'] = "Логин должен содержать от 4 до 10 символов";
}
else{
    $Users = $xml->xpath('//Users/User/Login[. = "'.$login.'"]');
    if(count($Users) > 0){
        $Res['login'] = "Пользователь с данным логином уже существует";
    }
}
if(strlen($password) < 7 || strlen($password) > 15)
{
    $Res['password'] = "Пароль должен содержать от 7 до 15 символов";
}
else if($password != $passwordСonf){
    $Res['passwordСonf'] = "Пароли не совпадают";
}
if(strlen($email) < 5){
    $Res['email'] = "Email не существует";
}
else{
    $Users = $xml->xpath('//Users/User/Email[. = "'.$email.'"]');
    if(count($Users) > 0){
        $Res['email'] = "Пользователь с данным email уже существует";
    }
}
if(strlen($name) < 5){
    $Res['name'] = "Имя должно содержать не меньше 5 символов";
}

//блок регистрации
if(empty($Res))
{
    $User = $xml->addChild('User');
    $User->addChild('Login', $login);
    $User->addChild('Password', md5($password.salt));
    $User->addChild('Email', $email);
    $User->addChild('Name', $name);
    $User->addChild('RememberToken', " ");
    $xml->asXML($path);
}

echo json_encode($Res);