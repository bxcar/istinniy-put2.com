<?php
/**
 * Template for displaying the header
 * Theme Name: SomeTheme
 */      
 
add_action( 'wp_enqueue_scripts', 'scripts_and_styles' );
function scripts_and_styles(){
  
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', null, null, 'all' );
  wp_enqueue_style( 'font', get_template_directory_uri() . '/css/font.css', null, null, 'all' );
  wp_enqueue_style( 'styles', get_stylesheet_uri(), array('bootstrap'), null, 'all' );
  wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', null, null, 'all' );
  wp_enqueue_style( 'main', get_template_directory_uri() . '/css/main.css', null, null, 'all' );
  wp_enqueue_style( 'style', get_template_directory_uri() . '/css/style.css', null, null, 'all' );
  
  

  
  wp_dequeue_script( 'jquery' );
  wp_deregister_script( 'jquery' );
  wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery-1.12.3.min.js', null, null, true );
  wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), null, true );
  wp_enqueue_script( 'jem', get_template_directory_uri() . '/js/jquery-event-manager.ru.js', array('jquery'), null, true ); 
}     

?>

<!DOCTYPE html>    
<html <?php language_attributes(); ?>>
<head>
  <base href="<?php bloginfo( 'template_url' ); ?>/" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="Cache-Control" content="max-age=3600, must-revalidate" />
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="<?php bloginfo( 'description' ); ?>" />
  <title><?php bloginfo( 'title' ); ?></title>
	<!--[if lt IE 9]>
	<script src="<?php bloginfo( 'template_url' ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>
<body>

<div class="hero">
<header>

<nav class="navbar navbar-default">
<?php  $post = get_post(95); ?>
               <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <div class="logo-img">
                  <a id="logo" href="#" title="Истинный путь человека"><?php echo the_post_thumbnail('full',array('class' => 'img-responsive'));  ?></a>       
                </div>
                <div class="collapse navbar-collapse header_right" id="bs-example-navbar-collapse-1">
                <ul id="menu" class="nav navbar-nav list-nav">
                    <li><a class="active" href="#line">Главная</a></li>
                    <li><a  href="#brands">Лечение</a></li>
                    <li><a href="#why-us">Новости</a></li>
                    <li><a href="#feedback">Форум</a></li>
                    <li><a href="#">Магазин</a></li>
                    <li><a href="#feedback">Мой аккаунт</a></li>
                  </ul> 
                <!--  <?php 
            wp_nav_menu( array( 
              'theme_location' => 'header', 
              'container' => 'ul', 
              'menu_class' => 'nav navbar-nav list-nav' 
              ) ); 
              ?>  -->
                   <ul id="menu-nav" class="nav navbar-nav list-nav-img">
                   <li> <a href="#feedback" class="item__basket"> <img class="img-responsive" src="images/basket-menu.png" alt="basket"> <span class="basket__number">1</span> </a></li>
                   <li> <a href="#feedback"> <img class="img-responsive relative" src="images/glas.png" alt="glas"></a></li>
                 </ul> 


               </div>
             </div>
           </nav>
</header>