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
                <th>نام</th>
                <th>نام خانوادگی</th>
                <th>شماره تماس</th>
                <th class="text-center">ایمیل</th>
                <th>شماره ملی</th>
                <th>تعداد رزرو</th>
                <th class="text-center">آخرین رزرو</th>
                <th> تاریخ عضویت</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $user){ ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['lastname'] ?></td>
                <td><?= $user['phone_number'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['National_id_card'] ?></td>
                <td><?= $user['count'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><?= $user['id'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




</body>
<script>
<?php include(Helper::asset("assets\admin\app.js")) ?>

</script>
</html>