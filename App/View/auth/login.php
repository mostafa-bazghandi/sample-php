<?php

use Core\Config;

  include_once(Config::$BASE_PATH.'/App/View/app/layouts/header.php') ?>
<body>
    <div class="login-block">
        <form action="<?= "login/check" ?>" method="POST">
            <?php

            use Core\Helper;

            $message = Helper::message('login_error');
            if ($message) { ?>
                <div class="success">
                    <p><?= $message ?></p>
                </div>
            <?php }
            unset($_SESSION['message']) ?>
            <h1>ورود</h1>
            <input type="text" value="" name="email" placeholder="Username" id="username" />
            <input type="password" value="" name="password" placeholder="Password" id="password" />
            <button>Submit</button>
        </form>
        <div class="mt-3" dir="rtl">
            <a href="/register" class="text-decoration-none text-dark">
                <p>ساخت حساب کاربری</p>
            </a>
        </div>
    </div>
</body>

</html>