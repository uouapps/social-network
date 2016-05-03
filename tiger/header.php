<!doctype html>
<html <?php language_attributes(); ?> >

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php $tiger_option_data =get_option('tiger_option_data'); ?>



  <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >
 <div class="uou-block-11a mobileMenu">
        <h5 class="title"><?php esc_html_e( 'Menu', 'tiger' ); ?></h5>
        <a href="#" class="mobile-sidebar-close"><?php esc_html_e( 'times', 'tiger' ); ?> </a>
          <?php get_template_part('templates/header','menuMobile'); ?>
        <hr>

        <?php
         // get_search_form();
         ?>
</div>

<div id="main-wrapper">
  <div class="toolbar">
        <?php get_template_part('templates/topS/header','topbarChoose'); ?>
        <?php get_template_part('templates/headerS/header','choose'); ?>
        <?php
        if ( !is_front_page() ) {
			get_template_part('templates/breadcrumbs/header','crumbChoose');
		}
         ?>

    </div>


