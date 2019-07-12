<?php
/*
 * Template name: Internal page
 * */
get_header();


?>

    <div class="main-content">
        <?php $sectionBannerIn = get_field('main_banner_in'); ?>
        <?php if( $sectionBannerIn ){ ?>
        <div class="main-banner section" style="background-image: url('<?php echo $sectionBannerIn['background_image_in']; ?>');">
            <div class="container">
                <h1 class="main-banner__title"><?php echo $sectionBannerIn['title_in']; ?></h1>
                <?php if(trim($sectionBannerIn['sub_title_in'])) { ?>
                <div>
                    <h2 class="main-banner__subtitle"><?php echo $sectionBannerIn['sub_title_in']; ?></h2>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <div class="text-box">
            <div class="container--box">
            <?php
            while ( have_posts() ) :
                the_post();

                    the_content();
            endwhile; // End of the loop.
            ?>
            </div>
        </div>
<?php if( get_field('bottom_banner_in') ){ ?>
        <div class="banner-box--no-text section" style="background-image: url('<?php echo get_field('bottom_banner_in'); ?>')"></div>
<?php } ?>
    </div>


<?php
get_footer();
