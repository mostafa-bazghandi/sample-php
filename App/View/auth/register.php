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
<div class="register-block" dir="rtl">
    <form action="<?= "register/store" ?>" method="POST">
    <?php

                    use Core\Helper;

 $message = Helper::message('register_error');

    if($message){


     ?>
     <div class="error">
         <p><?php echo $message ?></p>
     </div>
<?php }
unset($_SESSION['message']);
echo Helper::message('register_error');
 ?>
        <h1 class="ms-5 me-4">ثبت نام</h1>
        <div class="input-login">
            <div>
                <p>Username</p>
                <input type="text" name="name" id="">
            </div>
            <div>
                <p>Lastname</p>
                <input type="text" name="lastname" id="">
            </div>
            <div>
                <p>Phone number</p>
                <input type="text" name="phone_number" id="">
            </div>
            <div>
                <p>National id card</p>
                <input type="text" name="National_id_card" id="">
            </div>
            <div>
                <p>Email</p>
                <input type="text" name="email" id="">
            </div>
            <div>
                <p>Password</p>
                <input  name="password" type="password" id="">
            </div>
            <div>
                <p>Confirm password</p>
                <input name="confirm-password" type="password" id="">
            </div>
        </div>
            <button>Submit</button>
        </form>
    <div class="login">

        <div>
            <p>Do you have account?</p>
        </div>
        <div class="">
            <a class="login-button" href="/login">Login</a>
        </div>
    </div>
    </div>
</body>
</html>
