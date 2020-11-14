<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="theatersport,prodeo,improv,improvisatie">
    <meta name="theme-color" content="#D74141">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v7.0&appId=1538696539739752&autoLogAppEvents=1" nonce="osBQol7B"></script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 my-lg-2">
            <a class="masthead" href="<?php echo home_url(); ?>">
                <?php dynamic_sidebar('logo'); ?>
                <h1 class="title-desc">
                    <?php echo get_bloginfo('name'); ?>
                    <span><?php echo get_bloginfo('description'); ?></span>
                </h1>
            </a>
        </div>
    </div>
    <div class="row shadow-top">
        <div class="col-lg-8 offset-lg-2">
            <div class="d-flex">
                <nav class="toggle">
                    <button></button>
                </nav>
                <nav class="header-menu" role="navigation">
                    <?php wp_nav_menu(array(
                        'container'       => false,
                        'fallback_cb'     => false,
                        'items_wrap'      => '<ul><li><a class="home" href="/"></a></li>%3$s</ul>',
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
    <?php if (function_exists('yoast_breadcrumb') && !is_front_page()) {
        echo '<section class="container-fluid breadcrumbs">';
        echo '<div class="row"><div class="col-lg-8 offset-lg-2"><nav class="breadcrumbs" aria-label="breadcrumbs">';
        yoast_breadcrumb();
        echo '</nav></div></div>';
        echo '</section>';
    } ?>
<main class="container-fluid" id="site-content" role="main">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">

