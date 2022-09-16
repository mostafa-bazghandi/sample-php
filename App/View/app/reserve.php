<?php

use Core\Config;
use Core\Helper;

include (Config::$BASE_PATH) . '/app/view/app/layouts/header.php' ?>

<div class="container reserve bg-red mt-5 ps-0">

    <div class="row">
        <div class="col-6">
            <img src="../assets/app/images/hotel-3.jpg" class="image-reserve" alt="">
        </div>
        <div class="col-6" dir="rtl">

            <form action="/reserve/store" method="POST">
                <div class="row">
                    <input name="user_id" type="text" hidden value="<?= $data[0]['id'] ?>">
                    <input name="city_id" type="text" hidden value="<?= $data[1]['city_id'] ?>">
                    <input name="hotel_id" type="text" hidden value="<?= $data[1]['hotel_id'] ?>">
                    <div class="col-6">
                        <label for="hotel">هتل</label>
                        <input type="text" id="hotel" class="form-control shadow-none" value="<?= $data[1]['name'] ?>" readonly>
                    </div>
                    <div class="col-6">
                    <label for="hotel">شهر</label>
                        <input type="text" class="form-control shadow-none" value="<?= $data[1]['city'] ?>" readonly>
                    </div>
                    <div class="col-6">
                    <label for="hotel">نام و نام خانوادگی</label>
                        <input type="text" class="form-control shadow-none" value="<?= $data[0]['name'].' '. $data[0]['lastname'] ?>">
                    </div>
                    <div class="col-6">
                    <label for="hotel">شماره تماس</label>
                        <input type="text" class="form-control shadow-none" value="<?= $data[0]['phone_number'] ?>">
                    </div>
                    <div class="col-6">
                    <label for="hotel">انتخاب تاریخ</label>
                        <input name="reservation_date" type="text" id="date" class="form-control shadow-none">
                    </div>
                    <div class="col-6">
                    <label for="hotel">تعداد اتاق </label>
                        <select name="number_of_rooms" class="form-select shadow-none" id="">
                            <option value="1">1اتاق</option>
                            <option value="2">2اتاق</option>
                            <option value="3">3اتاق</option>
                            <option value="4">4اتاق</option>
                        </select>
                    </div>
                </div>
                <div class=" submit-reserve">
                    <div class="price-popular">
                        <p>قیمت با ازای 1 شب </p>
                        <input name="price" class="price-input" type="text" value="<?=number_format($data[1]['price'],0,".",",") ?>تومان ">
                    </div>
                    <div>
                        <button type="submit">ثبت</button>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
<?php include(Config::$BASE_PATH.'/App/View/app/layouts/footer.php') ?>
</body>