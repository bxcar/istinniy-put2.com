<?php
/**
 * The main template file
 * Displays all HTML content
 * Theme Name: SomeTheme
 */

get_header();

  while( have_posts() ) :
    the_post();
    the_content();
  endwhile;

get_footer();