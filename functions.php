<?php
/**
 * puma-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package puma-theme
 */

if ( ! function_exists( 'puma_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function puma_theme_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on puma-theme, use a find and replace
		 * to change 'puma-theme' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'puma-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'puma-theme' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'puma_theme_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'puma_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function puma_theme_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'puma_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'puma_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function puma_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'puma-theme' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'puma-theme' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'puma_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function puma_theme_scripts() {
	wp_enqueue_style( 'puma-theme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'puma-theme-font', 'https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;subset=latin-ext' );
	wp_enqueue_style( 'puma-theme-custom-style', get_template_directory_uri() . '/dist/css/styles.min.css' );
    wp_enqueue_script('jquery');
	wp_enqueue_script( 'puma-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'puma-theme-number', get_template_directory_uri() . '/js/libs/number-plugin.js', array(), '1', true );
	wp_enqueue_script( 'puma-fast-click', get_template_directory_uri() . '/js/libs/fast-click.js', array(), '1', true );

	wp_enqueue_script( 'puma-theme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
//	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/dist/js/main.min.js', array(), null, true );
    if( is_front_page() ) {
        wp_enqueue_script( 'sticky-nav-js', get_template_directory_uri() . '/js/libs/index/stickynav.js', array(), null, true );
    }
//    if( is_page( 'cart' ) ) {
//        wp_enqueue_script( 'inputNumMutation', get_template_directory_uri() . '/js/libs/cart-page/mutation-observer.js', array(), null, true );
//    }

	wp_enqueue_script( 'script-js', get_template_directory_uri() . '/js/scripts.js', array(), null, true );
    wp_enqueue_script( 'quantity-js', get_template_directory_uri() . '/js/count-quantity.js', array(), null, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
    wp_deregister_script( 'wc-checkout' );
	wp_enqueue_script( 'wc-checkout', get_template_directory_uri() . '/woocommerce/js/checkout.min.js', array( 'jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n' ), '3.4.5', true );

    wp_deregister_script( 'wc-cart' );
    wp_enqueue_script( 'wc-cart', get_template_directory_uri() . '/woocommerce/js/cart.min.js', array( 'jquery', 'woocommerce', 'wc-country-select', 'wc-address-i18n' ), '3.4.5', true );

}
add_action( 'wp_enqueue_scripts', 'puma_theme_scripts' );


add_action( 'wp_enqueue_scripts', 'de_script', 1000 );

function de_script() {

    wp_deregister_script( 'wc-add-to-cart-variation' );
    wp_register_script( 'wc-add-to-cart-variation', get_template_directory_uri() . '/woocommerce/js/add-to-cart-variation.js', array( 'jquery', 'wp-util' ), '5.0.0', true );

}
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

function register_my_widgets(){
    register_sidebar( array(
        'name' => 'Widget on shop page',
        'id' => 'homepage-sidebar',
        'description' => 'Widget for filter.',
        'before_widget' => '<aside>',
        'after_widget' => '</aside>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_custom_description', 'woocommerce_template_single_excerpt', 20 );


/*add options page*/
if( function_exists('acf_add_options_page') ) {

    acf_add_options_page('General settings');

}

/* register menu */
if ( function_exists( 'register_nav_menu' ) ) {
    register_nav_menus(
        array(
        'main_menu' => 'Main menu'
        ));
}


/**
 * Change the breadcrumb separator
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to ''
    $defaults['delimiter'] = '';
    return $defaults;
}
// Remove the sorting dropdown from Woocommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_catalog_ordering', 30 );
// Remove the result count from WooCommerce
remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * @snippet       Remove Additional Information Tab @ WooCommerce Single Product Page
 * @how-to        Watch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecode    https://businessbloomer.com/?p=317
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 3.3.4
 */

add_filter( 'woocommerce_product_tabs', 'bbloomer_remove_product_tabs', 98 );

function bbloomer_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
    return $tabs;
}
/* remove comments */
add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
function wcs_woo_remove_reviews_tab($tabs) {
    unset($tabs['reviews']);
    return $tabs;
}
/* remove sku */
//add_filter( 'wc_product_sku_enabled', '__return_false' );
/* remove category  */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/* remove title  */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart');

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart');

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', function( $size ) {
    return array(
        'width' => 160,
        'height' => 160,
        'crop' => 1,
    );
} );

/*print notice before breadcrumbs*/
remove_action( 'woocommerce_before_single_product', 'wc_print_notices');
add_action( 'woocommerce_before_main_content', 'wc_print_notices', 10 );

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

function custom_override_checkout_fields( $fields ) {

    $fields['billing']['billing_first_name']['placeholder'] = __('First name', 'woocommerce');
//    $fields['billing']['billing_first_name']['label'] = '';

    $fields['billing']['billing_last_name']['placeholder'] = __('Last name', 'woocommerce');
//    $fields['billing']['billing_last_name']['label'] = false;

    $fields['billing']['billing_company']['placeholder'] = __('Company', 'woocommerce');
//    $fields['billing']['billing_company']['label'] = false;

    $fields['billing']['billing_city']['placeholder'] = __('City', 'woocommerce');
//    $fields['billing']['billing_city']['label'] = false;

    $fields['billing']['billing_state']['placeholder'] = __('State', 'woocommerce');
//    $fields['billing']['billing_state']['label'] = false;

    $fields['billing']['billing_postcode']['placeholder'] = __('Postcode', 'woocommerce');
//    $fields['billing']['billing_postcode']['label'] = false;

    $fields['billing']['billing_phone']['placeholder'] = __('Phone', 'woocommerce');
//    $fields['billing']['billing_phone']['label'] = false;

    $fields['billing']['billing_email']['placeholder'] = __('Email', 'woocommerce');
//    $fields['billing']['billing_email']['label'] = false;

    $fields['billing']['billing_address_1']['placeholder'] = __('Address', 'woocommerce');
//    $fields['billing']['billing_address_1']['label'] = false;

    $fields['billing']['billing_address_2']['placeholder'] = __('Address2', 'woocommerce');
//    $fields['billing']['billing_address_2']['label'] = false;

    $fields['billing']['billing_comment'] = array(
        'priority'  => 200,
        'type'      => 'textarea',
        'label' => __('Order Comments', 'woocommerce'),
        'placeholder' => __('Comments', 'woocommerce'),
        //'placeholder'   => 'Bemerkungen',
        'required'  => false,
        'clear'     => true,
    );

    /*shipping fields*/
    $fields['shipping']['shipping_first_name']['placeholder'] = __('First name', 'woocommerce');
//    $fields['shipping']['shipping_first_name']['label'] = false;

    $fields['shipping']['shipping_last_name']['placeholder'] = __('Last name', 'woocommerce');
//    $fields['shipping']['shipping_last_name']['label'] = false;

    $fields['shipping']['shipping_company']['placeholder'] = __('Company', 'woocommerce');
//    $fields['shipping']['shipping_company']['label'] = false;

    $fields['shipping']['shipping_address_1']['placeholder'] = __('Address', 'woocommerce');
//    $fields['shipping']['shipping_address_1']['label'] = false;

    $fields['shipping']['shipping_address_2']['placeholder'] = __('Address2', 'woocommerce');
//    $fields['shipping']['shipping_address_2']['label'] = false;

    $fields['shipping']['shipping_city']['placeholder'] = __('City', 'woocommerce');
//    $fields['shipping']['shipping_city']['label'] = false;

    $fields['shipping']['shipping_state']['placeholder'] = __('State', 'woocommerce');
//    $fields['shipping']['shipping_state']['label'] = false;

    $fields['shipping']['shipping_postcode']['placeholder'] = __('Postcode', 'woocommerce');
//    $fields['shipping']['shipping_postcode']['label'] = false;

    $fields['account']['account_password']['label'] = '';

    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_country']);
    unset($fields['shipping']['shipping_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['shipping']['shipping_state']);
    return $fields;
}

/**
 * Display custom checkout fields on the order in admin panel (WooCommerce orders)
 */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'puma_custom_checkout_fields_display_admin_order_meta', 10, 1 );
function puma_custom_checkout_fields_display_admin_order_meta($order) {
    echo '<p><strong>' . __('Order Comments', 'woocommerce') . ':</strong> <br>' . get_post_meta($order->get_id(), '_billing_comment', true) . '</p>';
}

// define the woocommerce_checkout_cart_item_quantity callback
function filter_woocommerce_checkout_cart_item_quantity( $strong_class_product_quantity_sprintf_times_s_cart_item_quantity_strong, $cart_item, $cart_item_key ) {
    // make filter magic happen here...
    /*$arrString = explode(" ", $strong_class_product_quantity_sprintf_times_s_cart_item_quantity_strong);*/
    $str = $strong_class_product_quantity_sprintf_times_s_cart_item_quantity_strong;
    if(preg_match_all('/\>(.*?)\</',$str,$match)) {
        $arrString = explode(" ", $match[1][0]);

        $strong_class_product_quantity_sprintf_times_s_cart_item_quantity_strong = '<strong class="product-quantity">'.$arrString[1].' '.$arrString[0].'</strong>';
    }
    return $strong_class_product_quantity_sprintf_times_s_cart_item_quantity_strong;
};

// add the filter
add_filter( 'woocommerce_checkout_cart_item_quantity', 'filter_woocommerce_checkout_cart_item_quantity', 10, 3 );


add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );

function jk_change_breadcrumb_home_text( $defaults ) {

    $defaults['home'] = 'Shop';

    return $defaults;
}
/* change link to shop */
add_filter( "woocommerce_breadcrumb_home_url", "woo_custom_breadrumb_home_url" );
function woo_custom_breadrumb_home_url() {
    $shop_page_id = get_option( 'woocommerce_shop_page_id' );
    return get_permalink( $shop_page_id );
}

/* remove breadcrumbs on shop pgae */
add_action( "woocommerce_before_main_content", "remove_wc_breadcrumbs" );
function remove_wc_breadcrumbs() {
    if( is_archive() ) {
        remove_action("woocommerce_before_main_content", "woocommerce_breadcrumb", 20, 0);
    }
}
/**
 * @param $image
 * @param $_this
 * @param $size
 * @param $attr
 * @param $placeholder
 * @return mixed
 */
function filter_woocommerce_product_get_image($image, $_this, $size, $attr, $placeholder ) {
    if( !is_page('cart') && !is_page('checkout') ) {
        $image = '<div class="product__img" style="background-color: ' . get_field('background_color') . ';"> ' . $image . '</div>';
    }
    return $image;
}
add_filter ( 'woocommerce_product_get_image', 'filter_woocommerce_product_get_image', 10, 5);

// define the woocommerce_before_main_content callback
function action_woocommerce_before_main_content( $args ) {
    woocommerce_breadcrumb( $args );
}
// add the action
add_action( 'woocommerce_before_checkout_form', 'action_woocommerce_before_main_content', 10, 1 );

/**
 * Redirect users to custom URL based on their role after login
 *
 * @param string $redirect
 * @param object $user
 * @return string
 */
function puma_wc_custom_user_redirect( $redirect, $user ) {

    $role = $user->roles[0];
    $dashboard = admin_url();
    $checkout = get_permalink( wc_get_page_id( 'checkout' ) );

    if( $role == 'administrator' ) {
        $redirect = $dashboard;
    } elseif ( $role == 'shop-manager' ) {
        $redirect = $dashboard;
    } elseif ( $role == 'editor' ) {
        $redirect = $dashboard;
    } elseif ( $role == 'author' ) {
        $redirect = $dashboard;
    } elseif ( $role == 'customer' || $role == 'subscriber' ) {
        $redirect = $checkout;
    } else {
        $redirect = wp_get_referer() ? wp_get_referer() : home_url();
    }
    return $redirect;
}
add_filter( 'woocommerce_login_redirect', 'puma_wc_custom_user_redirect', 10, 2 );

/**
 * Changes the order in which fields are displayed on checkout page.
 */
 function puma_wc_override_ordering_checkout_fields($fields) {
    $fields_order = array( 'last_name', 'first_name', 'company', 'address_1', 'address_2', 'postcode', 'city', 'state', 'country');

    // Set fields priority
    $priority = 10;

    foreach ( $fields_order as $key ) {
        if ( ! isset( $fields[ $key ] ) ) {
            continue;
        }

        $fields[ $key ]['priority'] = $priority;
        $priority += 10;
    }

    // Change fields order
    $fields_ordered = array();

    foreach ( $fields_order as $key ) {
        if ( isset( $fields[ $key ] ) ) {
            $fields_ordered[ $key ] = $fields[ $key ];
        }
    }

    return $fields_ordered;
}
add_filter('woocommerce_default_address_fields', 'puma_wc_override_ordering_checkout_fields');

/**
 * Redirect to shop page if the user logged in and asked page myaccount.
 */
$url = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://';
$url = $url . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if(is_user_logged_in() && $url == get_permalink( wc_get_page_id( 'myaccount' ) ) ) {
    wp_redirect( get_permalink( wc_get_page_id( 'shop' ) ) );
    exit;
}

/**
 * Adjust the quantity input values Simple products
 * https://docs.woocommerce.com/document/adjust-the-quantity-input-values/
 */
add_filter( 'woocommerce_quantity_input_args', 'puma_product_simple_quantity_after_add_cart', 10, 2 ); // Simple products
function puma_product_simple_quantity_after_add_cart( $args, $product ) {
    if ( is_singular( 'product' ) ) {
        $args['input_value'] 	= 1;	// Starting value (only affect product pages, not cart)
    }
    $args['min_value'] 	= 1;   	// Minimum value
    //$args['max_value'] 	= 80; 	// Maximum value
    //$args['step'] 		= 1;    // Quantity steps

    return $args;
}

/**
 * Adjust the quantity input values Variations products
 * https://docs.woocommerce.com/document/adjust-the-quantity-input-values/
 */
add_filter( 'woocommerce_available_variation', 'puma_product_variation_quantity_after_add_cart' ); // Variations products
function puma_product_variation_quantity_after_add_cart( $args ) {
    $args['min_qty'] = 1;   	// Minimum value (variations)
    //$args['max_qty'] = 80; 		// Maximum value (variations)

    return $args;
}

/**
 * Hides name of method shipping.
 */
add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_name_from_shipping_label', 10 );
function remove_name_from_shipping_label( $label ){
    $pos = strpos( $label, ': ' );
    return substr( $label, ++$pos );
}

// on page thank you in table order-details remove string 'shipped via' in column shipping
add_filter( 'woocommerce_order_shipping_to_display_shipped_via', 'puma_wc_order_shipping_to_display_shipped_via', 10, 2 );
function puma_wc_order_shipping_to_display_shipped_via( $nbsp_small_class_shipped_via_sprintf_via_s_woocommerce_this_get_shipping_method_small, $instance ) {
    return "";
}

/**
 * Change html fragment quantity on page cart via Ajax
 */
add_action( 'wp_ajax_nopriv_quantity_html', 'puma_ajax_change_html_quantity' );
add_action( 'wp_ajax_quantity_html', 'puma_ajax_change_html_quantity' );
function puma_ajax_change_html_quantity() {
    wp_die('my_ajax_success');
}

// Display variation's price even if min and max prices are the same
add_filter('woocommerce_available_variation', 'puma_wc_display_variation_price_when_it_the_same', 10, 3);
function puma_wc_display_variation_price_when_it_the_same($variable_product_data, $object, $variation) {
    if ($variable_product_data['price_html'] == '') {
        $variable_product_data['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $variable_product_data;
}

/**
 * Need for output on variable product price under quantity.
 * Also see plugins/woocommerce/includes/wc-template-functions.php:2742
 */
function woocommerce_single_variation() {
    echo '';
}

/**
 * Disable terms and conditions link toggle on checkout page and force it to open in a new tab
 */
add_action( 'wp_enqueue_scripts', 'puma_wc_disable_wc_terms_toggle', 1010 );
function puma_wc_disable_wc_terms_toggle() {
    wp_add_inline_script(
        'wc-checkout',
        "jQuery( document ).ready( function() { jQuery( document.body ).off( 'click', 'a.woocommerce-terms-and-conditions-link' ); } );" );
}