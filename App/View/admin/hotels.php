<?php
use Core\Config;
use Core\Helper;
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH.'\App\View\admin\layouts\sidebar.php');
?>
<div class="title-admin">
    <p>لیست هتل ها</p>
</div>
<div class="table-container">
    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>هتل</th>
                <th>شهر</th>
                <th> امتیاز</th>
                <th>تعداد اتاق</th>
                <th>رزرو شده</th>
                <th>شماره تماس</th>
                <th>
                    <span><i class="fa fa-cog"></i></span>
                    تنظیمات
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $hotel){ ?>

            <tr>
                <td><?= $hotel['id'] ?></td>
                <td><?= $hotel['name'] ?></td>
                <td><?= $hotel['city'] ?></td>
                <td><?= $hotel['scare'] ?></td>
                <td><?= $hotel['number_of_rooms'] ?></td>
                <td><?= $data1[$hotel['id']] ?></td>
                <td><?= $hotel['phone'] ?></td>
                <td class="setting-hotels">
                    <a href="" class="btn btn-primary bt-sm">
                    <span><i class="fa fa-edit"></i></span>
                    <p>ویرایش</p>
                    </a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>

<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>