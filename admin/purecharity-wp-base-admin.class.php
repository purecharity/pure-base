<?php

/**
 * The dashboard-specific functionality of the plugin.
 *
 * @link       http://purecharity.com
 * @since      1.0.0
 *
 * @package    Purecharity_Wp_Base
 * @subpackage Purecharity_Wp_Base/admin
 */

/**
 * The dashboard-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the dashboard-specific stylesheet and JavaScript.
 *
 * @package    Purecharity_Wp_Base
 * @subpackage Purecharity_Wp_Base/admin
 * @author     Pure Charity <dev@purecharity.com>
 */
class Purecharity_Wp_Base_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @var      string    $plugin_name       The name of this plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	
	/**
	 * Add the Plugin Settings Menu.
	 *
	 * @since    1.0.0
	 */
	function add_admin_menu(  ) { 
		add_options_page( 'PureBase&#8482; Settings', 'PureBase&#8482;', 'manage_options', 'pure_base', array('Purecharity_Wp_Base_Admin', 'options_page') );
	}

	/**
	 * Checks for the existence of the pure base settings.
	 *
	 * @since    1.0.0
	 */
	public static function settings_exist(  ) { 
		if( false == get_option( 'pure_base_settings' ) ) { 
			add_option( 'pure_base_settings' );
		}
	}

	/**
	 * Initializes the settings page options.
	 *
	 * @since    1.0.0
	 */
	public static function settings_init(  ) 
	{
		register_setting( 'pbPluginPage', 'pure_base_settings' );

		add_settings_section(
			'pure_base_pbPluginPage_section', 
			__( 'General settings', 'wordpress' ), 
			array('Purecharity_Wp_Base_Admin', 'settings_section_callback'),
			'pbPluginPage'
		);

		add_settings_field( 
			'pure_base_mode', 
			__( 'API Mode', 'wordpress' ), 
			array('Purecharity_Wp_Base_Admin', 'api_mode_render'), 
			'pbPluginPage', 
			'pure_base_pbPluginPage_section' 
		);

		add_settings_field( 
			'pure_base_api_key', 
			__( 'API Key', 'wordpress' ), 
			array('Purecharity_Wp_Base_Admin', 'api_key_render'),
			'pbPluginPage', 
			'pure_base_pbPluginPage_section' 
		);

		add_settings_field( 
			'pure_base_main_color', 
			__( 'Main Color', 'wordpress' ), 
			array('Purecharity_Wp_Base_Admin', 'main_color_render'),
			'pbPluginPage', 
			'pure_base_pbPluginPage_section' 
		);
	}

	/**
	 * Renders the select for API Mode [ staging, production ].
	 *
	 * @since    1.0.0
	 */
	public static function api_mode_render(  ) { 

		$options = get_option( 'pure_base_settings' );
		?>
		<select name="pure_base_settings[mode]">
      <option value="sandbox" <?php @selected( $options['mode'], 'sandbox' ); ?> >Sandbox</option>
      <option value="production" <?php @selected( $options['mode'], 'production' ); ?> >Production</option>
      <option value="demo" <?php @selected( $options['mode'], 'demo' ); ?> >Demo</option>
      <option value="development" <?php @selected( $options['mode'], 'development' ); ?> >Development</option>
		</select>

	<?php

	}

	/**
	 * Renders the text field for API Key.
	 *
	 * @since    1.0.0
	 */
	public static function api_key_render(  )
	{ 
		$options = get_option( 'pure_base_settings' );
		?>
		<input type="text" name="pure_base_settings[api_key]" value="<?php echo @$options['api_key']; ?>">
		<?php
	}

	/**
	 * Renders the color picker for main color.
	 *
	 * @since    1.0.0
	 */
	public static function main_color_render(  )
	{ 
		$options = get_option( 'pure_base_settings' );
		?>
		<input type="text" id="main_color" name="pure_base_settings[main_color]" value="<?php echo @$options['main_color']; ?>">
		<?php
	}

	/**
	 * Callback for use with Settings API.
	 *
	 * @since    1.0.0
	 */
	public static function settings_section_callback(  ) 
	{ 
		echo __( 'General settings for the base plugin. Used across the dependent plugins.', 'wordpress' );
	}

	
	/**
	 * Creates the options page.
	 *
	 * @since    1.0.0
	 */
	public static function options_page()
	{
    ?>
    <div class="wrap">
      <form action="options.php" method="post" class="pure-settings-form">
				<?php
					echo '<img align="left" src="' . plugins_url( 'purecharity-wp-base/public/img/purecharity.png' ) . '" > ';
				?>
				<h2 style="padding-left:100px;padding-top: 20px;padding-bottom: 50px;border-bottom: 1px solid #ccc;">PureBase&#8482; Settings</h2>
				
				<?php
				settings_fields( 'pbPluginPage' );
				do_settings_sections( 'pbPluginPage' );
				submit_button();
				?>
				
			</form>
    </div>
    <?php
	}

	/**
	 * Register the stylesheets for the Dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() 
	{
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/spectrum.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/purecharity-wp-base-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the dashboard.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) 
	{
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/purecharity-wp-base-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'admin-color-picker', plugins_url( 'admin/js/spectrum.js' , dirname(__FILE__) ) );
	}

}
