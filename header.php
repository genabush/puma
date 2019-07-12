<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package puma-theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="wrapper <?php echo is_front_page() ? 'index' : ''; ?>">
    <header id="header" class="header">
        <div class="container flex">
            <div class="logo"><a href="<?php echo get_home_url(); ?>"><img
                            src="<?php echo get_field('logo', 'option'); ?>" alt="<?php bloginfo('name'); ?>"></a></div>
            <nav class="navigation mobile">
                <div class="navigation__wrap">
                    <ul>
                        <?php wp_nav_menu(array('theme_location' => 'main_menu', 'container' => false, 'items_wrap' => '%3$s')); ?>
                    </ul>
                    <ul class="lang-menu">
                        <?php $languages = icl_get_languages('skip_missing=0&orderby=custom');
                        foreach ((array)$languages as $lang):
                            $active = ($lang['code'] == ICL_LANGUAGE_CODE) ? 'active' : '';
                            ?>
                            <li><a href="<?php echo $lang['url']; ?>" class="<?php echo $active; ?>"><?php echo $lang['code']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </nav>
        </div>
    </header>