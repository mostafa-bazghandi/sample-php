<?php

use Core\Config;
use Core\Helper;

include (Config::$BASE_PATH) . '/app/view/app/layouts/header.php' ?>
<div class="most-popular">
    <div class="title-popular">
        <h4>
            هتل های محبوب
        </h4>
    </div>
    <div class="cards-popular">
        <?php foreach ($data as $most_popular) { ?>
            <div>

                <div class="card-hotel">
                    <a href="/reserve/<?= ($most_popular['id']) ?>">
                        <img src="images/ghasr-talaee-mashhad.jpg" alt="">
                        <div class="badge">
                            <?= $most_popular['discount'] ?>% تخفیف
                        </div>
                        <div class="text-card">
                            <p><?= $most_popular['name'] ?> <?= $most_popular['city'] ?></p>
                            <div class="star">
                                <div>
                                    <?php for ($x = 0; $x < $most_popular['scare']; $x++) { ?>
                                        <span class="fa fa-star check"></span>
                                    <?php } ?>

                                </div>
                                <div>
                                    <p><?= ($most_popular['scare']) ?>ستاره</p>
                                </div>
                            </div>
                            <p><?= ($most_popular['price']) ?> </p>
                            <p class="text-muted">تا <?= $most_popular['discount']  ?> درصد تخفیف</p>
                        </div>
                    </a>
                </div>
            </div>

        <?php } ?>
    </div>
</div>
<div class="section-cities-hotel">
    <div class="box-images">
        <div class="box-1">
            <a href="">
                <img src="../assets/app/images/yazd-city.jpg" alt="" >
                <p>هتل های یزد</p>
            </a>
        </div>
        <div class="box-2">
            <a href="">
                <img src="../assets/app/images/15781.jpeg" alt="">
                <p>هتل های یزد</p>
            </a>
        </div>
        <div class="box-3">
            <a href="">
                <img src="../assets/app/images/15781.jpeg" alt="">
                <p>هتل های یزد</p>
            </a>
        </div>
        <div class="box-4">
            <a href="">
                <img src="../assets/app/images/15781.jpeg" alt="">
                <p>هتل های یزد</p>
            </a>
        </div>
        <div class="box-5">
            <a href="">
                <img src="../assets/app/images/15781.jpeg" alt="">
                <p>هتل های یزد</p>
            </a>
        </div>
        <div class="box-6">
            <a href="">
                <img src="../assets/app/images/15781.jpeg" alt="">
                <p>هتل های یزد</p>
            </a>
        </div>
    </div>
</div>
</body>

</html>