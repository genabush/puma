<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package puma-theme
 */

?>
<footer class="footer">
    <div class="footer__main">
        <div class="container flex">
            <div class="footer__col">
                <h4 class="footer__title"><?php echo get_field('footer_title', 'option');  ?></h4>
                <?php
                    $telephone = get_field('footer_telephone', 'option');
                    $email     = get_field('footer_email', 'option');
                ?>
                <ul>
                    <li><?php echo get_field('footer_address', 'option');  ?></li>
                    <li>
                        <a href="tel:<?php echo str_replace(array('+','-',' '), array('','',''), $telephone); ?>"><?php echo $telephone; ?></a></li>
                    <li>
                        <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        <div class="container">
            <div>© <?php echo date('Y'); ?> LIFECOM NEUE MEDIEN – <a href="https://WWW.LIFECOM.CH" target="_blank">WWW.LIFECOM.CH</a></div>
        </div>
    </div>

    <?php $references = get_field('references', 'option'); ?>
    <?php if( !empty($references) ) { ?>
        <div class="footer__references">
            <div class="container">
                <ul>
                    <?php foreach( $references as $ref ) {
                        $name = $ref['link']['title'];
                        $url = $ref['link']['url'];
                        $blank = !empty($ref['link']['target']) ? $ref['link']['target'] : '';
                        ?>

                        <?php if ( !empty($name) ) { ?>
                            <li><a href="<?php echo $url; ?>" target="<?php echo $blank; ?>"><?php echo $name; ?></a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } ?>

</footer>
<?php if( is_front_page() ) { ?>
    <div id="nav" class="anchor-nav">
        <ul>
            <li><a id="nav_section1" class="active" href="#section_1">1</a></li>
            <li><a id="nav_section2" href="#section_2">2</a></li>
            <li><a id="nav_section3" href="#section_3">3</a></li>
            <li><a id="nav_section4" href="#section_4">4</a></li>
            <li><a id="nav_section5" href="#section_5">5</a></li>
        </ul>
    </div>
<?php } ?>
</div>

<?php wp_footer(); ?>

</body>
</html>
