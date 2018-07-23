<?php
/**
 * Template file for home page
 * Displays all HTML content
 * Theme Name: SomeTheme
 */
header('Location: /');
?>

<?php get_header(); ?>
 <?php if( function_exists('bxslider') ) bxslider('slider'); ?>
 <?php comments_template( '', true ); // Комментарии ?>

          <!-- <div class="slider-wrap">
            <div id="slider" class="slider-images">
             <div>
               <li>  
               <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div>
               <div class="myt">
                 <div class="patch-man">ИСТИННЫЙ ПУТЬ ЧЕЛОВЕКА</div><br>
                 <div class="shop-title">Интернет портал авторских книг</div>
                 <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения! 
                  Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>
                </div>
              </li>
            </div>
            <div>
             <li>  <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div><div class="myt">
               <div class="patch-man">Истинный путь человека</div><br>
               <div class="shop-title">Интернет портал авторских книг</div>
               <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения! 
                Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>
              </div>
            </li>
          </div>
          <div>
            <li> <div class="slide"><img src="images/font.jpg" class="img-responsive img-height"></div><div class="myt">
             <div class="patch-man">Истинный путь человека</div><br>
             <div class="shop-title">Интернет портал авторских книг</div>
             <p>Все книги в интернет-магазине на период тестирования доступны только в режиме онлайн чтения! 
              Наш интернет портал предлагает Вашему вниманию онлайн магазин электронных книг для духовного саморазвития человека – ресурс, включающий в себя статьи и электронные версии авторских книг по направлениям духовного развития человека и научно-публицистической литературы. Каталог портала постоянно пополняется новыми статьями и книгами авторов. На нашем интернет портале находится тематический “Форум” на котором Вы можете обсудит прочитанные книги или другую информацию по тематике сайта. Все книги нашего интерент-портала вы можете бесплатно прочитать на своем компьютере, планшете или смартфоне в режиме онлайн. Любую заинтересовавшую Вас книгу можно купить в электронном виде (в форматах .epub и .pdf) для последующего чтения на различных электронных устройствах. В ближайшее время для покупки с доставкой будут доступны книги в печатном виде. Печатные издания оформляются по отдельному запросу.</p>
            </div>
          </li>
        </div>
      </div>
    </div> -->

   <?php  $post = get_post(53); ?>

    <section id="brands-book" class="popular">
      <div class="brendcobtent">
        <div class="container">
          <div class="about-line row">
            <div class="text-left about-line_content col-lg-6">
             <span class="books-bog"><strong><?php echo $post ->post_title; ?></strong></span><br>
             <p>
             <?php echo $post ->post_content; ?>
            </p>
            <button type="button" class="btn btn-default navbar-btn-shop buy" >КУПИТЬ</button>
          </div>
          <div class="about-line_content col-lg-6">
            <div class="img-bible"><?php echo the_post_thumbnail('full',array('class' => 'img-responsive'));  ?></div>
          </div>
        </div>
      </div>
    </div>
  </section>
   <?php  $post = get_post(58); ?>
  <section id="line" class="catalog">
    <div class="contents products-area">
      <span class="contentp"><p><img class="img-responsive" src="images/bask.png" alt=""></p></span>
      <span class="contentsp title"><?php echo $post ->post_title; ?></span>
      <p><?php echo $post ->post_content; ?></p>
      <span class="shop"><p>Книги магазина</p></span>
      <section class="center slider">

<?php if( function_exists('bxslider') ) bxslider('slider2'); ?>
      <!--  <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
           <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
           <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
           <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
           <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
        <div>
         <div> <img src="images/covenant.png">
         </div>
         <span class="names"><strong>Новейший завет</strong></span>
          <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
         <div>
           <div> <img src="images/covenant.png">
           </div>
           <span class="names"><strong>Новейший завет</strong></span>
           <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
           <div>
             <div> <img src="images/covenant.png">
             </div>
             <span class="names"><strong>Новейший завет</strong></span>
              <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div>
             <div>
               <div> <img src="images/covenant.png">
               </div>
               <span class="names"><strong>Новейший завет</strong></span>
               <div class="price">300 руб  <button class="button-buy"><i class="fa fa-shopping-basket" aria-hidden="true"></i></button></div></div> -->
             </section>
           </div>
         </section>
            <?php  $post = get_post(68); ?>
         <section id="brands" class="popular">
          <div class="bookcontent">
            <div class="container margin-bottom">
             <div class="contents products-area">
               <span class="contentp"><p><img class="img-responsive" src="images/book.png" alt=""></p></span>
               <span class="contentsp title"><?php echo $post ->post_title; ?></span>
               <p><?php echo $post ->post_content; ?></p>

               <span class="shop"><p>Книги магазина</p></span>
               <div class="content-images">
                <div class="row">

 <?php $price = query_posts('post_type=post&cat=6');
$count =1;
foreach ($price as $post):
  the_post();?>
                 <div class="col-md-6 col-sm-6 centered">
                  <div class="product-box">
                    <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
                   <div class="items">
                    <span class="name-book"><strong><?=$post->post_title; ?></strong></span>
                   <div class="price"><?php the_content();?><button class="button-buy"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
                   </div>
                   </div>
                  </div>
                </div>
                <?php if ($count % 2 === 0 ) {
  echo '<div class="clearfix visible-sm"></div>';
}
$count++;
?>
<?php
endforeach;
wp_reset_query();?>
               <!--  <div class="col-md-3">
                  <div class="product-box">
                    <img class="img-responsive" src="images/litle-book.png" alt="">
                     <div class="items">
                     <span class="name-book"><strong>Новейший завет</strong></span>
                   <div class="price">Бесплатно! <button class="button-buy"> <i class="fa fa-shopping-basket" aria-hidden="true"></i></button>
                  </div>
                  
                </div> 
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
    <div class="box">
      <div class="container box-container">
        <section class="headline col-sm-12"><h2>Рецепты лечения народными средствами</h2></section>
      </div>
    </div>

    <div class="block">
      <div class="container">
        <div class="row">

 <?php $price = query_posts('post_type=post&cat=7');
