<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMPOTMFrontEndMain
{

	/*
	* Registration of styles and scripts
	*/
	public function register()
	{

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );

	}

		public function enqueue()
		{

			wp_enqueue_style( 'mxmpotm_font_awesome', MXMPOTM_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			wp_enqueue_style( 'mxmpotm_style', MXMPOTM_PLUGIN_URL . 'includes/frontend/assets/css/style.css', array( 'mxmpotm_font_awesome' ), MXMPOTM_PLUGIN_VERSION, 'all' );

			wp_enqueue_script( 'mxmpotm_script', MXMPOTM_PLUGIN_URL . 'includes/frontend/assets/js/script.js', array( 'jquery' ), MXMPOTM_PLUGIN_VERSION, false );

		}

}

// Initialize
$initialize_class = new MXMPOTMFrontEndMain();

// Apply scripts and styles
$initialize_class->register();