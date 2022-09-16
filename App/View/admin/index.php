 <?php

use Core\Application;
use Core\Config;
use Core\Helper;

Application::$app->auth->checkAdmin();
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");
?>
     <div class="container">
         <div class="cards">
             <div class="card">
                 <div class="card-item">
                     <span><i class="fa fa-users" aria-hidden="true"></i></span>
                     <p>Total Users</p>
                         <h3>25</h3>
                 </div>
             </div>
             <div class="card">
                 <div class="card-item">
                     <span style="background: yellow;"><i class="fa fa-hotel" aria-hidden="true";"></i></span>
                     <p>Total Hotels</p>
                         <h3>25</h3>
                 </div>
             </div>
             <div class="card">
                 <div class="card-item">
                     <span style="background: blue;"><i class="fa fa-city" aria-hidden="true";"></i></span>
                     <p>Total cities</p>
                         <h3>25</h3>
                 </div>
             </div>
             <div class="card">
                 <div class="card-item">
                     <span style="background: pink;"><i class="fa fa-hotel" aria-hidden="true";"></i></span>
                     <p>Reserved Hotels</p>
                         <h3>25</h3>
                 </div>
             </div>
         </div>
     </div>
    </body>
    <script>
<?php include(Helper::asset("assets\admin\app.js")) ?>
 </script>
 </html>