<?php

$woocommerce_installed = in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

if ( $woocommerce_installed ) {


    $files_to_include = array(
        'class_author_post_type.php',
        'class_core.php',
        'class_hooks.php',
        'class_scripts.php',
        'class_meta_boxes.php',
        'class_admin_inputs.php',
        'class_shortcodes.php',
        'elementor-widgets/class_elementor.php',
    );


    foreach ($files_to_include as $file_name){

        $file_path = WOOA_PLUGIN_INC_DIR . DIRECTORY_SEPARATOR . $file_name;

        if( file_exists($file_path) ){

            require_once $file_path;

        }

    }


} else {


    add_action( 'admin_notices', function(){

        $class = 'notice notice-error';

        $message = __("WooCommerce Author Require WooCommerce Being Activated , As We've Checked WooCommerce is Not Installed or Activated", WOOA_TEXT_DOMAIN );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );

    } );

}