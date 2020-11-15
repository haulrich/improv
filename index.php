<?php
get_header();
$posts = query_posts($query_string.'&orderby=title&order=asc');
if (have_posts()) { ?>
    <section class="content">
    <?php if(is_archive()) : ?>
            <?php if(is_post_type_archive('games')) : ?>
                <div class="search_form">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
            <div class="masonry">
                <?php while (have_posts()) : the_post() ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <?php the_excerpt(); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        </section>
    <?php elseif(is_front_page()) : ?>
        <?php the_content(); ?>
        <section class="row blocks">
            <section class="col col-lg-6 col-xl-4 mb-5">
                <div class="block">
                    <?php dynamic_sidebar('block-l'); ?>
                </div>
            </section>
            <section class="col col-lg-6 col-xl-4 mb-5">
                <div class="block block-m">
                    <?php dynamic_sidebar('block-m'); ?>
                </div>
            </section>
            <section class="col col-xl-4 mb-5">
                <div class="block">
                    <?php dynamic_sidebar('block-r'); ?>
                </div>
            </section>
        </section>
    <?php elseif(is_page(array('planning'))) : ?>
        <section class="planning">
        </section>
    <?php elseif(is_page(array('diensten','services'))) : ?>
        <section class="services">
            <?php $the_query = new WP_Query(array('post_type'=> 'services',));
            if($the_query->have_posts() ) :
                while ( $the_query->have_posts() ) :
                    $the_query->the_post();
                    echo '<h2>'.get_the_title().'</h2>';
                    the_content();
                endwhile;
                wp_reset_postdata();
            endif; ?>
        </section>
    <?php elseif(is_page(array('bestuur','board'))) : ?>
        <section class="boardmembers">
            <?php dynamic_sidebar('board-members'); ?>
        </section>
        <?php dynamic_sidebar('board-details'); ?>
    <?php elseif(is_page(array('documenten','documents'))) : ?>
        <section class="documents">
            <?php dynamic_sidebar('documents'); ?>
            <?php
            ?>
        </section>
    <?php else : ?>
        <div class="row">
            <div class="col-1 offset-1">
                <aside class="h-100 border-right border-white"></aside>
            </div>
        <?php while (have_posts()) : the_post() ?>
            <article class="col-9">
                <h2><?php echo (is_single() || is_singular() || is_page() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?></h2>
                <?php the_content(); ?>
                <?php the_tags(' ', ', ', ' '); ?>
            </article>
        <?php endwhile; ?>
        </div>
    <?php endif; ?>
    </section>
<?php }
get_footer();