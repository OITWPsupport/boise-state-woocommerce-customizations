<?php
/*
 * Plugin Name: Boise State Woocommerce Customizations
 * Plugin URI: https://github.com/OITWPsupport/boise-state-woocommerce-customizations
 * Description: Provides customizations and a11y fixes for sites using Woocommerce and the Storefront theme. 
 * Version: 0.1.0
 * Author: Kira Davis and David Lentz
 */

defined( 'ABSPATH' ) or die( 'No hackers' );

//-----------------------------------------------------
// Load Script
//-----------------------------------------------------
function load_scripts() {			// Uses JQuery to add titles to buttons.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'script', plugin_dir_url(__FILE__) . '/script.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_style( 'montserrat', 'https://fonts.googleapis.com/css?family=Montserrat' );
}
add_action( 'wp_enqueue_scripts', 'load_scripts' ); 

//-----------------------------------------------------
// Change search text
//-----------------------------------------------------
add_filter( 'get_product_search_form' , 'woo_custom_product_searchform' );

function woo_custom_product_searchform( $form ) {
	
	$form = '<form role="search" method="get" class="woocommerce-product-search" action="' . esc_url( home_url( '/'  ) ) . '">
		<div>
			<label class="screen-reader-text" for="s">' . __( 'Search for:', 'woocommerce' ) . '</label>
			<input type="text" value="' . get_search_query() . '" name="s" title="' . get_option('search_text') . '" placeholder="' . get_option('search_text') . '" />
			<input type="submit" value="'. esc_attr__( 'Search', 'woocommerce' ) .'" />
			<input type="hidden" name="post_type" value="product" />
		</div>
	</form>';
	
	return $form;
}

//-----------------------------------------------------
// Replace Breadcrumb Text
//-----------------------------------------------------
add_filter( 'woocommerce_breadcrumb_defaults', 'woocommerce_filter' );

function woocommerce_filter( $defaults ) {
	if ( get_option('breadcrumb_text') != '') {
		$defaults['home'] = get_option('breadcrumb_text');
	}
	return $defaults;
}

//-----------------------------------------------------
// Admin Page Settings
//-----------------------------------------------------
add_action('admin_menu', 'bsu_breadcrumb_admin_settings');

function bsu_breadcrumb_admin_settings() {
    $page_title = 'Boise State WooCommerce Customizations';
    $menu_title = 'Boise State WooCommerce Customizations';
    $capability = 'edit_posts';
    $menu_slug = 'bsu_breadcrumb_options';
    $function = 'bsu_breadcrumb_admin_settings_page_display';
    $icon_url = '';
    $position = 99;

    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

function breadcrumb_text_field() { ?> 
	<input type="text" name="breadcrumb_text" id="breadcrumb_text" value="<?php echo get_option('breadcrumb_text'); ?>" /> 
<?php }
function search_text_field() { ?> 
	<input type="text" name="search_text" id="search_text" value="<?php echo get_option('search_text'); ?>" /> 
<?php }

function bsu_breadcrumb_display_theme_panel_fields() {
	add_settings_section("breadcrumb-section", "Breadcrumb Settings", null, "breadcrumb-options");
	add_settings_field("breadcrumb_text", "Breadcrumb Text", "breadcrumb_text_field", "breadcrumb-options", "breadcrumb-section");
	register_setting("breadcrumb-section", "breadcrumb_text");	
	add_settings_field("search_text", "Search Placeholder Text", "search_text_field", "breadcrumb-options", "breadcrumb-section");
	register_setting("breadcrumb-section", "search_text");	
}

add_action("admin_init", "bsu_breadcrumb_display_theme_panel_fields");

//-----------------------------------------------------
// Admin Page Display
//-----------------------------------------------------
function bsu_breadcrumb_admin_settings_page_display() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die('You do not have sufficient permissions to access this page.');
	}
	?>
	<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		
		<!-- show error/update messages -->
		<?php settings_errors(); ?>
		
	    <form method="post" action="options.php">
	        <?php
				settings_fields("breadcrumb-section");
				do_settings_sections("breadcrumb-options");      
				submit_button(); 
	        ?>          
		</form>
	</div>
	<?php
}
?>
