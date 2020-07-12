        </div>
    </div>
</main>
<?php if(is_front_page()) : ?>
    <section class="instagram">
        <div class="wrap">
            <?php echo wdi_feed(array('id'=>'1')); ?>
        </div>
    </section>
<?php endif; ?>
<footer class="container-fluid">
    <div class="row">
        <div class="col-lg-8 offset-lg-2 d-flex justify-content-between my-4">
            <section>
                &copy; <?php echo date("Y"); echo ' '; echo bloginfo('name'); ?>
                <?php $contact_id = pll_current_language() == 'nl' ? 2 : 965 ?>
                - <a href="<?php the_permalink($contact_id); ?>"><?php echo get_the_title($contact_id); ?></a>
            </section>
            <?php $avg_id = pll_current_language() == 'nl' ? 3 : 1008 ?>
            <a href="<?php the_permalink($avg_id); ?>"><?php echo get_the_title($avg_id); ?></a>
            <section>
                <?php echo pll_current_language() == 'nl' ? 'Ontwerp en ontwikkeling' : 'Design and development' ?>
                <a href="https://www.heidiulrich.nl" target="_blank">heidiulrich.nl</a>
            </section>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>