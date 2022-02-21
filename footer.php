    </div>
</main>
<?php if(is_front_page()) : ?>
    <section class="container">
            <div id="instagram_feed"></div>
            <script type="text">
                /*<![CDATA[*/
                /*instagram-config7*/
                (function() {
                    new InstagramFeed({
                        'username': 'tsv.prodeo',
                        'container': document.getElementById('instagram_feed'),
                        'display_profile': 0,
                        'display_biography': 0,
                        'display_gallery': true,
                        'display_igtv': false,
                        'callback': null,
                        'styling': true,
                        'items': 5,
                        'items_per_row': 1,
                        'margin': 0.00
                    });
                })();
                /*]]>*/
            </script>
    </section>
<?php endif; ?>
<footer class="container-fluid py-3">
    <div class="container d-flex flex-column flex-lg-row justify-content-lg-between">
        <section>
            &copy; <?php echo date("Y"); echo ' '; echo bloginfo('name'); ?>
            <?php $contact_id = pll_current_language() == 'nl' ? 2 : 965 ?>
            - <a href="<?php the_permalink($contact_id); ?>"><?php echo get_the_title($contact_id); ?></a>
        </section>
        <?php $avg_id = pll_current_language() == 'nl' ? 3 : 1008 ?>
        <a href="<?php the_permalink($avg_id); ?>"><?php echo get_the_title($avg_id); ?></a>
        <section>
            <?php echo pll_current_language() == 'nl' ? 'Ontwerp en ontwikkeling door de' : 'Design and development by the' ?>
            <a href="https://www.prodeo.utwente.nl/contact/#colofon">Pro Deo Digicom</a>
        </section>
    </div>
</footer>
<?php dynamic_sidebar('scripts-footer'); ?>
<?php wp_footer(); ?>
</body>
</html>
