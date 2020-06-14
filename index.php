<?php
get_header();
if (have_posts() ) { while (have_posts()) { the_post(); ?>
    <h2>
        <?php if(is_single()) : ?>
            <?php the_title(); ?>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <?php endif; ?>
    </h2>
    <section class="content">
        <?php the_content(); ?>
    </section>
    <?php if(is_front_page()) : ?>
    <section class="blocks">
        <?php
        dynamic_sidebar('block-l');
        dynamic_sidebar('block-m');
        dynamic_sidebar('block-r');
        ?>
    </section>
    <?php endif;
}}
get_footer();