<?php

use Core\Config;
use Core\Helper;
include(Config::$BASE_PATH."\App\View\admin\layouts\header.php");
include(Config::$BASE_PATH.'\App\View\admin\layouts\sidebar.php');
?>
<div class="reserved-user">
    <p><strong><?= $data[0]['user_name'] ?? $data['user_name'] ?> <?= $data[0]['lastname'] ?? $data['lastname'] ?></strong>  مشاهده هتل های رزرو شده توسط </p>
</div>
<div class="table-container">

    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th>#</th>
                <th>نام هتل</th>
                <th>شهر</th>
                <th>تعداد اتاق</th>
                <th>مبلغ پرداختی</th>
                <th> تاریخ رزرو</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $reserved){ ?>
            <tr>
                <td><?= $reserved['id'] ?? $data['id']?></td>
                <td><?= $reserved['hotel'] ?? $data['hotel'] ?></td>
                <td><?= $reserved['city'] ?? $data['city'] ?></td>
                <td><?= $reserved['number_of_rooms'] ?? $data['number_of_rooms'] ?></td>
                <td><?= $reserved['price'] ?? $data['price'] ?></td>
                <td><?= $reserved['created_at'] ?? $data['created_at'] ?></td>
            </tr>
            <?php if(empty($reserved['id'])){
               break;
            } } ?>
        </tbody>
    </table>
</div>




</body>
<script>
<?php include(Helper::asset("assets\admin\app.js")) ?>

</script>
</html>