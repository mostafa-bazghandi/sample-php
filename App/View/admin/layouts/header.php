<!DOCTYPE html>
 <html lang="en">
     <head>
        <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
         <meta charset="UTF-8">
         <meta http-equiv="X-UA-Compatible" content="IE=edge">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
         <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
         <!-- <script src="https://kit.fontawesome.com/732338cc86.js" crossorigin="anonymous"></script> -->
         <!-- <link rel="stylesheet" href="../assets/admin/style.css"> -->
         <!-- <link rel="stylesheet" href="../../assets/admin/style.css"> -->
         <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        </head>
        <style>
            <?php

use Core\Config;
use Core\Helper;

 include_once(Config::$BASE_PATH.'/public/assets/admin/style.css') ?>

        </style>
        <body>
         <nav>
             <div class="navbar">
                 <div class="info">
                     <p class="dropdown-toggle1">mostafa</p>
                     <span class="dropdown-toggle1"><i class="fa fa-angle-down"></i></span>
                     <ul class="drop-down" id="dropdown">
                         <li><a href="/logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>