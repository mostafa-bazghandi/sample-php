 <?php

    use Core\Application;
    use Core\Config;
    use Core\Helper;

    // Application::$app->auth->checkAdmin();
    include(Config::$BASE_PATH . "\App\View\admin\layouts\header.php");
    ?>
 <div class="container">
     <div class="cards">
         <a href="/admin/users">
             <div class="card">
                 <div class="card-item">
                     <span><i class="fa fa-users" aria-hidden="true"></i></span>
                     <div class="card-item-text">
                         <p>تعداد کاربران</p>
                         <h3><?= $data[0]['users'] ?></h3>
                     </div>
                 </div>
             </div>
         </a>
         <a href="/admin/hotels">

             <div class="card">
                 <div class="card-item">
                     <span style="background: yellow;"><i class="fa fa-hotel" aria-hidden="true" ;></i></span>
                     <div class="card-item-text">

                         <p>تعداد هتل ها</p>
                         <h3><?= $data[0]['hotels'] ?></h3>
                     </div>
                 </div>
             </div>
         </a>
         <a href="/admin/cities">

             <div class="card">
                 <div class="card-item">
                     <span style="background: blue;"><i class="fa fa-city" aria-hidden="true" ;></i></span>
                     <div class="card-item-text">
                         <p>تعداد شهر ها </p>
                         <h3><?= $data[0]['cities'] ?></h3>
                     </div>
                 </div>
             </div>
         </a>
         <a href="/admin/reserved">

             <div class="card">
                 <div class="card-item">
                     <span style="background: pink;"><i class="fa fa-hotel" aria-hidden="true" ;></i></span>
                     <div class="card-item-text">
                         <p>تعداد رزرو شده ها</p>
                         <h3><?= $data[0]['reserved'] ?></h3>
                     </div>
                 </div>
             </div>
         </a>
     </div>
 </div>
 </body>
 <script>
     <?php include(Helper::asset("assets\admin\app.js")) ?>
 </script>

 </html>