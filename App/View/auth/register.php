<?php

use Core\Config;

  include_once(Config::$BASE_PATH.'/App/View/app/layouts/header.php') ?>

<body>
    <div class="register-block" dir="rtl">
        <form id="register-form">
            <?php

            use Core\Helper;

            $message = Helper::message('register_error');

            if ($message) {


            ?>
                <div class="error">
                    <p><?php echo $message ?></p>
                </div>
            <?php }
            unset($_SESSION['message']);
            echo Helper::message('register_error');
            ?>
            <div class="title text-center mb-4 ">
                <h3 class="">ثبت نام</h3>
            </div>
            <div id="error" class=""></div>
            <div class="input-login">
                <div>
                    <p>نام</p>
                    <input type="text" name="user_name" id="user_name">
                </div>
                <div>
                    <p>نام خانوادگی</p>
                    <input type="text" name="last_name" id="last_name">
                </div>
                <div>
                    <p>ایمیل</p>
                    <input type="email" name="email" id="email">
                </div>
                <div>
                    <p>شماره ملی</p>
                    <input type="text" name="national_id_card" id="card">
                </div>
                <div>
                    <p>شماره تماس</p>
                    <input type="text" name="phone_number" id="phone">
                </div>
                <div>
                    <p>رمز عبور</p>
                    <input type="text" name="password" id="password">
                </div>
                <div>
                    <p>تکرار رمز عبور</p>
                    <input type="text" name="confirm_password" id="confirm_password">
                </div>
            </div>
            <input id="submitButton" class="submitButton" type="button" value="Submit">
        </form>
        <div class="login" >
            <div class="">
                <a class="login-button" href="/login">Login</a>
            </div>
            <div>
                <p>?Do you have account</p>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#submitButton").click(function(e){
            e.preventDefault()
            var data = $("#register-form").serialize()
            $.ajax({
                method: 'POST',
                url: '/register/store',
                data: data,
                success: function(result){
                    if(result == 2){
                        $("#error").html("لطفا همه ی فیلد ها را پر کنید").addClass("alert-danger text-center my-2 rounded text-dark p-2")
                    }else if(result == 3){
                        $("#error").html("رمز عبور باید بیشتر از 8 کاراکتر باشد").addClass("alert-danger text-center my-2 rounded text-dark p-2")
                    }else if(result == 4){
                        $("#error").html("رمز عبور با تکرار رمز مطابقت ندارد").addClass("alert-danger text-center my-2 rounded text-dark p-2")
                    }else if(result == 5){
                        $("#error").html("این ایمیل قبلا ثبت نام کرده است").addClass("alert-danger text-center my-2 rounded text-dark p-2")
                    }else if(result == true){
                        $("#error").html("ثبت نام با موفقیت انجام شد").addClass("alert-success text-center my-2 rounded text-dark p-2")
                        setTimeout(function(){ window.location.href = "/login"; }, 2000);
                    }else{
                        $("#error").html("ثبت نام انجام نشد").addClass("alert-danger text-center my-2 rounded text-dark p-2")
                    }
                }
            })
        })
    })
</script>

</html>