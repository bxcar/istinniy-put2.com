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
            <?php if(isset($_GET['loginerror'])) { ?><h4 class="autorization-login-title">НЕВЕРНЫЙ ПАРОЛЬ! - восстановление</h4>
            <div class="autorization-login">
              <?php echo do_shortcode("[wppb-recover-password]"); ?>
            </div><?php } else { ?><h4 class="autorization-login-title">Авторизация</h4>
            <div class="autorization-login">
              <?php echo do_shortcode("[wppb-login]"); ?>
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