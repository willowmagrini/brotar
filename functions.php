<?php
/**
 * Odin functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package Odin
 * @since 2.2.0
 */

/**
 * Sets content width.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 600;
}

/**
 * Odin Classes.
 */
require_once get_template_directory() . '/core/classes/class-bootstrap-nav.php';
require_once get_template_directory() . '/inc/class-bootstrap-nav-boaterra.php';

require_once get_template_directory() . '/core/classes/class-shortcodes.php';
require_once get_template_directory() . '/core/classes/class-thumbnail-resizer.php';
// require_once get_template_directory() . '/core/classes/class-theme-options.php';
// require_once get_template_directory() . '/core/classes/class-options-helper.php';
// require_once get_template_directory() . '/core/classes/class-post-type.php';
// require_once get_template_directory() . '/core/classes/class-taxonomy.php';
// require_once get_template_directory() . '/core/classes/class-metabox.php';
// require_once get_template_directory() . '/core/classes/abstracts/abstract-front-end-form.php';
// require_once get_template_directory() . '/core/classes/class-contact-form.php';
// require_once get_template_directory() . '/core/classes/class-post-form.php';
// require_once get_template_directory() . '/core/classes/class-user-meta.php';
// require_once get_template_directory() . '/core/classes/class-post-status.php';
// require_once get_template_directory() . '/core/classes/class-term-meta.php';

/**
 * Odin Widgets.
 */
require_once get_template_directory() . '/core/classes/widgets/class-widget-like-box.php';

/**
 * A Boa Terra Widgets
 */
require_once get_template_directory() . '/inc/widgets.php';

if ( ! function_exists( 'odin_setup_features' ) ) {

	/**
	 * Setup theme features.
	 *
	 * @since 2.2.0
	 */
	function odin_setup_features() {

		/**
		 * Add support for multiple languages.
		 */
		load_theme_textdomain( 'odin', get_template_directory() . '/languages' );

		/**
		 * Register nav menus.
		 */
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'odin' )
			)
		);
		register_nav_menus(
			array(
				'institucional' => __( 'Menu institucional', 'odin' )
			)
		);

		/*
		 * Add post_thumbnails suport.
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add feed link.
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Support Custom Header.
		 */
		$default = array(
			'width'         => 0,
			'height'        => 0,
			'flex-height'   => false,
			'flex-width'    => false,
			'header-text'   => false,
			'default-image' => '',
			'uploads'       => true,
		);

		add_theme_support( 'custom-header', $default );

		/**
		 * Support Custom Background.
		 */
		$defaults = array(
			'default-color' => '',
			'default-image' => '',
		);

		add_theme_support( 'custom-background', $defaults );

		/**
		 * Support Custom Editor Style.
		 */
		add_editor_style( 'assets/css/editor-style.css' );

		/**
		 * Add support for infinite scroll.
		 */
		add_theme_support(
			'infinite-scroll',
			array(
				'type'           => 'scroll',
				'footer_widgets' => false,
				'container'      => 'content',
				'wrapper'        => false,
				'render'         => false,
				'posts_per_page' => get_option( 'posts_per_page' )
			)
		);

		/**
		 * Add support for Post Formats.
		 */
		// add_theme_support( 'post-formats', array(
		//     'aside',
		//     'gallery',
		//     'link',
		//     'image',
		//     'quote',
		//     'status',
		//     'video',
		//     'audio',
		//     'chat'
		// ) );

		/**
		 * Support The Excerpt on pages.
		 */
		// add_post_type_support( 'page', 'excerpt' );

		/**
		 * Switch default core markup for search form, comment form, and comments to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption'
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_image_size( 'mini-thumbnail', 80, 80 );
	}
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text' );    // 2.1 +

function woo_custom_cart_button_text() {

        return __( 'ADICIONAR NO CARRINHO', 'odin' );

}
add_action( 'after_setup_theme', 'odin_setup_features' );

// WooCommerce Checkout Fields Hook
add_filter( 'woocommerce_checkout_fields' , 'hjs_wc_checkout_fields' );


function hjs_wc_checkout_fields( $fields ) {
    $fields['billing']['billing_email']['label'] = 'Email';
    return $fields;
}

/**
 * Register widget areas.
 *
 * @since 2.2.0
 */
