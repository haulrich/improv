<?php
get_header();
if (have_posts()) {
    while (have_posts()) { the_post(); ?>
    <h2><?php echo (is_single() || is_page() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?></h2>
    <section class="content">
        <?php the_content(); ?>
    </section>
    <?php if(is_front_page()) { ?>
        <section class="blocks">
            <?php
            dynamic_sidebar('block-l');
            dynamic_sidebar('block-m');
            dynamic_sidebar('block-r');
            ?>
        </section>
    <?php } elseif(is_page('bestuur') || is_page('board')) { ?>
        <section class="boardmembers">
            <?php dynamic_sidebar('board-members'); ?>
        </section>
        <?php dynamic_sidebar('board-details'); ?>
    <?php } elseif(is_page('documenten') || is_page('documents')) { ?>
        <section class="documents">
            <?php dynamic_sidebar('documents'); ?>
            <?php
            ?>
        </section>
    <?php }}}
get_footer();