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
        <tbody>
            <?php foreach($data as $reserve){ ?>
            <tr>
                <td><?= $reserve['id'] ?></td>
                <td><?= $reserve['hotel'] ?></td>
                <td><?= $reserve['city'] ?></td>
                <td>
                    <a href="/admin/user/<?= $reserve['user_id'] ?>"><i class="fa fa-eye bg-info p-1"></i></a>
                    <?= $reserve['lastname']?> <?= $reserve['user_name'] ?>
                </td>
                <td><?= $reserve['phone_number'] ?></td>
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