<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../assets/auth/style.css">
    <title>Document</title>
</head>
<body>
<div class="login-block">
    <form action="<?= "login/check" ?>" method="POST">
    <?php

                    use Core\Helper;

 $message = Helper::message('login_error');if($message){ ?>
    <div class="success">
        <p><?= $message ?></p>
    </div>
    <?php } unset($_SESSION['message']) ?>
        <h1>Login</h1>
        <input type="text" value="" name="email" placeholder="Username" id="username" />
        <input type="password" value="" name="password" placeholder="Password" id="password" />
        <button>Submit</button>
    </form>
</div>
</body>
</html>
