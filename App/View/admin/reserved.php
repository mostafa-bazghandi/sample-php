<?php
use Core\Config;
use Core\Helper;
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH.'\App\View\admin\layouts\sidebar.php');
?>


<div class="table-container">

            <input type="text" class="form-control w-25 m-2 text-center" id="search" placeholder="جست و جو بر اساس شماره رزرو">
            <div id="error" class="ml-3 text-danger"></div>


    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>هتل</th>
                <th>شهر</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره رزرو</th>
                <th>تعداد اتاق</th>
                <th>تعداد شب</th>
                <th>پرداخت</th>
                <th>تاریخ  رزرو برای اقامت</th>
                <th class="text-center">تاریخ رزرو</th>
            </tr>
        </thead>
        <tbody id="result">

        </tbody>
    </table>
</div>




<script>
    $(document).ready(function(){
        load_data();
        function load_data(query){
            $.ajax({
                    url: "/admin/search/reserved",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function (data){
                        $("#result").html(data)
                    }
                })
        }
        $("#search").keyup(function(e){
            var search = $(this).val()
            if(search != "" && $.isNumeric(search)){

                load_data(search);
            }else{
                load_data()
                $("#error").html("")
            }
            if(!$.isNumeric(search)){
                $("#error").html("please insert only number")
            }
            if(search == ""){
                $("#error").html("")
            }

        })
    })
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>
</body>