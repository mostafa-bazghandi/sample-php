<?php

use Core\Config;
use Core\Helper;

include(Config::$BASE_PATH . "\App\View\admin\layouts\header.php");

include(Config::$BASE_PATH . '\App\View\admin\layouts\sidebar.php');
?>
<div class="title-admin">
    <div>
        <div id="re"></div>
        <a href="/admin/hotel/create" class="btn btn-primary"><i class="fa fa-plus"></i> ایجاد هتل</a>
    </div>
    <div>
        <select name="" id="select" class="form-select">
            <option value="">همه شهر ها</option>
            <?php foreach ($data as $city) { ?>
                <option id="city" data-city="<?= $city['id'] ?>"><?= $city['name'] ?></option>
            <?php } ?>
        </select>
    </div>
    <p>لیست هتل ها</p>
</div>
<div class="table-container">
    <table class="table table-striped" style="direction: rtl;">
        <thead>
            <tr>
                <th id="delete1">#</th>
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
        <tbody id="res">

        </tbody>
    </table>
    <div>
    </div>
</div>

</body>

<script>
    $(document).ready(function() {
        $.ajax({
            url: "/admin/hotels/show",
            method: "GET",
            success: function(data) {
                $("#res").html(data)
            }
        })
        $("#res").find(".delete1").click(function(e) {
            e.preventDefault()
            alert('hi')
            var el = this
            var deleteId = $(this).data('id')
            bootbox.confirm('Do you really want to delete record?', function(result) {
                if (result) {
                    $.ajax({
                        url: "/admin/remove/hotel",
                        method: "POST",
                        data: {
                            id: deleteId
                        },
                        success: function(response) {

                            if (response == true) {
                                location.reload()
                            } else {
                                bootbox.alert("record not deleted")
                            }
                        }
                    })
                }
            })
        })
        function hi(){
            alert('hi')
        }
        $("#select").change(function() {
            var id = $("#select option:selected").data('city');
            $.ajax({
                url: "/admin/hotels/show",
                method: "GET",
                data: {
                    city_id: id
                },
                success: function(data) {
                    $("#res").html(data)
                }
            })
        })

    })
    <?php include(Helper::asset("assets\admin\app.js")) ?>
</script>