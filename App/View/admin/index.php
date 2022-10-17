 <?php

    use Core\Application;
    use Core\Config;
    use Core\Helper;

    // Application::$app->auth->checkAdmin();
    include(Config::$BASE_PATH . "\App\View\admin\layouts\header.php");
    include(Config::$BASE_PATH . '\App\View\admin\layouts\sidebar.php');

    ?>
 <div class="container">
     <div class="info-home" dir="rtl">
        <div class="info-item">
            <div class="info-title">
                <p>تعداد کاربران</p>
            </div>
            <div class="info-number">
                <h2>12</h2>
            </div>
        </div>
        <div class="info-item">
            <div class="info-title">
                <p>تعداد هتل ها</p>
            </div>
            <div class="info-number">
                <h2>12</h2>
            </div>
        </div>
        <div class="info-item">
            <div class="info-title">
                <p>تعداد رزور شده ها</p>
            </div>
            <div class="info-number">
                <h2>12</h2>
            </div>
        </div>
        <div class="info-item">
            <div class="info-title">
                <p>تعداد شهر ها</p>
            </div>
            <div class="info-number">
                <h2>12</h2>
            </div>
        </div>
     </div>
 </div>
 </body>
 <script>
     $(document).ready(function() {
         load_data();

         function load_data(query) {
             $.ajax({
                 url: "/admin/search/reserve",
                 method: "POST",
                 data: {
                     query: query
                 },
                 success: function(data) {
                     $("#resut").html(data)
                 }
             })
         }
         $("#searc").keyup(function() {
             var search = $(this).val();
             if (search != "" && $.isNumeric(search)) {
                 load_data(search)
             } else {
                 $("#resut").html('please insert only number')
                 // load_data();
             }
         })
     })
     <?php include(Helper::asset("assets\admin\app.js")) ?>
 </script>

 </html>