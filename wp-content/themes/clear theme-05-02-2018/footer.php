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



      <div class="logo-footer col-sm-2 col-xs-12">







        <h3 class="foter-logo-ctr"><?php echo the_post_thumbnail('full',array('class' => 'img-responsive'));  ?></h3>



         <div class="tell">



                 <ul class="contacs-numberr">



            <li class="contacs-number-tel"><span><a href="tel:79858188439">+7(985)818-84-39</a></span></li>



             <li class="contacs-number-tel"><span><a href="tel:79858188441">+7(985)445-57-78</a></span></li>



              <li class="contacs-number-tel"><span><a href="tel:79854455778">+7(985)445-57-78</a></span></li>



            <li class="contacs-number-mail"><span><a href="mailto:zakaz@iztinniy-put.com">zakaz@istinniy-put.com</a></span></li>



          </ul>



                 </div>



      </div>



      <div class="about-us col-sm-3 col-xs-12">



      <?php  $post = get_post(70); ?>



        <h6 class="footer-headline"><?php echo $post ->post_title; ?></h6>



        <p class="pr-footer"><?php echo $post ->post_content; ?></p>



      </div>



      <div class="col-sm-2 col-xs-12 min-px">



      



        <h6 class="footer-headline">Меню</h6>



         <?php 



            wp_nav_menu( array( 



              'theme_location' => 'footer', 



              'container' => 'ul', 



              'menu_class' => 'pr-margin-top line' 



              ) ); 



              ?> 



      </div>



      <div class="info-footer col-sm-2 col-xs-12 min-px">



        <h6 class="footer-headline">Информация</h6>



         <?php 



            wp_nav_menu( array( 



              'theme_location' => 'footer1', 



              'container' => 'ul', 



              'menu_class' => 'pr-margin-top line' 



              ) ); 



              ?>



      </div>



      <div class="subscribe col-sm-2 col-xs-12 min-px">



        <h6 class="footer-headline ctr">Подпишись</h6>



        <ul class="pr-margin-top inline">



          <li class="logo-line"><a href="https://vk.com" target="_blank"><img src="images/logo-vk.png" alt=""></a></li>



           <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img src="images/ok.png" alt=""/></a></li>



          <li class="logo-line"><a href="https://www.facebook.com" target="_blank"><img src="images/logo-fb.png" alt=""/></a></li>



          <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img src="images/smile.png" alt=""/></a></li>



          <li class="logo-line"><a href="https://www.instagram.com" target="_blank"><img src="images/logo-insta.png" alt=""/></a></li>



        </ul>



      </div>     



    </div>



  </div>



  <div class="footer-block">



    <div class="row copyright">

    	<p class="footer-pr">&copy; <? echo date('Y');?> Истинный путь человека. Все права защищены Created by Creative Union PinoFran</p>

    </div>

	

	<div class="statistic">
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=47441545&amp;from=informer"
target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/47441545/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="47441545" data-lang="ru" /></a>
<!-- /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter47441545 = new Ya.Metrika2({
                    id:47441545,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true,
                    trackHash:true,
                    ecommerce:"dataLayer"
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/tag.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks2");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/47441545" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



	</div>



  </div>



</footer>



<?php wp_footer(); ?>






</body>



</html>