function odin_widgets_init() {
	register_sidebar(
		array(
			'name' => __( 'Main Sidebar', 'odin' ),
			'id' => 'main-sidebar',
			'description' => __( 'Site Main Sidebar', 'odin' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h3 class="widgettitle widget-title">',
			'after_title' => '</h3>',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Home E-mail/Mais pedidos Sidebar', 'odin' ),
			'id' => 'home-email-sidebar',
			'description' => __( 'Home E-mail Sidebar', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Home Produtos Sidebar', 'odin' ),
			'id' => 'home-produtos-sidebar',
			'description' => __( 'Home Produtos Sidebar', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Rodapé 1', 'odin' ),
			'id' => 'footer-sidebar',
			'description' => __( 'Footer Sidebar', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);

	register_sidebar(
		array(
			'name' => __( 'Rodapé 2', 'odin' ),
			'id' => 'footer-sidebar-2',
			'description' => __( 'Footer Sidebar 2', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Rodapé 3', 'odin' ),
			'id' => 'footer-sidebar-3',
			'description' => __( 'Footer Sidebar 3', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);
	register_sidebar(
		array(
			'name' => __( 'Rodapé 4', 'odin' ),
			'id' => 'footer-sidebar-4',
			'description' => __( 'Footer Sidebar 4', 'odin' ),
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => '',
		)
	);
}

add_action( 'widgets_init', 'odin_widgets_init' );

/**
 * Flush Rewrite Rules for new CPTs and Taxonomies.
 *
 * @since 2.2.0
 */
function odin_flush_rewrite() {
	flush_rewrite_rules();
}


add_action( 'after_switch_theme', 'odin_flush_rewrite' );

function odin_unlogged_user_body_class( $classes ) {
	if ( ! is_user_logged_in() && ! WCPBZIP()->customer->group_key ) {
		$classes[] = 'unlogged-user';
	}

    // return the $classes array
    return $classes;
}
add_filter( 'body_class', 'odin_unlogged_user_body_class' );

/**
 * Load site scripts.
 *
 * @since 2.2.0
 */
function odin_enqueue_scripts() {
	$template_url = get_template_directory_uri();

	// Loads Odin main stylesheet.
	wp_enqueue_style( 'odin-style', get_stylesheet_uri(), array(), null, 'all' );

	// jQuery.
	wp_enqueue_script( 'jquery' );

	// General scripts.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
		// Bootstrap.
		wp_enqueue_script( 'bootstrap', $template_url . '/assets/js/libs/bootstrap.min.js', array(), null, true );

		// FitVids.
		wp_enqueue_script( 'fitvids', $template_url . '/assets/js/libs/jquery.fitvids.js', array(), null, true );

		// Main jQuery.
		wp_enqueue_script( 'odin-main', $template_url . '/assets/js/main.js', array(), null, true );
	} else {
		// Grunt main file with Bootstrap, FitVids and others libs.
		wp_enqueue_script( 'odin-main-min', $template_url . '/assets/js/main.min.js', array(), null, true );
	}
	wp_localize_script( 'odin-main-min', 'odin', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	$woocommerce_checkout_params = array(
		'ajax_url'                  => WC()->ajax_url(),
		'wc_ajax_url'               => WC_AJAX::get_endpoint( "%%endpoint%%" ),
		'update_order_review_nonce' => wp_create_nonce( 'update-order-review' ),
		'apply_coupon_nonce'        => wp_create_nonce( 'apply-coupon' ),
		'remove_coupon_nonce'       => wp_create_nonce( 'remove-coupon' ),
		'option_guest_checkout'     => get_option( 'woocommerce_enable_guest_checkout' ),
		'checkout_url'              => WC_AJAX::get_endpoint( "checkout" ),
		'is_checkout'               => is_page( wc_get_page_id( 'checkout' ) ) && empty( $wp->query_vars['order-pay'] ) && ! isset( $wp->query_vars['order-received'] ) ? 1 : 0,
		'debug_mode'                => defined('WP_DEBUG') && WP_DEBUG,
		'i18n_checkout_error'       => esc_attr__( 'Error processing checkout. Please try again.', 'woocommerce' ),
	);
	wp_localize_script( 'odin-main-min', 'wc_checkout_params', $woocommerce_checkout_params );


	// Grunt watch livereload in the browser.
	// wp_enqueue_script( 'odin-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );

/**
 * Odin custom stylesheet URI.
 *
 * @since  2.2.0
 *
 * @param  string $uri Default URI.
 * @param  string $dir Stylesheet directory URI.
 *
 * @return string      New URI.
 */
function odin_stylesheet_uri( $uri, $dir ) {
	return $dir . '/assets/css/style.css';
}

add_filter( 'stylesheet_uri', 'odin_stylesheet_uri', 10, 2 );

/**
 * Query WooCommerce activation
 *
 * @since  2.2.6
 *
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		return class_exists( 'woocommerce' ) ? true : false;
	}
}

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/core/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

/**
 * Comments loop.
 */
require_once get_template_directory() . '/inc/comments-loop.php';

/**
 * WP optimize functions.
 */
require_once get_template_directory() . '/inc/optimize.php';

/**
 * Custom template tags.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * WooCommerce compatibility files.
 */
if ( is_woocommerce_activated() ) {
	add_theme_support( 'woocommerce' );
	require get_template_directory() . '/inc/woocommerce/hooks.php';
	require get_template_directory() . '/inc/woocommerce/functions.php';
	require get_template_directory() . '/inc/woocommerce/template-tags.php';
}

/**
 * WP Customizer ( kirki )
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * ACF and Fields.
 */
require_once get_template_directory() . '/inc/acf/acf.php';
require_once get_template_directory() . '/inc/custom-fields.php';
/**
 * Extra WC Fields
 */
require_once get_template_directory() . '/inc/class-extra-fields.php';

/**
 * Order to TXT
 */
require_once get_template_directory() . '/inc/class-order-to-txt.php';

/**
 * Check Delivery
 */
require_once get_template_directory() . '/inc/class-check-delivery.php';
function init_brasa_check_delivery_aboaterra() {
	$error = null;
	if ( $value = get_theme_mod( 'delivery_error', false ) ) {
		$value = htmlspecialchars_decode( $value );
		$error = "<span class='error animated bounceInUp'>{$value}</span>";
	}
	new Brasa_Check_Delivery( null, $error );
}
add_action( 'init', 'init_brasa_check_delivery_aboaterra', 9999 );

