<?php
use Core\Config;
use Core\Helper;
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH.'\App\View\admin\layouts\sidebar.php');
?>
<div class="title-admin">
    <div>
        <a href="/admin/hotel/create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> ایجاد هتل</a>
    </div>
    <p>لیست هتل ها</p>
</div>
<div class="table-container">
    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>هتل</th>
                <th>شهر</th>
                <th>عکس</th>
                <th> امتیاز</th>
                <th>تعداد اتاق</th>
                <th>اتاق رزرو شده</th>
                <th>کاربران رزرو کرده </th>
                <th>شماره تماس</th>
                <th class="text-center">
                    <span><i class="fa fa-cog"></i></span>
                    تنظیمات
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data[0] as $hotel){ ?>

            <tr>
                <td><?= $hotel['id'] ?></td>
                <td><?= $hotel['name'] ?></td>
                <td><?= $hotel['city'] ?></td>
                <td><img src="..\assets\app\images\<?=$hotel['picture']?>" width="60" height="60"></td>
                <td><?= $hotel['scare'] ?></td>
                <td class="text-center"><?= $hotel['number_of_rooms'] ?></td>
                <td class="text-center"><?= $data1[$hotel['id']] ?? 0 ?></td>
                <td class="text-center"><a href="/admin/reserved/hotel?hotel= <?= $hotel['id'] ?>" class="text-decoration-none text-primary"><?= $data[1][$hotel['id']] ?? 0 ?></a></td>
                <td><?= $hotel['phone'] ?></td>
                <td class="setting-hotels">
                    <div class="d-flex">
                        <a href="/admin/hotels/<?= $hotel['id'] ?>" class="btn btn-primary">
                            <span><i class="fa fa-edit"></i></span>
                            <p>ویرایش</p>
                        </a>
                        <a href="" class="btn btn-danger">
                            <span><i class="fa fa-trash"></i></span>
                            <p>حذف</p>
                        </a>
                    </div>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <div>
    </div>
</div>
</body>

<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>