<?php

/*************************
Lineup the Javascript...
*************************/

add_action( 'wp_enqueue_scripts', 'javascript_includes' );
function javascript_includes() {

	/* Enqueue Tooltipster */
	wp_register_script( 'tooltipster', get_stylesheet_directory_uri() . '/_inc/tooltipster/jquery.tooltipster.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'tooltipster' );

	/* Enqueue General js init */
	wp_register_script( 'fun_init', get_stylesheet_directory_uri() . '/_js/fun.js', array( 'jquery' ), '', true);
	wp_enqueue_script( 'fun_init' );
}

// load css into the website's front-end
function tooltipster_enqueue_style() {
    wp_enqueue_style( 'tooltipster', get_stylesheet_directory_uri() . '/_inc/tooltipster/tooltipster.css' ); 
}
/***/
//
// function bootstrap_enqueue_style() {
//     wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/bootstrap-3.3.5-dist/css/bootstrap.min.css' ); 
// }
// add_action( 'wp_enqueue_scripts', 'bootstrap_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'tooltipster_enqueue_style' );
/***/
