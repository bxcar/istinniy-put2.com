<?php
/**
 * The template for displaying the footer
 * Theme Name: SomeTheme
 */
?>
<?php  $post = get_post(90); ?>

<footer class="footer">
  <div class="container">
    <div class="row margin-top mg-last-cl">
      <div class="logo-footer col-lg-2 col-xs-12">

        <h3 class="foter-logo-ctr"><?php echo the_post_thumbnail('full',array('class' => 'img-responsive'));  ?></h3>
      </div>
      <div class="about-us col-sm-4 col-xs-12">
      <?php  $post = get_post(70); ?>
        <h6 class="footer-headline"><?php echo $post ->post_title; ?></h6>
        <p class="footer-headline pr-footer"><?php echo $post ->post_content; ?></p>
      </div>
      <div class="menu col-sm-2 col-xs-12 min-px">
      
        <h6 class="footer-headline">Меню</h6>
         <?php 
            wp_nav_menu( array( 
              'theme_location' => 'footer', 
              'container' => 'ul', 
              'menu_class' => 'pr-margin-top line' 
              ) ); 
              ?> 
      </div>
      <div class="info-footer col-sm-3 col-xs-12 min-px">
        <h6 class="footer-headline">Информация</h6>
         <?php 
            wp_nav_menu( array( 
              'theme_location' => 'footer1', 
              'container' => 'ul', 
              'menu_class' => 'pr-margin-top line' 
              ) ); 
              ?> 
      </div>
      <div class="subscribe col-sm-1 col-xs-12 min-px">
        <h6 class="footer-headline ctr">Подпишись</h6>
        <ul class="pr-margin-top inline">
          <li class="logo-line"><a href="https://vk.com" target="_blank"><img src="images/logo-vk.png" alt=""></a></li>
          <li class="logo-line"><a href="https://www.facebook.com" target="_blank"><img src="images/logo-fb.png" alt=""></a></li>
          <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img src="images/logo-insta.png" alt=""></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer-block">
    <div class="row copyright"><p class="footer-pr">&copy; 2017 Истинный путь человека. All Rights Reserved. Muffin group</p></div>
  </div>
</footer>
<?php wp_footer(); ?>

</body>
</html>