$count =1;
foreach ($price as $post):
  the_post();?>
          <div class="post col-lg-12">
            <div class="post-header">
              <h6><?= $post->post_title; ?></h6>
            </div>
            <div class="about col-lg-2 col-md-2">
              <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
            </div>
            <div class="info col-lg-10 col-md-10">
              <p class="font"><?php the_content(); ?><a href="#" class="full-text">[...]</a></p>
              <div class="post-footer to-left">
                <div class="button-love to-left top">
                  <p class="love-text">Нравится ли вам это? <i class="fa fa-heart-o" aria-hidden="true"></i><span class="love-icon"> 8 </span></p>
                </div>
                <div class="post-links to-right"> 
                  <span class="comments">
                   <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a> 
                 </span>
                 <span class="more"> <a href="#" class="link hover-link">Подробнее</a></span>
               </div>
             </div>
           </div>
         </div>
         <?php if ($count % 2 === 0 ) {
  echo '<div class="clearfix visible-sm"></div>';
}
$count++;
?>
<?php
endforeach;
wp_reset_query();?>
       </div>
     </div>
     <div class="container">
      <div class="row">
 <?php $price = query_posts('post_type=post&cat=7');
$count =1;
foreach ($price as $post):
  the_post();?>
          <div class="post col-lg-12">
            <div class="post-header">
              <h6><?= $post->post_title; ?></h6>
            </div>
            <div class="about col-lg-2 col-md-2">
              <?php the_post_thumbnail('full',array('class' => 'img-responsive')); ?>
            </div>
            <div class="info col-lg-10 col-md-10">
              <p class="font"><?php the_content(); ?><a href="#" class="full-text">[...]</a></p>
              <div class="post-footer to-left">
                <div class="button-love to-left top">
                  <p class="love-text">Нравится ли вам это? <i class="fa fa-heart-o" aria-hidden="true"></i><span class="love-icon"> 8 </span></p>
                </div>
                <div class="post-links to-right"> 
                  <span class="comments">
                   <i class="fa fa-comment-o" aria-hidden="true"></i><a href="#" class="hover-link number-comment">0</a> 
                 </span>
                 <span class="more"> <a href="#" class="link hover-link">Подробнее</a></span>
               </div>
             </div>
           </div>
         </div>
         <?php if ($count % 2 === 0 ) {
  echo '<div class="clearfix visible-sm"></div>';
}
$count++;
?>
<?php
endforeach;
wp_reset_query();?>
     </div>
   </div>


<?php $price = query_posts('post_type=post&cat=8');
$count =1;
foreach ($price as $post):
  the_post();?>
<div></div>

<?php if ($count % 2 === 0 ) {
  echo '<div class="clearfix visible-sm"></div>';
}
$count++;
?>
<?php
endforeach;
wp_reset_query();?>


   <div class="container">
    <div class="thin">
      <h6>1 Комментарий</h6>
    </div>
    <div class="row">
      <div class="user col-lg-1 col-md-1">
        <img src="images/user.jpg" class="circle" alt="">
      </div>
      <div class="usercomment col-lg-9 col-md-9">
        <p class="name">Артур:</p>
        <p class="time">Май 27, 2016 в 4:55 дп</p>
        <p class="paragraph">В вк Артур Ибрагимов 19.04.1984. Казань. У вас в пророчествах есть ошибки и в годах тоже.</p>
      </div>
      <div class="col-lg-2 col-md-2"><button class="button button-hover text-color" type="submit">Ответить</button></div>
    </div>
  </div>
  <div class="wrap-form">
    <div class="container">
      <div class="row">
        <div class="form-header">
          <h6>Добавить комментарий</h6>
        </div>
        <p class="paragraph margin-left">Ваш e-mail не будет опубликован. Обязательные поля помечены*</p>
        <form action="#" method="get" class="form">
          <p class="pr margin-left">Комментарий</p>
          <div class="row row-respons">
            <textarea name="comments" class="comm col-md-12 col-xs-12"></textarea>
          </div>
          <div class="row">
            <div class="username col-md-4 col-xs-4 margin-top">
              <p class="pr left">Имя*</p>
              <p><input type="text" class="margin-top input-text" required></p>
            </div>
            <div class="e-mail col-md-4 col-xs-4 margin-top">
              <p class="pr left">E-mail*</p>
              <p><input type="text" class=" margin-top input-text" required></p>
            </div>
            <div class="web col-md-4 col-xs-4 margin-top">
              <p class="pr left">Сайт</p>
              <p><input type="text" class="margin-top input-text"></p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 col-xs-12 margin-top">
              <input type="submit" value="Отправить комментарий" class="to-right submit button-hover sm-center">
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
<div class="forum">
  <div class="container">
    <section class="headline-forum col-sm-12">
      <h2>ФОРУМ</h2>
    </section>
    <div class="row">
      <div class="col-sm-12 pg-forum">
    
        <p>Общайтесь, делитесь своим мнением и знакомтесь на нашем форуме</p>
      </div>
    </div>
  </div>
</div>


<?php get_footer(); ?>