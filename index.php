<?php
get_header();
if (have_posts()) { ?>
    <section class="content">
    <?php if(is_front_page()) : ?>
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
    <?php elseif(is_page(array('de-agenda','the-agenda'))) : ?>
        <section class="planning">
            <?php the_content(); ?>
            <?php echo do_shortcode('[dancal divid="calendar"]'); ?>
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
        <?php the_content(); ?>
    <?php elseif(is_page(array('fotos','photos','fotodetails','photodetails'))) : ?>
        <section class="photos">
            <h2><?php echo (is_single() || is_singular() || is_page() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?></h2>
            <?php the_content(); ?>
        </section>
    <?php elseif(is_page(array('documenten','documents'))) : ?>
        <section class="documents">
            <?php
            if (is_active_sidebar('documents')) {
                dynamic_sidebar('documents');
            }
            else {
                echo 'No content available.';
            }
            ?>
            <?php the_content(); ?>
        </section>
    <?php else : ?>
        <?php if(is_post_type_archive('games')) : ?>
            <div class="search_form">
                <?php get_search_form(); ?>
            </div>
            <div class="masonry">
                <article class="d-none">
                    <!-- display all tags -->
                </article>
                <?php $posts = query_posts($query_string.'&orderby=title&order=asc'); var_dump($query_string); ?>
                <?php while (have_posts()) : the_post() ?>
                    <article>
                        <a href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <?php the_excerpt(); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <?php
                $catlist = null;
                $cats = get_the_category();
                foreach($cats as $cat) {
                    $catlist .= $cat->slug.' ';
                }
                $colwidth = is_page(array('contact','contact-us')) ? 'col-lg-4' : 'col-lg-8';
                ?>
            <div class="row">
                <aside class="d-none d-lg-block col-lg-2 border-right ruler"></aside>
                <section class="col <?php echo $colwidth ?>">
                <?php while (have_posts()) : the_post() ?>
                    <article <?php echo (!is_null($catlist) ? 'class="'.trim($catlist).'"' : null); ?>>
                        <h2><?php echo (is_single() || is_singular() || is_page() ? get_the_title() : '<a href="'.get_the_permalink().'">'.get_the_title().'</a>'); ?></h2>
                        <div class="row">
                            <div class="col col-10">
                                <?php the_content(); ?>
                            </div>
                            <div class="col col-2">
                                <?php the_post_thumbnail(); ?>
                                <?php the_terms(get_the_ID(), 'soort', 'Gamesoort: ', ' , '); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
                </section>
            <?php if(is_page(array('contact','contact-us'))) : ?>
                <aside class="col col-4 maps">
                    <?php dynamic_sidebar('contact-maps'); ?>
                </aside>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
    </section>
<?php }
get_footer();