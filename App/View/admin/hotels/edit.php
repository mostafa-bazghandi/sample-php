<?php

use Core\Config;
use Core\Helper;

include(Config::$BASE_PATH . "\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH . '\App\View\admin\layouts\sidebar.php');
?>

<div class="table-container">
    <form action="/admin/hotel/edit/<?= $data[0]['id'] ?>" method="POST" enctype="multipart/form-data" dir="rtl" class="p-3 d-grid text-right">
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="name">نام</label>
                <input id="name" class="form-control" type="text" name="name" value="<?= $data[0]['name'] ?>" >
            </div>
            <div class="form-group col-5">
                <label for="city">شهر</label>
                <select class="custom-select" name="city_id" >
                    <option value="<?= $data[0]['city_id'] ?>" selected><?= $data[0]['city'] ?></option>
                    <option value=""></option>

                </select>
            </div>
        </div>
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="phone">شماره تلفن</label>
                <input id="phone" class="form-control" type="text" name="phone" value="<?= $data[0]['phone'] ?>">
            </div>
            <div class="form-group col-5">
                <label for="scare">امتیاز</label>
                <input id="scare" class="form-control" type="text" name="scare"value="<?= $data[0]['scare'] ?>">
            </div>
        </div>
        <div class="form-row d-flex justify-content-around">
            <div class="form-group col-5">
                <label for="room">تعداد اتاق</label>
                <input id="roome" class="form-control" type="text" name="number_of_rooms" value="<?= $data[0]['number_of_rooms'] ?>">
            </div>
            <div class="col-5">
                <label for="formFile" class="form-label">انتخاب عکس</label>
                <input name="picture" class="form-control" type="file" id="formFile" >
                <img src="..\..\assets\app\images\<?= $data[0]['picture'] ?>" alt="" width="100" height="100">
            </div>
        </div>
        <div class="text-center mt-5">
            <button type="submit" class="btn btn-primary btn-sm w-25">ثبت</button>
        </div>
    </form>
</div>


</body>







<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>