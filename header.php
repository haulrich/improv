<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="theatersport,prodeo,improv,improvisatie">
    <meta name="theme-color" content="#D74141">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#d2232a">
    <meta name="msapplication-TileColor" content="#d2232a">
    <meta name="theme-color" content="#d2232a">
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "https://www.prodeo.utwente.nl",
            "logo": "https://www.prodeo.utwente.nl/logo.png"
        }
    </script>
<!--    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v7.0&appId=1538696539739752&autoLogAppEvents=1" nonce="osBQol7B"></script>-->
    <?php dynamic_sidebar('scripts-header'); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php dynamic_sidebar('scripts-bodystart'); ?>

<header class="sticky-top">
    <div class="d-flex flex-md-column">
        <div class="container-md order-2 order-md-1 masthead">
            <a href="<?php echo home_url(); ?>">
                <?php dynamic_sidebar('logo'); ?>
                <h1 class="title-desc d-flex flex-column">
                    <?php bloginfo('name'); ?>
                    <span class="d-none d-sm-inline"><?php bloginfo('description'); ?></span>
                </h1>
            </a>
            <span class="d-none d-md-flex justify-content-end social">
                <?php dynamic_sidebar('social'); ?>
            </span>
        </div>
        <div class="container-md-fluid order-1 order-md-1 navhead">
            <nav class="container navbar navbar-expand-md navbar-dark p-md-0" role="navigation">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'improv' ); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php
                wp_nav_menu( array(
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'navbar-collapse',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker(),
                ) );
                ?>
            </nav>
        </div>
    </div>
    <?php if (function_exists('yoast_breadcrumb') && !is_front_page()) {
        echo '<section class="breadcrumbs">';
        echo '<nav class="container breadcrumbs" aria-label="breadcrumbs">';
        yoast_breadcrumb();
        echo '</nav>';
        echo '</section>';
    } ?>
</header>
<?php if(is_front_page()) : ?>
    <?php dynamic_sidebar('fixed-photo'); ?>
<?php endif; ?>

<main class="container-fluid" id="site-content" role="main">
    <div class="container">

