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
                <th class="text-end">#</th>
                <th>نام</th>
                <th class="text-center">تعداد اتاق</th>
                <th class="text-center">عکس</th>
                <th class="text-center">شماره تلفن</th>
                <th class="text-center">امتیاز</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $hotel){ ?>
            <tr>
                <td class="text-end"><?= $hotel['id'] ?></td>
                <td><?= $hotel['name'] ?></td>
                <td class="text-center"><?= $hotel['number_of_rooms'] ?></td>
                <td><img src="../../../assets/app/images/<?= $hotel['picture'] ?>" alt="" width="100" height="100"></td>
                <td class="text-center"><?= $hotel['phone'] ?></td>
                <td class="text-center"><?= $hotel['scare'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>
</body>