<?php require_once 'auth/IsAuth.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Test</title>
</head>
<body>
    <div class="authInfoContainer">
        <?php if(IsAuth() == false): ?>
            <a href="auth/signup">Регистрация</a>
            <a href="auth/signin">Вход</a>
        <?php else : ?>
            Hello <?php echo $_SESSION['UserName']; ?>
            <a href="auth/logout.php">Выйти</a>
        <?php endif; ?>
    </div>
</body>
</html>