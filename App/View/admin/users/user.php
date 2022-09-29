<?php

use Core\Config;
use Core\Helper;

include(Config::$BASE_PATH . "\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH . '\App\View\admin\layouts\sidebar.php');
?>

<div class="table-container">
    <form action="/admin/hotel/store" method="POST" enctype="multipart/form-data" dir="rtl" class="p-3 d-grid text-right">
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="user_name">نام</label>
                <input id="user_name" class="form-control" type="text" name="user_name" value="<?= $data['user_name'] ?>" >
            </div>
            <div class="form-group col-5">
                <label for="lastname">نام خانوادگی</label>
                <input id="lastname" class="form-control" type="text" name="lastname" value="<?= $data['lastname'] ?>">
            </div>
        </div>
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="phone">شماره تلفن</label>
                <input id="phone" class="form-control" type="text" name="phone" value="<?= $data['phone_number'] ?>">
            </div>
            <div class="form-group col-5">
                <label for="email">ایمیل</label>
                <input id="email" class="form-control" type="text" name="email" value="<?= $data['email'] ?>">
            </div>
        </div>
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="room"> شماره ملی</label>
                <input id="roome" class="form-control" type="text" name="number_of_rooms" value="<?= $data['National_id_card'] ?>">
            </div>
        </div>
        <div class="text-center mt-5">
            <!-- <button type="submit" class="btn btn-primary btn-sm w-25">ثبت</button> -->
        </div>
    </form>
</div>


</body>







<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>