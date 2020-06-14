<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="theatersport,prodeo,improv,improvisatie">
    <meta name="theme-color" content="red">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="<?php echo home_url(); ?>">
                    <?php dynamic_sidebar('logo'); ?>
                    <h1 class="title-desc">
                        <?php echo get_bloginfo('name'); ?>
                        <span><?php echo get_bloginfo('description'); ?></span>
                    </h1>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav class="header-menu" role="navigation">
                    <?php wp_nav_menu(array(
                        'container'       => false,
                        'fallback_cb'     => false,
                        'items_wrap'      => '<ul>%3$s</ul>',
                    )); ?>
                    <ul>
                        <?php pll_the_languages(array('show_flags' => 1,'show_names' => 0)); ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<?php if(is_front_page()) : ?>
    <?php dynamic_sidebar('fixed-photo'); ?>
<?php endif; ?>
<main class="container-fluid" id="site-content" role="main">
    <div class="container">
        <nav class="breadcrumb" aria-label="breadcrumbs">
            <?php if (function_exists('yoast_breadcrumb') ) {yoast_breadcrumb();} ?>
        </nav>