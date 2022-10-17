<?php

use Core\Application;
use Core\Config;
use Core\Helper;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ی اصلی</title>
    <link rel="stylesheet" href="../assets/app/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="font-persian/node_modules/css-persian/css/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://kit.fontawesome.com/732338cc86.js" crossorigin="anonymous"></script> -->
    <link rel="stylesheet" href="../persianDatepicker/css/persianDatepicker-default.css">
    <script type="text/javascript" src="../persianDatepicker/js/jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="../persianDatepicker/js/persianDatepicker.min.js"></script>
</head>


<body>
    <nav>
        <div class="menu-left">
            <?php if (!isset($_SESSION['email'])) { ?>
                <div class="logout">
                    <a href="/login"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
                    <span class="text-hover-login">ورود/ثبت نام</span>
                </div>
            <?php } elseif (isset($_SESSION['email'])) {
                $user = Application::$app->database->select("*", "users")->where(['email'], ['='], [$_SESSION['email']])->data;
            ?>
                <div class="info-header">
                    <div class="logout">
                        <a href="/logout"><i class="fa fa-sign-out"></i></a>
                        <span class="text-hover-login">خروج</span>
                    </div>
                    <p><?= $user['user_name'];
                        echo ' ' . $user['last_name'] ?></p>
                </div>
            <?php } ?>
        </div>
        <div class="menu-right">
            <div>

                <ul class="">
                    <li>
                        <a ref="">تماس با ما</a>
                    </li>
                    <li>
                        <a href="">درباره ما</a>
                    </li>
                    <li>
                        <a href="">لیست هتل ها</a>
                    </li>
                    <li>
                        <a href="">صفحه ی صلی</a>

                    </li>
                </ul>
            </div>
            <div class="logo">

                <img src="images/logo.jpg" alt="">
            </div>
        </div>
    </nav>