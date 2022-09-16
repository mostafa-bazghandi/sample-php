<?php

use Core\Config;
use Core\Helper;

 include(Config::$BASE_PATH).'/app/view/app/layouts/header.php' ?>
    <div class="most-popular">
        <div class="title-popular">
            <h4>
                هتل های محبوب
            </h4>
        </div>
        <div class="cards-popular">
            <?php foreach($data as $most_popular){ ?>
            <div>

                <div class="card-hotel">
                    <a href="/reserve/<?= ($most_popular['id']) ?>">
                        <img src="images/ghasr-talaee-mashhad.jpg" alt="">
                        <div class="badge">
                            <?= $most_popular['discount'] ?>% تخفیف
                        </div>
                        <div class="text-card">
                            <p><?=  $most_popular['name'] ?> <?= $most_popular['city'] ?></p>
                            <div class="star">
                                <div>
                                    <?php for($x=0;$x<$most_popular['scare'];$x++){ ?>
                                    <span class="fa fa-star check"></span>
                                    <?php } ?>

                                </div>
                                <div>
                                    <p><?= ($most_popular['scare']) ?>ستاره</p>
                                </div>
                            </div>
                            <p><?=  ($most_popular['price']) ?> </p>
                            <p class="text-muted">تا <?= $most_popular['discount']  ?> درصد تخفیف</p>
                        </div>
                    </a>
                </div>
            </div>

        <?php } ?>
        </div>
    </div>
</body>

</html>