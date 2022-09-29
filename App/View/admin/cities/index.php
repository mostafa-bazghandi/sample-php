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
                <th>شهر</th>
                <th class="text-center">تعداد هتل ثبت شده</th>
                <th class="text-center">مشاهده هتل ثبت شده</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data as $city){ ?>
            <tr>
                <td class="text-end"><?= $city['id'] ?></td>
                <td><?= $city['name'] ?></td>
                <td class="text-center"><?= $city['count'] ?></td>
                <td class="text-center">
                    <a href="/admin/city/hotels/<?= $city['id'] ?>" class="bg-info bg border-secondary p-1 rounded"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>




<script>
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>
</body>