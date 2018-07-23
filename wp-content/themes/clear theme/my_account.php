<?php
/*
Template Name: Мой аккаунт
Template Post Type: post, page
*/
?>
<?php
get_header();

?>
<div class="autorization">
    <div class="autorization-header">
        <img src="images/reg.png" alt="">
        <p class="autorization-header-title">МОЙ АККАУНТ</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="autorization-wrap  col-sm-5  col-md-offset-1">
                <?php if (isset($_GET['loginerror'])) { ?><h4 class="autorization-login-title">НЕВЕРНЫЙ ПАРОЛЬ! -
                    восстановление</h4>
                    <div class="autorization-login">
                    <?php echo do_shortcode("[wppb-recover-password]"); ?>
                    </div><?php } else { ?><h4 class="autorization-login-title">Авторизация</h4>
                    <div class="autorization-login">
                    <?php if (is_user_logged_in()) {
                    echo do_shortcode("[wppb-login]");
                        ?>
                        <?php
                        $user = wp_get_current_user();
                        if (in_array('premium_user', (array)$user->roles)) { ?>
                            <span class="subs-purchased">Ваша подписка активна, у вас есть доступ к премиум-контенту на сайте</span>
                        <?php } ?>
                    <?php } else {
//                    echo do_shortcode("[wppb-login]");
                        wp_login_form(array(
                            'echo' => true,
                            'label_username' => __('Логин'),
                            'label_password' => __('Пароль'),
                            'label_remember' => __('Запомнить меня'),
                            'label_log_in' => __('Войти'),
                        ));
//                        echo do_shortcode("[wppb-login]");
                    } ?>
                    <style>
                        #loginform .login-password label,
                        #loginform .login-username label {
                            width: 30%;
                            float: left;
                            min-height: 1px;
                            text-align: center;
                        }

                        #loginform .login-password,
                        #loginform .login-username {
                            text-align: left;
                            margin-bottom: 15px;
                        }

                        #loginform input {
                            border: 1px solid #ccc;
                            border-radius: 3px;
                        }

                        #loginform .login-remember {
                            margin-top: 5px;
                        }

                        #loginform .login-submit {
                            margin-top: 15px;
                        }

                        .subs-purchased {
                            color: #288965;
                            margin-top: 20px;
                            display: inline-block;
                        }
                    </style>
                    </div><?php } ?>
            </div>

            <div class="autorization-wrap  col-sm-5">
                <h4 class="autorization-login-title">Регистрация</h4>
                <div class="autorization-login">
                    <?php echo do_shortcode("[wppb-register]"); ?>
                </div>
            </div>


        </div>
    </div>
</div>

<?php

get_footer();