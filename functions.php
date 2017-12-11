<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
/**
 * Set Localization (do not remove).
 * @return void
 */
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Genesis Starter' );
define( 'CHILD_THEME_URL', 'https://github.com/srikat/genesis-starter' );
define( 'CHILD_THEME_VERSION', '2.3.0' );

add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles.
 * @return scripts and styles
 */
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-secondary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 
	'caption', 
	'comment-form', 
	'comment-list', 
	'gallery', 
	'search-form' 
) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( 
	'404-page', 
	'drop-down-menu', 
	'headings', 
	'rems', 
	'search-form', 
	'skip-links' 
) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom logo.
add_theme_support( 'custom-logo', array(
	'width'       => 600,
	'height'      => 160,
	'flex-width' => true,
	'flex-height' => true,
) );

add_filter( 'genesis_seo_title', 'genesis_sample_header_inline_logo', 10, 3 );
/**
 * Add an image inline in the site title element for the logo.
 *
 * @param string $title Current markup of title.
 * @param string $inside Markup inside the title.
 * @param string $wrap Wrapping element for the title.
 *
 * @author @_AlphaBlossom
 * @author @_neilgee
 * @author @_JiveDig
 * @author @_srikat
 */
function genesis_sample_header_inline_logo( $title, $inside, $wrap ) {
	// If the custom logo function and custom logo exist, set the logo image element inside the wrapping tags.
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$inside = sprintf( '<span class="screen-reader-text">%s</span>%s', esc_html( get_bloginfo( 'name' ) ), get_custom_logo() );
	} else {
		// If no custom logo, wrap around the site name.
		$inside	= sprintf( '<a href="%s">%s</a>', trailingslashit( home_url() ), esc_html( get_bloginfo( 'name' ) ) );
	}

	// Build the title.
	$title = genesis_markup( array(
		'open'    => sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ),
		'close'   => "</{$wrap}>",
		'content' => $inside,
		'context' => 'site-title',
		'echo'    => false,
		'params'  => array(
			'wrap' => $wrap,
		),
	) );

	return $title;
}

add_filter( 'genesis_attr_site-description', 'genesis_sample_add_site_description_class' );
/**
 * Add class for screen readers to site description.
 * This will keep the site description markup but will not have any visual presence on the page
 * This runs if there is a logo image set in the Customizer.
 *
 * @param array $attributes Current attributes.
 *
 * @author @_neilgee
 * @author @_srikat
 */
function genesis_sample_add_site_description_class( $attributes ) {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) {
		$attributes['class'] .= ' screen-reader-text';
	}

	return $attributes;
}

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, true );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array(
	'primary'   => __( 'Primary Navigation Menu', 'genesis-sample' ),
	'secondary' => __( 'Secondary Navigation Menu', 'genesis-sample' ),
	'footer'    => __( 'Footer Navigation Menu', 'genesis-sample' ),
) );

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Remove Header Right widget area.
unregister_sidebar( 'header-right' );

// Reposition the primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav' );

// Remove Primary Navigation's structural wrap.
add_theme_support( 'genesis-structural-wraps', array( 
	'header', 
	'menu-secondary', 
	'footer-widgets', 
	'footer' 
) );

add_filter( 'theme_page_templates', 'genesis_sample_remove_genesis_page_templates' );
/**
 * Remove Genesis Page Templates.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/remove-genesis-page-templates
 *
 * @param array $page_templates
 * @return array
 */
function genesis_sample_remove_genesis_page_templates( $page_templates ) {
	unset( $page_templates['page_archive.php'] );
	unset( $page_templates['page_blog.php'] );
	return $page_templates;
}

// Add single post navigation.
add_action( 'genesis_after_entry', 'genesis_prev_next_post_nav' );
add_action( 'genesis_after_loop', 'genesis_adjacent_entry_nav' );

// Display author box on single posts.
// add_filter( 'get_the_author_genesis_author_box_single', '__return_true' );

// Display author box on archive pages.
// add_filter( 'get_the_author_genesis_author_box_archive', '__return_true' );

add_action( 'genesis_theme_settings_metaboxes', 'genesis_sample_remove_metaboxes' );
/**
 * Remove Metaboxes
 * This removes unused or unneeded metaboxes from Genesis > Theme Settings.
 * See /genesis/lib/admin/theme-settings for all metaboxes.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/code/remove-metaboxes-from-genesis-theme-settings/
 */
function genesis_sample_remove_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-blogpage', $_genesis_theme_settings_pagehook, 'main' );
}

// Unregister content/sidebar/sidebar layout setting.
genesis_unregister_layout( 'content-sidebar-sidebar' );

// Unregister sidebar/sidebar/content layout setting.
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Unregister sidebar/content/sidebar layout setting.
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Unregister secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Add typical attributes for footer navigation elements.
add_filter( 'genesis_attr_nav-footer', 'genesis_attributes_nav' );

// Display Footer Navigation Menu above footer content
add_action( 'genesis_footer', 'genesis_sample_do_footernav', 5 );
/**
 * Echo the "Footer Navigation" menu.
 *
 * @uses genesis_nav_menu() Display a navigation menu.
 * @uses genesis_nav_menu_supported() Checks for support of specific nav menu.
 */
function genesis_sample_do_footernav() {

	// Do nothing if menu not supported.
	if ( ! genesis_nav_menu_supported( 'footer' ) ) {
		return;
	}

	$class = 'menu genesis-nav-menu menu-footer';
	if ( genesis_superfish_enabled() ) {
		$class .= ' js-superfish';
	}

	genesis_nav_menu( array(
		'theme_location' => 'footer',
		'menu_class'     => $class,
	) );

}

add_filter( 'genesis_footer_creds_text', 'genesis_sample_footer_creds_filter' );
/**
 * Change Footer text.
 *
 * @link  https://my.studiopress.com/documentation/customization/shortcodes-reference/footer-shortcode-reference/
 */
function genesis_sample_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright before="Copyright "] [footer_childtheme_link before ="&middot; "] on [footer_genesis_link] &middot; [footer_wordpress_link] &middot; [footer_loginout]';

	return $creds;
}
