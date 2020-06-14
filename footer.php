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
    <div class="container">
        <section>
            &copy; <?php echo date("Y"); echo ' '; echo bloginfo('name'); ?>
        </section>
        <section>
            Ontwerp en ontwikkeling <a href="https://www.heidiulrich.nl" target="_blank">heidiulrich.nl</a>
        </section>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>