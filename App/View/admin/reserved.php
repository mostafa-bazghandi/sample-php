<?php
use Core\Config;
use Core\Helper;
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH.'\App\View\admin\layouts\sidebar.php');
?>


<div class="table-container">

    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>هتل</th>
                <th>نام و نام خانوادگی</th>
                <th>شماره تماس</th>
                <th class="text-center">ایمیل</th>
                <th>شماره ملی</th>
                <th>تعداد اتاق</th>
                <th>تعداد شب</th>
                <th>پرداخت</th>
                <th>تاریخ اقامت</th>
                <th class="text-center">تاریخ رزرو</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $reserve){ ?>
            <tr>
                <td><?= $reserve['id'] ?></td>
                <td><?= $reserve['name'] ?></td>
                <td><?= $reserve['lastname']?> <?= $reserve['user_name'] ?></td>
                <td><?= $reserve['phone_number'] ?></td>
                <td><?= $reserve['email'] ?></td>
                <td><?= $reserve['National_id_card'] ?></td>
                <td><?= $reserve['number_of_rooms'] ?></td>
                <td><?= $reserve['number_of_nights'] ?></td>
                <td><?= $reserve['price'] ?></td>
                <td><?= $reserve['reservation_date'] ?></td>
                <td><?= $reserve['created_at'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>
</body>