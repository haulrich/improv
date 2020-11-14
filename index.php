<?php
get_header();
if (have_posts()) { ?>
    <section class="content container">
        <?php if(is_archive('games')) : ?>
            <section class="row">
                <div class="col-12 col-md-6">
                    <div class="search_form">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="game_cats">
                        <?php $args = array(
                            'taxonomy' => 'games',
                            //'orderby' => 'name',
                            //'order'   => 'ASC'
                        );
                        $cats = get_categories($args);
                        foreach($cats as $cat) {
                            ?>
                            <a href="<?php echo get_category_link( $cat->term_id ) ?>">
                                <?php echo $cat->name; ?>
                            </a>
                            <?php } ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
            <?php if(is_archive()) : ?>
                <section class="row">
                    <div class="col-12 masonry">
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
            <?php else : ?>
                <?php while (have_posts()) : the_post() ?>
                    <h2><?php echo (is_single() || is_page() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?></h2>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php endif; ?>
        <?php if(is_front_page()) : ?>
            <section class="row blocks">
                <section class="col-12 col-lg-6 col-xl-4 mb-5">
                    <div class="block">
                    <?php dynamic_sidebar('block-l'); ?>
                    </div>
                </section>
                <section class="col-12 col-lg-6 col-xl-4 mb-5">
                    <div class="block block-m">
                    <?php dynamic_sidebar('block-m'); ?>
                    </div>
                </section>
                <section class="col-12 col-xl-4 mb-5">
                    <div class="block">
                    <?php dynamic_sidebar('block-r'); ?>
                    </div>
                </section>
            </section>
        <?php elseif(is_page(array('planning'))) : ?>
            <section class="planning">
            </section>
            <?php elseif (is_page(array('diensten','services'))) : ?>
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
    <?php endif; ?>
    </section>
<?php }
get_footer();