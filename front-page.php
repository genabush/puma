<?php
get_header();
?>
    <div class="main-content">

        <?php $mainBanner = get_field('main_banner'); ?>
        <?php if( $mainBanner ){ ?>
        <div class="main-banner section" style="background-image: url('<?php echo $mainBanner['background_image_m']; ?>');">
            <div class="container">
                <h1 class="main-banner__title"><?php echo $mainBanner['title_m']; ?></h1>
            </div>
        </div>
        <?php } ?>

        <?php $sectionOne = get_field('section_one'); ?>
        <?php if( $sectionOne ){ ?>
        <section id="section_1" class="advertising-banner section" style="background-image: url('<?php echo $sectionOne['background_image_one']; ?>');">
            <div class="container--box">
                <h3 class="advertising-banner__title"><?php echo $sectionOne['title_one']; ?></h3>
                <a href="<?php echo $sectionOne['link_banner_one']; ?>" class="btn"><?php echo $sectionOne['anchor_one']; ?></a>
            </div>
        </section>
        <?php } ?>

        <?php $lincSection = get_field('link_section'); ?>
        <?php if( $lincSection ){ ?>
        <div id="section_2" class="link-list section">
            <div class="container--box">
                <ul>
                <?php foreach ($lincSection as $itemSection ){
                    $flag =
                        !empty($itemSection['title_s']) &&
                        !empty($itemSection['link_s']) &&
                        !empty($itemSection['left_background_image']) &&
                        !empty($itemSection['right_background_image']);
                    if( $flag ) { ?>
                    <li>
                        <a href="<?php echo $itemSection['link_s']; ?>">
                            <div class="link-list__left-img" style="background-image: url('<?php echo $itemSection['left_background_image']['sizes']['large']; ?>')"></div>
                            <div class="link-list__text">
                                <span><?php echo $itemSection['title_s']; ?></span>
                            </div>
                            <div class="link-list__right-img" style="background-image: url('<?php echo $itemSection['right_background_image']['sizes']['large']; ?>')"></div>
                        </a>
                    </li>
                    <?php }?>
                <?php } ?>
                </ul>
            </div>
        </div>
        <?php } ?>
        <?php $sectionThree = get_field('section_three'); ?>
        <?php if( $sectionThree ){ ?>
        <div id="section_3" class="banner-box section" style="background-image: url('<?php echo $sectionThree['background_image_three']; ?>')">
            <div class="container--box">
                <h4 class="banner-box__title">
                    <?php echo $sectionThree['title_three']; ?>
                </h4>
                <h5 class="banner-box__subtitle">
                    <?php echo $sectionThree['sub_title_three']; ?>
                </h5>
                <p>
                    <?php echo $sectionThree['description_three']; ?>
                </p>
                <a href="<?php echo $sectionThree['link_three']; ?>" class="btn"><?php echo $sectionThree['anchor_three']; ?></a>
            </div>
        </div>
        <?php } ?>

    <?php $sectionFour = get_field('section_four'); ?>
    <?php if( $sectionFour ){ ?>
        <div id="section_4" class="banner-box section" style="background-image: url('<?php echo $sectionFour['background_image_four']; ?>')">
            <div class="container--box">
                <h4 class="banner-box__title">
                    <?php echo $sectionFour['title_four']; ?>
                </h4>
                <h5 class="banner-box__subtitle">
                    <?php echo $sectionFour['sub_title_four']; ?>
                </h5>
                <p>
                    <?php echo $sectionFour['description_four']; ?>
                </p>
                <a href="<?php echo $sectionFour['link_four']; ?>" class="btn"><?php echo $sectionFour['anchor_four']; ?></a>
            </div>
        </div>
    <?php } ?>
<?php $sectionFive = get_field('section_five'); ?>
        <?php if( $sectionFive ){ ?>
        <div id="section_5" class="banner-box section" style="background-image: url('<?php echo $sectionFive['background_image_five']; ?>')">
            <div class="container--box">
                <h4 class="banner-box__title">
                    <?php echo $sectionFive['title_five']; ?>
                </h4>
                <h5 class="banner-box__subtitle">
                    <?php echo $sectionFive['sub_title_five']; ?>
                </h5>
                <p>
                    <?php echo $sectionFive['description_five']; ?>
                </p>
                <a href="<?php echo $sectionFive['link_five']; ?>" class="btn"><?php echo $sectionFive['anchor_five']; ?></a>
            </div>
        </div>
        <?php }  ?>
    </div>
<?php
get_footer();
