<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class MXMPOTMAdminMain
{

	public $plugin_name;

	/*
	* MXMPOTMAdminMain constructor
	*/
	public function __construct()
	{

		$this->plugin_name = MXMPOTM_PLUGN_BASE_NAME;

		$this->mxmpotm_include();

	}

	/*
	* Include the necessary basic files for the admin panel
	*/
	public function mxmpotm_include()
	{

		// require database-talk class
		require_once MXMPOTM_PLUGIN_ABS_PATH . 'includes\admin\class-database-talk.php';

	}

	/*
	* Registration of styles and scripts
	*/
	public function mxmpotm_register()
	{

		// register scripts and styles
		add_action( 'admin_enqueue_scripts', array( $this, 'mxmpotm_enqueue' ) );

		// register admin menu
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );

		// add link Settings under the name of the plugin
		add_filter( "plugin_action_links_$this->plugin_name", array( $this, 'settings_link' ) );

	}

		public function mxmpotm_enqueue()
		{

			// include bootstrap 4.1.1
			if(
				$_GET['page'] == 'mxmpotm-many-points-on-the-map' ||
				$_GET['page'] == 'mxmpotm-many-points-on-the-map-add' ||
				$_GET['page'] == 'mxmpotm-many-points-on-the-map-edit'
			) {

				wp_enqueue_style( 'mxmpotm_bootstrap_4_1_1', MXMPOTM_PLUGIN_URL . 'includes/admin/assets/bootstrap-4.1.1/css/bootstrap.min.css' );

			}

			// include font-awesome
			wp_enqueue_style( 'mxmpotm_font_awesome', MXMPOTM_PLUGIN_URL . 'assets/font-awesome-4.6.3/css/font-awesome.min.css' );

			// include admin_style file
			wp_enqueue_style( 'mxmpotm_admin_style', MXMPOTM_PLUGIN_URL . 'includes/admin/assets/css/style.css', array( 'mxmpotm_font_awesome' ), MXMPOTM_PLUGIN_VERSION, 'all' );

			// include admin_script file
			wp_enqueue_script( 'mxmpotm_admin_script', MXMPOTM_PLUGIN_URL . 'includes/admin/assets/js/script.js', array( 'jquery' ), MXMPOTM_PLUGIN_VERSION, true );

		}

		// register admin menu
		public function add_admin_pages()
		{

			add_menu_page( __( 'List of the maps', 'mxmpotm_map' ), __( 'Many points', 'mxmpotm_map' ), 'manage_options', 'mxmpotm-many-points-on-the-map', array( $this, 'admin_index' ), 'dashicons-image-filter', 111 ); // icons https://developer.wordpress.org/resource/dashicons/#id

			// add map
			add_submenu_page( 'mxmpotm-many-points-on-the-map', __( 'New Map', 'mxmpotm_map' ), __( 'New Map', 'mxmpotm_map' ), 'manage_options', 'mxmpotm-many-points-on-the-map-add', array( $this, 'add_map' ) );

			// edit map
			add_submenu_page( NULL, __( 'Edit Map', 'mxmpotm_map' ), __( 'Edit Map', 'mxmpotm_map' ), 'manage_options', 'mxmpotm-many-points-on-the-map-edit', array( $this, 'edit_map' ) );

		}

			public function admin_index()
			{

				// require index page
				mxmpotm_require_template_admin( 'index.php' );

			}

			public function edit_map()
			{

				// require one_map page
				mxmpotm_require_template_admin( 'one_map.php' );

			}

			public function add_map()
			{
				
				// require add_new_map page
				mxmpotm_require_template_admin( 'add_new_map.php' );

			}

		// add settings link
		public function settings_link( $links )
		{

			$settings_link = '<a href="' . get_admin_url() . 'admin.php?page=mxmpotm-many-points-on-the-map">' . __( 'Settings', 'mxmpotm_map' ) . '</a>'; // options-general.php

			array_push( $links, $settings_link );

			return $links;

		}

}

// Initialize
$initialize_class = new MXMPOTMAdminMain();

// Apply scripts and styles
$initialize_class->mxmpotm_register();