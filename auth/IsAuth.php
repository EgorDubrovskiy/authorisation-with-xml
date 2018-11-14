<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/libs/MyLibrary.php';

function IsAuth(){
    if(isset($_SESSION['UserLogin'])) return true;
    else if(isset($_COOKIE['UserRememberToken']) && isset($_COOKIE['UserLogin'])){//если включена функция запомнить меня

        $path = "../../dataBase/dataBase.xml";
        $xml = simplexml_load_file($path);
        $User;

        foreach($xml as $U)
        {
            if($U->Login == $_COOKIE['UserLogin'])
            {
                $User = $U;
                break;
            }
        }

        //авторизуем пользователя
        $_SESSION['UserLogin'] = $User->Login;
        $_SESSION['UserName'] = $User->Name;

        //обновляем токен
        $RememberToken = generateRandomString();
        setcookie("UserRememberToken", $RememberToken);
        $User->RememberToken = $RememberToken;
        $xml->asXML($path);

        return true;
    }
    return false;
}